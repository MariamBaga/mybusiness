<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Advertisement;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(3)->get();

        $ads = Advertisement::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->inRandomOrder()
            ->get();

        return view('web.home', compact('posts', 'ads'));
    }
}
