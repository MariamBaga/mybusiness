<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use App\Models\Partner;
use App\Models\Advertisement;
use App\Models\Document;
use App\Models\Contact;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts'        => Post::count(),
            'products'     => Product::count(),
            'partners'     => Partner::count(),
            'ads'          => Advertisement::count(),
            'documents'    => Document::count(),
            'messages'     => Contact::count(),
            'tickets'      => Ticket::count(),
            'tickets_open' => Ticket::where('status', 'open')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
