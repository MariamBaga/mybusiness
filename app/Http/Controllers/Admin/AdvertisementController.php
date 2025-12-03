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
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'url' => 'nullable|url',
            'placement' => 'required|in:header,sidebar,footer,popup',
            'type' => 'required|in:banner,video,text',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'priority' => 'integer|min:0|max:10',
            'status' => 'boolean'
        ]);

        $data = $request->except('image');
        $data['status'] = $request->has('status');
        $data['views'] = 0;
        $data['clicks'] = 0;

        // Création automatique du dossier
        $folder = public_path('StockPiece/ads');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Upload image
        if ($request->hasFile('image')) {
            $filename = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move($folder, $filename);
            $data['image'] = $filename;
        }

        Advertisement::create($data);

        return redirect()->route('ads.index')
            ->with('success', 'Publicité créée avec succès');
    }

    public function edit(Advertisement $advertisement)
    {

        return view('admin.ads.edit', compact('advertisement'));
    }

    public function update(Request $request, Advertisement $advertisement)
    {


        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'url' => 'nullable|url',
            'placement' => 'required|in:header,sidebar,footer,popup',
            'type' => 'required|in:banner,video,text',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'priority' => 'integer|min:0|max:10',
            'status' => 'boolean'
        ]);

        $data = $request->except('image');
        $data['status'] = $request->has('status');

        // Création du dossier si non existant
        $folder = public_path('StockPiece/ads');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Remplacer l'image si nouvelle
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($advertisement->image && file_exists($folder . '/' . $advertisement->image)) {
                unlink($folder . '/' . $advertisement->image);
            }

            $filename = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move($folder, $filename);
            $data['image'] = $filename;
        }

        $advertisement->update($data);

        return redirect()->route('ads.index')
            ->with('success', 'Publicité mise à jour avec succès');
    }

    public function destroy(Advertisement $advertisement)
    {
       

        $folder = public_path('StockPiece/ads');

        if ($advertisement->image && file_exists($folder . '/' . $advertisement->image)) {
            unlink($folder . '/' . $advertisement->image);
        }

        $advertisement->delete();

        return redirect()->route('ads.index')
            ->with('success', 'Publicité supprimée avec succès');
    }
}
