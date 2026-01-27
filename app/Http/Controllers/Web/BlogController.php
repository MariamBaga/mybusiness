<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;

class BlogController extends Controller
{
  public function index()
{
    // Actuellement :
    $posts = Post::where('status', true)->latest()->paginate(9);

    // Si vous utilisez les statuts 'draft'/'published' :
    $posts = Post::where('status', 'published')->latest()->paginate(9);

    return view('web.blog.index', compact('posts'));
}

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        // Récupérer les articles connexes
        $relatedPosts = Post::where('id', '!=', $post->id)
            ->where(function($query) use ($post) {
                // Articles de même catégorie
                if ($post->category_id) {
                    $query->where('category_id', $post->category_id);
                }
            })
            ->where('status', true) // ou 'published' selon votre structure
            ->latest()
            ->take(3)
            ->get();

        return view('web.blog.show', compact('post', 'relatedPosts'));
    }

}
