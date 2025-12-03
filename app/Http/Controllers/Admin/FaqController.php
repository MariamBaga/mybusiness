<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $this->authorize('view faqs');
        $faqs = Faq::orderBy('order')->paginate(10);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $this->authorize('create faqs');
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create faqs');

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
        $this->authorize('edit faqs');
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $this->authorize('edit faqs');

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
        $this->authorize('delete faqs');
        $faq->delete();

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ supprimée avec succès');
    }

    public function updateOrder(Request $request)
    {
        $this->authorize('edit faqs');

        foreach ($request->order as $order => $id) {
            Faq::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }
}
