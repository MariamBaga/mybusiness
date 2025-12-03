<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index()
    {

        $sponsors = Sponsor::orderBy('order')->paginate(10);
        return view('admin.sponsors.index', compact('sponsors'));
    }

    public function create()
    {
       
        return view('admin.sponsors.create');
    }

    public function store(Request $request)
    {
       

        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'url' => 'nullable|url',
            'description' => 'nullable|string',
            'level' => 'required|in:platinum,gold,silver,bronze',
            'status' => 'boolean'
        ]);

        $data = $request->except('logo');
        $data['status'] = $request->has('status');
        $data['order'] = Sponsor::max('order') + 1;

        // Création automatique du dossier
        $folder = public_path('StockPiece/sponsors');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Upload logo
        if ($request->hasFile('logo')) {
            $filename = time() . '_' . uniqid() . '.' . $request->logo->extension();
            $request->logo->move($folder, $filename);
            $data['logo'] = $filename;
        }

        Sponsor::create($data);

        return redirect()->route('sponsors.index')
            ->with('success', 'Sponsor créé avec succès');
    }

    public function edit(Sponsor $sponsor)
    {

        return view('admin.sponsors.edit', compact('sponsor'));
    }

    public function update(Request $request, Sponsor $sponsor)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'url' => 'nullable|url',
            'description' => 'nullable|string',
            'level' => 'required|in:platinum,gold,silver,bronze',
            'status' => 'boolean'
        ]);

        $data = $request->except('logo');
        $data['status'] = $request->has('status');

        // Création du dossier si non existant
        $folder = public_path('StockPiece/sponsors');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Remplacer le logo si nouveau
        if ($request->hasFile('logo')) {
            // Supprimer l'ancien logo s'il existe
            if ($sponsor->logo && file_exists($folder . '/' . $sponsor->logo)) {
                unlink($folder . '/' . $sponsor->logo);
            }

            $filename = time() . '_' . uniqid() . '.' . $request->logo->extension();
            $request->logo->move($folder, $filename);
            $data['logo'] = $filename;
        }

        $sponsor->update($data);

        return redirect()->route('sponsors.index')
            ->with('success', 'Sponsor mis à jour avec succès');
    }

    public function destroy(Sponsor $sponsor)
    {


        $folder = public_path('StockPiece/sponsors');

        if ($sponsor->logo && file_exists($folder . '/' . $sponsor->logo)) {
            unlink($folder . '/' . $sponsor->logo);
        }

        $sponsor->delete();

        return redirect()->route('admin.sponsors.index')
            ->with('success', 'Sponsor supprimé avec succès');
    }

    public function updateOrder(Request $request)
    {


        foreach ($request->order as $order => $id) {
            Sponsor::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }
}
