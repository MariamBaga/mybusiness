<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketPublicController extends Controller
{
    /**
     * Afficher la liste des tickets de l'utilisateur
     */
    public function index()
    {
        // Vérifier que l'utilisateur est authentifié
        $this->middleware('auth');

        $user = Auth::user();

        $tickets = Ticket::where('user_id', $user->id)
            ->with(['replies', 'assignedTo'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $stats = [
            'open' => Ticket::where('user_id', $user->id)->where('status', 'open')->count(),
            'closed' => Ticket::where('user_id', $user->id)->where('status', 'closed')->count(),
            'total' => Ticket::where('user_id', $user->id)->count()
        ];

        return view('web.tickets.index', compact('tickets', 'stats'));
    }

    /**
     * Afficher le formulaire de création de ticket
     */
    public function create()
    {
        $priorities = [
            1 => ['name' => 'Basse', 'color' => 'success', 'icon' => 'fas fa-arrow-down'],
            2 => ['name' => 'Moyenne', 'color' => 'info', 'icon' => 'fas fa-equals'],
            3 => ['name' => 'Haute', 'color' => 'warning', 'icon' => 'fas fa-arrow-up'],
            4 => ['name' => 'Urgente', 'color' => 'danger', 'icon' => 'fas fa-exclamation-triangle']
        ];

        $categories = [
            'technical' => 'Problème technique',
            'billing' => 'Facturation',
            'account' => 'Compte utilisateur',
            'feature' => 'Demande de fonctionnalité',
            'other' => 'Autre'
        ];

        return view('web.tickets.create', compact('priorities', 'categories'));
    }

    /**
     * Soumettre un nouveau ticket
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'priority' => 'required|integer|in:1,2,3,4',
            'category' => 'required|string|in:technical,billing,account,feature,other',
            'attachment' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,pdf,doc,docx'
        ]);

        try {
            $user = Auth::user();

            $ticket = Ticket::create([
                'user_id' => $user->id,
                'subject' => $request->subject,
                'message' => $request->message,
                'priority' => $request->priority,
                'category' => $request->category,
                'status' => 'open'
            ]);

            // Gérer la pièce jointe
            if ($request->hasFile('attachment')) {
                $folder = public_path('StockPiece/ticket-attachments');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }

                $filename = time() . '_' . uniqid() . '.' . $request->attachment->extension();
                $request->attachment->move($folder, $filename);

                // Créer la première réponse avec la pièce jointe
                TicketReply::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $user->id,
                    'message' => $request->message,
                    'attachment' => $filename,
                    'is_internal' => false
                ]);
            } else {
                // Créer la première réponse sans pièce jointe
                TicketReply::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $user->id,
                    'message' => $request->message,
                    'is_internal' => false
                ]);
            }

            // Envoyer une notification à l'équipe support
            // Notification::sendToSupport('Nouveau ticket', $ticket);

            return redirect()->route('tickets.index')
                ->with('success', 'Votre ticket a été créé avec succès. Nous vous répondrons dans les plus brefs délais.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Erreur lors de la création du ticket : ' . $e->getMessage());
        }
    }

    /**
     * Afficher un ticket spécifique
     */
    public function show(Ticket $ticket)
    {
        // Vérifier que l'utilisateur peut voir ce ticket
        $this->authorize('view', $ticket);

        $ticket->load(['replies.user', 'assignedTo']);

        return view('web.tickets.show', compact('ticket'));
    }

    /**
     * Répondre à un ticket
     */
    public function reply(Request $request, Ticket $ticket)
    {
        // Vérifier que l'utilisateur peut répondre à ce ticket
        $this->authorize('reply', $ticket);

        $request->validate([
            'message' => 'required|string|min:5',
            'attachment' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,pdf,doc,docx'
        ]);

        try {
            $user = Auth::user();

            $data = [
                'ticket_id' => $ticket->id,
                'user_id' => $user->id,
                'message' => $request->message,
                'is_internal' => false
            ];

            // Gérer la pièce jointe
            if ($request->hasFile('attachment')) {
                $folder = public_path('StockPiece/ticket-attachments');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }

                $filename = time() . '_' . uniqid() . '.' . $request->attachment->extension();
                $request->attachment->move($folder, $filename);
                $data['attachment'] = $filename;
            }

            TicketReply::create($data);

            // Mettre à jour le statut du ticket
            $ticket->update(['status' => 'in_progress']);

            return redirect()->route('tickets.show', $ticket)
                ->with('success', 'Votre réponse a été envoyée.');

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'envoi de la réponse : ' . $e->getMessage());
        }
    }

    /**
     * Fermer un ticket
     */
    public function close(Ticket $ticket)
    {
        // Vérifier que l'utilisateur peut fermer ce ticket
        $this->authorize('close', $ticket);

        $ticket->update([
            'status' => 'closed',
            'closed_at' => now()
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Le ticket a été fermé.');
    }

    /**
     * Télécharger une pièce jointe
     */
    public function downloadAttachment(TicketReply $reply)
    {
        // Vérifier que l'utilisateur peut télécharger cette pièce jointe
        $this->authorize('download', $reply);

        $folder = public_path('StockPiece/ticket-attachments');
        $path = $folder . '/' . $reply->attachment;

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    }
}
