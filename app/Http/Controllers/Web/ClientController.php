<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    // SUPPRIME CE CONSTRUCTEUR
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function dashboard()
    {
        $user = Auth::user();

        $stats = [
            'tickets' => Ticket::where('user_id', $user->id)->count(),
            'open_tickets' => Ticket::where('user_id', $user->id)->where('status', 'open')->count(),
            'documents' => Document::where('status', true)->count(),
            'notifications' => $user->unreadNotifications()->count()
        ];

        $recentTickets = Ticket::where('user_id', $user->id)
            ->with(['replies'])
            ->latest()
            ->take(5)
            ->get();

        return view('web.client.dashboard', compact('stats', 'recentTickets'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('web.client.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string'
        ]);

        $user->update($request->only(['name', 'email', 'phone', 'company', 'address']));

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    public function billing()
    {
        $user = Auth::user();
        // À compléter avec votre logique de facturation
        return view('web.client.billing');
    }

    public function documents()
    {
        $user = Auth::user();
        $documents = Document::where('status', true)->get();

        return view('web.client.documents', compact('documents'));
    }

    public function notifications()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(10);

        return view('web.client.notifications', compact('notifications'));
    }

    // AJOUTE CES MÉTHODES MANQUANTES POUR TES ROUTES
    public function deleteNotification($notification)
    {
        $user = Auth::user();
        $user->notifications()->where('id', $notification)->delete();

        return back()->with('success', 'Notification supprimée.');
    }

    public function clearNotifications()
    {
        $user = Auth::user();
        $user->notifications()->delete();

        return back()->with('success', 'Toutes les notifications ont été supprimées.');
    }

    public function updateNotificationSettings(Request $request)
    {
        $user = Auth::user();
        // Logique pour mettre à jour les préférences de notifications
        return back()->with('success', 'Paramètres de notifications mis à jour.');
    }
}
