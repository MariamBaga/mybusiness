@extends('layouts.master')

@section('title', 'Tableau de bord - Espace Client MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Tableau de bord',
        'active' => 'Espace client'
    ])
</section>

<!-- =========================
    STATISTIQUES RAPIDES
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="row g-4">
            <!-- Tickets ouverts -->
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                <div class="stat-card-client bg-gradient-primary text-white rounded-3 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h2 class="display-5 fw-bold mb-0">{{ $stats['tickets'] }}</h2>
                            <p class="mb-0">Tickets total</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-ticket-alt fa-2x"></i>
                        </div>
                    </div>
                    <div class="progress bg-white bg-opacity-25" style="height: 5px;">
                        <div class="progress-bar bg-white"
                             style="width: {{ $stats['tickets'] > 0 ? ($stats['open_tickets'] / $stats['tickets'] * 100) : 0 }}%"></div>
                    </div>
                    <small class="d-block mt-2">{{ $stats['open_tickets'] }} ouverts</small>
                </div>
            </div>

            <!-- Documents -->
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                <div class="stat-card-client bg-gradient-success text-white rounded-3 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h2 class="display-5 fw-bold mb-0">{{ $stats['documents'] }}</h2>
                            <p class="mb-0">Documents</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-download fa-2x"></i>
                        </div>
                    </div>
                    <a href="{{ route('client.documents') }}" class="text-white text-decoration-none">
                        <small><i class="fas fa-arrow-right me-1"></i>Accéder aux documents</small>
                    </a>
                </div>
            </div>

            <!-- Notifications -->
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                <div class="stat-card-client bg-gradient-warning text-white rounded-3 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h2 class="display-5 fw-bold mb-0">{{ $stats['notifications'] }}</h2>
                            <p class="mb-0">Notifications</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bell fa-2x"></i>
                        </div>
                    </div>
                    <a href="{{ route('client.notifications') }}" class="text-white text-decoration-none">
                        <small><i class="fas fa-arrow-right me-1"></i>Voir les notifications</small>
                    </a>
                </div>
            </div>

            <!-- Profil -->
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                <div class="stat-card-client bg-gradient-info text-white rounded-3 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="fw-bold mb-0">Mon compte</h5>
                            <p class="mb-0">Gérez votre profil</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-circle fa-2x"></i>
                        </div>
                    </div>
                    <a href="{{ route('client.profile') }}" class="btn btn-light btn-sm w-100">
                        <i class="fas fa-cog me-1"></i>Paramètres
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================
    TICKETS RÉCENTS
========================= -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-0">Mes tickets récents</h3>
                <p class="text-muted mb-0">Historique de mes demandes de support</p>
            </div>
            <a href="{{ route('tickets.create') }}" class="ht-btn">
                <i class="fas fa-plus-circle me-2"></i>Nouveau ticket
            </a>
        </div>

        @if($recentTickets->count() > 0)
        <div class="table-responsive bg-white rounded-3 shadow-sm">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Sujet</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Réponses</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTickets as $ticket)
                    <tr>
                        <td>#{{ $ticket->id }}</td>
                        <td>{{ Str::limit($ticket->subject, 40) }}</td>
                        <td>
                            @php
                                $statusColors = [
                                    'open' => 'danger',
                                    'in_progress' => 'warning',
                                    'closed' => 'success',
                                    'resolved' => 'info'
                                ];
                            @endphp
                            <span class="badge bg-{{ $statusColors[$ticket->status] ?? 'secondary' }}">
                                {{ $ticket->status }}
                            </span>
                        </td>
                        <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $ticket->replies_count ?? 0 }}</span>
                        </td>
                        <td>
                            <a href="{{ route('tickets.index') }}?ticket={{ $ticket->id }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('tickets.index') }}" class="ht-btn btn-outline-primary">
                <i class="fas fa-list me-2"></i>Voir tous mes tickets
            </a>
        </div>
        @else
        <div class="text-center py-5 bg-white rounded-3 shadow-sm">
            <i class="fas fa-ticket-alt fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">Aucun ticket pour le moment</h4>
            <p class="text-muted mb-4">Créez votre premier ticket de support</p>
            <a href="{{ route('tickets.create') }}" class="ht-btn">
                <i class="fas fa-plus-circle me-2"></i>Créer un ticket
            </a>
        </div>
        @endif
    </div>
</section>

<!-- =========================
    ACTIONS RAPIDES
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">Actions rapides</span>
            <h3 class="title">Que souhaitez-vous faire ?</h3>
        </div>

        <div class="row g-4 mt-4">
            <!-- Profil -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                <div class="action-card text-center p-4 h-100 rounded-3 shadow-sm border">
                    <div class="icon mb-3">
                        <i class="fas fa-user-edit fa-3x text-primary"></i>
                    </div>
                    <h5>Modifier mon profil</h5>
                    <p class="text-muted">Mettez à jour vos informations personnelles</p>
                    <a href="{{ route('client.profile') }}" class="ht-btn style-2 w-100">
                        <i class="fas fa-edit me-2"></i>Modifier
                    </a>
                </div>
            </div>

            <!-- Documents -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                <div class="action-card text-center p-4 h-100 rounded-3 shadow-sm border">
                    <div class="icon mb-3">
                        <i class="fas fa-file-download fa-3x text-success"></i>
                    </div>
                    <h5>Télécharger des documents</h5>
                    <p class="text-muted">Accédez à tous nos documents ressources</p>
                    <a href="{{ route('client.documents') }}" class="ht-btn style-2 w-100">
                        <i class="fas fa-download me-2"></i>Télécharger
                    </a>
                </div>
            </div>

            <!-- Support -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                <div class="action-card text-center p-4 h-100 rounded-3 shadow-sm border">
                    <div class="icon mb-3">
                        <i class="fas fa-headset fa-3x text-warning"></i>
                    </div>
                    <h5>Contacter le support</h5>
                    <p class="text-muted">Obtenez de l'aide pour vos questions</p>
                    <a href="{{ route('support.contact') }}" class="ht-btn style-2 w-100">
                        <i class="fas fa-envelope me-2"></i>Contacter
                    </a>
                </div>
            </div>

            <!-- Facturation -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                <div class="action-card text-center p-4 h-100 rounded-3 shadow-sm border">
                    <div class="icon mb-3">
                        <i class="fas fa-file-invoice-dollar fa-3x text-info"></i>
                    </div>
                    <h5>Mes factures</h5>
                    <p class="text-muted">Consultez votre historique de facturation</p>
                    <a href="{{ route('client.billing') }}" class="ht-btn style-2 w-100">
                        <i class="fas fa-receipt me-2"></i>Voir
                    </a>
                </div>
            </div>

            <!-- Marketplace -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1s">
                <div class="action-card text-center p-4 h-100 rounded-3 shadow-sm border">
                    <div class="icon mb-3">
                        <i class="fas fa-store fa-3x text-danger"></i>
                    </div>
                    <h5>Marketplace</h5>
                    <p class="text-muted">Découvrez les produits de nos partenaires</p>
                    <a href="#" class="ht-btn style-2 w-100">
                        <i class="fas fa-shopping-bag me-2"></i>Visiter
                    </a>
                </div>
            </div>

            <!-- Publicité -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1.2s">
                <div class="action-card text-center p-4 h-100 rounded-3 shadow-sm border">
                    <div class="icon mb-3">
                        <i class="fas fa-ad fa-3x text-purple"></i>
                    </div>
                    <h5>Publicité</h5>
                    <p class="text-muted">Promouvez votre entreprise sur MyBusiness</p>
                    <a href="#" class="ht-btn style-2 w-100">
                        <i class="fas fa-bullhorn me-2"></i>Promouvoir
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================
    NOUVELLES FONCTIONNALITÉS
========================= -->
<section class="section-padding bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Découvrez les nouvelles fonctionnalités</h3>
                <p class="mb-0">
                    MyBusiness évolue constamment pour mieux répondre à vos besoins.
                    Restez informé des dernières mises à jour.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('blog.index') }}" class="ht-btn style-3">
                    <i class="fas fa-newspaper me-2"></i>Voir les nouveautés
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.stat-card-client {
    transition: all 0.3s ease;
    border: none;
}

.stat-card-client:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

.stat-card-client .icon {
    opacity: 0.8;
}

.bg-gradient-primary {
    background: linear-gradient(45deg, #667eea, #764ba2);
}

.bg-gradient-success {
    background: linear-gradient(45deg, #11998e, #38ef7d);
}

.bg-gradient-warning {
    background: linear-gradient(45deg, #f7971e, #ffd200);
}

.bg-gradient-info {
    background: linear-gradient(45deg, #4facfe, #00f2fe);
}

.action-card {
    transition: all 0.3s ease;
    background: white;
}

.action-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    border-color: #667eea !important;
}

.action-card .icon {
    transition: transform 0.3s;
}

.action-card:hover .icon {
    transform: scale(1.1);
}

.text-purple {
    color: #6f42c1;
}

.table-hover tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.05);
}

.badge {
    padding: 6px 12px;
    font-weight: 500;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des statistiques
    const statNumbers = document.querySelectorAll('.stat-card-client h2');

    statNumbers.forEach(stat => {
        const target = parseInt(stat.textContent.replace(/[^0-9]/g, ''));
        if (!isNaN(target)) {
            let current = 0;
            const increment = target / 50;

            const updateStat = () => {
                if (current < target) {
                    current += increment;
                    stat.textContent = Math.ceil(current).toLocaleString('fr-FR');
                    setTimeout(updateStat, 30);
                } else {
                    stat.textContent = target.toLocaleString('fr-FR');
                }
            };

            // Observer pour déclencher l'animation
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    updateStat();
                    observer.unobserve(stat.parentElement.parentElement);
                }
            });

            observer.observe(stat.parentElement.parentElement);
        }
    });
});
</script>
@endpush
