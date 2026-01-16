<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvertisementPublicController extends Controller
{
    /**
     * Afficher la page publicitaire
     */
    public function index()
    {
        // Récupérer les tarifs depuis les settings
        $pricing = Setting::where('group', 'ad_pricing')->get()->pluck('value', 'key')->toArray();

        // Formats disponibles
        $formats = [
            'sidebar' => [
                'name' => 'Encart latéral',
                'size' => '300x250px',
                'description' => 'Visible sur toutes les pages du site'
            ],
            'header' => [
                'name' => 'Bannière header',
                'size' => '728x90px',
                'description' => 'En haut de la page d\'accueil'
            ],
            'footer' => [
                'name' => 'Bannière footer',
                'size' => '468x60px',
                'description' => 'En bas de toutes les pages'
            ],
            'popup' => [
                'name' => 'Popup',
                'size' => '600x400px',
                'description' => 'Affichage modal occasionnel'
            ]
        ];

        // Statistiques (exemples)
        $stats = [
            'monthly_visitors' => '25,000+',
            'audience' => 'Commerçants & PME',
            'countries' => '12 pays africains',
            'satisfaction' => '98%'
        ];

        return view('web.advertise.index', compact('pricing', 'formats', 'stats'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create(Request $request)
    {
        // Vérifier si l'utilisateur est connecté
        $user = auth()->user();

        $formats = [
            'sidebar' => 'Encart latéral (300x250) - 50,000 FCFA/mois',
            'header' => 'Bannière header (728x90) - 75,000 FCFA/mois',
            'footer' => 'Bannière footer (468x60) - 40,000 FCFA/mois',
            'popup' => 'Popup (600x400) - 100,000 FCFA/mois'
        ];

        $durations = [
            '7' => '1 semaine',
            '14' => '2 semaines',
            '30' => '1 mois',
            '60' => '2 mois',
            '90' => '3 mois'
        ];

        return view('web.advertise.create', compact('formats', 'durations', 'user'));
    }

    /**
     * Soumettre une nouvelle publicité
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'website' => 'nullable|url',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:5120|dimensions:max_width=1200,max_height=800',
            'placement' => 'required|in:header,sidebar,footer,popup',
            'duration' => 'required|in:7,14,30,60,90',
            'target_url' => 'required|url',
            'description' => 'nullable|string',
            'agree_terms' => 'required|accepted'
        ]);

        try {
            DB::beginTransaction();

            // Calculer le prix selon le format et la durée
            $prices = [
                'sidebar' => 50000,
                'header' => 75000,
                'footer' => 40000,
                'popup' => 100000
            ];

            $price = $prices[$request->placement] ?? 50000;
            $duration = (int) $request->duration;
            $totalPrice = ($price / 30) * $duration; // Prix journalier

            // Sauvegarder l'image
            $folder = public_path('StockPiece/ads/public');
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move($folder, $filename);

            // Créer la publicité (statut pending)
            $ad = Advertisement::create([
                'title' => $request->title,
                'image' => $filename,
                'url' => $request->target_url,
                'placement' => $request->placement,
                'type' => 'banner',
                'start_date' => now(),
                'end_date' => now()->addDays($duration),
                'priority' => 0,
                'status' => false, // En attente de paiement
                'target' => 'public',
                'advertiser_name' => $request->company_name,
                'advertiser_email' => $request->email,
                'advertiser_phone' => $request->phone,
                'advertiser_website' => $request->website,
                'price_paid' => $totalPrice,
                'payment_status' => 'pending',
                'duration_days' => $duration,
                'description' => $request->description
            ]);

            DB::commit();

            // Rediriger vers la page de paiement
            return redirect()->route('advertise.payment', ['ad' => $ad->id])
                ->with('success', 'Votre publicité a été soumise avec succès. Veuillez procéder au paiement.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    /**
     * Afficher la page de paiement
     */
    public function payment(Advertisement $ad)
    {
        // Vérifier que la publicité est en attente de paiement
        if ($ad->payment_status != 'pending') {
            return redirect()->route('advertise.index')
                ->with('error', 'Cette publicité a déjà été traitée.');
        }

        // Méthodes de paiement disponibles
        $paymentMethods = [
            'orange_money' => [
                'name' => 'Orange Money',
                'icon' => 'fas fa-mobile-alt',
                'instructions' => 'Envoyez le montant au +225 07 00 00 00 00'
            ],
            'mtn_money' => [
                'name' => 'MTN Mobile Money',
                'icon' => 'fas fa-money-bill-wave',
                'instructions' => 'Envoyez le montant au +225 05 00 00 00 00'
            ],
            'wave' => [
                'name' => 'Wave',
                'icon' => 'fas fa-wave-square',
                'instructions' => 'Scannez le QR Code avec l\'application Wave'
            ],
            'card' => [
                'name' => 'Carte bancaire',
                'icon' => 'far fa-credit-card',
                'instructions' => 'Paiement sécurisé via Stripe'
            ]
        ];

        return view('web.advertise.payment', compact('ad', 'paymentMethods'));
    }

    /**
     * Traiter le paiement
     */
    public function processPayment(Request $request, Advertisement $ad)
    {
        $request->validate([
            'payment_method' => 'required|in:orange_money,mtn_money,wave,card',
            'transaction_id' => 'required|string|max:100',
            'proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        try {
            DB::beginTransaction();

            // Sauvegarder la preuve de paiement
            $proofPath = null;
            if ($request->hasFile('proof')) {
                $folder = public_path('StockPiece/payments');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }

                $proofName = time() . '_' . uniqid() . '.' . $request->proof->extension();
                $request->proof->move($folder, $proofName);
                $proofPath = $proofName;
            }

            // Mettre à jour la publicité
            $ad->update([
                'payment_method' => $request->payment_method,
                'transaction_id' => $request->transaction_id,
                'payment_proof' => $proofPath,
                'payment_status' => 'processing', // En attente de validation manuelle
                'submitted_at' => now()
            ]);

            DB::commit();

            // Envoyer une notification à l'admin
            // Notification::sendAdmin('Nouveau paiement publicitaire', $ad);

            return redirect()->route('advertise.index')
                ->with('success', 'Votre paiement a été soumis avec succès. Nous vous contacterons après validation.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors du traitement du paiement : ' . $e->getMessage());
        }
    }

    /**
     * Voir les tarifs
     */
    public function pricing()
    {
        $pricing = [
            'sidebar' => [
                'name' => 'Encart latéral',
                'price' => '50,000 FCFA',
                'period' => 'par mois',
                'features' => [
                    'Taille : 300x250px',
                    'Visible sur toutes les pages',
                    'Statistiques détaillées',
                    'Modification illimitée'
                ]
            ],
            'header' => [
                'name' => 'Bannière header',
                'price' => '75,000 FCFA',
                'period' => 'par mois',
                'features' => [
                    'Taille : 728x90px',
                    'Position premium',
                    'Taux de clics élevé',
                    'Support prioritaire'
                ]
            ],
            'popup' => [
                'name' => 'Popup',
                'price' => '100,000 FCFA',
                'period' => 'par mois',
                'features' => [
                    'Taille : 600x400px',
                    'Impact maximum',
                    'Fréquence contrôlée',
                    'Animations possibles'
                ]
            ]
        ];

        return view('web.advertise.pricing', compact('pricing'));
    }
}
