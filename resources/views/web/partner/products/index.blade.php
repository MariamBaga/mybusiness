@extends('layouts.master')

@section('title', 'Gestion des produits - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Produits',
        'parent' => 'Tableau de bord',
        'parent_url' => route('partner.dashboard'),
        'active' => 'Gestion des produits'
    ])
</section>

<!-- =========================
    GESTION DES PRODUITS
========================= -->
<section class="section-padding">
    <div class="container">
        <!-- Barre d'actions et filtres -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="mb-1">Gestion des produits</h4>
                        <p class="text-muted mb-0">
                            {{ $products->total() }} produit(s) trouvé(s)
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-md-end gap-2 flex-wrap">
                            <!-- Recherche -->
                            <div class="input-group" style="max-width: 300px;">
                                <input type="text"
                                       class="form-control"
                                       placeholder="Rechercher un produit..."
                                       id="searchInput"
                                       value="{{ request('search') }}">
                                <button class="btn btn-outline-secondary" type="button" onclick="performSearch()">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>

                            <!-- Filtres -->
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle"
                                        type="button"
                                        data-bs-toggle="dropdown">
                                    <i class="fas fa-filter me-1"></i>
                                    Filtres
                                </button>
                                <div class="dropdown-menu p-3" style="min-width: 300px;">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Statut</label>
                                        <select class="form-select form-select-sm" id="statusFilter">
                                            <option value="">Tous les statuts</option>
                                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Actifs</option>
                                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactifs</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Mis en avant</label>
                                        <select class="form-select form-select-sm" id="featuredFilter">
                                            <option value="">Tous</option>
                                            <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Mis en avant</option>
                                            <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Non mis en avant</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Stock</label>
                                        <select class="form-select form-select-sm" id="stockFilter">
                                            <option value="">Tous</option>
                                            <option value="in_stock" {{ request('stock') == 'in_stock' ? 'selected' : '' }}>En stock</option>
                                            <option value="low_stock" {{ request('stock') == 'low_stock' ? 'selected' : '' }}>Stock faible</option>
                                            <option value="out_of_stock" {{ request('stock') == 'out_of_stock' ? 'selected' : '' }}>Rupture</option>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="applyFilters()">
                                            Appliquer
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="resetFilters()">
                                            Réinitialiser
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Nouveau produit -->
                            <a href="{{ route('partner.products.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Nouveau produit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des produits -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                @if($products->count() > 0)
                    <!-- Actions groupées -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                                <label class="form-check-label" for="selectAll">
                                    Tout sélectionner
                                </label>
                            </div>
                            <span class="text-muted" id="selectedCount">0 produit(s) sélectionné(s)</span>
                        </div>
                        <div class="dropdown" id="bulkActions" style="display: none;">
                            <button class="btn btn-outline-primary dropdown-toggle"
                                    type="button"
                                    data-bs-toggle="dropdown">
                                Actions groupées
                            </button>
                            <div class="dropdown-menu">
                                <form action="{{ route('partner.products.bulk.activate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_ids" id="bulkActivateIds">
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-play me-2"></i>Activer
                                    </button>
                                </form>
                                <form action="{{ route('partner.products.bulk.deactivate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_ids" id="bulkDeactivateIds">
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-pause me-2"></i>Désactiver
                                    </button>
                                </form>
                                <form action="{{ route('partner.products.bulk.feature') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_ids" id="bulkFeatureIds">
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-star me-2"></i>Mettre en avant
                                    </button>
                                </form>
                                <form action="{{ route('partner.products.bulk.unfeature') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_ids" id="bulkUnfeatureIds">
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-star-half-alt me-2"></i>Retirer mise en avant
                                    </button>
                                </form>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('partner.products.bulk.delete') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="product_ids" id="bulkDeleteIds">
                                    <button type="submit"
                                            class="dropdown-item text-danger"
                                            onclick="return confirm('Supprimer les produits sélectionnés ? Cette action est irréversible.')">
                                        <i class="fas fa-trash me-2"></i>Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tableau des produits -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="50"></th>
                                    <th>Produit</th>
                                    <th>Prix</th>
                                    <th>Stock</th>
                                    <th>Statistiques</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input product-checkbox"
                                                   type="checkbox"
                                                   value="{{ $product->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                @if($product->image)
                                                <img src="{{ Storage::url($product->image) }}"
                                                     alt="{{ $product->name }}"
                                                     class="rounded"
                                                     width="60"
                                                     height="60"
                                                     style="object-fit: cover;">
                                                @else
                                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                                     style="width: 60px; height: 60px;">
                                                    <i class="fas fa-box text-white"></i>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">
                                                    <a href="{{ route('marketplace.show', $product->slug) }}"
                                                       target="_blank"
                                                       class="text-decoration-none">
                                                        {{ Str::limit($product->name, 40) }}
                                                    </a>
                                                    @if($product->is_sponsored)
                                                    <span class="badge bg-warning ms-2">
                                                        <i class="fas fa-bullhorn me-1"></i>Sponsorisé
                                                    </span>
                                                    @endif
                                                </h6>
                                                <small class="text-muted d-block">
                                                    <i class="fas fa-tag me-1"></i>
                                                    {{ $product->category->name ?? 'Non catégorisé' }}
                                                </small>
                                                <small class="text-muted">
                                                    Créé le {{ $product->created_at->format('d/m/Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong class="text-primary">
                                                {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                            </strong>
                                            @if($product->old_price)
                                            <small class="text-danger text-decoration-line-through">
                                                {{ number_format($product->old_price, 0, ',', ' ') }} FCFA
                                            </small>
                                            @endif
                                            <small class="text-muted mt-1">
                                                SKU: {{ $product->sku ?? 'N/A' }}
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        @if($product->stock > 10)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>
                                            {{ $product->stock }} unités
                                        </span>
                                        @elseif($product->stock > 0)
                                        <span class="badge bg-warning">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $product->stock }} unités
                                        </span>
                                        @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times me-1"></i>
                                            Rupture
                                        </span>
                                        @endif
                                        @if($product->stock <= 10 && $product->stock > 0)
                                        <div class="mt-1">
                                            <small class="text-warning">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                Stock faible
                                            </small>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <small>
                                                <i class="fas fa-eye text-info me-1"></i>
                                                {{ $product->views ?? 0 }} vues
                                            </small>
                                            <small>
                                                <i class="fas fa-mouse-pointer text-success me-1"></i>
                                                {{ $product->clicks ?? 0 }} clics
                                            </small>
                                            <small>
                                                <i class="fas fa-chart-line text-warning me-1"></i>
                                                {{ $product->views > 0 ? round(($product->clicks / $product->views) * 100, 2) : 0 }}% CTR
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column gap-1">
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
                                                <i class="fas fa-star me-1"></i>En avant
                                            </span>
                                            @endif
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
                                                   href="{{ route('partner.products.show', $product) }}">
                                                    <i class="fas fa-eye me-2"></i>Détails
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
                                                <form action="{{ route('partner.products.toggle-featured', $product) }}"
                                                      method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        @if($product->is_featured)
                                                        <i class="fas fa-star-half-alt me-2"></i>Retirer mise en avant
                                                        @else
                                                        <i class="fas fa-star me-2"></i>Mettre en avant
                                                        @endif
                                                    </button>
                                                </form>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('partner.products.duplicate', $product) }}"
                                                      method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-copy me-2"></i>Dupliquer
                                                    </button>
                                                </form>
                                                <form action="{{ route('partner.products.destroy', $product) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="dropdown-item text-danger"
                                                            onclick="return confirm('Supprimer ce produit ?')">
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
                    @if($products->hasPages())
                    <div class="mt-4">
                        {{ $products->withQueryString()->links() }}
                    </div>
                    @endif

                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-box-open fa-4x text-muted"></i>
                        </div>
                        <h5 class="text-muted">Aucun produit trouvé</h5>
                        <p class="text-muted mb-4">
                            @if(request()->hasAny(['search', 'status', 'featured', 'stock']))
                                Aucun produit ne correspond à vos critères de recherche.
                            @else
                                Vous n'avez pas encore ajouté de produits.
                            @endif
                        </p>
                        <a href="{{ route('partner.products.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Ajouter votre premier produit
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Résumé -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-2">Produits actifs</h6>
                        <h3 class="display-5 fw-bold text-primary">{{ $stats['active'] }}</h3>
                        <small class="text-muted">{{ round(($stats['active'] / max(1, $stats['total'])) * 100) }}% du total</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-2">Produits en avant</h6>
                        <h3 class="display-5 fw-bold text-warning">{{ $stats['featured'] }}</h3>
                        <small class="text-muted">Produits mis en avant</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-2">En rupture de stock</h6>
                        <h3 class="display-5 fw-bold text-danger">{{ $stats['out_of_stock'] }}</h3>
                        <small class="text-muted">Nécessite réapprovisionnement</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="card border-0 shadow-sm mt-4">
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
                        <a href="{{ route('partner.dashboard') }}"
                           class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                            <i class="fas fa-tachometer-alt fa-2x mb-2"></i>
                            <span>Tableau de bord</span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('partner.stats') }}"
                           class="btn btn-outline-info w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                            <i class="fas fa-chart-bar fa-2x mb-2"></i>
                            <span>Statistiques</span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <button type="button"
                                class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3"
                                onclick="exportProducts()">
                            <i class="fas fa-download fa-2x mb-2"></i>
                            <span>Exporter produits</span>
                        </button>
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

.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

.dropdown-menu {
    min-width: 200px;
}

.badge {
    font-size: 0.75rem;
}

.card {
    border-radius: 10px;
}

#bulkActions {
    transition: opacity 0.3s;
}

.btn-outline-primary:hover {
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
}
</style>
@endpush

@push('scripts')
<script>
// Gestion de la sélection multiple
const selectAllCheckbox = document.getElementById('selectAll');
const productCheckboxes = document.querySelectorAll('.product-checkbox');
const bulkActions = document.getElementById('bulkActions');
const selectedCount = document.getElementById('selectedCount');
const bulkActivateIds = document.getElementById('bulkActivateIds');
const bulkDeactivateIds = document.getElementById('bulkDeactivateIds');
const bulkFeatureIds = document.getElementById('bulkFeatureIds');
const bulkUnfeatureIds = document.getElementById('bulkUnfeatureIds');
const bulkDeleteIds = document.getElementById('bulkDeleteIds');

function updateSelection() {
    const selectedProducts = Array.from(productCheckboxes).filter(cb => cb.checked);
    const selectedIds = selectedProducts.map(cb => cb.value);

    // Mettre à jour le compteur
    selectedCount.textContent = `${selectedProducts.length} produit(s) sélectionné(s)`;

    // Afficher/masquer les actions groupées
    if (selectedProducts.length > 0) {
        bulkActions.style.display = 'block';
    } else {
        bulkActions.style.display = 'none';
    }

    // Mettre à jour les champs cachés
    bulkActivateIds.value = selectedIds.join(',');
    bulkDeactivateIds.value = selectedIds.join(',');
    bulkFeatureIds.value = selectedIds.join(',');
    bulkUnfeatureIds.value = selectedIds.join(',');
    bulkDeleteIds.value = selectedIds.join(',');

    // Mettre à jour "Tout sélectionner"
    const allChecked = selectedProducts.length === productCheckboxes.length;
    const allUnchecked = selectedProducts.length === 0;

    if (allChecked) {
        selectAllCheckbox.checked = true;
        selectAllCheckbox.indeterminate = false;
    } else if (allUnchecked) {
        selectAllCheckbox.checked = false;
        selectAllCheckbox.indeterminate = false;
    } else {
        selectAllCheckbox.checked = false;
        selectAllCheckbox.indeterminate = true;
    }
}

// Événements
selectAllCheckbox.addEventListener('change', function() {
    productCheckboxes.forEach(cb => {
        cb.checked = this.checked;
    });
    updateSelection();
});

productCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateSelection);
});

// Recherche
function performSearch() {
    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput.value.trim();

    if (searchTerm) {
        const url = new URL(window.location.href);
        url.searchParams.set('search', searchTerm);
        window.location.href = url.toString();
    } else {
        const url = new URL(window.location.href);
        url.searchParams.delete('search');
        window.location.href = url.toString();
    }
}

// Appliquer les filtres
function applyFilters() {
    const statusFilter = document.getElementById('statusFilter');
    const featuredFilter = document.getElementById('featuredFilter');
    const stockFilter = document.getElementById('stockFilter');

    const url = new URL(window.location.href);

    if (statusFilter.value) {
        url.searchParams.set('status', statusFilter.value);
    } else {
        url.searchParams.delete('status');
    }

    if (featuredFilter.value !== '') {
        url.searchParams.set('featured', featuredFilter.value);
    } else {
        url.searchParams.delete('featured');
    }

    if (stockFilter.value) {
        url.searchParams.set('stock', stockFilter.value);
    } else {
        url.searchParams.delete('stock');
    }

    window.location.href = url.toString();
}

// Réinitialiser les filtres
function resetFilters() {
    window.location.href = "{{ route('partner.products.index') }}";
}

// Recherche avec la touche Entrée
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        performSearch();
    }
});

// Exporter les produits
function exportProducts() {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = "{{ route('partner.products.export') }}";

    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    form.appendChild(csrfToken);

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}

// Initialiser
updateSelection();

// Auto-refresh des données de stock
setInterval(function() {
    // Vérifier les stocks faibles
    const lowStockItems = document.querySelectorAll('.badge.bg-warning');
    lowStockItems.forEach(item => {
        item.classList.add('pulse-animation');
    });
}, 30000);

// Ajouter une animation CSS
const style = document.createElement('style');
style.textContent = `
@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}
.pulse-animation {
    animation: pulse 1s infinite;
}
`;
document.head.appendChild(style);
</script>
@endpush
