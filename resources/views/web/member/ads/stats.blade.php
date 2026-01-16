@extends('layouts.master')

@section('title', 'Statistiques de la publicité - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Statistiques',
        'parent' => 'Mes Publicités',
        'parent_url' => route('member.ads.index'),
        'active' => $ad->title
    ])
</section>

<!-- =========================
    STATISTIQUES DÉTAILLÉES
========================= -->
<section class="section-padding">
    <div class="container">
        <!-- En-tête de la publicité -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        @if($ad->image)
                        <img src="{{ asset('StockPiece/ads/member/' . $ad->image) }}"
                             alt="{{ $ad->title }}"
                             class="img-fluid rounded"
                             style="max-height: 100px; object-fit: cover;">
                        @else
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                             style="height: 100px;">
                            <i class="fas fa-ad fa-2x text-white"></i>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h4 class="mb-1">{{ $ad->title }}</h4>
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <span class="badge bg-primary">{{ $ad->placement }}</span>
                            @if($ad->status)
                                @if($ad->end_date >= now())
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-warning">Expirée</span>
                                @endif
                            @else
                                <span class="badge bg-secondary">En attente</span>
                            @endif
                            <span class="badge bg-info">{{ $ad->duration_days }} jours</span>
                        </div>
                        <p class="text-muted mb-0">
                            <i class="far fa-calendar me-1"></i>
                            Du {{ $ad->start_date->format('d/m/Y') }} au {{ $ad->end_date->format('d/m/Y') }}
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="btn-group">
                            <a href="{{ route('member.ads.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Retour
                            </a>
                            <a href="{{ route('member.ads.edit', $ad) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit me-1"></i>Modifier
                            </a>
                            <button type="button" class="btn btn-outline-info" onclick="window.print()">
                                <i class="fas fa-print me-1"></i>Imprimer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Statistiques principales -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card card border-0 shadow-sm text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-eye fa-3x text-primary"></i>
                    </div>
                    <h2 class="display-4 fw-bold mb-2">{{ number_format($ad->views) }}</h2>
                    <p class="mb-0">Impressions</p>
                    <small class="text-muted">Vues totales</small>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card card border-0 shadow-sm text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-mouse-pointer fa-3x text-success"></i>
                    </div>
                    <h2 class="display-4 fw-bold mb-2">{{ number_format($ad->clicks) }}</h2>
                    <p class="mb-0">Clics</p>
                    <small class="text-muted">Interactions</small>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card card border-0 shadow-sm text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-percentage fa-3x text-info"></i>
                    </div>
                    <h2 class="display-4 fw-bold mb-2">{{ $ad->views > 0 ? number_format(($ad->clicks / $ad->views) * 100, 2) : 0 }}%</h2>
                    <p class="mb-0">Taux de clics</p>
                    <small class="text-muted">CTR</small>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card card border-0 shadow-sm text-center p-4">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-money-bill-wave fa-3x text-warning"></i>
                    </div>
                    <h2 class="display-4 fw-bold mb-2">{{ number_format($ad->price_paid) }}</h2>
                    <p class="mb-0">Coût total</p>
                    <small class="text-muted">FCFA</small>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Graphiques -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-line me-2"></i>
                            Performances sur 30 jours
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height: 300px;">
                            <canvas id="performanceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Répartition par jour -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Performances par jour
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Jour</th>
                                        <th>Vues</th>
                                        <th>Clics</th>
                                        <th>CTR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dailyStats as $day)
                                    <tr>
                                        <td>{{ $day['date']->format('d/m') }}</td>
                                        <td>{{ $day['views'] }}</td>
                                        <td>{{ $day['clicks'] }}</td>
                                        <td>{{ $day['views'] > 0 ? number_format(($day['clicks'] / $day['views']) * 100, 2) : 0 }}%</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">
                                            Aucune donnée disponible
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Détails techniques -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Détails techniques
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <strong>Format :</strong>
                                        <span class="badge bg-primary">{{ $ad->placement }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <strong>Type :</strong> {{ $ad->type }}
                                    </li>
                                    <li class="mb-2">
                                        <strong>Priorité :</strong>
                                        <span class="badge bg-{{ $ad->priority >= 7 ? 'danger' : ($ad->priority >= 4 ? 'warning' : 'info') }}">
                                            Niveau {{ $ad->priority }}
                                        </span>
                                    </li>
                                    <li class="mb-2">
                                        <strong>Cible :</strong> {{ $ad->target }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <strong>Statut :</strong>
                                        @if($ad->status)
                                            @if($ad->end_date >= now())
                                            <span class="badge bg-success">Active</span>
                                            @else
                                            <span class="badge bg-warning">Expirée</span>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary">En attente</span>
                                        @endif
                                    </li>
                                    <li class="mb-2">
                                        <strong>Création :</strong> {{ $ad->created_at->format('d/m/Y H:i') }}
                                    </li>
                                    <li class="mb-2">
                                        <strong>Mise à jour :</strong> {{ $ad->updated_at->format('d/m/Y H:i') }}
                                    </li>
                                    <li class="mb-2">
                                        <strong>Jours restants :</strong>
                                        <span class="badge bg-{{ $ad->end_date->diffInDays(now()) <= 7 ? 'danger' : 'success' }}">
                                            {{ max(0, $ad->end_date->diffInDays(now())) }} jours
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performances comparatives -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-bar me-2"></i>
                            Comparaison avec la moyenne
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4">
                                <h6 class="text-muted">Votre CTR</h6>
                                <h3 class="{{ $ad->views > 0 && ($ad->clicks / $ad->views) * 100 > 2 ? 'text-success' : 'text-danger' }}">
                                    {{ $ad->views > 0 ? number_format(($ad->clicks / $ad->views) * 100, 2) : 0 }}%
                                </h3>
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted">Moyenne</h6>
                                <h3 class="text-info">2.5%</h3>
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted">Meilleur</h6>
                                <h3 class="text-success">5.8%</h3>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 20px;">
                            <div class="progress-bar bg-success"
                                 style="width: {{ min(100, ($ad->views > 0 ? ($ad->clicks / $ad->views) * 100 * 10 : 0)) }}%">
                                Votre performance
                            </div>
                        </div>
                        <div class="mt-3">
                            <small class="text-muted">
                                @if($ad->views > 0 && ($ad->clicks / $ad->views) * 100 > 2.5)
                                    <i class="fas fa-arrow-up text-success me-1"></i>
                                    Votre performance est supérieure à la moyenne
                                @elseif($ad->views > 0)
                                    <i class="fas fa-arrow-down text-danger me-1"></i>
                                    Votre performance est inférieure à la moyenne
                                @else
                                    <i class="fas fa-minus text-warning me-1"></i>
                                    Pas assez de données pour comparer
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="btn-group">
                            @if($ad->status && $ad->end_date >= now())
                            <form action="{{ route('member.ads.pause', $ad) }}" method="POST" class="me-2">
                                @csrf
                                <button type="submit" class="btn btn-outline-warning">
                                    <i class="fas fa-pause me-1"></i>Mettre en pause
                                </button>
                            </form>
                            @elseif($ad->status)
                            <form action="{{ route('member.ads.activate', $ad) }}" method="POST" class="me-2">
                                @csrf
                                <button type="submit" class="btn btn-outline-success">
                                    <i class="fas fa-play me-1"></i>Réactiver
                                </button>
                            </form>
                            @endif

                            <a href="{{ route('member.ads.edit', $ad) }}" class="btn btn-outline-primary me-2">
                                <i class="fas fa-edit me-1"></i>Modifier
                            </a>

                            <form action="{{ route('member.ads.destroy', $ad) }}" method="POST" class="me-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-outline-danger"
                                        onclick="return confirm('Supprimer cette publicité ?')">
                                    <i class="fas fa-trash me-1"></i>Supprimer
                                </button>
                            </form>

                            <button type="button" class="btn btn-outline-info" onclick="exportData()">
                                <i class="fas fa-download me-1"></i>Exporter
                            </button>
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

.card-header {
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
}

.progress-bar {
    border-radius: 5px;
}

.table-sm th {
    font-weight: 600;
    background-color: #f8f9fa;
}

.btn-group .btn {
    border-radius: 5px !important;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Données pour le graphique
const performanceData = {
    labels: {!! json_encode($chartLabels) !!},
    datasets: [
        {
            label: 'Impressions',
            data: {!! json_encode($chartViews) !!},
            borderColor: '#667eea',
            backgroundColor: 'rgba(102, 126, 234, 0.1)',
            borderWidth: 2,
            fill: true
        },
        {
            label: 'Clics',
            data: {!! json_encode($chartClicks) !!},
            borderColor: '#10b981',
            backgroundColor: 'rgba(16, 185, 129, 0.1)',
            borderWidth: 2,
            fill: true
        }
    ]
};

// Configuration du graphique
const config = {
    type: 'line',
    data: performanceData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                mode: 'index',
                intersect: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
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

// Initialiser le graphique
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('performanceChart').getContext('2d');
    new Chart(ctx, config);

    // Auto-refresh des statistiques
    setInterval(function() {
        fetch('{{ route("member.ads.refresh", $ad) }}')
            .then(response => response.json())
            .then(data => {
                if (data.updated) {
                    location.reload();
                }
            });
    }, 30000); // Toutes les 30 secondes
});

// Exporter les données
function exportData() {
    const data = {
        publicite: {
            titre: "{{ $ad->title }}",
            format: "{{ $ad->placement }}",
            statut: "{{ $ad->status ? 'Active' : 'Inactive' }}",
            dates: "Du {{ $ad->start_date->format('d/m/Y') }} au {{ $ad->end_date->format('d/m/Y') }}",
            cout: "{{ number_format($ad->price_paid) }} FCFA"
        },
        statistiques: {
            impressions: {{ $ad->views }},
            clics: {{ $ad->clicks }},
            ctr: {{ $ad->views > 0 ? number_format(($ad->clicks / $ad->views) * 100, 2) : 0 }} + "%",
            cout_par_clic: {{ $ad->clicks > 0 ? number_format($ad->price_paid / $ad->clicks, 2) : 0 }} + " FCFA"
        },
        performances_quotidiennes: {!! json_encode($dailyStats) !!}
    };

    const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'statistiques-publicite-{{ $ad->id }}.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

// Impression optimisée
window.addEventListener('beforeprint', function() {
    document.querySelectorAll('.btn-group, .card-header .dropdown').forEach(el => {
        el.style.display = 'none';
    });

    document.querySelectorAll('.stat-card').forEach(card => {
        card.style.boxShadow = 'none';
        card.style.border = '1px solid #dee2e6';
    });
});

window.addEventListener('afterprint', function() {
    document.querySelectorAll('.btn-group, .card-header .dropdown').forEach(el => {
        el.style.display = '';
    });

    document.querySelectorAll('.stat-card').forEach(card => {
        card.style.boxShadow = '';
        card.style.border = '';
    });
});
</script>
@endpush
