<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeoController extends Controller
{
    public function sitemap()
    {
        $posts = Post::where('status', true)
            ->where('published_at', '<=', now())
            ->latest()
            ->get();

        $products = Product::where('status', true)
            ->latest()
            ->get();

        $pages = [
            'about' => now(),
            'features' => now(),
            'pricing' => now(),
            'downloads' => now(),
            'partners' => now(),
            'legal' => now(),
            'privacy' => now(),
            'cookies' => now(),
            'gdpr' => now(),
            'testimonials' => now(),
            'case-studies' => now(),
            'demo' => now(),
            'sponsors' => now(),
            'support' => now()
        ];

        return response()->view('web.seo.sitemap', compact('posts', 'products', 'pages'))
            ->header('Content-Type', 'application/xml');
    }

    public function robots()
    {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /dashboard/\n";
        $content .= "Disallow: /client/\n";
        $content .= "Disallow: /partner/\n";
        $content .= "Disallow: /member/\n";
        $content .= "Sitemap: " . url('/sitemap.xml') . "\n";

        return response($content, 200, ['Content-Type' => 'text/plain']);
    }

    public function manifest()
    {
        $manifest = [
            "name" => "MyBusiness",
            "short_name" => "MyBusiness",
            "start_url" => "/",
            "display" => "standalone",
            "background_color" => "#ffffff",
            "theme_color" => "#007bff",
            "icons" => [
                [
                    "src" => asset("assets/img/icons/icon-72x72.png"),
                    "sizes" => "72x72",
                    "type" => "image/png"
                ],
                [
                    "src" => asset("assets/img/icons/icon-96x96.png"),
                    "sizes" => "96x96",
                    "type" => "image/png"
                ]
            ]
        ];

        return response()->json($manifest);
    }

    // Ajoutez ces méthodes pour les sitemaps multiples
    public function sitemapIndex()
    {
        $sitemaps = [
            ['loc' => url('/sitemap/pages'), 'lastmod' => now()->format('Y-m-d')],
            ['loc' => url('/sitemap/blog'), 'lastmod' => now()->format('Y-m-d')],
            ['loc' => url('/sitemap/products'), 'lastmod' => now()->format('Y-m-d')],
        ];

        return response()->view('web.seo.sitemap-index', compact('sitemaps'))
            ->header('Content-Type', 'application/xml');
    }

    public function pages()
    {
        $pages = [
            'home' => now(),
            'about' => now(),
            'features' => now(),
            'pricing' => now(),
            'downloads' => now(),
            'partners' => now(),
            'legal' => now(),
            'privacy' => now(),
            'cookies' => now(),
            'gdpr' => now(),
            'testimonials' => now(),
            'case-studies' => now(),
            'demo' => now(),
            'sponsors' => now(),
            'support' => now()
        ];

        return response()->view('web.seo.sitemap-pages', compact('pages'))
            ->header('Content-Type', 'application/xml');
    }

    public function blog()
    {
        $posts = Post::where('status', true)
            ->where('published_at', '<=', now())
            ->latest()
            ->get();

        return response()->view('web.seo.sitemap-blog', compact('posts'))
            ->header('Content-Type', 'application/xml');
    }

    public function products()
    {
        $products = Product::where('status', true)
            ->latest()
            ->get();

        return response()->view('web.seo.sitemap-products', compact('products'))
            ->header('Content-Type', 'application/xml');
    }
}
