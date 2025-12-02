<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Partner;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $partners = Partner::all();
        return view('admin.products.create', compact('partners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'partner_id'    => 'required|exists:partners,id',
            'price'         => 'nullable|numeric',
            'stock'         => 'nullable|integer',
            'category'      => 'nullable|string',
            'description'   => 'nullable|string',
            'is_sponsored'  => 'nullable|boolean',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $data = $request->except('image');

        // Création automatique du dossier
        $folder = public_path('StockPiece/products');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Upload image
        if ($request->hasFile('image')) {
            $filename = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move($folder, $filename);
            $data['image'] = $filename;
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Produit créé.');
    }

    public function edit(Product $product)
    {
        $partners = Partner::all();
        return view('admin.products.edit', compact('product', 'partners'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'          => 'required',
            'partner_id'    => 'required|exists:partners,id',
            'price'         => 'nullable|numeric',
            'stock'         => 'nullable|integer',
            'category'      => 'nullable|string',
            'description'   => 'nullable|string',
            'is_sponsored'  => 'nullable|boolean',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $data = $request->except('image');

        // Création du dossier si non existant
        $folder = public_path('StockPiece/products');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Remplacer l’image si nouvelle
        if ($request->hasFile('image')) {

            if ($product->image && file_exists($folder . '/' . $product->image)) {
                unlink($folder . '/' . $product->image);
            }

            $filename = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move($folder, $filename);
            $data['image'] = $filename;
        }

        $product->update($data);

        return back()->with('success', 'Produit mis à jour.');
    }

    public function destroy(Product $product)
    {
        $folder = public_path('StockPiece/products');

        if ($product->image && file_exists($folder . '/' . $product->image)) {
            unlink($folder . '/' . $product->image);
        }

        $product->delete();

        return back()->with('success', 'Produit supprimé.');
    }
}
