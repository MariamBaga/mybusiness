@extends('adminlte::page')

@section('title', 'Gestion des Tags')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>
        <i class="fas fa-hashtag text-orange mr-2"></i>
        Gestion des Tags
    </h1>
    <a href="{{ route('tags.create') }}" class="btn btn-success btn-lg">
        <i class="fas fa-plus-circle mr-1"></i>Nouveau Tag
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

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@stop

@section('content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card card-orange">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar mr-1"></i>Statistiques
                </h3>
            </div>
            <div class="card-body">
                <p class="mb-2">
                    <i class="fas fa-hashtag text-orange mr-2"></i>
                    <strong>{{ $tags->total() }}</strong> tags
                </p>
                <p class="mb-2">
                    <i class="fas fa-newspaper text-primary mr-2"></i>
                    <strong>{{ \App\Models\Post::whereHas('tags')->count() }}</strong> articles taggés
                </p>
                <p class="mb-0">
                    <i class="fas fa-star text-warning mr-2"></i>
                    <strong>{{ $tags->sum('posts_count') }}</strong> utilisations totales
                </p>
            </div>
        </div>

        <div class="card card-info mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-lightbulb mr-1"></i>Conseils
                </h3>
            </div>
            <div class="card-body">
                <ul class="list-unstyled small">
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success mr-2"></i>
                        Maximum 10-15 tags par article
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success mr-2"></i>
                        Utilisez des noms courts (1-2 mots)
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-check-circle text-success mr-2"></i>
                        Évitez les doublons et synonymes
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card card-orange card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list mr-1"></i>Liste des tags
                </h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 200px;">
                        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
                        <div class="input-group-append">
                            <button class="btn btn-orange" onclick="searchTags()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="tagsTable">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 10%">
                                    <i class="fas fa-hashtag"></i> ID
                                </th>
                                <th style="width: 30%">
                                    <i class="fas fa-tag"></i> Tag
                                </th>
                                <th style="width: 20%">
                                    <i class="fas fa-palette"></i> Couleur
                                </th>
                                <th style="width: 20%">
                                    <i class="fas fa-newspaper"></i> Articles
                                </th>
                                <th style="width: 20%" class="text-center">
                                    <i class="fas fa-cogs"></i> Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tags as $tag)
                            <tr>
                                <td>
                                    <span class="badge badge-orange badge-pill">{{ $tag->id }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($tag->color)
                                        <div class="tag-color mr-2"
                                             style="background-color: {{ $tag->color }};"></div>
                                        @endif
                                        <div>
                                            <strong>{{ $tag->name }}</strong>
                                            @if($tag->description)
                                            <div class="small text-muted">
                                                {{ Str::limit($tag->description, 40) }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($tag->color)
                                    <div class="d-flex align-items-center">
                                        <div class="color-preview mr-2"
                                             style="background-color: {{ $tag->color }};"></div>
                                        <code>{{ $tag->color }}</code>
                                    </div>
                                    @else
                                    <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-info">
                                        <i class="fas fa-file-alt mr-1"></i>
                                        {{ $tag->posts_count }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('tags.edit', $tag) }}"
                                           class="btn btn-outline-warning btn-sm"
                                           data-toggle="tooltip"
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="button"
                                                class="btn btn-outline-info btn-sm"
                                                onclick="showTagDetails({{ $tag->id }})"
                                                data-toggle="tooltip"
                                                title="Détails">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <form action="{{ route('tags.destroy', $tag) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirmDeleteTag({{ $tag->posts_count }})">
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
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-hashtag fa-4x text-muted mb-3"></i>
                                    <h5 class="text-muted">Aucun tag trouvé</h5>
                                    <p class="text-muted">Commencez par créer votre premier tag</p>
                                    <a href="{{ route('tags.create') }}" class="btn btn-orange">
                                        <i class="fas fa-plus"></i> Créer un tag
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
                        Affichage de <strong>{{ $tags->firstItem() ?? 0 }}</strong> à
                        <strong>{{ $tags->lastItem() ?? 0 }}</strong> sur
                        <strong>{{ $tags->total() }}</strong> tags
                    </div>
                    <div class="pagination-wrapper">
                        {{ $tags->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour les détails -->
<div class="modal fade" id="tagDetailsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-orange text-white">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle mr-2"></i>Détails du tag
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="tagDetailsContent">
                <!-- Contenu chargé via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Fermer
                </button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .card-orange {
        border-top: 3px solid #fd7e14;
    }

    .card-orange .card-header {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border-bottom: 2px solid #dee2e6;
    }

    .btn-orange {
        background-color: #fd7e14;
        border-color: #fd7e14;
        color: white;
    }

    .btn-orange:hover {
        background-color: #e96b00;
        border-color: #e96b00;
    }

    .badge-orange {
        background-color: #fd7e14;
        color: white;
    }

    .tag-color {
        width: 16px;
        height: 16px;
        border-radius: 4px;
        border: 1px solid #dee2e6;
    }

    .color-preview {
        width: 20px;
        height: 20px;
        border-radius: 4px;
        border: 1px solid #dee2e6;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(253, 126, 20, 0.05);
        transform: scale(1.002);
        transition: transform 0.2s;
    }

    .thead-dark th {
        background: linear-gradient(45deg, #343a40, #495057);
        border: none;
        color: white;
        font-weight: 600;
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
<script>
    $(document).ready(function() {
        // Initialiser les tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Recherche en temps réel
        $('#searchInput').on('keyup', function() {
            searchTags();
        });

        // Animation des lignes
        $('table tbody tr').each(function(i) {
            $(this).delay(i * 100).animate({
                opacity: 1
            }, 200);
        });
    });

    function searchTags() {
        const searchTerm = $('#searchInput').val().toLowerCase();

        $('#tagsTable tbody tr').each(function() {
            const text = $(this).text().toLowerCase();
            if (text.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function showTagDetails(tagId) {
        // Charger les détails via AJAX
        $.ajax({
            url: `/admin/tags/${tagId}/details`,
            method: 'GET',
            beforeSend: function() {
                $('#tagDetailsContent').html(`
                    <div class="text-center py-4">
                        <div class="spinner-border text-orange" role="status">
                            <span class="sr-only">Chargement...</span>
                        </div>
                        <p class="mt-2">Chargement des détails...</p>
                    </div>
                `);
            },
            success: function(response) {
                $('#tagDetailsContent').html(response.html);
                $('#tagDetailsModal').modal('show');
            },
            error: function() {
                $('#tagDetailsContent').html(`
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Erreur lors du chargement des détails
                    </div>
                `);
            }
        });
    }

    function confirmDeleteTag(postsCount) {
        if (postsCount > 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Attention !',
                html: `Ce tag est utilisé dans <strong>${postsCount}</strong> article(s).<br>
                       Si vous le supprimez, il sera retiré de tous les articles associés.`,
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#fd7e14',
                confirmButtonText: 'Supprimer quand même',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                return result.isConfirmed;
            });
        } else {
            return Swal.fire({
                title: 'Supprimer ce tag ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#fd7e14',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler',
                buttonsStyling: true
            }).then((result) => {
                return result.isConfirmed;
            });
        }
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

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Erreur !',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif
</script>
@stop
