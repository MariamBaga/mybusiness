<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Partner;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PartnerProductController extends Controller
{


    public function index()
    {
        $partner = Partner::where('email', Auth::user()->email)->firstOrFail();
        $products = Product::where('partner_id', $partner->id)->latest()->paginate(10);

        return view('web.partner.products.index', compact('products', 'partner'));
    }

    public function create()
    {
        $partner = Partner::where('email', Auth::user()->email)->firstOrFail();
        $categories = Category::where('status', true)->get();

        return view('web.partner.products.create', compact('partner', 'categories'));
    }

    public function store(Request $request)
    {
        $partner = Partner::where('email', Auth::user()->email)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $data = $request->except('image');
        $data['partner_id'] = $partner->id;
        $data['slug'] = Str::slug($request->name);
        $data['status'] = false; // En attente de validation par admin

        // Upload image
        $folder = public_path('StockPiece/products/partner');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $filename = time() . '_' . uniqid() . '.' . $request->image->extension();
        $request->image->move($folder, $filename);
        $data['image'] = $filename;

        Product::create($data);

        return redirect()->route('partner.products.index')
            ->with('success', 'Produit soumis avec succès. Attente de validation.');
    }

    public function edit(Product $product)
    {
        $partner = Partner::where('email', Auth::user()->email)->firstOrFail();

        if ($product->partner_id != $partner->id) {
            abort(403, 'Accès non autorisé');
        }

        $categories = Category::where('status', true)->get();

        return view('web.partner.products.edit', compact('product', 'categories', 'partner'));
    }

    public function update(Request $request, Product $product)
    {
        $partner = Partner::where('email', Auth::user()->email)->firstOrFail();

        if ($product->partner_id != $partner->id) {
            abort(403, 'Accès non autorisé');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $data = $request->except('image');

        if ($request->name != $product->name) {
            $data['slug'] = Str::slug($request->name);
        }

        // Update image if new
        if ($request->hasFile('image')) {
            $folder = public_path('StockPiece/products/partner');

            // Delete old image
            if ($product->image && file_exists($folder . '/' . $product->image)) {
                unlink($folder . '/' . $product->image);
            }

            $filename = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move($folder, $filename);
            $data['image'] = $filename;
        }

        $product->update($data);

        return redirect()->route('partner.products.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Product $product)
    {
        $partner = Partner::where('email', Auth::user()->email)->firstOrFail();

        if ($product->partner_id != $partner->id) {
            abort(403, 'Accès non autorisé');
        }

        // Delete image
        $folder = public_path('StockPiece/products/partner');
        if ($product->image && file_exists($folder . '/' . $product->image)) {
            unlink($folder . '/' . $product->image);
        }

        $product->delete();

        return redirect()->route('partner.products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }

    // Dans PartnerProductController.php, ajoute :
public function show(Product $product)
{
    $partner = Partner::where('email', Auth::user()->email)->firstOrFail();

    if ($product->partner_id != $partner->id) {
        abort(403, 'Accès non autorisé');
    }

    return view('web.partner.products.show', compact('product', 'partner'));
}

public function toggleStatus(Product $product)
{
    $partner = Partner::where('email', Auth::user()->email)->firstOrFail();

    if ($product->partner_id != $partner->id) {
        abort(403, 'Accès non autorisé');
    }

    $product->update(['status' => !$product->status]);

    return back()->with('success', 'Statut du produit mis à jour.');
}

public function toggleFeatured(Product $product)
{
    $partner = Partner::where('email', Auth::user()->email)->firstOrFail();

    if ($product->partner_id != $partner->id) {
        abort(403, 'Accès non autorisé');
    }

    $product->update(['is_featured' => !$product->is_featured]);

    return back()->with('success', 'Produit mis en avant mis à jour.');
}

public function analytics(Product $product)
{
    $partner = Partner::where('email', Auth::user()->email)->firstOrFail();

    if ($product->partner_id != $partner->id) {
        abort(403, 'Accès non autorisé');
    }

    return view('web.partner.products.analytics', compact('product', 'partner'));
}
}
