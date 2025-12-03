@extends('adminlte::page')

@section('title', 'Gestion des Partenaires')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-handshake mr-2 text-primary"></i>
            Gestion des Partenaires
        </h1>
        <a href="{{ route('partners.create') }}" class="btn btn-success btn-lg">
            <i class="fas fa-plus-circle mr-1"></i>Nouveau Partenaire
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
                        <label for="typeFilter"><i class="fas fa-tag mr-1"></i> Type</label>
                        <select id="typeFilter" class="form-control">
                            <option value="">Tous les types</option>
                            <option value="corporate">Entreprise</option>
                            <option value="individual">Individuel</option>
                            <option value="ngo">ONG</option>
                            <option value="government">Gouvernement</option>
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
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="featuredFilter">
                        <label class="form-check-label" for="featuredFilter">
                            <i class="fas fa-star mr-1"></i> Partenaires vedettes seulement
                        </label>
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
                        <i class="fas fa-handshake text-primary mr-2"></i>
                        <strong>{{ $partners->total() }}</strong> partenaires
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-boxes text-success mr-2"></i>
                        <strong>{{ $partners->sum('products_count') }}</strong> produits
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-star text-warning mr-2"></i>
                        <strong>{{ $partners->where('featured', true)->count() }}</strong> vedettes
                    </p>
                    <p class="mb-0">
                        <i class="fas fa-check-circle text-info mr-2"></i>
                        <strong>{{ $partners->where('status', true)->count() }}</strong> actifs
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-white mb-0">
                        <i class="fas fa-list mr-1"></i>Liste des partenaires
                    </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
                            <div class="input-group-append">
                                <button class="btn btn-light" onclick="searchPartners()">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="partnersTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 10%" class="text-center">
                                        <i class="fas fa-hashtag"></i> ID
                                    </th>
                                    <th style="width: 20%">
                                        <i class="fas fa-image"></i> Logo
                                    </th>
                                    <th style="width: 25%">
                                        <i class="fas fa-building"></i> Nom
                                    </th>
                                    <th style="width: 15%">
                                        <i class="fas fa-tag"></i> Type
                                    </th>
                                    <th style="width: 15%">
                                        <i class="fas fa-boxes"></i> Produits
                                    </th>
                                    <th style="width: 15%" class="text-center">
                                        <i class="fas fa-cogs"></i> Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($partners as $partner)
                                <tr data-type="{{ $partner->type }}"
                                    data-status="{{ $partner->status ? 'active' : 'inactive' }}"
                                    data-featured="{{ $partner->featured ? '1' : '0' }}">
                                    <td class="text-center">
                                        <span class="badge badge-info badge-pill">{{ $partner->id }}</span>
                                    </td>
                                    <td>
                                        @if($partner->logo)
                                            <img src="{{ file_exists(public_path('StockPiece/partners/' . $partner->logo)) ? asset('StockPiece/partners/' . $partner->logo) : asset('images/default-partner.png') }}"
                                                 class="img-thumbnail rounded-circle"
                                                 style="width: 60px; height: 60px; object-fit: cover;"
                                                 alt="{{ $partner->name }}">
                                        @else
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-building text-muted fa-lg"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $partner->name }}</strong>
                                        <div class="small text-muted">
                                            @if($partner->email)
                                                <i class="fas fa-envelope mr-1"></i>{{ $partner->email }}
                                            @endif
                                            @if($partner->featured)
                                                <span class="badge badge-warning ml-2">Vedette</span>
                                            @endif
                                            <br>
                                            @if($partner->status)
                                                <span class="badge badge-success">Actif</span>
                                            @else
                                                <span class="badge badge-danger">Inactif</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @switch($partner->type)
                                            @case('corporate')
                                                <span class="badge badge-primary">Entreprise</span>
                                                @break
                                            @case('individual')
                                                <span class="badge badge-info">Individuel</span>
                                                @break
                                            @case('ngo')
                                                <span class="badge badge-success">ONG</span>
                                                @break
                                            @case('government')
                                                <span class="badge badge-secondary">Gouvernement</span>
                                                @break
                                        @endswitch
                                        <br>
                                        @if($partner->website)
                                            <small>
                                                <a href="{{ $partner->website }}" target="_blank" class="text-primary">
                                                    <i class="fas fa-external-link-alt"></i> Site
                                                </a>
                                            </small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-light">
                                            <i class="fas fa-box mr-1"></i>{{ $partner->products_count }}
                                        </span>
                                        <br>
                                        <small class="text-muted">
                                            @if($partner->products_count > 0)
                                                <a href="{{ route('partners.show', $partner) }}" class="text-info">
                                                    Voir les produits
                                                </a>
                                            @else
                                                Aucun produit
                                            @endif
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('partners.show', $partner) }}"
                                               class="btn btn-outline-info btn-sm"
                                               data-toggle="tooltip"
                                               title="Voir détails">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('partners.edit', $partner->id) }}"
                                               class="btn btn-outline-warning btn-sm"
                                               data-toggle="tooltip"
                                               title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('partners.destroy', $partner->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirmDeletePartner()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-outline-danger btn-sm"
                                                        data-toggle="tooltip"
                                                        title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="fas fa-handshake fa-4x text-muted mb-3"></i>
                                        <h5 class="text-muted">Aucun partenaire trouvé</h5>
                                        <p class="text-muted">Commencez par créer votre premier partenaire</p>
                                        <a href="{{ route('partners.create') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-plus"></i> Créer un partenaire
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
                            Affichage de <strong>{{ $partners->firstItem() ?? 0 }}</strong> à
                            <strong>{{ $partners->lastItem() ?? 0 }}</strong> sur
                            <strong>{{ $partners->total() }}</strong> partenaires
                        </div>
                        <div class="pagination-wrapper">
                            {{ $partners->links() }}
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
        if ($('#typeFilter').length) {
            $('#typeFilter').select2({
                placeholder: "Filtrer par type",
                allowClear: true
            });
        }

        if ($('#statusFilter').length) {
            $('#statusFilter').select2({
                placeholder: "Filtrer par statut",
                allowClear: true
            });
        }

        // Filtrage des partenaires
        $('#typeFilter, #statusFilter, #featuredFilter').on('change', function() {
            filterPartners();
        });

        // Recherche en temps réel
        $('#searchInput').on('keyup', function() {
            searchPartners();
        });

        // Animation des lignes
        $('table tbody tr').each(function(i) {
            $(this).delay(i * 100).animate({
                opacity: 1
            }, 200);
        });
    });

    function filterPartners() {
        const type = $('#typeFilter').val();
        const status = $('#statusFilter').val();
        const featured = $('#featuredFilter').is(':checked');

        $('#partnersTable tbody tr').each(function() {
            const rowType = $(this).data('type') || '';
            const rowStatus = $(this).data('status') || '';
            const rowFeatured = $(this).data('featured') || '0';

            let show = true;

            if (type && rowType != type) {
                show = false;
            }

            if (status && rowStatus != status) {
                show = false;
            }

            if (featured && rowFeatured != '1') {
                show = false;
            }

            if (show) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function searchPartners() {
        const searchTerm = $('#searchInput').val().toLowerCase();

        $('#partnersTable tbody tr').each(function() {
            const text = $(this).text().toLowerCase();
            if (text.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function resetFilters() {
        if ($('#typeFilter').length) {
            $('#typeFilter').val(null).trigger('change');
        }
        if ($('#statusFilter').length) {
            $('#statusFilter').val(null).trigger('change');
        }
        $('#featuredFilter').prop('checked', false);
        $('#searchInput').val('');
        $('#partnersTable tbody tr').show();
    }

    function confirmDeletePartner() {
        return Swal.fire({
            title: 'Supprimer ce partenaire ?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler',
            buttonsStyling: true
        }).then((result) => {
            return result.isConfirmed;
        });
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
</script>
@stop
