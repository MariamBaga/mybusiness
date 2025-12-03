<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('posts')
                  ->latest()
                  ->paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:tags',
            'color' => 'nullable|string|max:7',
            'description' => 'nullable|string|max:255'
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'color' => $request->color,
            'description' => $request->description
        ]);

        return redirect()->route('tags.index')
            ->with('success', 'Tag créé avec succès');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:tags,name,' . $tag->id,
            'color' => 'nullable|string|max:7',
            'description' => 'nullable|string|max:255'
        ]);

        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'color' => $request->color,
            'description' => $request->description
        ]);

        return redirect()->route('tags.index')
            ->with('success', 'Tag mis à jour avec succès');
    }

    public function destroy(Tag $tag)
    {
        // Vérifier si le tag est utilisé
        if ($tag->posts()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer ce tag car il est associé à des articles');
        }

        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag supprimé avec succès');
    }
}
