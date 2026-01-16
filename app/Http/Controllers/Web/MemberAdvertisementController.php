<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberAdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:member']);
    }

    public function index()
    {
        $user = Auth::user();
        $ads = Advertisement::where('advertiser_id', $user->id)
            ->orWhere('advertiser_email', $user->email)
            ->latest()
            ->paginate(10);

        return view('web.member.ads.index', compact('ads'));
    }

    public function create()
    {
        $pricing = [
            'sidebar' => ['price' => 30000, 'name' => 'Encart latéral'],
            'header' => ['price' => 50000, 'name' => 'Bannière header'],
            'footer' => ['price' => 25000, 'name' => 'Bannière footer'],
            'popup' => ['price' => 75000, 'name' => 'Popup']
        ];

        return view('web.member.ads.create', compact('pricing'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:5120',
            'url' => 'required|url',
            'placement' => 'required|in:header,sidebar,footer,popup',
            'duration' => 'required|integer|min:7|max:90'
        ]);

        $user = Auth::user();

        // Calcul du prix
        $prices = [
            'sidebar' => 30000,
            'header' => 50000,
            'footer' => 25000,
            'popup' => 75000
        ];

        $price = $prices[$request->placement] ?? 30000;
        $totalPrice = ($price / 30) * $request->duration;

        // Upload image
        $folder = public_path('StockPiece/ads/member');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $filename = time() . '_' . uniqid() . '.' . $request->image->extension();
        $request->image->move($folder, $filename);

        // Création
        $ad = Advertisement::create([
            'title' => $request->title,
            'image' => $filename,
            'url' => $request->url,
            'placement' => $request->placement,
            'type' => 'banner',
            'start_date' => now(),
            'end_date' => now()->addDays($request->duration),
            'priority' => 5, // Priorité moyenne pour membres
            'status' => false, // En attente validation
            'target' => 'members',
            'advertiser_id' => $user->id,
            'advertiser_name' => $user->name,
            'advertiser_email' => $user->email,
            'price_paid' => $totalPrice,
            'payment_status' => 'pending',
            'duration_days' => $request->duration
        ]);

        return redirect()->route('member.ads.index')
            ->with('success', 'Votre publicité a été soumise. Attente de validation.');
    }

    public function stats(Advertisement $ad)
    {
        $user = Auth::user();

        if ($ad->advertiser_id != $user->id && $ad->advertiser_email != $user->email) {
            abort(403, 'Accès non autorisé');
        }

        return view('web.member.ads.stats', compact('ad'));
    }
}
