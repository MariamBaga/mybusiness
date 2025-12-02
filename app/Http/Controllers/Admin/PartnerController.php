<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::latest()->paginate(10);
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'nullable|email',
            'logo'  => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $data = $request->except('logo');

        // Dossier pour stocker les logos des partenaires
        $folder = public_path('StockPiece/partners');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        if ($request->hasFile('logo')) {
            $filename = time() . '_' . uniqid() . '.' . $request->logo->extension();
            $request->logo->move($folder, $filename);
            $data['logo'] = $filename;
        }

        Partner::create($data);

        return redirect()->route('partners.index')->with('success', 'Partenaire créé.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'nullable|email',
            'logo'  => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $data = $request->except('logo');

        $folder = public_path('StockPiece/partners');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Si un nouveau logo est uploadé
        if ($request->hasFile('logo')) {

            // supprimer l’ancien logo
            if ($partner->logo && file_exists($folder . '/' . $partner->logo)) {
                unlink($folder . '/' . $partner->logo);
            }

            // uploader le nouveau
            $filename = time() . '_' . uniqid() . '.' . $request->logo->extension();
            $request->logo->move($folder, $filename);
            $data['logo'] = $filename;
        }

        $partner->update($data);

        return back()->with('success', 'Partenaire mis à jour.');
    }

    public function destroy(Partner $partner)
    {
        $folder = public_path('StockPiece/partners');

        // supprimer le logo si existe
        if ($partner->logo && file_exists($folder . '/' . $partner->logo)) {
            unlink($folder . '/' . $partner->logo);
        }

        $partner->delete();

        return back()->with('success', 'Partenaire supprimé.');
    }
}
