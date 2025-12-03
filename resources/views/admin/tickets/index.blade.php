@extends('adminlte::page')

@section('title', 'Gestion des tickets')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-ticket-alt text-primary"></i>
            Gestion des tickets
        </h1>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Créer un ticket
        </a>
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3 class="card-title">Liste des tickets</h3>
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    <!-- Filtres rapides -->
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-filter"></i> Filtres
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item {{ !request('status') ? 'active' : '' }}" href="{{ route('tickets.index') }}">Tous les tickets</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ request('status') == 'open' ? 'active' : '' }}" href="{{ route('tickets.index', ['status' => 'open']) }}">
                                <span class="badge badge-success mr-2">●</span> Ouverts
                            </a>
                            <a class="dropdown-item {{ request('status') == 'in_progress' ? 'active' : '' }}" href="{{ route('tickets.index', ['status' => 'in_progress']) }}">
                                <span class="badge badge-warning mr-2">●</span> En cours
                            </a>
                            <a class="dropdown-item {{ request('status') == 'closed' ? 'active' : '' }}" href="{{ route('tickets.index', ['status' => 'closed']) }}">
                                <span class="badge badge-secondary mr-2">●</span> Fermés
                            </a>
                            <a class="dropdown-item {{ request('status') == 'resolved' ? 'active' : '' }}" href="{{ route('tickets.index', ['status' => 'resolved']) }}">
                                <span class="badge badge-info mr-2">●</span> Résolus
                            </a>
                        </div>
                    </div>

                    <!-- Recherche -->
                    <form action="{{ route('tickets.index') }}" method="GET" class="d-inline-block">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-door-open"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tickets ouverts</span>
                        <span class="info-box-number">{{ $openCount ?? Ticket::where('status', 'open')->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-tasks"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">En cours</span>
                        <span class="info-box-number">{{ $openCount }}</span>

                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-check-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Résolus</span>
                        <span class="info-box-number">{{ $resolvedCount }}</span>

                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary"><i class="fas fa-times-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Fermés</span>
                        <span class="info-box-number">{{ $closedCount ?? Ticket::where('status', 'closed')->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des tickets -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th width="60">ID</th>
                        <th>Sujet</th>
                        <th>Client</th>
                        <th>Priorité</th>
                        <th>Statut</th>
                        <th>Assigné à</th>
                        <th>Créé le</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                    <tr class="{{ $ticket->status == 'closed' ? 'table-secondary' : '' }}">
                        <td class="text-center">
                            <strong>#{{ $ticket->id }}</strong>
                        </td>
                        <td>
                            <a href="{{ route('tickets.show', $ticket->id) }}" class="font-weight-bold">
                                {{ Str::limit($ticket->subject, 50) }}
                            </a>
                            <br>
                            <small class="text-muted">
                                {{ Str::limit($ticket->message, 70) }}
                            </small>
                        </td>
                        <td>
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
                        </td>
                        <td>
                            <span class="badge badge-{{ $ticket->priority_color }} p-2">
                                <i class="fas fa-flag"></i> {{ $ticket->priority_label }}
                            </span>
                        </td>
                        <td>
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
                            <span class="badge badge-{{ $statusColors[$ticket->status] ?? 'secondary' }}">
                                {{ $statusLabels[$ticket->status] ?? $ticket->status }}
                            </span>
                        </td>
                        <td>
                            @if($ticket->assignedTo)
                                <div class="d-flex align-items-center">
                                    @if($ticket->assignedTo->avatar)
                                        <img src="{{ asset('storage/' . $ticket->assignedTo->avatar) }}"
                                             alt="{{ $ticket->assignedTo->name }}"
                                             class="img-circle img-sm mr-2">
                                    @else
                                        <div class="img-circle img-sm bg-info text-white d-flex align-items-center justify-content-center mr-2" style="width: 32px; height: 32px;">
                                            {{ strtoupper(substr($ticket->assignedTo->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span>{{ $ticket->assignedTo->name }}</span>
                                </div>
                            @else
                                <span class="text-muted">Non assigné</span>
                            @endif
                        </td>
                        <td>
                            {{ $ticket->created_at->format('d/m/Y') }}<br>
                            <small class="text-muted">{{ $ticket->created_at->format('H:i') }}</small>
                            @if($ticket->closed_at)
                                <br>
                                <small class="text-danger">
                                    <i class="fas fa-clock"></i> Fermé le {{ $ticket->closed_at->format('d/m/Y') }}
                                </small>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('tickets.show', $ticket->id) }}"
                                   class="btn btn-info"
                                   title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('tickets.edit', $ticket->id) }}"
                                   class="btn btn-warning"
                                   title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-danger"
                                        title="Supprimer"
                                        onclick="confirmDelete({{ $ticket->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                            <!-- Formulaire de suppression caché -->
                            <form id="delete-form-{{ $ticket->id }}"
                                  action="{{ route('tickets.destroy', $ticket->id) }}"
                                  method="POST"
                                  style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fas fa-ticket-alt fa-3x mb-3"></i>
                            <h5>Aucun ticket trouvé</h5>
                            <p class="mb-4">Il n'y a aucun ticket pour le moment</p>
                            <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Créer un ticket
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($tickets->hasPages())
        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $tickets->links() }}
            </div>
            <div class="float-left">
                <small class="text-muted">
                    Affichage de {{ $tickets->firstItem() }} à {{ $tickets->lastItem() }} sur {{ $tickets->total() }} tickets
                </small>
            </div>
        </div>
        @endif
    </div>
</div>
@stop

@section('css')
<style>
    .info-box {
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 0;
    }
    .info-box-icon {
        border-radius: 8px 0 0 8px;
    }
    .table tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    .img-circle {
        border-radius: 50%;
    }
    .img-sm {
        width: 32px;
        height: 32px;
        object-fit: cover;
    }
    .btn-group .btn {
        margin-right: 2px;
    }
    .btn-group .btn:last-child {
        margin-right: 0;
    }
</style>
@stop

@section('js')
<script>
// Fonction de confirmation de suppression
function confirmDelete(id) {
    Swal.fire({
        title: 'Confirmer la suppression',
        html: 'Êtes-vous sûr de vouloir supprimer ce ticket ?<br><small class="text-danger">Cette action est irréversible. Toutes les réponses seront également supprimées.</small>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    });
}

// Fonction pour fermer rapidement un ticket
function quickClose(id) {
    Swal.fire({
        title: 'Fermer le ticket',
        text: 'Êtes-vous sûr de vouloir fermer ce ticket ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, fermer',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            // Envoyer la requête AJAX
            fetch(`/admin/tickets/${id}/close`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'Le ticket a été fermé avec succès',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    throw new Error(data.message || 'Erreur lors de la fermeture');
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: error.message || 'Une erreur est survenue',
                });
            });
        }
    });
}

// Initialiser les tooltips
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@stop
