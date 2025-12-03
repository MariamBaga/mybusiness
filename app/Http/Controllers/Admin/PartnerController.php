<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Product;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {

        $partners = Partner::withCount('products')->latest()->paginate(10);
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {

        return view('admin.partners.create');
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'website' => 'nullable|url',
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'type' => 'required|in:corporate,individual,ngo,government',
            'status' => 'boolean',
            'featured' => 'boolean'
        ]);

        $data = $request->except('logo');
        $data['status'] = $request->has('status');
        $data['featured'] = $request->has('featured');

        // Création automatique du dossier
        $folder = public_path('StockPiece/partners');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Upload logo
        if ($request->hasFile('logo')) {
            $filename = time() . '_' . uniqid() . '.' . $request->logo->extension();
            $request->logo->move($folder, $filename);
            $data['logo'] = $filename;
        }

        Partner::create($data);

        return redirect()->route('partners.index')
            ->with('success', 'Partenaire créé avec succès');
    }

    public function show(Partner $partner)
    {

        $products = $partner->products()->paginate(10);
        return view('admin.partners.show', compact('partner', 'products'));
    }

    public function edit(Partner $partner)
    {

        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'type' => 'required|in:corporate,individual,ngo,government',
            'status' => 'boolean',
            'featured' => 'boolean'
        ]);

        $data = $request->except('logo');
        $data['status'] = $request->has('status');
        $data['featured'] = $request->has('featured');

        // Création du dossier si non existant
        $folder = public_path('StockPiece/partners');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Remplacer le logo si nouveau
        if ($request->hasFile('logo')) {
            // Supprimer l'ancien logo s'il existe
            if ($partner->logo && file_exists($folder . '/' . $partner->logo)) {
                unlink($folder . '/' . $partner->logo);
            }

            $filename = time() . '_' . uniqid() . '.' . $request->logo->extension();
            $request->logo->move($folder, $filename);
            $data['logo'] = $filename;
        }

        $partner->update($data);

        return redirect()->route('partners.index')
            ->with('success', 'Partenaire mis à jour avec succès');
    }

    public function destroy(Partner $partner)
    {


        // Vérifier s'il y a des produits associés
        if ($partner->products()->count() > 0) {
            return redirect()->route('partners.index')
                ->with('error', 'Impossible de supprimer ce partenaire car il a des produits associés');
        }

        $folder = public_path('StockPiece/partners');

        if ($partner->logo && file_exists($folder . '/' . $partner->logo)) {
            unlink($folder . '/' . $partner->logo);
        }

        $partner->delete();

        return redirect()->route('partners.index')
            ->with('success', 'Partenaire supprimé avec succès');
    }
    // Ajoutez ces méthodes à votre contrôleur PartnerController

public function toggleStatus(Partner $partner)
{
    // Autorisation si nécessaire
    // Gate::authorize('update', $partner);

    $partner->update([
        'status' => !$partner->status
    ]);

    return response()->json([
        'message' => $partner->status
            ? 'Partenaire activé avec succès'
            : 'Partenaire désactivé avec succès',
        'status' => $partner->status
    ]);
}

public function toggleFeatured(Partner $partner)
{
    // Autorisation si nécessaire
    // Gate::authorize('update', $partner);

    $partner->update([
        'featured' => !$partner->featured
    ]);

    return response()->json([
        'message' => $partner->featured
            ? 'Partenaire mis en vedette avec succès'
            : 'Partenaire retiré des vedettes avec succès',
        'featured' => $partner->featured
    ]);
}
// Dans PartnerController.php, ajoutez :
public function export(Partner $partner, Request $request)
{
    $format = $request->get('format', 'pdf');

    // Logique d'export selon le format
    // Vous pouvez utiliser des packages comme barryvdh/laravel-dompdf pour PDF
    // ou maatwebsite/excel pour Excel

    // Pour l'instant, retournons une réponse simple
    return response()->json([
        'message' => 'Export fonctionnel',
        'format' => $format,
        'partner' => $partner->name
    ]);
}
}
