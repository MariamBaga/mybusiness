<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'tags')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $data = $request->except(['image', 'tags']);
        $data['slug'] = Str::slug($request->title);

        // Dossier pour stocker les images de blog
        $folder = public_path('StockPiece/posts');
        if (!file_exists($folder)) mkdir($folder, 0777, true);

        // Upload de l’image
        if ($request->hasFile('image')) {
            $filename = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move($folder, $filename);
            $data['image'] = $filename;
        }

        $post = Post::create($data);

        // Attacher les tags si présents
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('posts.index')->with('success', 'Article créé');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $postTags = $post->tags->pluck('id')->toArray();
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'postTags'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $data = $request->except(['image', 'tags']);
        $data['slug'] = Str::slug($request->title);

        $folder = public_path('StockPiece/posts');
        if (!file_exists($folder)) mkdir($folder, 0777, true);

        // Remplacer l’image si nouvelle
        if ($request->hasFile('image')) {
            if ($post->image && file_exists($folder . '/' . $post->image)) {
                unlink($folder . '/' . $post->image);
            }
            $filename = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move($folder, $filename);
            $data['image'] = $filename;
        }

        $post->update($data);

        // Mettre à jour les tags
        $post->tags()->sync($request->tags ?? []);

        return back()->with('success', 'Article mis à jour');
    }

    public function destroy(Post $post)
    {
        $folder = public_path('StockPiece/posts');

        if ($post->image && file_exists($folder . '/' . $post->image)) {
            unlink($folder . '/' . $post->image);
        }

        // Supprimer les relations tags
        $post->tags()->detach();

        $post->delete();

        return back()->with('success', 'Article supprimé');
    }
}
