<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Advertisement;
use App\Models\Product;
use App\Models\Sponsor;
use App\Models\Testimonial;
use App\Models\Partner;

class HomeController extends Controller
{
    public function index()
    {
        // Articles récents du blog
        $posts = Post::where('status', true) // Utilisez 'status' au lieu de 'is_active'
            ->where('published_at', '<=', now())
            ->with(['category', 'author'])
            ->latest()
            ->take(3)
            ->get();

        // Publicités actives - CORRECTION ICI
        $ads = Advertisement::where('status', true) // 'status' et non 'is_active'
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->where('type', '!=', 'admin_only')
            ->inRandomOrder()
            ->take(3)
            ->get();

        // Produits en vedette pour marketplace
        $featuredProducts = Product::where('status', true) // 'status' et non 'is_active'
            ->where('is_featured', true)
            ->with(['partner', 'category'])
            ->orderBy('is_sponsored', 'desc')
            ->take(8)
            ->get();

        // Sponsors et partenaires
        $sponsors = Sponsor::where('status', true) // 'status' et non 'is_active'
            ->orderBy('order')
            ->get();

        // Témoignages - si le modèle existe
        $testimonials = collect([]); // Par défaut collection vide

        if (class_exists(Testimonial::class)) {
            $testimonials = Testimonial::where('is_approved', true)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }

        return view('web.home', compact(
            'posts',
            'ads',
            'featuredProducts',
            'sponsors',
            'testimonials'
        ));
    }
}
