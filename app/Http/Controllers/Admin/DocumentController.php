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
            'title' => 'required',
            'file'  => 'required|file|mimes:pdf,doc,docx',
        ]);

        $data = $request->except('file');

        // 📁 créer le dossier si inexistant
        $folder = public_path('StockPiece/documents');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // 📤 upload du fichier
        if ($request->hasFile('file')) {
            $filename = time() . '_' . uniqid() . '.' . $request->file->extension();
            $request->file->move($folder, $filename);
            $data['file'] = $filename;
        }

        Document::create($data);

        return redirect()->route('documents.index')->with('success', 'Document ajouté.');
    }

    public function edit(Document $document)
    {
        return view('admin.documents.edit', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'title' => 'required',
            'file'  => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $data = $request->except('file');

        $folder = public_path('StockPiece/documents');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // 📝 si un nouveau fichier est ajouté
        if ($request->hasFile('file')) {

            // supprimer l’ancien fichier
            if ($document->file && file_exists($folder . '/' . $document->file)) {
                unlink($folder . '/' . $document->file);
            }

            // uploader le nouveau
            $filename = time() . '_' . uniqid() . '.' . $request->file->extension();
            $request->file->move($folder, $filename);
            $data['file'] = $filename;
        }

        $document->update($data);

        return back()->with('success', 'Document mis à jour.');
    }

    public function destroy(Document $document)
    {
        $folder = public_path('StockPiece/documents');

        // 🗑️ supprimer le fichier dans le dossier
        if ($document->file && file_exists($folder . '/' . $document->file)) {
            unlink($folder . '/' . $document->file);
        }

        $document->delete();

        return back()->with('success', 'Document supprimé.');
    }
}
