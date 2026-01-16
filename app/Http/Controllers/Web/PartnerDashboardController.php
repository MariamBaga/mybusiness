<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerDashboardController extends Controller
{
    public function index()
    {
        $partner = Partner::where('email', Auth::user()->email)->firstOrFail();

        $stats = [
            'products' => Product::where('partner_id', $partner->id)->count(),
            'active_products' => Product::where('partner_id', $partner->id)->where('status', true)->count(),
            'featured_products' => Product::where('partner_id', $partner->id)->where('is_featured', true)->count(),
            'total_views' => Product::where('partner_id', $partner->id)->sum('views') ?? 0
        ];

        $recentProducts = Product::where('partner_id', $partner->id)
            ->latest()
            ->take(5)
            ->get();

        return view('web.partner.dashboard', compact('stats', 'recentProducts', 'partner'));
    }

    public function stats()
    {
        $partner = Partner::where('email', Auth::user()->email)->firstOrFail();

        $products = Product::where('partner_id', $partner->id)
            ->withCount(['views'])
            ->orderBy('views_count', 'desc')
            ->get();

        return view('web.partner.stats', compact('partner', 'products'));
    }

    public function profile()
    {
        $partner = Partner::where('email', Auth::user()->email)->firstOrFail();
        return view('web.partner.profile', compact('partner'));
    }

    public function updateProfile(Request $request)
    {
        $partner = Partner::where('email', Auth::user()->email)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:partners,email,' . $partner->id,
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $partner->update($request->all());

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    // Méthodes pour les documents (optionnel)
    public function documents()
    {
        $partner = Partner::where('email', Auth::user()->email)->firstOrFail();
        return view('web.partner.documents', compact('partner'));
    }

    public function uploadDocument(Request $request)
    {
        // Logique pour uploader un document
        return back()->with('success', 'Document téléchargé avec succès.');
    }

    public function deleteDocument($document)
    {
        // Logique pour supprimer un document
        return back()->with('success', 'Document supprimé avec succès.');
    }

    public function downloadDocument($document)
    {
        // Logique pour télécharger un document
        return response()->download($document->path);
    }
}
