<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        // Autorisation
        // Gate::authorize('viewAny', Post::class);

        $posts = Post::with(['category', 'tags', 'author'])
            ->latest()
            ->paginate(10);

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.index', compact('posts', 'categories', 'tags'));
    }

    public function create()
    {
        // Autorisation
        // Gate::authorize('create', Post::class);

        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();

        // Récupérer les 5 articles les plus récents
        $recentPosts = Post::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.posts.create', compact('categories', 'tags', 'users', 'recentPosts'));
    }

    public function store(Request $request)
    {
        // Autorisation
        // Gate::authorize('create', Post::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'required|in:draft,published',
            'author_id' => 'nullable|exists:users,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        $data = $request->except(['image', 'tags']);
        $data['slug'] = Str::slug($request->title);
        $data['author_id'] = $request->author_id ?? auth()->id();
        $data['excerpt'] = Str::limit(strip_tags($request->content), 150);

        // Gérer la date de publication
        if ($request->status == 'published' && !$request->has('published_at')) {
            $data['published_at'] = now();
        }

        // Création automatique du dossier
        $folder = public_path('StockPiece/posts');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Upload image
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

        return redirect()->route('posts.index')
            ->with('success', 'Article créé avec succès');
    }

    public function show(Post $post)
    {
        // Autorisation
        // Gate::authorize('view', $post);

        // Charger les relations nécessaires
        $post->load(['category', 'tags', 'author']);

        // Articles similaires (même catégorie)
        $similarPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get();

        // Incrémenter le compteur de vues
        $post->increment('views');

        return view('admin.posts.show', compact('post', 'similarPosts'));
    }

    public function edit(Post $post)
    {
        // Autorisation
        // Gate::authorize('update', $post);

        $categories = Category::all();
        $tags = Tag::all();
        $postTags = $post->tags->pluck('id')->toArray();

        // Récupérer les 5 articles les plus récents
        $recentPosts = Post::with('category')
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(5)
            ->get();

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'postTags', 'recentPosts'));
    }

    public function update(Request $request, Post $post)
    {
        // Autorisation
        // Gate::authorize('update', $post);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'remove_image' => 'nullable|boolean',
        ]);

        $data = $request->except(['image', 'tags', 'remove_image']);
        $data['slug'] = Str::slug($request->title);
        $data['excerpt'] = Str::limit(strip_tags($request->content), 150);

        // Gérer la date de publication
        if ($request->status == 'published' && !$post->published_at) {
            $data['published_at'] = now();
        } elseif ($request->status == 'draft') {
            $data['published_at'] = null;
        }

        // Création du dossier si non existant
        $folder = public_path('StockPiece/posts');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Supprimer l'image si demandé
        if ($request->has('remove_image') && $request->remove_image) {
            if ($post->image && file_exists($folder . '/' . $post->image)) {
                unlink($folder . '/' . $post->image);
            }
            $data['image'] = null;
        }

        // Remplacer l'image si nouvelle
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
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

        return redirect()->route('posts.index')
            ->with('success', 'Article mis à jour avec succès');
    }

    public function destroy(Post $post)
    {
        // Autorisation
        // Gate::authorize('delete', $post);

        $folder = public_path('StockPiece/posts');

        if ($post->image && file_exists($folder . '/' . $post->image)) {
            unlink($folder . '/' . $post->image);
        }

        // Supprimer les relations tags
        $post->tags()->detach();

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Article supprimé avec succès');
    }

    public function toggleStatus(Post $post)
    {
        // Autorisation
        // Gate::authorize('update', $post);

        $newStatus = $post->status == 'published' ? 'draft' : 'published';
        $publishDate = $newStatus == 'published' ? now() : null;

        $post->update([
            'status' => $newStatus,
            'published_at' => $publishDate
        ]);

        return response()->json([
            'message' => $newStatus == 'published'
                ? 'Article publié avec succès'
                : 'Article dépublié avec succès',
            'status' => $newStatus
        ]);
    }
}
