@extends('layouts.master')

@section('title', 'Tableau de bord Partenaire - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Tableau de bord Partenaire',
        'active' => 'Espace Partenaire'
    ])
</section>

<!-- =========================
    STATISTIQUES RAPIDES
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1">Bienvenue, {{ $partner->name }}</h4>
                                <p class="text-muted mb-0">
                                    {{ $partner->type == 'corporate' ? 'Entreprise' : 'Partenaire' }} |
                                    Membre depuis {{ $partner->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="text-end">
                                @if($partner->status)
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i>Compte actif
                                </span>
                                @else
                                <span class="badge bg-danger">
                                    <i class="fas fa-times-circle me-1"></i>Compte inactif
                                </span>
                                @endif
                                @if($partner->featured)
                                <span class="badge bg-warning ms-2">
                                    <i class="fas fa-star me-1"></i>Partenaire premium
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card card border-0 shadow-sm text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-box fa-3x text-primary"></i>
                    </div>
                    <h3 class="display-5 fw-bold mb-2">{{ $stats['products'] }}</h3>
                    <p class="mb-0">Produits</p>
                    <small class="text-muted">Total</small>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card card border-0 shadow-sm text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-check-circle fa-3x text-success"></i>
                    </div>
                    <h3 class="display-5 fw-bold mb-2">{{ $stats['active_products'] }}</h3>
                    <p class="mb-0">Produits actifs</p>
                    <small class="text-muted">En ligne</small>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card card border-0 shadow-sm text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-star fa-3x text-warning"></i>
                    </div>
                    <h3 class="display-5 fw-bold mb-2">{{ $stats['featured_products'] }}</h3>
                    <p class="mb-0">Produits mis en avant</p>
                    <small class="text-muted">Premium</small>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card card border-0 shadow-sm text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-eye fa-3x text-info"></i>
                    </div>
                    <h3 class="display-5 fw-bold mb-2">{{ number_format($stats['total_views']) }}</h3>
                    <p class="mb-0">Vues totales</p>
                    <small class="text-muted">Visibilité</small>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Produits récents -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-boxes me-2"></i>
                            Derniers produits ajoutés
                        </h5>
                        <a href="{{ route('partner.products.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i>Nouveau produit
                        </a>
                    </div>
                    <div class="card-body">
                        @if($recentProducts->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Produit</th>
                                            <th>Prix</th>
                                            <th>Stock</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentProducts as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        @if($product->image)
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                             alt="{{ $product->name }}"
                                                             class="rounded"
                                                             width="50"
                                                             height="50"
                                                             style="object-fit: cover;">
                                                        @else
                                                        <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                                             style="width: 50px; height: 50px;">
                                                            <i class="fas fa-box text-white"></i>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">{{ Str::limit($product->name, 40) }}</h6>
                                                        <small class="text-muted">
                                                            {{ $product->created_at->diffForHumans() }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong class="text-primary">{{ number_format($product->price, 0, ',', ' ') }} FCFA</strong>
                                                @if($product->old_price)
                                                <div>
                                                    <small class="text-danger text-decoration-line-through">
                                                        {{ number_format($product->old_price, 0, ',', ' ') }} FCFA
                                                    </small>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if($product->stock > 10)
                                                <span class="badge bg-success">{{ $product->stock }} unités</span>
                                                @elseif($product->stock > 0)
                                                <span class="badge bg-warning">{{ $product->stock }} unités</span>
                                                @else
                                                <span class="badge bg-danger">Rupture</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($product->status)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check me-1"></i>Actif
                                                </span>
                                                @else
                                                <span class="badge bg-secondary">
                                                    <i class="fas fa-pause me-1"></i>Inactif
                                                </span>
                                                @endif
                                                @if($product->is_featured)
                                                <span class="badge bg-warning mt-1">
                                                    <i class="fas fa-star me-1"></i>En avant
                                                </span>
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
                                                           href="{{ route('marketplace.show', $product->slug) }}"
                                                           target="_blank">
                                                            <i class="fas fa-external-link-alt me-2"></i>Voir sur le site
                                                        </a>
                                                        <a class="dropdown-item"
                                                           href="{{ route('partner.products.edit', $product) }}">
                                                            <i class="fas fa-edit me-2"></i>Modifier
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <form action="{{ route('partner.products.toggle-status', $product) }}"
                                                              method="POST">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">
                                                                @if($product->status)
                                                                <i class="fas fa-pause me-2"></i>Désactiver
                                                                @else
                                                                <i class="fas fa-play me-2"></i>Activer
                                                                @endif
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
                            <div class="text-center mt-3">
                                <a href="{{ route('partner.products.index') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-list me-2"></i>Voir tous les produits
                                </a>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <i class="fas fa-box-open fa-4x text-muted"></i>
                                </div>
                                <h5 class="text-muted">Aucun produit</h5>
                                <p class="text-muted mb-4">
                                    Vous n'avez pas encore ajouté de produits.
                                </p>
                                <a href="{{ route('partner.products.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Ajouter votre premier produit
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informations du partenaire -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="fas fa-building me-2"></i>
                            Informations du partenaire
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            @if($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}"
                                 alt="{{ $partner->name }}"
                                 class="img-fluid rounded mb-3"
                                 style="max-height: 100px;">
                            @else
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mx-auto mb-3"
                                 style="width: 100px; height: 100px;">
                                <i class="fas fa-building fa-2x text-white"></i>
                            </div>
                            @endif
                            <h5>{{ $partner->name }}</h5>
                            <p class="text-muted">{{ $partner->type }}</p>
                        </div>

                        <ul class="list-unstyled">
                            @if($partner->email)
                            <li class="mb-3">
                                <strong><i class="fas fa-envelope me-2 text-primary"></i>Email :</strong>
                                <a href="mailto:{{ $partner->email }}" class="text-decoration-none">
                                    {{ $partner->email }}
                                </a>
                            </li>
                            @endif

                            @if($partner->phone)
                            <li class="mb-3">
                                <strong><i class="fas fa-phone me-2 text-success"></i>Téléphone :</strong>
                                <a href="tel:{{ $partner->phone }}" class="text-decoration-none">
                                    {{ $partner->phone }}
                                </a>
                            </li>
                            @endif

                            @if($partner->website)
                            <li class="mb-3">
                                <strong><i class="fas fa-globe me-2 text-info"></i>Site web :</strong>
                                <a href="{{ $partner->website }}" target="_blank" class="text-decoration-none">
                                    {{ parse_url($partner->website, PHP_URL_HOST) }}
                                </a>
                            </li>
                            @endif

                            @if($partner->address)
                            <li class="mb-3">
                                <strong><i class="fas fa-map-marker-alt me-2 text-warning"></i>Adresse :</strong>
                                {{ $partner->address }}
                            </li>
                            @endif
                        </ul>

                        @if($partner->description)
                        <div class="mt-3">
                            <strong>Description :</strong>
                            <p class="text-muted mt-1">{{ Str::limit($partner->description, 200) }}</p>
                        </div>
                        @endif

                        <div class="mt-4 text-center">
                            <a href="{{ route('partner.profile') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit me-1"></i>Modifier le profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications et alertes -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="fas fa-bell me-2"></i>
                            Alertes et notifications
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Produits en rupture -->
                            <div class="col-md-4">
                                <div class="alert alert-warning">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="alert-heading">Produits en rupture</h6>
                                            @php
                                                $lowStockProducts = collect(); // À remplacer par une vraie requête
                                            @endphp
                                            @if($lowStockProducts->count() > 0)
                                                <ul class="mb-0">
                                                    @foreach($lowStockProducts->take(2) as $product)
                                                    <li>{{ $product->name }} - {{ $product->stock }} unités</li>
                                                    @endforeach
                                                </ul>
                                                @if($lowStockProducts->count() > 2)
                                                <small class="d-block mt-1">
                                                    + {{ $lowStockProducts->count() - 2 }} autres produits
                                                </small>
                                                @endif
                                            @else
                                                <p class="mb-0">Aucun produit en rupture</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Produits à valider -->
                            <div class="col-md-4">
                                <div class="alert alert-info">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-clock fa-2x"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="alert-heading">Produits en attente</h6>
                                            @php
                                                $pendingProducts = collect(); // À remplacer par une vraie requête
                                            @endphp
                                            @if($pendingProducts->count() > 0)
                                                <ul class="mb-0">
                                                    @foreach($pendingProducts->take(2) as $product)
                                                    <li>{{ $product->name }}</li>
                                                    @endforeach
                                                </ul>
                                                @if($pendingProducts->count() > 2)
                                                <small class="d-block mt-1">
                                                    + {{ $pendingProducts->count() - 2 }} autres produits
                                                </small>
                                                @endif
                                            @else
                                                <p class="mb-0">Aucun produit en attente</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Performances -->
                            <div class="col-md-4">
                                <div class="alert alert-success">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-chart-line fa-2x"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="alert-heading">Performances du mois</h6>
                                            <p class="mb-0">
                                                @php
                                                    $monthViews = 0; // À remplacer par une vraie statistique
                                                @endphp
                                                <strong>{{ number_format($monthViews) }} vues</strong> ce mois-ci
                                            </p>
                                            <small class="d-block mt-1">
                                                @if($monthViews > 0)
                                                    <i class="fas fa-arrow-up text-success me-1"></i>
                                                    Croissance positive
                                                @else
                                                    <i class="fas fa-minus text-warning me-1"></i>
                                                    Aucune donnée
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3">
                            <i class="fas fa-bolt me-2 text-warning"></i>
                            Actions rapides
                        </h5>
                        <div class="row g-3">
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('partner.products.create') }}"
                                   class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                                    <i class="fas fa-plus-circle fa-2x mb-2"></i>
                                    <span>Nouveau produit</span>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('partner.stats') }}"
                                   class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                                    <i class="fas fa-chart-bar fa-2x mb-2"></i>
                                    <span>Voir les statistiques</span>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('partner.products.index') }}"
                                   class="btn btn-outline-info w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                                    <i class="fas fa-boxes fa-2x mb-2"></i>
                                    <span>Gérer les produits</span>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('partner.profile') }}"
                                   class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                                    <i class="fas fa-cog fa-2x mb-2"></i>
                                    <span>Paramètres du profil</span>
                                </a>
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
.stat-card {
    transition: all 0.3s ease;
    border-radius: 10px;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.stat-icon {
    transition: transform 0.3s;
}

.stat-card:hover .stat-icon {
    transform: scale(1.1);
}

.table th {
    background-color: #f8f9fa;
    font-weight: 600;
}

.alert {
    border-radius: 8px;
    border: none;
}

.btn-outline-primary:hover {
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
}

.card-header {
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
}
</style>
@endpush

@push('scripts')
<script>
// Auto-refresh des statistiques
function refreshStats() {
    fetch('{{ route("partner.stats.refresh") }}')
        .then(response => response.json())
        .then(data => {
            if (data.updated) {
                // Mettre à jour les compteurs
                document.querySelectorAll('[data-stat]').forEach(element => {
                    const stat = element.getAttribute('data-stat');
                    if (data[stat] !== undefined) {
                        element.textContent = data[stat];
                    }
                });
            }
        });
}

// Auto-refresh toutes les 60 secondes
setInterval(refreshStats, 60000);

// Animation des cartes de statistiques
document.querySelectorAll('.stat-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        const icon = this.querySelector('.stat-icon i');
        icon.style.transform = 'scale(1.2)';
    });

    card.addEventListener('mouseleave', function() {
        const icon = this.querySelector('.stat-icon i');
        icon.style.transform = 'scale(1)';
    });
});

// Notification visuelle pour les alertes
document.querySelectorAll('.alert').forEach(alert => {
    alert.addEventListener('click', function() {
        this.style.transform = 'scale(0.98)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 200);
    });
});
</script>
@endpush
