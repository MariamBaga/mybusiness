@extends('adminlte::page')

@section('title', 'Ticket #' . $ticket->id)

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>
        <i class="fas fa-ticket-alt text-primary"></i>
        Ticket #{{ $ticket->id }} : {{ $ticket->subject }}
    </h1>
    <div>
        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Modifier
        </a>
        <a href="{{ route('tickets.index') }}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>
</div>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
    <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}">Tickets</a></li>
    <li class="breadcrumb-item active">Ticket #{{ $ticket->id }}</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Conversation du ticket -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">
                    <i class="fas fa-comments"></i> Conversation
                </h3>
            </div>
            <div class="card-body p-0">
                <!-- Message initial du ticket -->
                <div class="direct-chat-msg ticket-message">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">
                            <i class="fas fa-user"></i> {{ $ticket->user->name }}
                        </span>
                        <span class="direct-chat-timestamp float-right">
                            {{ $ticket->created_at->format('d/m/Y H:i') }}
                            @if($ticket->created_at->diffInDays() > 0)
                                ({{ $ticket->created_at->diffForHumans() }})
                            @endif
                        </span>
                    </div>
                    @if($ticket->user->avatar)
                        <img class="direct-chat-img" src="{{ asset('storage/' . $ticket->user->avatar) }}" alt="{{ $ticket->user->name }}">
                    @else
                        <div class="direct-chat-img bg-secondary text-white d-flex align-items-center justify-content-center">
                            {{ strtoupper(substr($ticket->user->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="direct-chat-text bg-light">
                        {!! nl2br(e($ticket->message)) !!}
                    </div>
                </div>

                <!-- Réponses -->
                @foreach($ticket->replies->sortBy('created_at') as $reply)
                <div class="direct-chat-msg {{ $reply->user_id == auth()->id() ? 'right' : '' }} {{ $reply->is_internal ? 'internal-reply' : '' }}">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-{{ $reply->user_id == auth()->id() ? 'right' : 'left' }}">
                            <i class="fas fa-{{ $reply->user_id == auth()->id() ? 'user-shield' : 'user' }}"></i>
                            {{ $reply->user->name }}
                            @if($reply->is_internal)
                                <span class="badge badge-info ml-1">Interne</span>
                            @endif
                        </span>
                        <span class="direct-chat-timestamp float-{{ $reply->user_id == auth()->id() ? 'left' : 'right' }}">
                            {{ $reply->created_at->format('d/m/Y H:i') }}
                            @if($reply->created_at->diffInDays() > 0)
                                ({{ $reply->created_at->diffForHumans() }})
                            @endif
                        </span>
                    </div>
                    @if($reply->user->avatar)
                        <img class="direct-chat-img" src="{{ asset('storage/' . $reply->user->avatar) }}" alt="{{ $reply->user->name }}">
                    @else
                        <div class="direct-chat-img bg-{{ $reply->user_id == auth()->id() ? 'primary' : 'secondary' }} text-white d-flex align-items-center justify-content-center">
                            {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="direct-chat-text {{ $reply->user_id == auth()->id() ? 'bg-primary' : 'bg-light' }} {{ $reply->user_id == auth()->id() ? 'text-white' : '' }}">
                        {!! nl2br(e($reply->message)) !!}

                        @if($reply->attachment)
                        <div class="mt-2">
                            <a href="{{ asset('StockPiece/ticket-attachments/' . $reply->attachment) }}"
                               target="_blank"
                               class="btn btn-sm btn-{{ $reply->user_id == auth()->id() ? 'light' : 'primary' }}">
                                <i class="fas fa-paperclip"></i> Pièce jointe
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Formulaire de réponse -->
        <div class="card mt-3">
            <div class="card-header bg-success text-white">
                <h3 class="card-title mb-0">
                    <i class="fas fa-reply"></i> Répondre au ticket
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('tickets.reply', $ticket->id) }}" method="POST" enctype="multipart/form-data" id="replyForm">
                    @csrf

                    <div class="form-group">
                        <label for="reply_message">Votre message *</label>
                        <textarea name="message"
                                  id="reply_message"
                                  class="form-control"
                                  rows="5"
                                  required
                                  placeholder="Tapez votre réponse ici..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file"
                                           name="attachment"
                                           id="attachment"
                                           class="custom-file-input">
                                    <label class="custom-file-label" for="attachment" id="attachmentLabel">
                                        Ajouter une pièce jointe (optionnel)
                                    </label>
                                </div>
                                <small class="text-muted">
                                    Formats acceptés: tous les fichiers. Max: 2 MB
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-control custom-switch mt-3">
                                    <input type="checkbox"
                                           name="is_internal"
                                           class="custom-control-input"
                                           id="is_internal"
                                           value="1">
                                    <label class="custom-control-label" for="is_internal">
                                        Message interne (visible seulement par le support)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-success" id="submitReplyBtn">
                            <i class="fas fa-paper-plane"></i> Envoyer la réponse
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Informations du ticket -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h3 class="card-title mb-0">
                    <i class="fas fa-info-circle"></i> Informations du ticket
                </h3>
            </div>
            <div class="card-body">
                <!-- Statut -->
                <div class="mb-3">
                    <h6><i class="fas fa-flag"></i> Statut</h6>
                    @php
                        $statusColors = [
                            'open' => 'success',
                            'in_progress' => 'warning',
                            'closed' => 'secondary',
                            'resolved' => 'info'
                        ];
                        $statusLabels = [
                            'open' => 'Ouvert',
                            'in_progress' => 'En cours',
                            'closed' => 'Fermé',
                            'resolved' => 'Résolu'
                        ];
                    @endphp
                    <span class="badge badge-{{ $statusColors[$ticket->status] }} p-2">
                        {{ $statusLabels[$ticket->status] }}
                    </span>
                </div>

                <!-- Priorité -->
                <div class="mb-3">
                    <h6><i class="fas fa-exclamation-circle"></i> Priorité</h6>
                    <span class="badge badge-{{ $ticket->priority_color }} p-2">
                        {{ $ticket->priority_label }}
                    </span>
                </div>

                <!-- Client -->
                <div class="mb-3">
                    <h6><i class="fas fa-user"></i> Client</h6>
                    <div class="d-flex align-items-center">
                        @if($ticket->user->avatar)
                            <img src="{{ asset('storage/' . $ticket->user->avatar) }}"
                                 alt="{{ $ticket->user->name }}"
                                 class="img-circle img-sm mr-2">
                        @else
                            <div class="img-circle img-sm bg-secondary text-white d-flex align-items-center justify-content-center mr-2" style="width: 32px; height: 32px;">
                                {{ strtoupper(substr($ticket->user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <strong>{{ $ticket->user->name }}</strong><br>
                            <small class="text-muted">{{ $ticket->user->email }}</small>
                        </div>
                    </div>
                </div>

                <!-- Assigné à -->
                <div class="mb-3">
                    <h6><i class="fas fa-user-tie"></i> Assigné à</h6>
                    @if($ticket->assignedTo)
                        <div class="d-flex align-items-center">
                            @if($ticket->assignedTo->avatar)
                                <img src="{{ asset('storage/' . $ticket->assignedTo->avatar) }}"
                                     alt="{{ $ticket->assignedTo->name }}"
                                     class="img-circle img-sm mr-2">
                            @else
                                <div class="img-circle img-sm bg-primary text-white d-flex align-items-center justify-content-center mr-2" style="width: 32px; height: 32px;">
                                    {{ strtoupper(substr($ticket->assignedTo->name, 0, 1)) }}
                                </div>
                            @endif
                            <span>{{ $ticket->assignedTo->name }}</span>
                        </div>
                    @else
                        <span class="text-muted">Non assigné</span>
                        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('PUT')
                            <div class="input-group input-group-sm">
                                <select name="assigned_to" class="form-control form-control-sm">
                                    <option value="">-- Assigner à --</option>
                                    @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>

                <!-- Dates -->
                <div class="mb-3">
                    <h6><i class="fas fa-calendar-alt"></i> Dates</h6>
                    <ul class="list-unstyled small">
                        <li><strong>Créé:</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</li>
                        <li><strong>Dernière réponse:</strong>
                            @if($ticket->replies->count() > 0)
                                {{ $ticket->replies->last()->created_at->format('d/m/Y H:i') }}
                            @else
                                Aucune
                            @endif
                        </li>
                        @if($ticket->closed_at)
                            <li><strong>Fermé:</strong> {{ $ticket->closed_at->format('d/m/Y H:i') }}</li>
                        @endif
                    </ul>
                </div>

                <!-- Actions rapides -->
                <div class="mt-4">
                    <h6><i class="fas fa-bolt"></i> Actions rapides</h6>
                    <div class="btn-group btn-group-sm w-100" role="group">
                        @if($ticket->status != 'closed')
                        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="closed">
                            <button type="submit" class="btn btn-secondary" onclick="return confirm('Fermer ce ticket ?')">
                                <i class="fas fa-times"></i> Fermer
                            </button>
                        </form>
                        @endif

                        @if($ticket->status != 'resolved')
                        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="resolved">
                            <button type="submit" class="btn btn-info" onclick="return confirm('Marquer comme résolu ?')">
                                <i class="fas fa-check"></i> Résolu
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="card mt-3">
            <div class="card-header bg-secondary text-white">
                <h3 class="card-title mb-0">
                    <i class="fas fa-chart-bar"></i> Statistiques
                </h3>
            </div>
            <div class="card-body">
                <ul class="list-unstyled small">
                    <li class="mb-2">
                        <i class="fas fa-comments text-primary mr-1"></i>
                        <strong>Réponses:</strong> {{ $ticket->replies->count() }}
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-clock text-warning mr-1"></i>
                        <strong>Âge du ticket:</strong> {{ $ticket->created_at->diffForHumans() }}
                    </li>
                    @if($ticket->replies->count() > 0)
                    <li class="mb-2">
                        <i class="fas fa-sync-alt text-info mr-1"></i>
                        <strong>Temps de réponse moyen:</strong>
                        {{ calculateAverageResponseTime($ticket) }}
                    </li>
                    @endif
                    <li class="mb-2">
                        <i class="fas fa-paperclip text-success mr-1"></i>
                        <strong>Pièces jointes:</strong>
                        {{ $ticket->replies->whereNotNull('attachment')->count() }}
                    </li>
                    <li>
                        <i class="fas fa-user-shield text-danger mr-1"></i>
                        <strong>Messages internes:</strong>
                        {{ $ticket->replies->where('is_internal', true)->count() }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .direct-chat-msg {
        margin-bottom: 10px;
        padding: 15px;
        border-bottom: 1px solid #f4f4f4;
    }
    .direct-chat-msg:last-child {
        border-bottom: none;
    }
    .direct-chat-msg.right {
        background-color: rgba(0,123,255,0.05);
    }
    .direct-chat-msg.internal-reply {
        background-color: rgba(108,117,125,0.1);
        border-left: 3px solid #6c757d;
    }
    .direct-chat-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }
    .direct-chat-text {
        margin-left: 50px;
        margin-right: 50px;
        padding: 10px 15px;
        border-radius: 8px;
        position: relative;
    }
    .direct-chat-msg.right .direct-chat-text {
        margin-left: 50px;
        margin-right: 0;
    }
    .ticket-message {
        background-color: #f8f9fa;
        border-radius: 8px;
        margin: 0;
        padding: 15px;
    }
    .ticket-message .direct-chat-text {
        background-color: #fff;
        border: 1px solid #dee2e6;
    }
    .custom-file-label::after {
        content: "Parcourir";
    }
</style>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const attachmentInput = document.getElementById('attachment');
    const attachmentLabel = document.getElementById('attachmentLabel');
    const submitReplyBtn = document.getElementById('submitReplyBtn');
    const replyForm = document.getElementById('replyForm');

    // Gestion du fichier joint
    if (attachmentInput) {
        attachmentInput.addEventListener('change', function(e) {
            if (this.files.length) {
                const file = this.files[0];
                attachmentLabel.textContent = file.name;

                // Vérification de la taille
                const maxSize = 2 * 1024 * 1024; // 2 MB
                if (file.size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Fichier trop volumineux',
                        text: 'La taille maximale autorisée est de 2 MB',
                    });
                    this.value = '';
                    attachmentLabel.textContent = 'Ajouter une pièce jointe (optionnel)';
                }
            } else {
                attachmentLabel.textContent = 'Ajouter une pièce jointe (optionnel)';
            }
        });
    }

    // Validation du formulaire de réponse
    if (replyForm) {
        replyForm.addEventListener('submit', function(e) {
            const messageTextarea = document.getElementById('reply_message');

            // Vérifier que le message n'est pas vide
            if (!messageTextarea.value.trim()) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Message vide',
                    text: 'Veuillez saisir un message pour votre réponse',
                });
                messageTextarea.focus();
                return;
            }

            // Désactiver le bouton pour éviter les doubles clics
            submitReplyBtn.disabled = true;
            submitReplyBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi...';
        });
    }

    // Scroll automatique vers le bas de la conversation
    function scrollToBottom() {
        const conversation = document.querySelector('.card-body');
        if (conversation) {
            conversation.scrollTop = conversation.scrollHeight;
        }
    }

    // Initial scroll
    setTimeout(scrollToBottom, 100);
});
</script>
@stop

@php
function calculateAverageResponseTime($ticket) {
    $replies = $ticket->replies->sortBy('created_at');
    $totalSeconds = 0;
    $count = 0;

    $lastTime = $ticket->created_at;

    foreach ($replies as $reply) {
        $responseTime = $lastTime->diffInSeconds($reply->created_at);
        $totalSeconds += $responseTime;
        $count++;
        $lastTime = $reply->created_at;
    }

    if ($count === 0) return 'Aucune réponse';

    $averageSeconds = $totalSeconds / $count;

    if ($averageSeconds < 60) {
        return round($averageSeconds) . ' sec';
    } elseif ($averageSeconds < 3600) {
        return round($averageSeconds / 60) . ' min';
    } elseif ($averageSeconds < 86400) {
        return round($averageSeconds / 3600) . ' h';
    } else {
        return round($averageSeconds / 86400) . ' jours';
    }
}
@endphp
