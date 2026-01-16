@extends('layouts.master')

@section('title', 'Mes Publicités - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Mes Publicités',
        'parent' => 'Espace Membre',
        'parent_url' => route('client.dashboard'),
        'active' => 'Gestion des publicités'
    ])
</section>

<!-- =========================
    MES PUBLICITÉS
========================= -->
<section class="section-padding">
    <div class="container">
        <!-- En-tête avec statistiques -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-2">Publicités actives</h6>
                        <h3 class="display-5 fw-bold text-primary">{{ $activeCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-2">Vues totales</h6>
                        <h3 class="display-5 fw-bold text-success">{{ $totalViews ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-2">Clics totaux</h6>
                        <h3 class="display-5 fw-bold text-info">{{ $totalClicks ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-2">Taux de clics</h6>
                        <h3 class="display-5 fw-bold text-warning">{{ $avgCTR ?? 0 }}%</h3>
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
                            <i class="fas fa-ad me-2"></i>
                            Liste de vos publicités
                        </h4>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle"
                                    type="button"
                                    data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-1"></i>Filtrer
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['status' => 'all']) }}">
                                    Toutes
                                </a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}">
                                    Actives
                                </a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}">
                                    En attente
                                </a>
                                <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['status' => 'expired']) }}">
                                    Expirées
                                </a>
                            </div>
                        </div>
                        <a href="{{ route('member.ads.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Nouvelle publicité
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des publicités -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                @if($ads->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll">
                                        </div>
                                    </th>
                                    <th>Publicité</th>
                                    <th>Format</th>
                                    <th>Statut</th>
                                    <th>Dates</th>
                                    <th>Performances</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ads as $ad)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input select-item"
                                                   type="checkbox"
                                                   value="{{ $ad->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                @if($ad->image)
                                                <img src="{{ asset('StockPiece/ads/member/' . $ad->image) }}"
                                                     alt="{{ $ad->title }}"
                                                     class="rounded"
                                                     width="60"
                                                     height="40"
                                                     style="object-fit: cover;">
                                                @else
                                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                                     style="width: 60px; height: 40px;">
                                                    <i class="fas fa-ad text-white"></i>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ Str::limit($ad->title, 40) }}</h6>
                                                <small class="text-muted">
                                                    {{ $ad->created_at->format('d/m/Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $ad->placement == 'header' ? 'primary' : ($ad->placement == 'sidebar' ? 'info' : 'secondary') }}">
                                            {{ $ad->placement }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($ad->status)
                                            @if($ad->end_date >= now())
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i>Active
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-clock me-1"></i>Expirée
                                                </span>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-hourglass-half me-1"></i>En attente
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <small>
                                                <strong>Début:</strong> {{ $ad->start_date->format('d/m/Y') }}
                                            </small>
                                            <small>
                                                <strong>Fin:</strong> {{ $ad->end_date->format('d/m/Y') }}
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <small>
                                                <i class="fas fa-eye text-info me-1"></i>
                                                {{ $ad->views ?? 0 }} vues
                                            </small>
                                            <small>
                                                <i class="fas fa-mouse-pointer text-success me-1"></i>
                                                {{ $ad->clicks ?? 0 }} clics
                                            </small>
                                            <small>
                                                <i class="fas fa-chart-line text-warning me-1"></i>
                                                {{ $ad->views > 0 ? round(($ad->clicks / $ad->views) * 100, 2) : 0 }}% CTR
                                            </small>
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
                                                   href="{{ route('member.ads.stats', $ad) }}">
                                                    <i class="fas fa-chart-line me-2"></i>Statistiques
                                                </a>
                                                <a class="dropdown-item"
                                                   href="{{ route('member.ads.edit', $ad) }}">
                                                    <i class="fas fa-edit me-2"></i>Modifier
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                @if($ad->status && $ad->end_date >= now())
                                                <form action="{{ route('member.ads.pause', $ad) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-pause me-2"></i>Mettre en pause
                                                    </button>
                                                </form>
                                                @elseif($ad->status)
                                                <form action="{{ route('member.ads.activate', $ad) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-play me-2"></i>Activer
                                                    </button>
                                                </form>
                                                @endif
                                                <form action="{{ route('member.ads.destroy', $ad) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="dropdown-item text-danger"
                                                            onclick="return confirm('Supprimer cette publicité ?')">
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

                    <!-- Actions groupées -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAllBottom">
                                <label class="form-check-label" for="selectAllBottom">
                                    Tout sélectionner
                                </label>
                            </div>
                            <span class="text-muted ms-2" id="selectedCount">0 sélectionné(s)</span>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    id="bulkActionsButton"
                                    disabled>
                                Actions groupées
                            </button>
                            <div class="dropdown-menu">
                                <form action="{{ route('member.ads.bulk.activate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="selected_ids" id="selectedIdsActivate">
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-play me-2"></i>Activer
                                    </button>
                                </form>
                                <form action="{{ route('member.ads.bulk.pause') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="selected_ids" id="selectedIdsPause">
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-pause me-2"></i>Mettre en pause
                                    </button>
                                </form>
                                <form action="{{ route('member.ads.bulk.delete') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="selected_ids" id="selectedIdsDelete">
                                    <button type="submit"
                                            class="dropdown-item text-danger"
                                            onclick="return confirm('Supprimer les publicités sélectionnées ?')">
                                        <i class="fas fa-trash me-2"></i>Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    @if($ads->hasPages())
                    <div class="mt-4">
                        {{ $ads->withQueryString()->links() }}
                    </div>
                    @endif

                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-ad fa-4x text-muted"></i>
                        </div>
                        <h5 class="text-muted">Aucune publicité</h5>
                        <p class="text-muted mb-4">
                            Vous n'avez pas encore créé de publicité.
                        </p>
                        <a href="{{ route('member.ads.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Créer votre première publicité
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
                    Conseils pour optimiser vos publicités
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Utilisez des images de haute qualité
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Rédigez des titres accrocheurs
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Ciblez la bonne audience
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Testez différents formats
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Analysez régulièrement vos performances
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Actualisez vos publicités régulièrement
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
.table th {
    background-color: #f8f9fa;
    font-weight: 600;
}

.badge {
    font-size: 0.75rem;
}

.card {
    border-radius: 10px;
}

.dropdown-menu {
    min-width: 200px;
}

.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

#bulkActionsButton:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
</style>
@endpush

@push('scripts')
<script>
// Gestion de la sélection multiple
const selectAllCheckboxes = document.querySelectorAll('#selectAll, #selectAllBottom');
const selectItemCheckboxes = document.querySelectorAll('.select-item');
const bulkActionsButton = document.getElementById('bulkActionsButton');
const selectedCountSpan = document.getElementById('selectedCount');
const selectedIdsActivate = document.getElementById('selectedIdsActivate');
const selectedIdsPause = document.getElementById('selectedIdsPause');
const selectedIdsDelete = document.getElementById('selectedIdsDelete');

function updateSelection() {
    const selectedItems = Array.from(selectItemCheckboxes).filter(cb => cb.checked);
    const selectedIds = selectedItems.map(cb => cb.value);

    // Mettre à jour le compteur
    selectedCountSpan.textContent = `${selectedItems.length} sélectionné(s)`;

    // Activer/désactiver le bouton d'actions groupées
    bulkActionsButton.disabled = selectedItems.length === 0;

    // Mettre à jour les champs cachés
    selectedIdsActivate.value = selectedIds.join(',');
    selectedIdsPause.value = selectedIds.join(',');
    selectedIdsDelete.value = selectedIds.join(',');

    // Synchroniser les cases "Tout sélectionner"
    const allChecked = selectedItems.length === selectItemCheckboxes.length;
    const allUnchecked = selectedItems.length === 0;

    selectAllCheckboxes.forEach(cb => {
        if (allChecked) {
            cb.checked = true;
            cb.indeterminate = false;
        } else if (allUnchecked) {
            cb.checked = false;
            cb.indeterminate = false;
        } else {
            cb.checked = false;
            cb.indeterminate = true;
        }
    });
}

// Événements pour les cases à cocher
selectAllCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const isChecked = this.checked;
        selectItemCheckboxes.forEach(cb => {
            cb.checked = isChecked;
        });
        updateSelection();
    });
});

selectItemCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateSelection);
});

// Initialiser
updateSelection();

// Confirmation avant certaines actions
document.querySelectorAll('form[action*="destroy"], form[action*="delete"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (!confirm('Êtes-vous sûr de vouloir supprimer cette/ces publicité(s) ? Cette action est irréversible.')) {
            e.preventDefault();
        }
    });
});

// Auto-refresh des statistiques toutes les 60 secondes
setTimeout(function() {
    location.reload();
}, 60000);
</script>
@endpush
