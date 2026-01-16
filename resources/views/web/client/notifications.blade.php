@extends('layouts.master')

@section('title', 'Notifications - Espace Client MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Notifications',
        'parent' => 'Tableau de bord',
        'parent_url' => route('client.dashboard'),
        'active' => 'Notifications'
    ])
</section>

<!-- =========================
    NOTIFICATIONS
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="client-sidebar card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-bell me-2"></i>Notifications
                        </h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('client.dashboard') }}"
                           class="list-group-item list-group-item-action">
                            <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
                        </a>
                        <a href="{{ route('client.profile') }}"
                           class="list-group-item list-group-item-action">
                            <i class="fas fa-user-edit me-2"></i>Profil
                        </a>
                        <a href="{{ route('client.billing') }}"
                           class="list-group-item list-group-item-action">
                            <i class="fas fa-file-invoice-dollar me-2"></i>Facturation
                        </a>
                        <a href="{{ route('client.documents') }}"
                           class="list-group-item list-group-item-action">
                            <i class="fas fa-file-download me-2"></i>Documents
                        </a>
                        <a href="{{ route('client.notifications') }}"
                           class="list-group-item list-group-item-action active">
                            <i class="fas fa-bell me-2"></i>Notifications
                        </a>
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <h6 class="card-title mb-3">
                            <i class="fas fa-chart-bar me-2 text-primary"></i>Statistiques
                        </h6>
                        <div class="stats-list">
                            <div class="stat-item d-flex justify-content-between mb-2">
                                <span class="text-muted">Non lues</span>
                                <strong class="text-danger">{{ $notifications->whereNull('read_at')->count() }}</strong>
                            </div>
                            <div class="stat-item d-flex justify-content-between mb-2">
                                <span class="text-muted">Lues</span>
                                <strong class="text-success">{{ $notifications->whereNotNull('read_at')->count() }}</strong>
                            </div>
                            <div class="stat-item d-flex justify-content-between">
                                <span class="text-muted">Total</span>
                                <strong>{{ $notifications->total() }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <h6 class="card-title mb-3">
                            <i class="fas fa-cog me-2 text-primary"></i>Actions
                        </h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-success btn-sm" onclick="markAllAsRead()">
                                <i class="fas fa-check-double me-1"></i>Tout marquer comme lu
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="clearAllNotifications()">
                                <i class="fas fa-trash me-1"></i>Tout supprimer
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="col-lg-9">
                <!-- En-tête -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="mb-0">
                            <i class="fas fa-bell text-primary me-2"></i>
                            Mes notifications
                        </h3>
                        <p class="text-muted mb-0">
                            Restez informé de toutes les activités
                        </p>
                    </div>
                    <div class="btn-group" role="group">
                        <button class="btn btn-outline-primary btn-sm active" onclick="filterNotifications('all')">
                            Toutes
                        </button>
                        <button class="btn btn-outline-primary btn-sm" onclick="filterNotifications('unread')">
                            Non lues
                        </button>
                        <button class="btn btn-outline-primary btn-sm" onclick="filterNotifications('read')">
                            Lues
                        </button>
                    </div>
                </div>

                <!-- Liste des notifications -->
                <div class="card border-0 shadow-sm">
                    @if($notifications->count() > 0)
                    <div class="list-group list-group-flush" id="notificationsList">
                        @foreach($notifications as $notification)
                        <div class="list-group-item list-group-item-action notification-item {{ $notification->read_at ? 'read' : 'unread' }}"
                             data-id="{{ $notification->id }}"
                             data-read="{{ $notification->read_at ? 'true' : 'false' }}">
                            <div class="row align-items-center">
                                <!-- Icône -->
                                <div class="col-auto">
                                    <div class="notification-icon">
                                        @php
                                            $data = json_decode($notification->data, true);
                                            $type = $data['type'] ?? 'info';
                                            $icon = match($type) {
                                                'success' => 'fas fa-check-circle',
                                                'warning' => 'fas fa-exclamation-triangle',
                                                'error' => 'fas fa-times-circle',
                                                'info' => 'fas fa-info-circle',
                                                default => 'fas fa-bell'
                                            };
                                            $color = match($type) {
                                                'success' => 'text-success',
                                                'warning' => 'text-warning',
                                                'error' => 'text-danger',
                                                'info' => 'text-info',
                                                default => 'text-primary'
                                            };
                                        @endphp
                                        <i class="{{ $icon }} {{ $color }} fa-2x"></i>
                                    </div>
                                </div>

                                <!-- Contenu -->
                                <div class="col">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">{{ $data['title'] ?? 'Notification' }}</h6>
                                            <p class="mb-1 text-muted">{{ $data['message'] ?? '' }}</p>
                                            <small class="text-muted">
                                                <i class="far fa-clock me-1"></i>
                                                {{ $notification->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        <div class="notification-actions">
                                            @if(!$notification->read_at)
                                            <button class="btn btn-sm btn-outline-success mark-read-btn"
                                                    onclick="markAsRead('{{ $notification->id }}')"
                                                    title="Marquer comme lu">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            @endif
                                            <button class="btn btn-sm btn-outline-danger delete-btn"
                                                    onclick="deleteNotification('{{ $notification->id }}')"
                                                    title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Indicateur non lu -->
                                @if(!$notification->read_at)
                                <div class="col-auto">
                                    <span class="badge bg-danger">Nouveau</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                Affichage de {{ $notifications->firstItem() }} à {{ $notifications->lastItem() }}
                                sur {{ $notifications->total() }} notifications
                            </div>
                            <nav>
                                {{ $notifications->links() }}
                            </nav>
                        </div>
                    </div>
                    @else
                    <!-- Aucune notification -->
                    <div class="card-body text-center py-5">
                        <i class="fas fa-bell-slash fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Aucune notification</h4>
                        <p class="text-muted mb-4">
                            Vous n'avez aucune notification pour le moment
                        </p>
                        <a href="{{ route('client.dashboard') }}" class="ht-btn">
                            <i class="fas fa-arrow-left me-2"></i>Retour au tableau de bord
                        </a>
                    </div>
                    @endif
                </div>

                <!-- Types de notifications -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-ticket-alt fa-3x text-primary"></i>
                                </div>
                                <h5>Tickets</h5>
                                <p class="text-muted small">
                                    Notifications concernant vos tickets de support
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-file-invoice-dollar fa-3x text-success"></i>
                                </div>
                                <h5>Facturation</h5>
                                <p class="text-muted small">
                                    Alertes de paiement et factures
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-bullhorn fa-3x text-warning"></i>
                                </div>
                                <h5>Annonces</h5>
                                <p class="text-muted small">
                                    Nouvelles fonctionnalités et mises à jour
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.notification-item {
    padding: 20px;
    border-left: 4px solid transparent;
    transition: all 0.3s ease;
}

.notification-item.unread {
    background-color: rgba(0,123,255,0.05);
    border-left-color: #007bff;
}

.notification-item.read {
    opacity: 0.8;
}

.notification-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.notification-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #f8f9fa;
}

.notification-actions .btn {
    opacity: 0;
    transition: opacity 0.3s;
}

.notification-item:hover .notification-actions .btn {
    opacity: 1;
}

.badge {
    padding: 5px 10px;
    font-size: 0.75rem;
    font-weight: 500;
}

.pagination {
    margin-bottom: 0;
}

.pagination .page-link {
    border-radius: 5px;
    margin: 0 2px;
    color: #667eea;
    border: 1px solid #dee2e6;
}

.pagination .page-item.active .page-link {
    background-color: #667eea;
    border-color: #667eea;
    color: white;
}

.pagination .page-link:hover {
    background-color: #f8f9fa;
}

.text-success {
    color: #28a745 !important;
}

.text-warning {
    color: #ffc107 !important;
}

.text-danger {
    color: #dc3545 !important;
}

.text-info {
    color: #17a2b8 !important;
}

.text-primary {
    color: #667eea !important;
}

.btn-group .btn.active {
    background-color: #667eea;
    color: white;
    border-color: #667eea;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'entrée des notifications
    const notificationItems = document.querySelectorAll('.notification-item');
    notificationItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-20px)';

        setTimeout(() => {
            item.style.transition = 'all 0.5s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
        }, index * 100);
    });
});

// Filtrer les notifications
function filterNotifications(filter) {
    const items = document.querySelectorAll('.notification-item');

    items.forEach(item => {
        switch(filter) {
            case 'all':
                item.style.display = 'flex';
                break;
            case 'unread':
                if (item.dataset.read === 'false') {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
                break;
            case 'read':
                if (item.dataset.read === 'true') {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
                break;
        }
    });

    // Mettre à jour les boutons actifs
    document.querySelectorAll('.btn-group .btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
}

// Marquer comme lu
function markAsRead(notificationId) {
    fetch(`/notifications/read/${notificationId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const item = document.querySelector(`.notification-item[data-id="${notificationId}"]`);
            if (item) {
                item.classList.remove('unread');
                item.classList.add('read');
                item.dataset.read = 'true';
                item.querySelector('.badge').remove();

                // Animation de transition
                item.style.transition = 'all 0.3s';
                item.style.backgroundColor = '#fff';
                item.style.borderLeftColor = 'transparent';

                // Mettre à jour les statistiques
                updateStats();
            }
        }
    });
}

// Tout marquer comme lu
function markAllAsRead() {
    if (!confirm('Marquer toutes les notifications comme lues ?')) return;

    fetch('/notifications/read-all', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelectorAll('.notification-item.unread').forEach(item => {
                item.classList.remove('unread');
                item.classList.add('read');
                item.dataset.read = 'true';
                const badge = item.querySelector('.badge');
                if (badge) badge.remove();

                item.style.transition = 'all 0.3s';
                item.style.backgroundColor = '#fff';
                item.style.borderLeftColor = 'transparent';
            });

            updateStats();

            // Notification
            showAlert('Toutes les notifications ont été marquées comme lues', 'success');
        }
    });
}

// Supprimer une notification
function deleteNotification(notificationId) {
    if (!confirm('Supprimer cette notification ?')) return;

    fetch(`/notifications/${notificationId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const item = document.querySelector(`.notification-item[data-id="${notificationId}"]`);
            if (item) {
                // Animation de disparition
                item.style.transition = 'all 0.3s';
                item.style.opacity = '0';
                item.style.transform = 'translateX(-100%)';

                setTimeout(() => {
                    item.remove();
                    updateStats();
                }, 300);
            }
        }
    });
}

// Tout supprimer
function clearAllNotifications() {
    if (!confirm('Supprimer toutes les notifications ? Cette action est irréversible.')) return;

    fetch('/notifications/clear-all', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Animation de disparition
            const items = document.querySelectorAll('.notification-item');
            items.forEach((item, index) => {
                item.style.transition = 'all 0.3s';
                item.style.opacity = '0';
                item.style.transform = 'translateX(-100%)';

                setTimeout(() => {
                    item.remove();
                }, index * 50);
            });

            setTimeout(() => {
                document.querySelector('#notificationsList').innerHTML = `
                    <div class="card-body text-center py-5">
                        <i class="fas fa-bell-slash fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Aucune notification</h4>
                        <p class="text-muted">Toutes les notifications ont été supprimées</p>
                    </div>
                `;

                updateStats();
                showAlert('Toutes les notifications ont été supprimées', 'success');
            }, items.length * 50 + 300);
        }
    });
}

// Mettre à jour les statistiques
function updateStats() {
    const unreadCount = document.querySelectorAll('.notification-item.unread').length;
    const readCount = document.querySelectorAll('.notification-item.read').length;
    const totalCount = unreadCount + readCount;

    // Mettre à jour l'affichage (à adapter selon votre structure HTML)
    const statsElements = {
        unread: document.querySelector('.stat-item:nth-child(1) strong'),
        read: document.querySelector('.stat-item:nth-child(2) strong'),
        total: document.querySelector('.stat-item:nth-child(3) strong')
    };

    if (statsElements.unread) {
        statsElements.unread.textContent = unreadCount;
        statsElements.unread.className = unreadCount > 0 ? 'text-danger' : 'text-success';
    }

    if (statsElements.read) {
        statsElements.read.textContent = readCount;
    }

    if (statsElements.total) {
        statsElements.total.textContent = totalCount;
    }
}

// Afficher une alerte
function showAlert(message, type = 'info') {
    const alert = document.createElement('div');
    alert.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    alert.style.cssText = `
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    `;

    const icon = type === 'success' ? 'check-circle' :
                 type === 'warning' ? 'exclamation-triangle' :
                 type === 'error' ? 'times-circle' : 'info-circle';

    alert.innerHTML = `
        <i class="fas fa-${icon} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(alert);

    // Auto-dismiss après 3 secondes
    setTimeout(() => {
        alert.classList.remove('show');
        setTimeout(() => alert.remove(), 150);
    }, 3000);
}
</script>
@endpush
