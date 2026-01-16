@extends('layouts.master')

@section('title', $product->name . ' - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Détails du produit',
        'parent' => 'Produits',
        'parent_url' => route('partner.products.index'),
        'active' => $product->name
    ])
</section>

<!-- =========================
    DÉTAILS DU PRODUIT
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Informations principales -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h2 class="mb-2">{{ $product->name }}</h2>
                                <div class="d-flex flex-wrap gap-2 mb-3">
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
                                    <span class="badge bg-warning">
                                        <i class="fas fa-star me-1"></i>Mis en avant
                                    </span>
                                    @endif

                                    @if($product->is_sponsored)
                                    <span class="badge bg-info">
                                        <i class="fas fa-bullhorn me-1"></i>Sponsorisé
                                    </span>
                                    @endif

                                    <span class="badge bg-primary">
                                        {{ $product->category->name ?? 'Non catégorisé' }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-end">
                                <a href="{{ route('marketplace.show', $product->slug) }}"
                                   target="_blank"
                                   class="btn btn-outline-primary btn-sm mb-2">
                                    <i class="fas fa-external-link-alt me-1"></i>Voir sur le site
                                </a>
                                <p class="text-muted mb-0">
                                    <small>Créé le {{ $product->created_at->format('d/m/Y') }}</small>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Image -->
                            <div class="col-md-6 mb-4">
                                @if($product->image)
                                <div class="product-image">
                                    <img src="{{ Storage::url($product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="img-fluid rounded border"
                                         style="max-height: 400px; object-fit: contain;">
                                </div>
                                @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="height: 300px;">
                                    <i class="fas fa-box fa-4x text-muted"></i>
                                </div>
                                @endif
                            </div>

                            <!-- Informations détaillées -->
                            <div class="col-md-6">
                                <div class="product-details">
                                    <!-- Prix -->
                                    <div class="mb-4">
                                        <h3 class="text-primary mb-2">
                                            {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                        </h3>
                                        @if($product->old_price)
                                        <div class="d-flex align-items-center">
                                            <h5 class="text-danger text-decoration-line-through me-3 mb-0">
                                                {{ number_format($product->old_price, 0, ',', ' ') }} FCFA
                                            </h5>
                                            @php
                                                $discount = (($product->old_price - $product->price) / $product->old_price) * 100;
                                            @endphp
                                            <span class="badge bg-danger">
                                                -{{ round($discount, 1) }}%
                                            </span>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Stock -->
                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-2">Stock :</h6>
                                        @if($product->stock > 10)
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success me-2">
                                                <i class="fas fa-check me-1"></i>
                                                {{ $product->stock }} unités disponibles
                                            </span>
                                        </div>
                                        @elseif($product->stock > 0)
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-warning me-2">
                                                <i class="fas fa-exclamation-triangle me-1"></i>
                                                {{ $product->stock }} unités disponibles
                                            </span>
                                            <small class="text-warning">(Stock faible)</small>
                                        </div>
                                        @else
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-danger me-2">
                                                <i class="fas fa-times me-1"></i>
                                                Rupture de stock
                                            </span>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Référence -->
                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-2">Référence :</h6>
                                        <p class="mb-0">
                                            <code>{{ $product->sku ?? 'Non définie' }}</code>
                                        </p>
                                    </div>

                                    <!-- Poids et dimensions -->
                                    <div class="mb-4">
                                        <div class="row">
                                            @if($product->weight)
                                            <div class="col-6">
                                                <h6 class="fw-bold mb-2">Poids :</h6>
                                                <p class="mb-0">{{ $product->weight }} kg</p>
                                            </div>
                                            @endif
                                            @if($product->dimensions)
                                            <div class="col-6">
                                                <h6 class="fw-bold mb-2">Dimensions :</h6>
                                                <p class="mb-0">{{ $product->dimensions }}</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Statistiques -->
                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-3">Statistiques :</h6>
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <div class="stat-box">
                                                    <h4 class="text-primary mb-1">{{ $product->views ?? 0 }}</h4>
                                                    <small class="text-muted">Vues</small>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="stat-box">
                                                    <h4 class="text-success mb-1">{{ $product->clicks ?? 0 }}</h4>
                                                    <small class="text-muted">Clics</small>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="stat-box">
                                                    <h4 class="text-info mb-1">
                                                        {{ $product->views > 0 ? round(($product->clicks / $product->views) * 100, 2) : 0 }}%
                                                    </h4>
                                                    <small class="text-muted">CTR</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <h5 class="mb-3">Description</h5>
                            @if($product->short_description)
                            <div class="mb-3">
                                <h6 class="fw-bold">Description courte :</h6>
                                <p class="mb-0">{{ $product->short_description }}</p>
                            </div>
                            @endif

                            @if($product->description)
                            <div>
                                <h6 class="fw-bold">Description détaillée :</h6>
                                <div class="product-description">
                                    {!! $product->description !!}
                                </div>
                            </div>
                            @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Aucune description détaillée n'a été ajoutée.
                            </div>
                            @endif
                        </div>

                        <!-- Caractéristiques -->
                        @php
                            $specifications = $product->specifications ? json_decode($product->specifications, true) : [];
                        @endphp
                        @if(!empty($specifications))
                        <div class="mt-4">
                            <h5 class="mb-3">Caractéristiques</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach($specifications as $key => $value)
                                        <tr>
                                            <th width="30%">{{ $key }}</th>
                                            <td>{{ $value }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                        <!-- Informations de contact -->
                        <div class="mt-4">
                            <h5 class="mb-3">Informations de contact</h5>
                            <div class="row">
                                @if($product->partner_contact_email)
                                <div class="col-md-6 mb-2">
                                    <strong>Email :</strong>
                                    <a href="mailto:{{ $product->partner_contact_email }}" class="d-block">
                                        {{ $product->partner_contact_email }}
                                    </a>
                                </div>
                                @endif

                                @if($product->partner_product_url)
                                <div class="col-md-6 mb-2">
                                    <strong>URL produit :</strong>
                                    <a href="{{ $product->partner_product_url }}"
                                       target="_blank"
                                       class="d-block text-truncate">
                                        {{ $product->partner_product_url }}
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistiques détaillées -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-line me-2"></i>
                            Statistiques détaillées
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 mb-3">
                                <div class="stat-card p-3 border rounded">
                                    <h3 class="text-primary mb-2">{{ $product->views ?? 0 }}</h3>
                                    <small class="text-muted">Vues totales</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="stat-card p-3 border rounded">
                                    <h3 class="text-success mb-2">{{ $product->clicks ?? 0 }}</h3>
                                    <small class="text-muted">Clics totaux</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="stat-card p-3 border rounded">
                                    <h3 class="text-info mb-2">
                                        {{ $product->views > 0 ? round(($product->clicks / $product->views) * 100, 2) : 0 }}%
                                    </h3>
                                    <small class="text-muted">Taux de clics</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="stat-card p-3 border rounded">
                                    <h3 class="text-warning mb-2">
                                        {{ $product->views > 0 ? round($product->clicks / $product->views, 2) : 0 }}
                                    </h3>
                                    <small class="text-muted">Clics par vue</small>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <a href="{{ route('partner.product.stats', $product) }}" class="btn btn-outline-primary">
                                <i class="fas fa-chart-bar me-2"></i>Voir les statistiques complètes
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions et informations -->
            <div class="col-lg-4">
                <!-- Actions -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="fas fa-cogs me-2"></i>
                            Actions
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('partner.products.edit', $product) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>Modifier le produit
                            </a>

                            <form action="{{ route('partner.products.toggle-status', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-warning w-100">
                                    @if($product->status)
                                    <i class="fas fa-pause me-2"></i>Désactiver
                                    @else
                                    <i class="fas fa-play me-2"></i>Activer
                                    @endif
                                </button>
                            </form>

                            <form action="{{ route('partner.products.toggle-featured', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-info w-100">
                                    @if($product->is_featured)
                                    <i class="fas fa-star-half-alt me-2"></i>Retirer mise en avant
                                    @else
                                    <i class="fas fa-star me-2"></i>Mettre en avant
                                    @endif
                                </button>
                            </form>

                            <form action="{{ route('partner.products.duplicate', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-copy me-2"></i>Dupliquer
                                </button>
                            </form>

                            <a href="{{ route('marketplace.show', $product->slug) }}"
                               target="_blank"
                               class="btn btn-outline-success">
                                <i class="fas fa-external-link-alt me-2"></i>Voir sur le site
                            </a>

                            <form action="{{ route('partner.products.destroy', $product) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-outline-danger w-100"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                    <i class="fas fa-trash me-2"></i>Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Informations techniques -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Informations techniques
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <strong>ID :</strong>
                                <span class="text-muted">{{ $product->id }}</span>
                            </li>
                            <li class="mb-2">
                                <strong>Slug :</strong>
                                <code class="d-block mt-1">{{ $product->slug }}</code>
                            </li>
                            <li class="mb-2">
                                <strong>Créé le :</strong>
                                <span class="text-muted">{{ $product->created_at->format('d/m/Y H:i') }}</span>
                            </li>
                            <li class="mb-2">
                                <strong>Mis à jour le :</strong>
                                <span class="text-muted">{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                            </li>
                            @if($product->deleted_at)
                            <li class="mb-2">
                                <strong>Supprimé le :</strong>
                                <span class="text-danger">{{ $product->deleted_at->format('d/m/Y H:i') }}</span>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Partenaire -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="fas fa-building me-2"></i>
                            Informations du partenaire
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            @if($partner->logo)
                            <div class="flex-shrink-0 me-3">
                                <img src="{{ Storage::url($partner->logo) }}"
                                     alt="{{ $partner->name }}"
                                     class="rounded"
                                     width="50"
                                     height="50"
                                     style="object-fit: cover;">
                            </div>
                            @endif
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $partner->name }}</h6>
                                <small class="text-muted">{{ $partner->type }}</small>
                            </div>
                        </div>

                        <ul class="list-unstyled mb-0">
                            @if($partner->email)
                            <li class="mb-2">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                <a href="mailto:{{ $partner->email }}" class="text-decoration-none">
                                    {{ $partner->email }}
                                </a>
                            </li>
                            @endif

                            @if($partner->phone)
                            <li class="mb-2">
                                <i class="fas fa-phone text-success me-2"></i>
                                <a href="tel:{{ $partner->phone }}" class="text-decoration-none">
                                    {{ $partner->phone }}
                                </a>
                            </li>
                            @endif

                            @if($partner->website)
                            <li class="mb-2">
                                <i class="fas fa-globe text-info me-2"></i>
                                <a href="{{ $partner->website }}" target="_blank" class="text-decoration-none">
                                    Site web
                                </a>
                            </li>
                            @endif
                        </ul>

                        <div class="mt-3">
                            <a href="{{ route('partner.dashboard') }}" class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-tachometer-alt me-1"></i>Tableau de bord partenaire
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('partner.products.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                                </a>
                            </div>
                            <div class="d-flex gap-2">
                                @if($previousProduct)
                                <a href="{{ route('partner.products.show', $previousProduct) }}"
                                   class="btn btn-outline-primary">
                                    <i class="fas fa-chevron-left me-2"></i>Produit précédent
                                </a>
                                @endif

                                @if($nextProduct)
                                <a href="{{ route('partner.products.show', $nextProduct) }}"
                                   class="btn btn-outline-primary">
                                    Produit suivant
                                    <i class="fas fa-chevron-right ms-2"></i>
                                </a>
                                @endif
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
.product-image img {
    transition: transform 0.3s;
}

.product-image img:hover {
    transform: scale(1.02);
}

.stat-card {
    transition: all 0.3s ease;
}

.stat-card:hover {
    border-color: #667eea;
    box-shadow: 0 2px 10px rgba(102, 126, 234, 0.1);
}

.product-description {
    line-height: 1.6;
}

.product-description img {
    max-width: 100%;
    height: auto;
}

.btn {
    border-radius: 8px;
}

.card {
    border-radius: 10px;
}

.badge {
    font-size: 0.75rem;
}
</style>
@endpush

@push('scripts')
<script>
// Animation des statistiques
function animateStatistics() {
    const stats = document.querySelectorAll('.stat-card h3');
    stats.forEach(stat => {
        const finalValue = parseInt(stat.textContent.replace(/[^0-9]/g, ''));
        const suffix = stat.textContent.replace(/[0-9]/g, '');

        if (!isNaN(finalValue)) {
            let current = 0;
            const increment = finalValue / 50;

            const updateStat = () => {
                if (current < finalValue) {
                    current += increment;
                    stat.textContent = Math.ceil(current).toLocaleString('fr-FR') + suffix;
                    setTimeout(updateStat, 30);
                } else {
                    stat.textContent = finalValue.toLocaleString('fr-FR') + suffix;
                }
            };

            // Observer pour déclencher l'animation quand visible
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    updateStat();
                    observer.unobserve(stat);
                }
            });

            observer.observe(stat);
        }
    });
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    animateStatistics();

    // Copier le slug
    const slugElement = document.querySelector('code');
    if (slugElement) {
        slugElement.addEventListener('click', function() {
            navigator.clipboard.writeText(this.textContent)
                .then(() => {
                    const originalText = this.textContent;
                    this.textContent = 'Copié !';
                    setTimeout(() => {
                        this.textContent = originalText;
                    }, 2000);
                });
        });

        slugElement.style.cursor = 'pointer';
        slugElement.title = 'Cliquer pour copier';
    }

    // Auto-refresh des statistiques
    setInterval(function() {
        fetch('{{ route("partner.product.refresh-stats", $product) }}')
            .then(response => response.json())
            .then(data => {
                if (data.updated) {
                    // Mettre à jour les statistiques affichées
                    document.querySelectorAll('[data-stat]').forEach(element => {
                        const stat = element.getAttribute('data-stat');
                        if (data[stat] !== undefined) {
                            element.textContent = data[stat];
                        }
                    });
                }
            });
    }, 60000); // Toutes les minutes
});

// Impression de la page produit
function printProduct() {
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
        <head>
            <title>{{ $product->name }} - Fiche produit</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; margin-bottom: 30px; }
                .product-info { margin-bottom: 20px; }
                .price { color: #dc3545; font-size: 24px; font-weight: bold; }
                .stats { display: flex; justify-content: space-around; margin: 20px 0; }
                .stat-item { text-align: center; }
                @media print {
                    .no-print { display: none; }
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>{{ $product->name }}</h1>
                <p>Fiche produit - Générée le ${new Date().toLocaleDateString('fr-FR')}</p>
            </div>

            <div class="product-info">
                <p><strong>Référence :</strong> {{ $product->sku ?? 'N/A' }}</p>
                <p><strong>Prix :</strong> <span class="price">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span></p>
                @if($product->old_price)
                <p><strong>Prix d'origine :</strong> {{ number_format($product->old_price, 0, ',', ' ') }} FCFA</p>
                @endif
                <p><strong>Stock :</strong> {{ $product->stock }} unités</p>
                <p><strong>Catégorie :</strong> {{ $product->category->name ?? 'Non catégorisé' }}</p>
            </div>

            @if($product->short_description)
            <div class="description">
                <h3>Description courte</h3>
                <p>{{ $product->short_description }}</p>
            </div>
            @endif

            @if(!empty($specifications))
            <div class="specifications">
                <h3>Caractéristiques</h3>
                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <tbody>
                        @foreach($specifications as $key => $value)
                        <tr>
                            <th width="30%">{{ $key }}</th>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            <div class="stats">
                <div class="stat-item">
                    <h4>{{ $product->views ?? 0 }}</h4>
                    <small>Vues</small>
                </div>
                <div class="stat-item">
                    <h4>{{ $product->clicks ?? 0 }}</h4>
                    <small>Clics</small>
                </div>
                <div class="stat-item">
                    <h4>{{ $product->views > 0 ? round(($product->clicks / $product->views) * 100, 2) : 0 }}%</h4>
                    <small>CTR</small>
                </div>
            </div>

            <div class="footer">
                <p><em>Fiche générée par MyBusiness - {{ config('app.url') }}</em></p>
            </div>
        </body>
        </html>
    `);

    printWindow.document.close();
    printWindow.print();
}
</script>
@endpush
