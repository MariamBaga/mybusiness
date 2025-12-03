<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $this->authorize('view tickets');

        $tickets = Ticket::with(['user', 'assignedTo'])
            ->latest()
            ->paginate(10);

        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        $this->authorize('create tickets');
        $users = User::all();
        return view('admin.tickets.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->authorize('create tickets');

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'priority' => 'required|integer|in:1,2,3,4'
        ]);

        Ticket::create([
            'user_id' => $request->user_id,
            'subject' => $request->subject,
            'message' => $request->message,
            'priority' => $request->priority,
            'status' => 'open'
        ]);

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Ticket créé avec succès');
    }

    public function show(Ticket $ticket)
    {
        $this->authorize('view tickets');

        $ticket->load(['replies.user', 'user', 'assignedTo']);
        $agents = User::role(['admin', 'editor'])->get();

        return view('admin.tickets.show', compact('ticket', 'agents'));
    }

    public function edit(Ticket $ticket)
    {
        $this->authorize('edit tickets');

        $users = User::all();
        $agents = User::role(['admin', 'editor'])->get();

        return view('admin.tickets.edit', compact('ticket', 'users', 'agents'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('edit tickets');

        $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
            'priority' => 'required|integer|in:1,2,3,4',
            'status' => 'required|in:open,in_progress,closed,resolved'
        ]);

        $data = $request->only(['assigned_to', 'priority', 'status']);

        // Si le ticket est fermé, enregistrer la date de fermeture
        if ($request->status == 'closed' && $ticket->status != 'closed') {
            $data['closed_at'] = now();
        }

        $ticket->update($data);

        return redirect()->route('admin.tickets.show', $ticket)
            ->with('success', 'Ticket mis à jour avec succès');
    }

    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete tickets');

        // Supprimer les pièces jointes des réponses
        $folder = public_path('StockPiece/ticket-attachments');
        if (file_exists($folder)) {
            foreach ($ticket->replies as $reply) {
                if ($reply->attachment && file_exists($folder . '/' . $reply->attachment)) {
                    unlink($folder . '/' . $reply->attachment);
                }
            }
        }

        // Supprimer les réponses
        $ticket->replies()->delete();

        $ticket->delete();

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Ticket supprimé avec succès');
    }

    public function reply(Request $request, Ticket $ticket)
    {
        $this->authorize('edit tickets');

        $request->validate([
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:2048',
            'is_internal' => 'boolean'
        ]);

        $data = [
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
            'is_internal' => $request->has('is_internal')
        ];

        // Création automatique du dossier
        $folder = public_path('StockPiece/ticket-attachments');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . uniqid() . '.' . $file->extension();
            $file->move($folder, $filename);
            $data['attachment'] = $filename;
        }

        TicketReply::create($data);

        // Mettre à jour le statut du ticket
        if ($ticket->status == 'open') {
            $ticket->update(['status' => 'in_progress']);
        }

        return redirect()->route('admin.tickets.show', $ticket)
            ->with('success', 'Réponse envoyée avec succès');
    }
}
