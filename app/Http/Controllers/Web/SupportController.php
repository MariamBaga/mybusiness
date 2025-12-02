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

    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Contact::create($request->all());

        return back()->with('success', 'Votre message a été envoyé.');
    }
}
