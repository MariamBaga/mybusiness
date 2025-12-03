<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        // Récupérer les catégories uniques
        $categories = Faq::select('category')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category');

        // Filtrer par catégorie si spécifiée
        $query = Faq::orderBy('order');

        if (request()->has('category') && request('category') != '') {
            $query->where('category', request('category'));
        }

        if (request()->has('search') && request('search') != '') {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('question', 'LIKE', "%{$search}%")
                  ->orWhere('answer', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%");
            });
        }

        $faqs = $query->paginate(10);

        return view('admin.faqs.index', compact('faqs', 'categories'));
    }

    public function create()
    {
        // Récupérer l'ordre maximum pour la nouvelle FAQ
        $nextOrder = Faq::max('order') + 1;
        return view('admin.faqs.create', compact('nextOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
            'status' => 'boolean'
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'category' => $request->category,
            'status' => $request->has('status'),
            'order' => Faq::max('order') + 1
        ]);

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ créée avec succès');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
            'status' => 'boolean'
        ]);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'category' => $request->category,
            'status' => $request->has('status')
        ]);

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ mise à jour avec succès');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ supprimée avec succès');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $order => $id) {
            Faq::where('id', $id)->update(['order' => $order + 1]);
        }

        return response()->json(['success' => true]);
    }
}
