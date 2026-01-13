<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Contact;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function faq()
    {
        $faqs = Faq::where('status', true)->get();
        return view('web.support.faq', compact('faqs'));
    }

    // ✅ Méthode GET pour afficher le formulaire
    public function showContactForm()
    {
        return view('web.support.contact');
    }

    // ✅ Méthode POST pour traiter le formulaire
    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'attachment' => 'nullable|file|max:5120|mimes:pdf,doc,docx,jpg,jpeg,png',
            'privacy' => 'required|accepted',
        ]);

        // Créer le contact
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'new',
        ]);

        // Gérer la pièce jointe (si nécessaire)
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('contacts/attachments', $filename, 'public');

            $contact->update([
                'attachment' => $path,
                'attachment_name' => $file->getClientOriginalName(),
            ]);
        }

        // Ici, vous pouvez ajouter l'envoi d'email
        // Mail::to('contact@mybusiness.ci')->send(new ContactMail($contact));

        return back()->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }
}
