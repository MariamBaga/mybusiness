<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {

        $documents = Document::latest()->paginate(10);
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {

        return view('admin.documents.create');
    }

    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,mp4,webp|max:10240',
            'description' => 'nullable|string',
            'type' => 'required|in:pdf,doc,excel,image,video,other',
            'status' => 'boolean'
        ]);

        $data = $request->except('file');
        $data['status'] = $request->has('status');

        // Création automatique du dossier
        $folder = public_path('StockPiece/documents');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Upload du fichier
       if ($request->hasFile('file')) {

    $file = $request->file('file');

    // Infos AVANT de déplacer
    $data['file_size'] = $file->getSize();
    $data['file_type'] = $file->getMimeType();

    // Nom et emplacement
    $filename = time() . '_' . uniqid() . '.' . $file->extension();

    $file->move(public_path('StockPiece/documents'), $filename);

    $data['file'] = $filename;

    // Slug
    $data['slug'] = \Str::slug($request->title);
}


        Document::create($data);

        return redirect()->route('documents.index')
            ->with('success', 'Document uploadé avec succès');
    }

    public function edit(Document $document)
    {

        return view('admin.documents.edit', compact('document'));
    }

    public function update(Request $request, Document $document)
    {


        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,mp4,webp|max:10240',
            'description' => 'nullable|string',
            'type' => 'required|in:pdf,doc,excel,image,video,other',
            'status' => 'boolean'
        ]);

        $data = $request->except('file');
        $data['status'] = $request->has('status');
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);

        // Création du dossier si non existant
        $folder = public_path('StockPiece/documents');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Remplacer le fichier si nouveau
        if ($request->hasFile('file')) {
            // Supprimer l'ancien fichier s'il existe
            if ($document->file && file_exists($folder . '/' . $document->file)) {
                unlink($folder . '/' . $document->file);
            }

            $file = $request->file('file');
            $filename = time() . '_' . uniqid() . '.' . $file->extension();
            $file->move($folder, $filename);

            $data['file'] = $filename;
            $data['file_size'] = $file->getSize();
            $data['file_type'] = $file->getMimeType();
        }

        $document->update($data);

        return redirect()->route('documents.index')
            ->with('success', 'Document mis à jour avec succès');
    }

    public function destroy(Document $document)
    {


        $folder = public_path('StockPiece/documents');

        if ($document->file && file_exists($folder . '/' . $document->file)) {
            unlink($folder . '/' . $document->file);
        }

        $document->delete();

        return redirect()->route('documents.index')
            ->with('success', 'Document supprimé avec succès');
    }

    public function download(Document $document)
    {


        // Incrémenter le compteur de téléchargements
        $document->increment('download_count');

        $folder = public_path('StockPiece/documents');
        $path = $folder . '/' . $document->file;

        return response()->download($path, $document->title . '.' . pathinfo($document->file, PATHINFO_EXTENSION));
    }
}
