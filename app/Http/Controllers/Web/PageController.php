<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Partner;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Page À propos
     */
    public function about()
    {
        return view('web.pages.about');
    }

    /**
     * Page Fonctionnalités
     */
    public function features()
    {
        return view('web.pages.features');
    }

    /**
     * Page Tarifs
     */
    public function pricing()
    {
        return view('web.pages.pricing');
    }

    /**
     * Page Téléchargements (documents PDF : business plan, brochures…)
     */
    public function downloads()
    {
        $documents = Document::latest()->get();

        return view('web.pages.downloads', compact('documents'));
    }

    /**
     * Page Partenaires & Sponsors
     */
    public function partners()
    {
        $partners = Partner::where('status', true)->get();

        return view('web.pages.partners', compact('partners'));
    }

    /**
     * Page Mentions légales
     */
    public function legal()
    {
        return view('web.pages.legal');
    }

    /**
     * Page Politique de confidentialité
     */
    public function privacy()
    {
        return view('web.pages.privacy');
    }
}
