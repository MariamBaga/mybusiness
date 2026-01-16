<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminNotificationsController extends Controller
{
    // Afficher toutes les notifications
    public function index(Request $request)
    {
        $user = $request->user();

        return view('notifications.index', [
            'unread' => $user->unreadNotifications,
            'read'   => $user->readNotifications,
        ]);
    }

    // Lire une notification
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);

        $notification->markAsRead();

        return back();
    }

    // Lire toutes les notifications
    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back();
    }
}
