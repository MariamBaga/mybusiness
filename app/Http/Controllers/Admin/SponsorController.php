<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::latest()->paginate(10);
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
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $data = $request->except('logo');

        $folder = public_path('StockPiece/sponsors');
        if (!file_exists($folder)) mkdir($folder, 0777, true);

        if ($request->hasFile('logo')) {
            $filename = time() . '_' . uniqid() . '.' . $request->logo->extension();
            $request->logo->move($folder, $filename);
            $data['logo'] = $filename;
        }

        Sponsor::create($data);

        return redirect()->route('sponsors.index')->with('success', 'Sponsor ajouté.');
    }

    public function edit(Sponsor $sponsor)
    {
        return view('admin.sponsors.edit', compact('sponsor'));
    }

    public function update(Request $request, Sponsor $sponsor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $data = $request->except('logo');

        $folder = public_path('StockPiece/sponsors');
        if (!file_exists($folder)) mkdir($folder, 0777, true);

        if ($request->hasFile('logo')) {
            if ($sponsor->logo && file_exists($folder.'/'.$sponsor->logo)) {
                unlink($folder.'/'.$sponsor->logo);
            }
            $filename = time() . '_' . uniqid() . '.' . $request->logo->extension();
            $request->logo->move($folder, $filename);
            $data['logo'] = $filename;
        }

        $sponsor->update($data);

        return back()->with('success', 'Sponsor mis à jour.');
    }

    public function destroy(Sponsor $sponsor)
    {
        $folder = public_path('StockPiece/sponsors');
        if ($sponsor->logo && file_exists($folder.'/'.$sponsor->logo)) {
            unlink($folder.'/'.$sponsor->logo);
        }
        $sponsor->delete();

        return back()->with('success', 'Sponsor supprimé.');
    }
}
