@extends('adminlte::page')

@section('title', 'Gestion des Publicités')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-ad mr-2 text-primary"></i>
            Gestion des Publicités
        </h1>
        <a href="{{ route('ads.create') }}" class="btn btn-success btn-lg">
            <i class="fas fa-plus-circle mr-1"></i>Nouvelle Publicité
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-exclamation-triangle mr-2"></i>{{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@stop

@section('content')
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-filter mr-1"></i>Filtres
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="placementFilter"><i class="fas fa-th-large mr-1"></i> Emplacement</label>
                        <select id="placementFilter" class="form-control">
                            <option value="">Tous les emplacements</option>
                            <option value="header">Header</option>
                            <option value="sidebar">Sidebar</option>
                            <option value="footer">Footer</option>
                            <option value="popup">Popup</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="statusFilter"><i class="fas fa-circle mr-1"></i> Statut</label>
                        <select id="statusFilter" class="form-control">
                            <option value="">Tous les statuts</option>
                            <option value="active">Actif</option>
                            <option value="inactive">Inactif</option>
                        </select>
                    </div>
                    <button class="btn btn-outline-primary btn-block" onclick="resetFilters()">
                        <i class="fas fa-redo mr-1"></i>Réinitialiser
                    </button>
                </div>
            </div>

            <div class="card card-info mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-1"></i>Statistiques
                    </h3>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        <i class="fas fa-ad text-primary mr-2"></i>
                        <strong>{{ $ads->total() }}</strong> publicités
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-eye text-success mr-2"></i>
                        <strong>{{ $ads->sum('views') }}</strong> vues totales
                    </p>
                    <p class="mb-0">
                        <i class="fas fa-mouse-pointer text-warning mr-2"></i>
                        <strong>{{ $ads->sum('clicks') }}</strong> clics totaux
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-white mb-0">
                        <i class="fas fa-list mr-1"></i>Liste des publicités
                    </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
                            <div class="input-group-append">
                                <button class="btn btn-light" onclick="searchAds()">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="adsTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 10%" class="text-center">
                                        <i class="fas fa-hashtag"></i> ID
                                    </th>
                                    <th style="width: 20%">
                                        <i class="fas fa-image"></i> Image
                                    </th>
                                    <th style="width: 25%">
                                        <i class="fas fa-heading"></i> Titre
                                    </th>
                                    <th style="width: 15%">
                                        <i class="fas fa-th-large"></i> Emplacement
                                    </th>
                                    <th style="width: 15%">
                                        <i class="fas fa-chart-line"></i> Stats
                                    </th>
                                    <th style="width: 15%" class="text-center">
                                        <i class="fas fa-cogs"></i> Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ads as $ad)
                                <tr data-placement="{{ $ad->placement }}"
                                    data-status="{{ $ad->status ? 'active' : 'inactive' }}">
                                    <td class="text-center">
                                        <span class="badge badge-info badge-pill">{{ $ad->id }}</span>
                                    </td>
                                    <td>
                                        @if($ad->image)
                                            <img src="{{ file_exists(public_path('StockPiece/ads/' . $ad->image)) ? asset('StockPiece/ads/' . $ad->image) : asset('images/default-ad.jpg') }}"
                                                 class="img-thumbnail"
                                                 style="width: 80px; height: 60px; object-fit: cover;"
                                                 alt="{{ $ad->title }}">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                 style="width: 80px; height: 60px;">
                                                <i class="fas fa-ad text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ Str::limit($ad->title, 30) }}</strong>
                                        <div class="small text-muted">
                                            @if($ad->isActive())
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                            <br>
                                            <small>
                                                Du {{ $ad->start_date->format('d/m/Y') }}
                                                au {{ $ad->end_date->format('d/m/Y') }}
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        @switch($ad->placement)
                                            @case('header')
                                                <span class="badge badge-primary">Header</span>
                                                @break
                                            @case('sidebar')
                                                <span class="badge badge-info">Sidebar</span>
                                                @break
                                            @case('footer')
                                                <span class="badge badge-secondary">Footer</span>
                                                @break
                                            @case('popup')
                                                <span class="badge badge-warning">Popup</span>
                                                @break
                                        @endswitch
                                        <br>
                                        <small class="text-muted">
                                            Priorité: {{ $ad->priority }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="small">
                                            <i class="fas fa-eye text-primary mr-1"></i>
                                            {{ $ad->views }} vues
                                            <br>
                                            <i class="fas fa-mouse-pointer text-success mr-1"></i>
                                            {{ $ad->clicks }} clics
                                            @if($ad->views > 0)
                                                <br>
                                                <small class="text-muted">
                                                    CTR: {{ number_format(($ad->clicks / $ad->views) * 100, 2) }}%
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @if($ad->url)
                                                <a href="{{ $ad->url }}"
                                                   target="_blank"
                                                   class="btn btn-outline-info btn-sm"
                                                   data-toggle="tooltip"
                                                   title="Voir le lien">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            @endif

                                            <a href="{{ route('ads.edit', $ad->id) }}"
                                               class="btn btn-outline-warning btn-sm"
                                               data-toggle="tooltip"
                                               title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button type="button"
                                                    class="btn btn-outline-primary btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#viewAd{{ $ad->id }}"
                                                    title="Détails">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                           <form action="{{ route('ads.destroy', $ad->id) }}"
      method="POST"
      class="d-inline delete-form">
    @csrf
    @method('DELETE')
    <button type="button"
            class="btn btn-outline-danger btn-sm delete-btn"
            data-toggle="tooltip"
            title="Supprimer">
        <i class="fas fa-trash"></i>
    </button>
</form>
                                        </div>

                                        <!-- Modal pour voir les détails -->
                                        <div class="modal fade" id="viewAd{{ $ad->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">
                                                            <i class="fas fa-ad mr-2"></i>Détails de la publicité
                                                        </h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            @if($ad->image)
                                                            <div class="col-md-4 text-center">
                                                                <img src="{{ file_exists(public_path('StockPiece/ads/' . $ad->image)) ? asset('StockPiece/ads/' . $ad->image) : asset('images/default-ad.jpg') }}"
                                                                     class="img-fluid rounded mb-3"
                                                                     style="max-height: 200px;"
                                                                     alt="{{ $ad->title }}">
                                                            </div>
                                                            <div class="col-md-8">
                                                            @else
                                                            <div class="col-md-12">
                                                            @endif
                                                                <h4>{{ $ad->title }}</h4>
                                                                <p class="text-muted">
                                                                    <i class="fas fa-link mr-1"></i>
                                                                    URL :
                                                                    @if($ad->url)
                                                                        <a href="{{ $ad->url }}" target="_blank">{{ $ad->url }}</a>
                                                                    @else
                                                                        <span class="text-muted">Aucun lien</span>
                                                                    @endif
                                                                </p>
                                                                <p>
                                                                    <i class="fas fa-th-large mr-1"></i>
                                                                    Emplacement :
                                                                    <span class="badge
                                                                        @switch($ad->placement)
                                                                            @case('header') badge-primary @break
                                                                            @case('sidebar') badge-info @break
                                                                            @case('footer') badge-secondary @break
                                                                            @case('popup') badge-warning @break
                                                                        @endswitch">
                                                                        {{ $ad->placement }}
                                                                    </span>
                                                                </p>
                                                                <p>
                                                                    <i class="fas fa-calendar mr-1"></i>
                                                                    Période :
                                                                    <strong>{{ $ad->start_date->format('d/m/Y') }}</strong>
                                                                    au
                                                                    <strong>{{ $ad->end_date->format('d/m/Y') }}</strong>
                                                                </p>
                                                                <p>
                                                                    <i class="fas fa-chart-line mr-1"></i>
                                                                    Statistiques :
                                                                    {{ $ad->views }} vues, {{ $ad->clicks }} clics
                                                                </p>
                                                                <p>
                                                                    <i class="fas fa-flag mr-1"></i>
                                                                    Priorité : {{ $ad->priority }}
                                                                </p>
                                                                <p>
                                                                    <i class="fas fa-circle mr-1"></i>
                                                                    Statut :
                                                                    @if($ad->status)
                                                                        <span class="badge badge-success">Actif</span>
                                                                    @else
                                                                        <span class="badge badge-danger">Inactif</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('ads.edit', $ad->id) }}"
                                                           class="btn btn-warning">
                                                            <i class="fas fa-edit mr-1"></i> Modifier
                                                        </a>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                            Fermer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="fas fa-ad fa-4x text-muted mb-3"></i>
                                        <h5 class="text-muted">Aucune publicité trouvée</h5>
                                        <p class="text-muted">Commencez par créer votre première publicité</p>
                                        <a href="{{ route('ads.create') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-plus"></i> Créer une publicité
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer clearfix">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Affichage de <strong>{{ $ads->firstItem() ?? 0 }}</strong> à
                            <strong>{{ $ads->lastItem() ?? 0 }}</strong> sur
                            <strong>{{ $ads->total() }}</strong> publicités
                        </div>
                        <div class="pagination-wrapper">
                            {{ $ads->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-top: 3px solid #007bff;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0,123,255,0.05);
        transform: scale(1.002);
        transition: transform 0.2s;
    }

    .thead-dark th {
        background: linear-gradient(45deg, #343a40, #495057);
        border: none;
        color: white;
        font-weight: 600;
    }

    .img-thumbnail {
        border-radius: 5px;
        border: 1px solid #dee2e6;
    }

    .badge {
        font-size: 0.85em;
        padding: 5px 10px;
    }

    .btn-group .btn {
        margin-right: 5px;
        border-radius: 5px;
    }

    .btn-group .btn:last-child {
        margin-right: 0;
    }

    .modal-content {
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialiser les tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Initialiser Select2 pour les filtres si disponible
        if ($('#placementFilter').length) {
            $('#placementFilter').select2({
                placeholder: "Filtrer par emplacement",
                allowClear: true
            });
        }

        if ($('#statusFilter').length) {
            $('#statusFilter').select2({
                placeholder: "Filtrer par statut",
                allowClear: true
            });
        }

        // Filtrage des publicités
        $('#placementFilter, #statusFilter').on('change', function() {
            filterAds();
        });

        // Recherche en temps réel
        $('#searchInput').on('keyup', function() {
            searchAds();
        });

        // Animation des lignes
        $('table tbody tr').each(function(i) {
            $(this).delay(i * 100).animate({
                opacity: 1
            }, 200);
        });
    });

    function filterAds() {
        const placement = $('#placementFilter').val();
        const status = $('#statusFilter').val();

        $('#adsTable tbody tr').each(function() {
            const rowPlacement = $(this).data('placement') || '';
            const rowStatus = $(this).data('status') || '';

            let show = true;

            if (placement && rowPlacement != placement) {
                show = false;
            }

            if (status && rowStatus != status) {
                show = false;
            }

            if (show) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function searchAds() {
        const searchTerm = $('#searchInput').val().toLowerCase();

        $('#adsTable tbody tr').each(function() {
            const text = $(this).text().toLowerCase();
            if (text.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function resetFilters() {
        if ($('#placementFilter').length) {
            $('#placementFilter').val(null).trigger('change');
        }
        if ($('#statusFilter').length) {
            $('#statusFilter').val(null).trigger('change');
        }
        $('#searchInput').val('');
        $('#adsTable tbody tr').show();
    }

    // REMPLACEZ la fonction confirmDeleteAd() par :
function confirmDeleteAd(event) {
    // Empêcher la soumission par défaut
    event.preventDefault();
    event.stopPropagation();

    // Trouver le formulaire parent
    const form = event.target.closest('form');

    Swal.fire({
        title: 'Supprimer cette publicité ?',
        text: "Cette action est irréversible !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer !',
        cancelButtonText: 'Annuler',
        buttonsStyling: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Soumettre le formulaire si confirmé
            form.submit();
        }
    });

    // Toujours retourner false pour empêcher la soumission immédiate
    return false;
}

    // Notifications SweetAlert2
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Succès !',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif

    @if(session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Attention !',
            text: '{{ session('warning') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif


    // Gestion des clics sur les boutons de suppression avec délégation d'événement
$(document).on('click', '.delete-btn', function(e) {
    e.preventDefault();
    const form = $(this).closest('form');

    Swal.fire({
        title: 'Supprimer cette publicité ?',
        text: "Cette action est irréversible !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer !',
        cancelButtonText: 'Annuler',
        buttonsStyling: true,
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
</script>
@stop
