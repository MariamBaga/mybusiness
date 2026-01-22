<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
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
