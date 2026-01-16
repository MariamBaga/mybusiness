@extends('layouts.master')

@section('title', 'Mes Tickets - Support MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Mes Tickets',
        'active' => 'Support technique'
    ])
</section>

<!-- =========================
    MES TICKETS
========================= -->
<section class="section-padding">
    <div class="container">
        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-2">Tickets ouverts</h6>
                        <h3 class="display-5 fw-bold text-primary">{{ $stats['open'] }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-2">Tickets fermés</h6>
                        <h3 class="display-5 fw-bold text-success">{{ $stats['closed'] }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-2">Tickets totaux</h6>
                        <h3 class="display-5 fw-bold text-info">{{ $stats['total'] }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-2">Temps moyen</h6>
                        <h3 class="display-5 fw-bold text-warning">2 jours</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barre d'actions -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">
                            <i class="fas fa-ticket-alt me-2"></i>
                            Mes Tickets de Support
                        </h4>
                        <p class="text-muted mb-0">
                            Gérez toutes vos demandes d'assistance
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Nouveau Ticket
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <select class="form-select" id="statusFilter" onchange="applyFilters()">
                            <option value="">Tous les statuts</option>
                            <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Ouvert</option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>En cours</option>
                            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Fermé</option>
                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Résolu</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" id="priorityFilter" onchange="applyFilters()">
                            <option value="">Toutes les priorités</option>
                            <option value="1" {{ request('priority') == '1' ? 'selected' : '' }}>Basse</option>
                            <option value="2" {{ request('priority') == '2' ? 'selected' : '' }}>Moyenne</option>
                            <option value="3" {{ request('priority') == '3' ? 'selected' : '' }}>Haute</option>
                            <option value="4" {{ request('priority') == '4' ? 'selected' : '' }}>Urgente</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" id="categoryFilter" onchange="applyFilters()">
                            <option value="">Toutes les catégories</option>
                            <option value="technical" {{ request('category') == 'technical' ? 'selected' : '' }}>Technique</option>
                            <option value="billing" {{ request('category') == 'billing' ? 'selected' : '' }}>Facturation</option>
                            <option value="account" {{ request('category') == 'account' ? 'selected' : '' }}>Compte</option>
                            <option value="feature" {{ request('category') == 'feature' ? 'selected' : '' }}>Fonctionnalité</option>
                            <option value="other" {{ request('category') == 'other' ? 'selected' : '' }}>Autre</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <button class="btn btn-outline-secondary w-100" onclick="resetFilters()">
                            <i class="fas fa-redo me-1"></i>Réinitialiser
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des tickets -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                @if($tickets->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Sujet</th>
                                    <th>Catégorie</th>
                                    <th>Priorité</th>
                                    <th>Statut</th>
                                    <th>Créé le</th>
                                    <th>Dernière réponse</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                <tr>
                                    <td>
                                        <strong>#{{ $ticket->id }}</strong>
                                    </td>
                                    <td>
                                        <a href="{{ route('tickets.show', $ticket) }}" class="text-decoration-none">
                                            {{ Str::limit($ticket->subject, 50) }}
                                        </a>
                                        <div class="mt-1">
                                            <small class="text-muted">
                                                {{ $ticket->replies_count ?? 0 }} réponses
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $categoryColors = [
                                                'technical' => 'info',
                                                'billing' => 'warning',
                                                'account' => 'success',
                                                'feature' => 'primary',
                                                'other' => 'secondary'
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $categoryColors[$ticket->category] ?? 'secondary' }}">
                                            {{ $ticket->category }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $priorityData = [
                                                1 => ['name' => 'Basse', 'color' => 'success', 'icon' => 'arrow-down'],
                                                2 => ['name' => 'Moyenne', 'color' => 'info', 'icon' => 'equals'],
                                                3 => ['name' => 'Haute', 'color' => 'warning', 'icon' => 'arrow-up'],
                                                4 => ['name' => 'Urgente', 'color' => 'danger', 'icon' => 'exclamation-triangle']
                                            ];
                                            $priority = $priorityData[$ticket->priority] ?? $priorityData[2];
                                        @endphp
                                        <span class="badge bg-{{ $priority['color'] }}">
                                            <i class="fas fa-{{ $priority['icon'] }} me-1"></i>
                                            {{ $priority['name'] }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'open' => 'success',
                                                'in_progress' => 'info',
                                                'closed' => 'secondary',
                                                'resolved' => 'primary'
                                            ];
                                            $statusIcons = [
                                                'open' => 'clock',
                                                'in_progress' => 'spinner',
                                                'closed' => 'check-circle',
                                                'resolved' => 'thumbs-up'
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusColors[$ticket->status] ?? 'secondary' }}">
                                            <i class="fas fa-{{ $statusIcons[$ticket->status] ?? 'question' }} me-1"></i>
                                            {{ $ticket->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="d-block">
                                            {{ $ticket->created_at->format('d/m/Y') }}
                                        </small>
                                        <small class="text-muted">
                                            {{ $ticket->created_at->format('H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        @if($ticket->latest_reply)
                                        <small class="d-block">
                                            {{ $ticket->latest_reply->created_at->diffForHumans() }}
                                        </small>
                                        <small class="text-muted">
                                            par {{ $ticket->latest_reply->user->name ?? 'Système' }}
                                        </small>
                                        @else
                                        <small class="text-muted">Pas de réponse</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary border-0"
                                                    type="button"
                                                    data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                   href="{{ route('tickets.show', $ticket) }}">
                                                    <i class="fas fa-eye me-2"></i>Voir
                                                </a>
                                                <a class="dropdown-item"
                                                   href="{{ route('tickets.show', $ticket) }}#reply">
                                                    <i class="fas fa-reply me-2"></i>Répondre
                                                </a>
                                                @if($ticket->status !== 'closed')
                                                <form action="{{ route('tickets.close', $ticket) }}"
                                                      method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-times-circle me-2"></i>Fermer
                                                    </button>
                                                </form>
                                                @endif
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('tickets.destroy', $ticket) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="dropdown-item text-danger"
                                                            onclick="return confirm('Supprimer ce ticket ?')">
                                                        <i class="fas fa-trash me-2"></i>Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($tickets->hasPages())
                    <div class="mt-4">
                        {{ $tickets->withQueryString()->links() }}
                    </div>
                    @endif

                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-ticket-alt fa-4x text-muted"></i>
                        </div>
                        <h5 class="text-muted">Aucun ticket</h5>
                        <p class="text-muted mb-4">
                            @if(request()->hasAny(['status', 'priority', 'category']))
                                Aucun ticket ne correspond à vos critères de filtrage.
                            @else
                                Vous n'avez pas encore créé de ticket.
                            @endif
                        </p>
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Créer votre premier ticket
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Conseils -->
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body">
                <h5 class="mb-3">
                    <i class="fas fa-lightbulb me-2 text-warning"></i>
                    Conseils pour un support efficace
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Soyez précis dans la description du problème
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Joignez des captures d'écran si nécessaire
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Indiquez les étapes pour reproduire le problème
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Utilisez la bonne catégorie et priorité
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Répondez rapidement aux questions du support
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Fermez le ticket une fois le problème résolu
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.stat-card {
    transition: all 0.3s ease;
    border-radius: 10px;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.table th {
    background-color: #f8f9fa;
    font-weight: 600;
}

.badge {
    font-size: 0.75rem;
}

.dropdown-menu {
    min-width: 200px;
}
</style>
@endpush

@push('scripts')
<script>
// Appliquer les filtres
function applyFilters() {
    const status = document.getElementById('statusFilter').value;
    const priority = document.getElementById('priorityFilter').value;
    const category = document.getElementById('categoryFilter').value;

    const url = new URL(window.location.href);

    if (status) {
        url.searchParams.set('status', status);
    } else {
        url.searchParams.delete('status');
    }

    if (priority) {
        url.searchParams.set('priority', priority);
    } else {
        url.searchParams.delete('priority');
    }

    if (category) {
        url.searchParams.set('category', category);
    } else {
        url.searchParams.delete('category');
    }

    window.location.href = url.toString();
}

// Réinitialiser les filtres
function resetFilters() {
    window.location.href = "{{ route('tickets.index') }}";
}

// Auto-refresh des nouveaux tickets
setInterval(function() {
    fetch('{{ route("tickets.check-new") }}')
        .then(response => response.json())
        .then(data => {
            if (data.has_new) {
                // Afficher une notification
                showNotification('Nouveau message de support', 'Vous avez reçu une nouvelle réponse sur un de vos tickets.', 'info');
            }
        });
}, 30000); // Toutes les 30 secondes

// Fonction de notification
function showNotification(title, message, type = 'info') {
    // Créer la notification
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
    notification.style.zIndex = '9999';
    notification.style.maxWidth = '350px';
    notification.innerHTML = `
        <strong>${title}</strong>
        <p class="mb-0">${message}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    // Ajouter au document
    document.body.appendChild(notification);

    // Supprimer automatiquement après 5 secondes
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// Confirmation avant suppression
document.querySelectorAll('form[action*="destroy"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (!confirm('Êtes-vous sûr de vouloir supprimer ce ticket ? Toutes les réponses seront également supprimées.')) {
            e.preventDefault();
        }
    });
});
</script>
@endpush
