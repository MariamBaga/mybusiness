<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest()->paginate(10);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate(['status' => 'required|string|in:open,pending,closed']);
        $ticket->update(['status' => $request->status]);
        return back()->with('success','Ticket mis à jour.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return back()->with('success','Ticket supprimé.');
    }
}
