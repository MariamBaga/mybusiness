<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index()
    {
        $ads = Advertisement::latest()->paginate(10);
        return view('admin.ads.index', compact('ads'));
    }

    public function create()
    {
        return view('admin.ads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'placement'   => 'required|string',
        ]);

        $data = $request->except('image');

        // 📁 Créer le dossier si inexistant
        $folder = public_path('StockPiece/ads');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // 📤 Upload de l’image
        if ($request->hasFile('image')) {
            $filename = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move($folder, $filename);
            $data['image'] = $filename;
        }

        Advertisement::create($data);

        return redirect()->route('ads.index')->with('success', 'Publicité créée.');
    }

    public function edit(Advertisement $ad)
    {
        return view('admin.ads.edit', compact('ad'));
    }

    public function update(Request $request, Advertisement $ad)
    {
        $request->validate([
            'title'       => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'placement'   => 'required|string',
        ]);

        $data = $request->except('image');

        // 📁 dossier
        $folder = public_path('StockPiece/ads');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // 📤 Nouvelle image ?
        if ($request->hasFile('image')) {

            // Supprimer l’ancienne image
            if ($ad->image && file_exists($folder . '/' . $ad->image)) {
                unlink($folder . '/' . $ad->image);
            }

            // Upload de la nouvelle
            $filename = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move($folder, $filename);
            $data['image'] = $filename;
        }

        $ad->update($data);

        return back()->with('success', 'Publicité mise à jour.');
    }

    public function destroy(Advertisement $ad)
    {
        $folder = public_path('StockPiece/ads');

        // 🗑️ supprimer l’image
        if ($ad->image && file_exists($folder . '/' . $ad->image)) {
            unlink($folder . '/' . $ad->image);
        }

        $ad->delete();

        return back()->with('success', 'Publicité supprimée.');
    }
}
