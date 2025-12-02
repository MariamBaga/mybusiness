<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::latest()->paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Tag::create($request->all());
        return redirect()->route('tags.index')->with('success','Tag ajouté.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $tag->update($request->all());
        return back()->with('success','Tag mis à jour.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back()->with('success','Tag supprimé.');
    }
}
