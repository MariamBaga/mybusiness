<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Contact;
use App\Models\Document; // Si vous avez un modèle Document pour les guides
use App\Models\Guide; // Si vous avez un modèle Guide
use App\Models\Category; // Si vous avez un modèle Category
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupportController extends Controller
{
    public function faq()
    {
        $faqs = Faq::where('status', true)->get();
        return view('web.support.faq', compact('faqs'));
    }

    // ✅ Méthode pour afficher tous les guides
    public function guides()
    {
        // Si vous avez un modèle Guide, utilisez-le :
        // $guides = Guide::where('status', 'published')->get();

        // Pour l'instant, utilisez des données de test
        $categories = [
            [
                'slug' => 'getting-started',
                'name' => 'Premiers pas',
                'icon' => 'fas fa-rocket',
                'color' => 'text-primary',
                'count' => 5,
                'guides' => [
                    [
                        'title' => 'Comment créer votre premier compte',
                        'description' => 'Guide étape par étape pour créer votre compte',
                        'icon' => 'fas fa-user-plus',
                        'color' => 'text-primary',
                        'duration' => '5 min',
                        'date' => '15 Jan 2024',
                        'url' => route('support.guides.show', 'creer-compte')
                    ]
                ]
            ],
            [
                'slug' => 'gestion-compte',
                'name' => 'Gestion du compte',
                'icon' => 'fas fa-user-cog',
                'color' => 'text-success',
                'count' => 8,
                'guides' => [
                    [
                        'title' => 'Modifier votre profil',
                        'description' => 'Personnalisez les informations de votre profil',
                        'icon' => 'fas fa-user-edit',
                        'color' => 'text-success',
                        'duration' => '8 min',
                        'date' => '20 Fév 2024',
                        'url' => route('support.guides.show', 'modifier-profil')
                    ]
                ]
            ],
            [
                'slug' => 'facturation',
                'name' => 'Facturation & Paiements',
                'icon' => 'fas fa-credit-card',
                'color' => 'text-warning',
                'count' => 6,
                'guides' => []
            ],
            [
                'slug' => 'fonctionnalites-avancees',
                'name' => 'Fonctionnalités avancées',
                'icon' => 'fas fa-cogs',
                'color' => 'text-danger',
                'count' => 12,
                'guides' => []
            ]
        ];

        $popularGuides = [
            [
                'title' => 'Démarrer avec MyBusiness',
                'description' => 'Guide complet pour commencer à utiliser notre plateforme',
                'icon' => 'fas fa-rocket',
                'color' => 'text-primary',
                'duration' => '15 min',
                'views' => 1250,
                'url' => route('support.guides.show', 'demarrage-mybusiness')
            ],
            [
                'title' => 'Gérer votre profil',
                'description' => 'Apprenez à personnaliser les paramètres de votre profil',
                'icon' => 'fas fa-user-cog',
                'color' => 'text-success',
                'duration' => '8 min',
                'views' => 980,
                'url' => route('support.guides.show', 'gerer-profil')
            ],
            [
                'title' => 'Guide des méthodes de paiement',
                'description' => 'Comment ajouter et gérer les méthodes de paiement',
                'icon' => 'fas fa-credit-card',
                'color' => 'text-warning',
                'duration' => '10 min',
                'views' => 756,
                'url' => route('support.guides.show', 'methodes-paiement')
            ]
        ];

        $videos = [
            [
                'title' => 'Introduction à MyBusiness',
                'duration' => '5:30',
                'url' => '#'
            ],
            [
                'title' => 'Aperçu du tableau de bord',
                'duration' => '8:15',
                'url' => '#'
            ],
            [
                'title' => 'Tutoriel des paramètres de profil',
                'duration' => '6:45',
                'url' => '#'
            ]
        ];

        $downloads = [
            [
                'name' => 'Manuel utilisateur PDF',
                'type' => 'pdf',
                'size' => '2.4 MB',
                'url' => '#'
            ],
            [
                'name' => 'Guide de démarrage rapide',
                'type' => 'pdf',
                'size' => '1.2 MB',
                'url' => '#'
            ],
            [
                'name' => 'Documentation API',
                'type' => 'zip',
                'size' => '4.8 MB',
                'url' => '#'
            ]
        ];

        return view('web.support.guides', compact('categories', 'popularGuides', 'videos', 'downloads'));
    }

    // ✅ Méthode pour afficher les guides par catégorie
    public function guidesByCategory($category)
    {
        // Récupérer les guides par catégorie
        // $guides = Guide::where('category_slug', $category)->where('status', 'published')->get();

        // Pour l'instant, utilisez des données de test
        $categoryName = ucfirst(str_replace('-', ' ', $category));

        return view('support.guides-category', [
            'category' => $category,
            'categoryName' => $categoryName,
            // 'guides' => $guides
        ]);
    }

    // ✅ Méthode pour afficher le guide du débutant
    public function beginnerGuide()
    {
        return view('web.support.beginner-guide');
    }

    // ✅ Méthode pour afficher les vidéos
    public function videos()
    {
        return view('web.support.videos');
    }

    // ✅ Méthode pour afficher un guide spécifique
    public function showGuide($slug)
    {
        // Récupérer le guide depuis la base de données
        // $guide = Guide::where('slug', $slug)->where('status', 'published')->firstOrFail();

        // Pour l'instant, utilisez des données de test
        $guide = [
            'title' => 'Guide : ' . ucfirst(str_replace('-', ' ', $slug)),
            'content' => 'Contenu du guide...',
            'created_at' => now(),
            'views' => 150
        ];

        return view('web.support.guide-show', compact('guide', 'slug'));
    }

    // ✅ Méthode GET pour afficher le formulaire de contact
    public function showContactForm()
    {
        return view('web.support.contact');
    }

    // ✅ Méthode POST pour traiter le formulaire de contact
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
