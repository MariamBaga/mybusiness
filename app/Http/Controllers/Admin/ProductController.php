<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Partner;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['partner', 'category'])->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $partners = Partner::where('status', true)->get();
        $categories = Category::where('status', true)->get();
        return view('admin.products.create', compact('partners', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'specifications' => 'nullable|array',
            'specifications.key' => 'nullable|array',
            'specifications.value' => 'nullable|array',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_sponsored' => 'boolean',
            'status' => 'boolean'
        ]);

        $data = $request->except('image', 'specifications');
        $data['status'] = $request->has('status');
        $data['is_featured'] = $request->has('is_featured');
        $data['is_sponsored'] = $request->has('is_sponsored');

        // Générer le slug automatiquement
        $data['slug'] = $this->generateUniqueSlug($request->name);

        // Traitement des spécifications
        if ($request->has('specifications') &&
            isset($request->specifications['key']) &&
            isset($request->specifications['value'])) {

            $specifications = [];
            $keys = $request->specifications['key'] ?? [];
            $values = $request->specifications['value'] ?? [];

            // Créer un tableau associatif avec les clés/valeurs non vides
            foreach ($keys as $index => $key) {
                if (!empty(trim($key)) && isset($values[$index]) && !empty(trim($values[$index]))) {
                    $specifications[trim($key)] = trim($values[$index]);
                }
            }

            $data['specifications'] = !empty($specifications) ? json_encode($specifications, JSON_UNESCAPED_UNICODE) : null;
        } else {
            $data['specifications'] = null;
        }

        // Traitement de l'image dans public/StockPiece/products
        if ($request->hasFile('image')) {
            $folder = public_path('StockPiece/products');

            // Créer le dossier s'il n'existe pas
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            // Générer un nom de fichier unique
            $filename = time() . '_' . uniqid() . '.' . $request->image->extension();

            // Déplacer l'image
            $request->image->move($folder, $filename);

            $data['image'] = $filename;
        }

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Produit créé avec succès');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $partners = Partner::where('status', true)->get();
        $categories = Category::where('status', true)->get();
        return view('admin.products.edit', compact('product', 'partners', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'specifications' => 'nullable|array',
            'specifications.key' => 'nullable|array',
            'specifications.value' => 'nullable|array',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_sponsored' => 'boolean',
            'status' => 'boolean'
        ]);

        $data = $request->except('image', 'specifications');
        $data['status'] = $request->has('status');
        $data['is_featured'] = $request->has('is_featured');
        $data['is_sponsored'] = $request->has('is_sponsored');

        // Générer un nouveau slug si le nom a changé
        if ($request->name != $product->name) {
            $data['slug'] = $this->generateUniqueSlug($request->name, $product->id);
        }

        // Traitement des spécifications
        if ($request->has('specifications') &&
            isset($request->specifications['key']) &&
            isset($request->specifications['value'])) {

            $specifications = [];
            $keys = $request->specifications['key'] ?? [];
            $values = $request->specifications['value'] ?? [];

            // Créer un tableau associatif avec les clés/valeurs non vides
            foreach ($keys as $index => $key) {
                if (!empty(trim($key)) && isset($values[$index]) && !empty(trim($values[$index]))) {
                    $specifications[trim($key)] = trim($values[$index]);
                }
            }

            $data['specifications'] = !empty($specifications) ? json_encode($specifications, JSON_UNESCAPED_UNICODE) : null;
        } else {
            $data['specifications'] = null;
        }

        // Traitement de l'image
        if ($request->hasFile('image')) {
            $folder = public_path('StockPiece/products');

            // Créer le dossier s'il n'existe pas
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            // Supprimer l'ancienne image si elle existe
            if ($product->image && file_exists($folder . '/' . $product->image)) {
                unlink($folder . '/' . $product->image);
            }

            // Générer un nom de fichier unique
            $filename = time() . '_' . uniqid() . '.' . $request->image->extension();

            // Déplacer l'image
            $request->image->move($folder, $filename);

            $data['image'] = $filename;
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produit mis à jour avec succès');
    }

    public function destroy(Product $product)
    {
        // Supprimer l'image
        $folder = public_path('StockPiece/products');
        if ($product->image && file_exists($folder . '/' . $product->image)) {
            unlink($folder . '/' . $product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produit supprimé avec succès');
    }

    /**
     * Générer un slug unique
     *
     * @param string $name
     * @param int|null $excludeId
     * @return string
     */
    private function generateUniqueSlug($name, $excludeId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        // Vérifier si le slug existe déjà
        $query = Product::where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;

            $query = Product::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }
}
