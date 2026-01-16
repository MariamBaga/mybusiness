@extends('layouts.master')

@section('title', 'Statistiques Partenaire - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Statistiques',
        'parent' => 'Tableau de bord',
        'parent_url' => route('partner.dashboard'),
        'active' => 'Analyse des performances'
    ])
</section>

<!-- =========================
    STATISTIQUES PARTENAIRE
========================= -->
<section class="section-padding">
    <div class="container">
        <!-- En-tête avec filtres -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h4 class="mb-1">Statistiques de {{ $partner->name }}</h4>
                        <p class="text-muted mb-0">Analyse des performances de vos produits</p>
                    </div>
                    <div class="d-flex gap-2 mt-2">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle"
                                    type="button"
                                    data-bs-toggle="dropdown">
                                <i class="fas fa-calendar me-1"></i>
                                Période : {{ ucfirst($period) }}
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['period' => 'today']) }}">
                                    Aujourd'hui
                                </a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['period' => 'week']) }}">
                                    Cette semaine
                                </a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['period' => 'month']) }}">
                                    Ce mois
                                </a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['period' => 'year']) }}">
                                    Cette année
                                </a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['period' => 'all']) }}">
                                    Toute la période
                                </a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary" onclick="exportStats()">
                            <i class="fas fa-download me-1"></i>Exporter
                        </button>
                        <button type="button" class="btn btn-outline-info" onclick="window.print()">
                            <i class="fas fa-print me-1"></i>Imprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques principales -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-eye fa-2x text-primary"></i>
                        </div>
                        <h3 class="display-5 fw-bold mb-2">{{ number_format($totalViews) }}</h3>
                        <p class="mb-1">Vues totales</p>
                        <small class="text-muted d-block">
                            @if($viewsChange > 0)
                            <i class="fas fa-arrow-up text-success me-1"></i>
                            +{{ $viewsChange }}% vs période précédente
                            @elseif($viewsChange < 0)
                            <i class="fas fa-arrow-down text-danger me-1"></i>
                            {{ $viewsChange }}% vs période précédente
                            @else
                            <i class="fas fa-minus text-warning me-1"></i>
                            Pas de changement
                            @endif
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-mouse-pointer fa-2x text-success"></i>
                        </div>
                        <h3 class="display-5 fw-bold mb-2">{{ number_format($totalClicks) }}</h3>
                        <p class="mb-1">Clics totaux</p>
                        <small class="text-muted d-block">
                            @if($clicksChange > 0)
                            <i class="fas fa-arrow-up text-success me-1"></i>
                            +{{ $clicksChange }}% vs période précédente
                            @elseif($clicksChange < 0)
                            <i class="fas fa-arrow-down text-danger me-1"></i>
                            {{ $clicksChange }}% vs période précédente
                            @else
                            <i class="fas fa-minus text-warning me-1"></i>
                            Pas de changement
                            @endif
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-percentage fa-2x text-info"></i>
                        </div>
                        <h3 class="display-5 fw-bold mb-2">{{ number_format($avgCTR, 2) }}%</h3>
                        <p class="mb-1">Taux de clics moyen</p>
                        <small class="text-muted d-block">
                            @if($ctrChange > 0)
                            <i class="fas fa-arrow-up text-success me-1"></i>
                            +{{ number_format($ctrChange, 2) }}% vs moyenne
                            @elseif($ctrChange < 0)
                            <i class="fas fa-arrow-down text-danger me-1"></i>
                            {{ number_format($ctrChange, 2) }}% vs moyenne
                            @else
                            <i class="fas fa-equals text-warning me-1"></i>
                            Égal à la moyenne
                            @endif
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stat-card card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-shopping-cart fa-2x text-warning"></i>
                        </div>
                        <h3 class="display-5 fw-bold mb-2">{{ number_format($conversionRate, 2) }}%</h3>
                        <p class="mb-1">Taux de conversion</p>
                        <small class="text-muted d-block">
                            Estimation basée sur les clics
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Graphique d'évolution -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-line me-2"></i>
                            Évolution des performances
                        </h5>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-outline-secondary active" data-metric="views">
                                Vues
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-metric="clicks">
                                Clics
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-metric="ctr">
                                CTR
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height: 300px;">
                            <canvas id="performanceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top produits -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="fas fa-trophy me-2"></i>
                            Top 5 des produits
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($topProducts->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($topProducts as $index => $product)
                                <div class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-primary me-3">{{ $index + 1 }}</span>
                                            <div>
                                                <h6 class="mb-1">{{ Str::limit($product->name, 25) }}</h6>
                                                <small class="text-muted">
                                                    {{ number_format($product->views) }} vues
                                                </small>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge bg-success">
                                                {{ number_format($product->clicks) }} clics
                                            </span>
                                            <div class="mt-1">
                                                <small class="text-muted">
                                                    {{ $product->views > 0 ? number_format(($product->clicks / $product->views) * 100, 1) : 0 }}% CTR
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ route('partner.products.index') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-list me-1"></i>Voir tous les produits
                                </a>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Aucune donnée disponible</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau détaillé -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-table me-2"></i>
                            Détail par produit
                        </h5>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                    type="button"
                                    data-bs-toggle="dropdown">
                                <i class="fas fa-sort me-1"></i>Trier
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'views']) }}">
                                    Par vues
                                </a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'clicks']) }}">
                                    Par clics
                                </a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'ctr']) }}">
                                    Par CTR
                                </a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'name']) }}">
                                    Par nom
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($products->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Produit</th>
                                            <th>Vues</th>
                                            <th>Clics</th>
                                            <th>CTR</th>
                                            <th>Conversion estimée</th>
                                            <th>Performance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        @if($product->image)
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                             alt="{{ $product->name }}"
                                                             class="rounded"
                                                             width="40"
                                                             height="40"
                                                             style="object-fit: cover;">
                                                        @else
                                                        <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                                             style="width: 40px; height: 40px;">
                                                            <i class="fas fa-box text-white"></i>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">{{ Str::limit($product->name, 30) }}</h6>
                                                        <small class="text-muted">
                                                            {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>{{ number_format($product->views) }}</strong>
                                                <div class="progress mt-1" style="height: 5px;">
                                                    <div class="progress-bar bg-primary"
                                                         style="width: {{ $product->views / max(1, $maxViews) * 100 }}%">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>{{ number_format($product->clicks) }}</strong>
                                                <div class="progress mt-1" style="height: 5px;">
                                                    <div class="progress-bar bg-success"
                                                         style="width: {{ $product->clicks / max(1, $maxClicks) * 100 }}%">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>{{ $product->views > 0 ? number_format(($product->clicks / $product->views) * 100, 2) : 0 }}%</strong>
                                                <div class="mt-1">
                                                    @php
                                                        $ctr = $product->views > 0 ? ($product->clicks / $product->views) * 100 : 0;
                                                    @endphp
                                                    @if($ctr > 5)
                                                    <span class="badge bg-success">Excellent</span>
                                                    @elseif($ctr > 2)
                                                    <span class="badge bg-info">Bon</span>
                                                    @elseif($ctr > 0)
                                                    <span class="badge bg-warning">Moyen</span>
                                                    @else
                                                    <span class="badge bg-secondary">Faible</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $estimatedConversions = round($product->clicks * 0.05); // Estimation 5%
                                                    $estimatedRevenue = $estimatedConversions * $product->price;
                                                @endphp
                                                <div>
                                                    <small class="text-muted">{{ $estimatedConversions }} ventes estimées</small>
                                                    <div>
                                                        <strong class="text-success">
                                                            {{ number_format($estimatedRevenue, 0, ',', ' ') }} FCFA
                                                        </strong>
                                                    </div>
                                                </div>
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
                                                        <a class="dropdown-item"
                                                           href="{{ route('partner.product.stats', $product) }}">
                                                            <i class="fas fa-chart-line me-2"></i>Statistiques détaillées
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            @if($products->hasPages())
                            <div class="mt-3">
                                {{ $products->withQueryString()->links() }}
                            </div>
                            @endif

                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Aucune donnée disponible</h5>
                                <p class="text-muted mb-4">
                                    Aucun produit n'a encore généré de statistiques.
                                </p>
                                <a href="{{ route('partner.products.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Ajouter des produits
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Insights et recommandations -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="fas fa-lightbulb me-2 text-warning"></i>
                            Insights et recommandations
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="insight-card p-3 border rounded">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="insight-icon me-3">
                                            <i class="fas fa-star fa-2x text-warning"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Produits performants</h6>
                                            <small class="text-muted">Top performers</small>
                                        </div>
                                    </div>
                                    @if($topProducts->count() > 0)
                                    <ul class="list-unstyled mb-0">
                                        @foreach($topProducts->take(3) as $product)
                                        <li class="mb-2">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            {{ Str::limit($product->name, 25) }}
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <p class="text-muted mb-0">Aucun produit performant identifié</p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="insight-card p-3 border rounded">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="insight-icon me-3">
                                            <i class="fas fa-chart-line fa-2x text-info"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Amélioration possible</h6>
                                            <small class="text-muted">CTR à optimiser</small>
                                        </div>
                                    </div>
                                    @php
                                        $lowCTRProducts = $products->filter(fn($p) => $p->views > 10 && ($p->clicks / $p->views) * 100 < 1);
                                    @endphp
                                    @if($lowCTRProducts->count() > 0)
                                    <ul class="list-unstyled mb-0">
                                        @foreach($lowCTRProducts->take(3) as $product)
                                        <li class="mb-2">
                                            <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                                            {{ Str::limit($product->name, 25) }}
                                        </li>
                                        @endforeach
                                    </ul>
                                    <small class="text-muted d-block mt-2">
                                        Optimisez les images et descriptions
                                    </small>
                                    @else
                                    <p class="text-muted mb-0">Tous les produits ont un bon CTR</p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="insight-card p-3 border rounded">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="insight-icon me-3">
                                            <i class="fas fa-bullseye fa-2x text-success"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Recommandations</h6>
                                            <small class="text-muted">Actions suggérées</small>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2">
                                            <i class="fas fa-camera text-primary me-2"></i>
                                            Améliorez les images des produits
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-tags text-success me-2"></i>
                                            Optimisez les prix et promotions
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-star text-warning me-2"></i>
                                            Mettez en avant les meilleurs produits
                                        </li>
                                    </ul>
                                </div>
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
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.stat-icon {
    transition: transform 0.3s;
}

.stat-card:hover .stat-icon {
    transform: scale(1.1);
}

.btn-group .btn.active {
    background-color: #667eea;
    color: white;
    border-color: #667eea;
}

.insight-card {
    transition: all 0.3s ease;
    height: 100%;
}

.insight-card:hover {
    border-color: #667eea;
    box-shadow: 0 2px 10px rgba(102, 126, 234, 0.1);
}

.insight-icon i {
    transition: transform 0.3s;
}

.insight-card:hover .insight-icon i {
    transform: scale(1.1);
}

.progress {
    background-color: #e9ecef;
    border-radius: 2px;
}

.card-header {
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Données pour les graphiques
const chartData = {
    views: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'Vues',
            data: {!! json_encode($chartViews) !!},
            borderColor: '#667eea',
            backgroundColor: 'rgba(102, 126, 234, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
        }]
    },
    clicks: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'Clics',
            data: {!! json_encode($chartClicks) !!},
            borderColor: '#10b981',
            backgroundColor: 'rgba(16, 185, 129, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
        }]
    },
    ctr: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'Taux de clics (%)',
            data: {!! json_encode($chartCTR) !!},
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
        }]
    }
};

// Configuration du graphique
let currentChart = null;
const ctx = document.getElementById('performanceChart').getContext('2d');

function renderChart(metric) {
    if (currentChart) {
        currentChart.destroy();
    }

    const config = {
        type: 'line',
        data: chartData[metric],
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (metric === 'ctr') {
                                label += context.parsed.y.toFixed(2) + '%';
                            } else {
                                label += context.parsed.y.toLocaleString('fr-FR');
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            if (metric === 'ctr') {
                                return value + '%';
                            }
                            return value.toLocaleString('fr-FR');
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'nearest'
            }
        }
    };

    currentChart = new Chart(ctx, config);
}

// Boutons de changement de métrique
document.querySelectorAll('[data-metric]').forEach(button => {
    button.addEventListener('click', function() {
        const metric = this.getAttribute('data-metric');

        // Mettre à jour les boutons actifs
        document.querySelectorAll('[data-metric]').forEach(btn => {
            btn.classList.remove('active');
        });
        this.classList.add('active');

        // Changer le graphique
        renderChart(metric);
    });
});

// Initialiser le graphique
document.addEventListener('DOMContentLoaded', function() {
    renderChart('views');

    // Auto-refresh des statistiques
    setInterval(function() {
        fetch('{{ route("partner.stats.refresh") }}?period={{ $period }}')
            .then(response => response.json())
            .then(data => {
                if (data.updated) {
                    // Relancer le chargement pour les données principales
                    location.reload();
                }
            });
    }, 30000); // Toutes les 30 secondes
});

// Exporter les statistiques
function exportStats() {
    const data = {
        partenaire: {
            nom: "{{ $partner->name }}",
            periode: "{{ $period }}",
            date_export: new Date().toLocaleString('fr-FR')
        },
        resume: {
            vues_totales: {{ $totalViews }},
            clics_totaux: {{ $totalClicks }},
            ctr_moyen: {{ $avgCTR }},
            taux_conversion: {{ $conversionRate }}
        },
        produits: {!! json_encode($productsData) !!},
        evolution: {!! json_encode($chartData) !!}
    };

    const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'statistiques-partenaire-{{ $partner->id }}-{{ date("Y-m-d") }}.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

// Impression optimisée
window.addEventListener('beforeprint', function() {
    document.querySelectorAll('.btn-group, .dropdown, [onclick]').forEach(el => {
        el.style.display = 'none';
    });

    document.querySelectorAll('.stat-card, .insight-card').forEach(card => {
        card.style.boxShadow = 'none';
        card.style.border = '1px solid #dee2e6';
    });
});

window.addEventListener('afterprint', function() {
    document.querySelectorAll('.btn-group, .dropdown, [onclick]').forEach(el => {
        el.style.display = '';
    });

    document.querySelectorAll('.stat-card, .insight-card').forEach(card => {
        card.style.boxShadow = '';
        card.style.border = '';
    });
});
</script>
@endpush
