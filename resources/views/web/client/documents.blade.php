@extends('layouts.master')

@section('title', 'Documents - Espace Client MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Documents',
        'parent' => 'Tableau de bord',
        'parent_url' => route('client.dashboard'),
        'active' => 'Documents'
    ])
</section>

<!-- =========================
    DOCUMENTS CLIENT
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="client-sidebar card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-file-download me-2"></i>Documents
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
                           class="list-group-item list-group-item-action active">
                            <i class="fas fa-file-download me-2"></i>Documents
                        </a>
                        <a href="{{ route('client.notifications') }}"
                           class="list-group-item list-group-item-action">
                            <i class="fas fa-bell me-2"></i>Notifications
                        </a>
                    </div>
                </div>

                <!-- Filtres -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white">
                        <h6 class="mb-0">
                            <i class="fas fa-filter me-2"></i>Filtrer
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Type de document</label>
                            <select class="form-select form-select-sm" id="typeFilter">
                                <option value="all">Tous les types</option>
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                                <option value="word">Word</option>
                                <option value="image">Images</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Date</label>
                            <select class="form-select form-select-sm" id="dateFilter">
                                <option value="all">Toutes dates</option>
                                <option value="week">Cette semaine</option>
                                <option value="month">Ce mois</option>
                                <option value="year">Cette année</option>
                            </select>
                        </div>
                        <button class="btn btn-outline-primary btn-sm w-100" onclick="resetFilters()">
                            <i class="fas fa-redo me-1"></i>Réinitialiser
                        </button>
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
                                <span class="text-muted">Documents</span>
                                <strong>{{ $documents->count() }}</strong>
                            </div>
                            <div class="stat-item d-flex justify-content-between mb-2">
                                <span class="text-muted">PDF</span>
                                <strong>{{ $documents->where('type', 'pdf')->count() }}</strong>
                            </div>
                            <div class="stat-item d-flex justify-content-between">
                                <span class="text-muted">Téléchargés</span>
                                <strong>{{ $documents->sum('download_count') }}</strong>
                            </div>
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
                            <i class="fas fa-folder-open text-primary me-2"></i>
                            Mes documents
                        </h3>
                        <p class="text-muted mb-0">
                            Tous les documents mis à votre disposition
                        </p>
                    </div>
                    <div class="input-group" style="width: 300px;">
                        <input type="text"
                               class="form-control"
                               placeholder="Rechercher un document..."
                               id="searchInput">
                        <button class="ht-btn btn-sm" onclick="searchDocuments()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Alertes -->
                <div class="alert alert-info">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle fa-2x me-3"></i>
                        <div>
                            <h6 class="alert-heading mb-2">Documents disponibles</h6>
                            <p class="mb-0">
                                Téléchargez les documents dont vous avez besoin.
                                Les fichiers sont mis à jour régulièrement.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Liste des documents -->
                @if($documents->count() > 0)
                <div class="row g-4" id="documentsGrid">
                    @foreach($documents as $document)
                    <div class="col-lg-4 col-md-6 document-item"
                         data-type="{{ $document->type }}"
                         data-date="{{ $document->created_at->format('Y-m-d') }}"
                         data-title="{{ strtolower($document->title) }}">
                        <div class="document-card card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <!-- Type de document -->
                                <div class="document-type mb-3">
                                    @switch($document->type)
                                        @case('pdf')
                                            <div class="type-badge bg-danger">
                                                <i class="fas fa-file-pdf"></i> PDF
                                            </div>
                                            @break
                                        @case('excel')
                                            <div class="type-badge bg-success">
                                                <i class="fas fa-file-excel"></i> Excel
                                            </div>
                                            @break
                                        @case('doc')
                                            <div class="type-badge bg-primary">
                                                <i class="fas fa-file-word"></i> Word
                                            </div>
                                            @break
                                        @case('image')
                                            <div class="type-badge bg-info">
                                                <i class="fas fa-file-image"></i> Image
                                            </div>
                                            @break
                                        @default
                                            <div class="type-badge bg-secondary">
                                                <i class="fas fa-file"></i> {{ $document->type }}
                                            </div>
                                    @endswitch
                                </div>

                                <!-- Titre -->
                                <h5 class="document-title mb-2">
                                    {{ Str::limit($document->title, 50) }}
                                </h5>

                                <!-- Description -->
                                @if($document->description)
                                <p class="document-description text-muted small mb-3">
                                    {{ Str::limit($document->description, 80) }}
                                </p>
                                @endif

                                <!-- Informations -->
                                <div class="document-info">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="info-item">
                                                <small class="text-muted d-block">Taille</small>
                                                <strong>{{ $document->size_formatted }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="info-item">
                                                <small class="text-muted d-block">Téléchargements</small>
                                                <strong>{{ $document->download_count }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="info-item">
                                                <small class="text-muted d-block">Date d'ajout</small>
                                                <strong>{{ $document->created_at->format('d/m/Y') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="document-actions mt-4">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('documents.download', $document->id) }}"
                                           class="ht-btn style-2 flex-grow-1"
                                           onclick="trackDownload('{{ $document->id }}')">
                                            <i class="fas fa-download me-2"></i>Télécharger
                                        </a>
                                        <button class="btn btn-outline-primary btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#documentModal{{ $document->id }}"
                                                title="Aperçu">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Aperçu -->
                        <div class="modal fade" id="documentModal{{ $document->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-file-alt me-2"></i>
                                            {{ $document->title }}
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4 text-center">
                                                <div class="document-preview mb-3">
                                                    @switch($document->type)
                                                        @case('pdf')
                                                            <i class="fas fa-file-pdf fa-5x text-danger"></i>
                                                            @break
                                                        @case('excel')
                                                            <i class="fas fa-file-excel fa-5x text-success"></i>
                                                            @break
                                                        @case('doc')
                                                            <i class="fas fa-file-word fa-5x text-primary"></i>
                                                            @break
                                                        @default
                                                            <i class="fas fa-file fa-5x text-secondary"></i>
                                                    @endswitch
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h5>Informations du document</h5>
                                                <table class="table table-sm">
                                                    <tr>
                                                        <th width="40%">Titre</th>
                                                        <td>{{ $document->title }}</td>
                                                    </tr>
                                                    @if($document->description)
                                                    <tr>
                                                        <th>Description</th>
                                                        <td>{{ $document->description }}</td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <th>Type</th>
                                                        <td>
                                                            <span class="badge bg-secondary">
                                                                {{ strtoupper($document->type) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Taille</th>
                                                        <td>{{ $document->size_formatted }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Ajouté le</th>
                                                        <td>{{ $document->created_at->format('d/m/Y à H:i') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Téléchargements</th>
                                                        <td>{{ $document->download_count }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('documents.download', $document->id) }}"
                                           class="ht-btn"
                                           onclick="trackDownload('{{ $document->id }}')">
                                            <i class="fas fa-download me-2"></i>Télécharger
                                        </a>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Fermer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Aucun résultat -->
                <div id="noResults" class="text-center py-5" style="display: none;">
                    <i class="fas fa-search fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucun document trouvé</h4>
                    <p class="text-muted">Essayez avec d'autres critères de recherche</p>
                    <button class="btn btn-outline-primary" onclick="resetFilters()">
                        <i class="fas fa-redo me-1"></i>Réinitialiser les filtres
                    </button>
                </div>
                @else
                <!-- Aucun document -->
                <div class="text-center py-5">
                    <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucun document disponible</h4>
                    <p class="text-muted">Les documents seront bientôt mis à votre disposition</p>
                    <a href="{{ route('client.dashboard') }}" class="ht-btn">
                        <i class="fas fa-arrow-left me-2"></i>Retour au tableau de bord
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- =========================
    TÉLÉCHARGEMENTS POPULAIRES
========================= -->
@if($documents->count() > 3)
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">Les plus populaires</span>
            <h3 class="title">Documents les plus téléchargés</h3>
        </div>

        <div class="row mt-4">
            @foreach($documents->sortByDesc('download_count')->take(3) as $document)
            <div class="col-lg-4 col-md-6">
                <div class="popular-document card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="mb-1">{{ Str::limit($document->title, 40) }}</h5>
                                <small class="text-muted">
                                    <i class="fas fa-download me-1"></i>
                                    {{ $document->download_count }} téléchargements
                                </small>
                            </div>
                            @switch($document->type)
                                @case('pdf')
                                    <span class="badge bg-danger">
                                        <i class="fas fa-file-pdf"></i>
                                    </span>
                                    @break
                                @case('excel')
                                    <span class="badge bg-success">
                                        <i class="fas fa-file-excel"></i>
                                    </span>
                                    @break
                                @default
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-file"></i>
                                    </span>
                            @endswitch
                        </div>
                        <p class="text-muted small mb-4">
                            {{ Str::limit($document->description, 60) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">{{ $document->size_formatted }}</span>
                            <a href="{{ route('documents.download', $document->id) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download me-1"></i>Télécharger
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('styles')
<style>
.document-card {
    transition: all 0.3s ease;
    border: 1px solid #eaeaea;
    border-radius: 10px;
    overflow: hidden;
}

.document-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border-color: #667eea;
}

.type-badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 20px;
    color: white;
    font-size: 12px;
    font-weight: 600;
}

.document-title {
    color: #333;
    font-size: 1.1rem;
    font-weight: 600;
    min-height: 50px;
}

.document-description {
    line-height: 1.5;
    min-height: 40px;
}

.info-item {
    padding: 8px;
    background: #f8f9fa;
    border-radius: 5px;
    text-align: center;
}

.info-item strong {
    color: #333;
    font-size: 0.9rem;
}

.info-item small {
    font-size: 0.8rem;
}

.popular-document {
    transition: all 0.3s;
    border: 1px solid transparent;
}

.popular-document:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    border-color: #ffc107;
}

.modal-content {
    border-radius: 10px;
    border: none;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
}

.table-sm th {
    font-weight: 600;
    color: #495057;
}

.table-sm td {
    color: #666;
}

.alert {
    border-radius: 10px;
    border-left: 4px solid #17a2b8;
}

.badge {
    font-size: 0.8em;
    padding: 4px 8px;
}

.input-group .ht-btn {
    border-radius: 0 5px 5px 0;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les filtres
    const typeFilter = document.getElementById('typeFilter');
    const dateFilter = document.getElementById('dateFilter');
    const searchInput = document.getElementById('searchInput');

    // Filtrer les documents
    function filterDocuments() {
        const type = typeFilter.value;
        const date = dateFilter.value;
        const search = searchInput.value.toLowerCase();

        const documentItems = document.querySelectorAll('.document-item');
        let visibleCount = 0;

        documentItems.forEach(item => {
            const itemType = item.dataset.type;
            const itemDate = item.dataset.date;
            const itemTitle = item.dataset.title;

            let show = true;

            // Filtre par type
            if (type !== 'all' && itemType !== type) {
                show = false;
            }

            // Filtre par date
            if (date !== 'all') {
                const today = new Date();
                const itemDateObj = new Date(itemDate);

                switch(date) {
                    case 'week':
                        const weekAgo = new Date();
                        weekAgo.setDate(today.getDate() - 7);
                        if (itemDateObj < weekAgo) show = false;
                        break;
                    case 'month':
                        const monthAgo = new Date();
                        monthAgo.setMonth(today.getMonth() - 1);
                        if (itemDateObj < monthAgo) show = false;
                        break;
                    case 'year':
                        const yearAgo = new Date();
                        yearAgo.setFullYear(today.getFullYear() - 1);
                        if (itemDateObj < yearAgo) show = false;
                        break;
                }
            }

            // Filtre par recherche
            if (search && !itemTitle.includes(search)) {
                show = false;
            }

            if (show) {
                item.style.display = 'block';
                visibleCount++;

                // Animation d'apparition
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    item.style.transition = 'all 0.5s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 100);
            } else {
                item.style.display = 'none';
            }
        });

        // Afficher/masquer le message "aucun résultat"
        const noResults = document.getElementById('noResults');
        if (noResults) {
            if (visibleCount === 0) {
                noResults.style.display = 'block';
            } else {
                noResults.style.display = 'none';
            }
        }
    }

    // Événements des filtres
    typeFilter.addEventListener('change', filterDocuments);
    dateFilter.addEventListener('change', filterDocuments);
    searchInput.addEventListener('input', filterDocuments);

    // Réinitialiser les filtres
    window.resetFilters = function() {
        typeFilter.value = 'all';
        dateFilter.value = 'all';
        searchInput.value = '';
        filterDocuments();
    };

    // Rechercher documents
    window.searchDocuments = function() {
        filterDocuments();
    };

    // Suivi des téléchargements
    window.trackDownload = function(documentId) {
        // Envoyer une statistique
        fetch('/api/track-document-download', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                document_id: documentId
            })
        }).catch(err => console.error('Tracking error:', err));
    };

    // Initialiser les tooltips Bootstrap
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endpush
