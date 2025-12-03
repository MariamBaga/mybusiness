@extends('adminlte::page')

@section('title', 'Gestion des Catégories')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>
        <i class="fas fa-tags text-purple mr-2"></i>
        Gestion des Catégories
    </h1>
    <a href="{{ route('categories.create') }}" class="btn btn-success btn-lg">
        <i class="fas fa-plus-circle mr-1"></i>Nouvelle Catégorie
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
        <div class="card card-purple">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar mr-1"></i>Statistiques
                </h3>
            </div>
            <div class="card-body">
                <p class="mb-2">
                    <i class="fas fa-tags text-purple mr-2"></i>
                    <strong>{{ $categories->total() }}</strong> catégories
                </p>
                <p class="mb-2">
                    <i class="fas fa-newspaper text-success mr-2"></i>
                    <strong>{{ \App\Models\Post::whereHas('category')->count() }}</strong> articles
                </p>
                <p class="mb-0">
                    <i class="fas fa-box text-info mr-2"></i>
                    <strong>{{ \App\Models\Product::whereHas('category')->count() }}</strong> produits
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
                        Utilisez des noms courts et clairs
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success mr-2"></i>
                        Évitez les doublons
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-check-circle text-success mr-2"></i>
                        Maximum 20 catégories recommandé
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card card-purple card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list mr-1"></i>Liste des catégories
                </h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 200px;">
                        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
                        <div class="input-group-append">
                            <button class="btn btn-purple" onclick="searchCategories()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="categoriesTable">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 10%">
                                    <i class="fas fa-hashtag"></i> ID
                                </th>
                                <th style="width: 40%">
                                    <i class="fas fa-tag"></i> Nom
                                </th>
                                <th style="width: 20%">
                                    <i class="fas fa-newspaper"></i> Articles
                                </th>
                                <th style="width: 20%">
                                    <i class="fas fa-box"></i> Produits
                                </th>
                                <th style="width: 10%" class="text-center">
                                    <i class="fas fa-cogs"></i> Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <td>
                                    <span class="badge badge-purple badge-pill">{{ $category->id }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="category-color mr-3"
                                             style="background-color: {{ $category->color ?? '#6f42c1' }};"></div>
                                        <div>
                                            <strong>{{ $category->name }}</strong>
                                            @if($category->description)
                                            <div class="small text-muted">
                                                {{ Str::limit($category->description, 50) }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">
                                        <i class="fas fa-file-alt mr-1"></i>
                                        {{ $category->posts_count ?? 0 }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-success">
                                        <i class="fas fa-box mr-1"></i>
                                        {{ $category->products_count ?? 0 }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('categories.edit', $category) }}"
                                           class="btn btn-outline-warning btn-sm"
                                           data-toggle="tooltip"
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="button"
                                                class="btn btn-outline-info btn-sm"
                                                onclick="showCategoryDetails({{ $category->id }})"
                                                data-toggle="tooltip"
                                                title="Détails">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <form action="{{ route('categories.destroy', $category) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirmDeleteCategory()">
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
                                    <i class="fas fa-tags fa-4x text-muted mb-3"></i>
                                    <h5 class="text-muted">Aucune catégorie trouvée</h5>
                                    <p class="text-muted">Commencez par créer votre première catégorie</p>
                                    <a href="{{ route('categories.create') }}" class="btn btn-purple">
                                        <i class="fas fa-plus"></i> Créer une catégorie
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
                        Affichage de <strong>{{ $categories->firstItem() ?? 0 }}</strong> à
                        <strong>{{ $categories->lastItem() ?? 0 }}</strong> sur
                        <strong>{{ $categories->total() }}</strong> catégories
                    </div>
                    <div class="pagination-wrapper">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour les détails -->
<div class="modal fade" id="categoryDetailsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-purple text-white">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle mr-2"></i>Détails de la catégorie
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="categoryDetailsContent">
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
    .card-purple {
        border-top: 3px solid #6f42c1;
    }

    .card-purple .card-header {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border-bottom: 2px solid #dee2e6;
    }

    .btn-purple {
        background-color: #6f42c1;
        border-color: #6f42c1;
        color: white;
    }

    .btn-purple:hover {
        background-color: #5a32a3;
        border-color: #5a32a3;
    }

    .badge-purple {
        background-color: #6f42c1;
        color: white;
    }

    .category-color {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid #dee2e6;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(111, 66, 193, 0.05);
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
            searchCategories();
        });

        // Animation des lignes
        $('table tbody tr').each(function(i) {
            $(this).delay(i * 100).animate({
                opacity: 1
            }, 200);
        });
    });

    function searchCategories() {
        const searchTerm = $('#searchInput').val().toLowerCase();

        $('#categoriesTable tbody tr').each(function() {
            const text = $(this).text().toLowerCase();
            if (text.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function showCategoryDetails(categoryId) {
        // Charger les détails via AJAX
        $.ajax({
            url: `/admin/categories/${categoryId}/details`,
            method: 'GET',
            beforeSend: function() {
                $('#categoryDetailsContent').html(`
                    <div class="text-center py-4">
                        <div class="spinner-border text-purple" role="status">
                            <span class="sr-only">Chargement...</span>
                        </div>
                        <p class="mt-2">Chargement des détails...</p>
                    </div>
                `);
            },
            success: function(response) {
                $('#categoryDetailsContent').html(response.html);
                $('#categoryDetailsModal').modal('show');
            },
            error: function() {
                $('#categoryDetailsContent').html(`
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Erreur lors du chargement des détails
                    </div>
                `);
            }
        });
    }

    function confirmDeleteCategory() {
        return Swal.fire({
            title: 'Supprimer cette catégorie ?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6f42c1',
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
