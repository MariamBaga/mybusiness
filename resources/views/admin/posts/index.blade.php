@extends('adminlte::page')

@section('title', 'Gestion des Articles')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-newspaper mr-2 text-primary"></i>
            Gestion des Articles
        </h1>
        <a href="{{ route('posts.create') }}" class="btn btn-success btn-lg">
            <i class="fas fa-plus-circle mr-1"></i>Créer un article
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
        @if(isset($categories) && $categories->count() > 0)
        <div class="col-md-3 mb-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-filter mr-1"></i>Filtres
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="categoryFilter"><i class="fas fa-tag mr-1"></i> Catégorie</label>
                        <select id="categoryFilter" class="form-control">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="statusFilter"><i class="fas fa-circle mr-1"></i> Statut</label>
                        <select id="statusFilter" class="form-control">
                            <option value="">Tous les statuts</option>
                            <option value="published">Publié</option>
                            <option value="draft">Brouillon</option>
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
                        <i class="fas fa-file-alt text-primary mr-2"></i>
                        <strong>{{ $posts->total() }}</strong> articles au total
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-tags text-success mr-2"></i>
                        <strong>{{ $categories->count() }}</strong> catégories
                    </p>
                    <p class="mb-0">
                        <i class="fas fa-hashtag text-warning mr-2"></i>
                        <strong>{{ isset($tags) ? $tags->count() : 0 }}</strong> tags
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
        @else
        <div class="col-md-12">
        @endif
            <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-white mb-0">
                        <i class="fas fa-list mr-1"></i>Liste des articles
                    </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un article...">
                            <div class="input-group-append">
                                <button class="btn btn-light" onclick="searchPosts()">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="postsTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 5%" class="text-center">
                                        <i class="fas fa-hashtag"></i> ID
                                    </th>
                                    <th style="width: 35%">
                                        <i class="fas fa-heading"></i> Titre
                                    </th>
                                    <th style="width: 20%">
                                        <i class="fas fa-tag"></i> Catégorie
                                    </th>
                                    <th style="width: 20%">
                                        <i class="fas fa-calendar"></i> Date
                                    </th>
                                    <th style="width: 20%" class="text-center">
                                        <i class="fas fa-cogs"></i> Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($posts as $post)
                                <tr data-category="{{ $post->category_id }}"
                                    data-status="{{ $post->status ?? 'published' }}">
                                    <td class="text-center">
                                        <span class="badge badge-info badge-pill">{{ $post->id }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($post->image)
                                                <img src="{{ file_exists(public_path('StockPiece/posts/' . $post->image)) ? asset('StockPiece/posts/' . $post->image) : (Storage::exists('posts/' . $post->image) ? asset('storage/posts/' . $post->image) : asset('images/default-post.jpg')) }}"
                                                     class="img-thumbnail mr-2"
                                                     style="width: 40px; height: 40px; object-fit: cover;"
                                                     alt="{{ $post->title }}">
                                            @else
                                                <div class="bg-light rounded-circle mr-2 d-flex align-items-center justify-content-center"
                                                     style="width: 40px; height: 40px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <strong>{{ Str::limit($post->title, 50) }}</strong>
                                                <div class="small text-muted">
                                                    <i class="fas fa-eye mr-1"></i>{{ $post->views ?? 0 }} vues
                                                    @if(isset($post->status) && $post->status == 'draft')
                                                        <span class="badge badge-warning ml-2">Brouillon</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($post->category)
                                            <span class="badge" style="background-color: {{ $post->category->color ?? '#007bff' }}; color: white;">
                                                {{ $post->category->name }}
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">Non catégorisé</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            @php
                                                // Formatage compatible toutes bases de données
                                                $createdAt = $post->created_at;
                                                if ($createdAt instanceof \Carbon\Carbon) {
                                                    echo $createdAt->format('d/m/Y H:i');
                                                } else {
                                                    echo date('d/m/Y H:i', strtotime($createdAt));
                                                }
                                            @endphp
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @if($post->slug)
                                                <a href="{{ route('posts.show', $post->slug) }}"
                                                   target="_blank"
                                                   class="btn btn-outline-info btn-sm"
                                                   data-toggle="tooltip"
                                                   title="Voir l'article">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            @endif

                                            <a href="{{ route('posts.edit', $post) }}"
                                               class="btn btn-outline-warning btn-sm"
                                               data-toggle="tooltip"
                                               title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button type="button"
                                                    class="btn btn-outline-primary btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#viewPost{{ $post->id }}"
                                                    title="Détails">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <form action="{{ route('posts.destroy', $post) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirmDeletePost()">
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

                                        <!-- Modal pour voir les détails -->
                                        <div class="modal fade" id="viewPost{{ $post->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">
                                                            <i class="fas fa-newspaper mr-2"></i>Détails de l'article
                                                        </h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            @if($post->image)
                                                            <div class="col-md-4 text-center">
                                                                <img src="{{ file_exists(public_path('StockPiece/posts/' . $post->image)) ? asset('StockPiece/posts/' . $post->image) : (Storage::exists('posts/' . $post->image) ? asset('storage/posts/' . $post->image) : asset('images/default-post.jpg')) }}"
                                                                     class="img-fluid rounded mb-3"
                                                                     style="max-height: 200px;"
                                                                     alt="{{ $post->title }}">
                                                            </div>
                                                            <div class="col-md-8">
                                                            @else
                                                            <div class="col-md-12">
                                                            @endif
                                                                <h4>{{ $post->title }}</h4>
                                                                <p class="text-muted">
                                                                    <i class="fas fa-calendar mr-1"></i>
                                                                    Créé le :
                                                                    @php
                                                                        if ($post->created_at instanceof \Carbon\Carbon) {
                                                                            echo $post->created_at->format('d/m/Y à H:i');
                                                                        } else {
                                                                            echo date('d/m/Y à H:i', strtotime($post->created_at));
                                                                        }
                                                                    @endphp
                                                                </p>
                                                                @if($post->category)
                                                                <p>
                                                                    <i class="fas fa-tag mr-1"></i>
                                                                    Catégorie :
                                                                    <span class="badge" style="background-color: {{ $post->category->color ?? '#007bff' }}; color: white;">
                                                                        {{ $post->category->name }}
                                                                    </span>
                                                                </p>
                                                                @endif
                                                                @if($post->tags && $post->tags->count() > 0)
                                                                <p>
                                                                    <i class="fas fa-hashtag mr-1"></i>
                                                                    Tags :
                                                                    @foreach($post->tags as $tag)
                                                                        <span class="badge badge-secondary">{{ $tag->name }}</span>
                                                                    @endforeach
                                                                </p>
                                                                @endif
                                                                <hr>
                                                                <h6>Extrait du contenu :</h6>
                                                                <p>{{ Str::limit(strip_tags($post->content), 200) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('posts.edit', $post) }}"
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
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                                        <h5 class="text-muted">Aucun article trouvé</h5>
                                        <p class="text-muted">Commencez par créer votre premier article</p>
                                        <a href="{{ route('posts.create') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-plus"></i> Créer un article
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
                            Affichage de <strong>{{ $posts->firstItem() ?? 0 }}</strong> à
                            <strong>{{ $posts->lastItem() ?? 0 }}</strong> sur
                            <strong>{{ $posts->total() }}</strong> articles
                        </div>
                        <div class="pagination-wrapper">
                            {{ $posts->links() }}
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
        if ($('#categoryFilter').length) {
            $('#categoryFilter').select2({
                placeholder: "Filtrer par catégorie",
                allowClear: true
            });
        }

        if ($('#statusFilter').length) {
            $('#statusFilter').select2({
                placeholder: "Filtrer par statut",
                allowClear: true
            });
        }

        // Filtrage des articles
        $('#categoryFilter, #statusFilter').on('change', function() {
            filterPosts();
        });

        // Recherche en temps réel
        $('#searchInput').on('keyup', function() {
            searchPosts();
        });

        // Animation des lignes
        $('table tbody tr').each(function(i) {
            $(this).delay(i * 100).animate({
                opacity: 1
            }, 200);
        });
    });

    function filterPosts() {
        const categoryId = $('#categoryFilter').val();
        const status = $('#statusFilter').val();

        $('#postsTable tbody tr').each(function() {
            const rowCategory = $(this).data('category') || '';
            const rowStatus = $(this).data('status') || 'published';

            let show = true;

            if (categoryId && rowCategory != categoryId) {
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

    function searchPosts() {
        const searchTerm = $('#searchInput').val().toLowerCase();

        $('#postsTable tbody tr').each(function() {
            const text = $(this).text().toLowerCase();
            if (text.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function resetFilters() {
        if ($('#categoryFilter').length) {
            $('#categoryFilter').val(null).trigger('change');
        }
        if ($('#statusFilter').length) {
            $('#statusFilter').val(null).trigger('change');
        }
        $('#searchInput').val('');
        $('#postsTable tbody tr').show();
    }

    function confirmDeletePost() {
        return Swal.fire({
            title: 'Supprimer cet article ?',
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
