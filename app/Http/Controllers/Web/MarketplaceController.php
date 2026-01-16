<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Partner;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    /**
     * Afficher la marketplace publique
     */
    public function index(Request $request)
    {
        // Récupérer les paramètres de filtrage
        $query = Product::where('status', true)
            ->with(['partner', 'category'])
            ->whereHas('partner', function ($q) {
                $q->where('status', true);
            });

        // Filtrage par catégorie
        if ($request->has('category') && $request->category != 'all') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filtrage par partenaire
        if ($request->has('partner')) {
            $query->where('partner_id', $request->partner);
        }

        // Filtrage par prix
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Recherche
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('short_description', 'LIKE', "%{$search}%");
            });
        }

        // Tri
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'featured':
                $query->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default: // 'newest'
                $query->latest();
                break;
        }

        // Produits sponsorisés en premier
        $sponsoredProducts = Product::where('status', true)
            ->where('is_sponsored', true)
            ->with(['partner', 'category'])
            ->inRandomOrder()
            ->take(4)
            ->get();

        // Pagination
        $products = $query->paginate(12)->withQueryString();

        // Données pour les filtres
        $categories = Category::where('status', true)->get();
        $partners = Partner::where('status', true)->get();

        return view('web.marketplace.index', compact(
            'products',
            'sponsoredProducts',
            'categories',
            'partners'
        ));
    }

    /**
     * Afficher un produit
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', true)
            ->with(['partner', 'category'])
            ->whereHas('partner', function ($q) {
                $q->where('status', true);
            })
            ->firstOrFail();

        // Produits similaires (même catégorie ou partenaire)
        $similarProducts = Product::where('status', true)
            ->where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                $query->where('category_id', $product->category_id)
                      ->orWhere('partner_id', $product->partner_id);
            })
            ->with(['partner', 'category'])
            ->inRandomOrder()
            ->take(4)
            ->get();

        // Incrémenter les vues (si vous avez un champ pour ça)
        // $product->increment('views');

        return view('web.marketplace.show', compact('product', 'similarProducts'));
    }

    /**
     * Rediriger vers le site du partenaire
     */
    public function redirectToPartner(Request $request, Product $product)
    {
        // Vérifier si le produit a une URL de redirection
        if ($product->partner_contact_email || $product->partner_product_url) {
            // Logique de suivi de clic
            $product->increment('redirect_count');

            // Redirection
            if ($product->partner_product_url) {
                return redirect()->away($product->partner_product_url);
            }

            // Ou ouvrir l'email client
            $email = $product->partner_contact_email;
            return redirect()->to("mailto:{$email}?subject=Demande d'information sur {$product->name}");
        }

        return back()->with('error', 'Aucune information de contact disponible pour ce produit.');
    }
}
