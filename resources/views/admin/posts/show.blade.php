@extends('adminlte::page')

@section('title', $post->title . ' - Détails de l\'Article')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>
        <i class="fas fa-newspaper text-info mr-2"></i>
        Détails de l'article
    </h1>
    <div>
        <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning mr-2">
            <i class="fas fa-edit mr-1"></i> Modifier
        </a>
        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Retour
        </a>
    </div>
</div>
<nav aria-label="breadcrumb" class="mt-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('posts.index') }}">
                <i class="fas fa-newspaper"></i> Articles
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <i class="fas fa-eye"></i> {{ Str::limit($post->title, 40) }}
        </li>
    </ol>
</nav>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Carte principale de l'article -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-alt mr-2"></i>
                    Contenu de l'article
                </h3>
                <div class="card-tools">
                    <span class="badge badge-light">
                        ID: {{ $post->id }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <!-- Image de l'article -->
                @if($post->image)
                <div class="text-center mb-4">
                    <img src="{{ asset('StockPiece/posts/' . $post->image) }}"
                         alt="{{ $post->title }}"
                         class="img-fluid rounded shadow"
                         style="max-height: 400px; object-fit: cover;">
                </div>
                @endif

                <!-- Titre et métadonnées -->
                <h1 class="mb-3">{{ $post->title }}</h1>

                <div class="d-flex flex-wrap align-items-center mb-4">
                    <!-- Auteur -->
                    @if($post->author)
                    <div class="mr-3 mb-2">
                        <i class="fas fa-user-circle text-info mr-1"></i>
                        <span class="text-muted">Par</span>
                        <strong>{{ $post->author->name }}</strong>
                    </div>
                    @endif

                    <!-- Date de publication -->
                    <div class="mr-3 mb-2">
                        <i class="fas fa-calendar-alt text-info mr-1"></i>
                        <span class="text-muted">Publié le</span>
                        <strong>
                            @php
                                if ($post->published_at instanceof \Carbon\Carbon) {
                                    echo $post->published_at->format('d/m/Y à H:i');
                                } elseif ($post->published_at) {
                                    echo date('d/m/Y à H:i', strtotime($post->published_at));
                                } else {
                                    echo 'Non publié';
                                }
                            @endphp
                        </strong>
                    </div>

                    <!-- Statut -->
                    <div class="mr-3 mb-2">
                        @if($post->status == 'published')
                            <span class="badge badge-success">
                                <i class="fas fa-check-circle mr-1"></i> Publié
                            </span>
                        @else
                            <span class="badge badge-warning">
                                <i class="fas fa-edit mr-1"></i> Brouillon
                            </span>
                        @endif
                    </div>

                    <!-- Catégorie -->
                    @if($post->category)
                    <div class="mb-2">
                        <span class="badge" style="background-color: {{ $post->category->color ?? '#17a2b8' }}; color: white;">
                            <i class="fas fa-tag mr-1"></i>{{ $post->category->name }}
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Statistiques -->
                <div class="row text-center mb-4">
                    <div class="col-4">
                        <div class="p-3 bg-light rounded">
                            <h3 class="mb-0 text-info">{{ $post->views ?? 0 }}</h3>
                            <small class="text-muted">Vues</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 bg-light rounded">
                            <h3 class="mb-0 text-success">{{ $post->comments_count ?? 0 }}</h3>
                            <small class="text-muted">Commentaires</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 bg-light rounded">
                            <h3 class="mb-0 text-warning">{{ $post->likes_count ?? 0 }}</h3>
                            <small class="text-muted">Likes</small>
                        </div>
                    </div>
                </div>

                <!-- Contenu -->
                <div class="article-content mb-4">
                    <h4 class="border-bottom pb-2 mb-3">
                        <i class="fas fa-align-left text-info mr-2"></i>Contenu
                    </h4>
                    <div class="p-3 bg-light rounded">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>

                <!-- Extrait -->
                @if($post->excerpt)
                <div class="mb-4">
                    <h5 class="text-info">
                        <i class="fas fa-quote-left mr-2"></i>Extrait
                    </h5>
                    <div class="p-3 bg-light rounded border-left-4 border-info">
                        {{ $post->excerpt }}
                    </div>
                </div>
                @endif

                <!-- Tags -->
                @if($post->tags && $post->tags->count() > 0)
                <div class="mb-4">
                    <h5 class="text-info">
                        <i class="fas fa-hashtag mr-2"></i>Tags
                    </h5>
                    <div class="d-flex flex-wrap">
                        @foreach($post->tags as $tag)
                            <span class="badge badge-secondary mr-2 mb-2 p-2">
                                <i class="fas fa-tag mr-1"></i>{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Métadonnées SEO -->
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-search mr-2"></i>Informations SEO
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Slug :</strong><br>
                                    <code>{{ $post->slug }}</code>
                                </p>
                                @if($post->meta_title)
                                <p class="mb-2">
                                    <strong>Titre SEO :</strong><br>
                                    {{ $post->meta_title }}
                                </p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if($post->meta_description)
                                <p class="mb-2">
                                    <strong>Description SEO :</strong><br>
                                    {{ $post->meta_description }}
                                </p>
                                @endif
                                @if($post->meta_keywords)
                                <p class="mb-0">
                                    <strong>Mots-clés SEO :</strong><br>
                                    {{ $post->meta_keywords }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="card card-info mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bolt mr-2"></i>
                    Actions rapides
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-outline-primary btn-block" onclick="copyPermalink()">
                            <i class="fas fa-link mr-1"></i> Copier le lien
                        </button>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-outline-warning btn-block" onclick="toggleStatus()">
                            <i class="fas fa-toggle-{{ $post->status == 'published' ? 'off' : 'on' }} mr-1"></i>
                            {{ $post->status == 'published' ? 'Dépublier' : 'Publier' }}
                        </button>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-info btn-block">
                            <i class="fas fa-edit mr-1"></i> Modifier
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-outline-danger btn-block" onclick="confirmDelete()">
                            <i class="fas fa-trash mr-1"></i> Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Informations techniques -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informations techniques
                </h3>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-database text-info mr-2"></i>
                            <strong>ID</strong>
                        </span>
                        <span class="badge badge-info">{{ $post->id }}</span>
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-calendar-plus text-info mr-2"></i>
                        <strong>Création :</strong><br>
                        <small class="text-muted">
                            @php
                                if ($post->created_at instanceof \Carbon\Carbon) {
                                    echo $post->created_at->format('d/m/Y à H:i:s');
                                } else {
                                    echo date('d/m/Y à H:i:s', strtotime($post->created_at));
                                }
                            @endphp
                        </small>
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-calendar-check text-info mr-2"></i>
                        <strong>Dernière modification :</strong><br>
                        <small class="text-muted">
                            @php
                                if ($post->updated_at instanceof \Carbon\Carbon) {
                                    echo $post->updated_at->format('d/m/Y à H:i:s');
                                } else {
                                    echo date('d/m/Y à H:i:s', strtotime($post->updated_at));
                                }
                            @endphp
                        </small>
                    </li>
                    @if($post->published_at)
                    <li class="list-group-item">
                        <i class="fas fa-calendar-alt text-info mr-2"></i>
                        <strong>Publication :</strong><br>
                        <small class="text-muted">
                            @php
                                if ($post->published_at instanceof \Carbon\Carbon) {
                                    echo $post->published_at->format('d/m/Y à H:i:s');
                                } else {
                                    echo date('d/m/Y à H:i:s', strtotime($post->published_at));
                                }
                            @endphp
                        </small>
                    </li>
                    @endif
                    <li class="list-group-item">
                        <i class="fas fa-code text-info mr-2"></i>
                        <strong>Type de contenu :</strong><br>
                        <small class="text-muted">Article standard</small>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Statistiques avancées -->
        <div class="card card-info mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Statistiques avancées
                </h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6 class="text-info">
                        <i class="fas fa-eye mr-1"></i> Performance des vues
                    </h6>
                    <div class="progress" style="height: 20px;">
                        @php
                            $maxViews = 1000; // Valeur maximale de référence
                            $viewPercentage = min(100, ($post->views ?? 0) / $maxViews * 100);
                        @endphp
                        <div class="progress-bar bg-info"
                             role="progressbar"
                             style="width: {{ $viewPercentage }}%"
                             aria-valuenow="{{ $post->views ?? 0 }}"
                             aria-valuemin="0"
                             aria-valuemax="{{ $maxViews }}">
                            {{ $post->views ?? 0 }} vues
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <h6 class="text-info">
                        <i class="fas fa-comments mr-1"></i> Engagement
                    </h6>
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="p-2 bg-light rounded">
                                <h4 class="mb-0 text-success">{{ $post->comments_count ?? 0 }}</h4>
                                <small class="text-muted">Commentaires</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded">
                                <h4 class="mb-0 text-warning">
                                    @php
                                        $engagementRate = $post->comments_count > 0 && $post->views > 0
                                            ? round(($post->comments_count / $post->views) * 100, 2)
                                            : 0;
                                    @endphp
                                    {{ $engagementRate }}%
                                </h4>
                                <small class="text-muted">Taux d'engagement</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-0">
                    <h6 class="text-info">
                        <i class="fas fa-clock mr-1"></i> Temps de lecture estimé
                    </h6>
                    <div class="p-3 bg-light rounded text-center">
                        @php
                            $wordCount = str_word_count(strip_tags($post->content));
                            $readingTime = ceil($wordCount / 200); // 200 mots par minute
                        @endphp
                        <h2 class="text-info mb-0">{{ $readingTime }}</h2>
                        <small class="text-muted">minute{{ $readingTime > 1 ? 's' : '' }}</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Partage et prévisualisation -->
        <div class="card card-info mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-share-alt mr-2"></i>
                    Partage & Prévisualisation
                </h3>
            </div>
            <div class="card-body">
                <!-- Lien permanent -->
                <div class="mb-3">
                    <label class="font-weight-bold">
                        <i class="fas fa-link mr-1"></i> Lien permanent
                    </label>
                    <div class="input-group">
                        <input type="text"
                               class="form-control"
                               id="permalink"
                               value="{{ route('posts.show', $post->slug) }}"
                               readonly>
                        <div class="input-group-append">
                            <button class="btn btn-outline-info" onclick="copyPermalink()">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Boutons de partage -->
                <div class="mb-3">
                    <label class="font-weight-bold">
                        <i class="fas fa-share-square mr-1"></i> Partage rapide
                    </label>
                    <div class="d-flex justify-content-around">
                        <button class="btn btn-outline-primary btn-sm" onclick="shareOnFacebook()">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-outline-info btn-sm" onclick="shareOnTwitter()">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-outline-danger btn-sm" onclick="shareOnLinkedIn()">
                            <i class="fab fa-linkedin"></i>
                        </button>
                        <button class="btn btn-outline-success btn-sm" onclick="shareOnWhatsApp()">
                            <i class="fab fa-whatsapp"></i>
                        </button>
                    </div>
                </div>

                <!-- Prévisualisation -->
                <div class="mb-0">
                    <label class="font-weight-bold">
                        <i class="fas fa-desktop mr-1"></i> Prévisualisation
                    </label>
                    <a href="{{ route('posts.show', $post->slug) }}"
                       target="_blank"
                       class="btn btn-outline-secondary btn-block">
                        <i class="fas fa-external-link-alt mr-1"></i> Voir sur le site
                    </a>
                </div>
            </div>
        </div>

        <!-- Articles similaires -->
        @if($similarPosts && $similarPosts->count() > 0)
        <div class="card card-info mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-layer-group mr-2"></i>
                    Articles similaires
                </h3>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($similarPosts as $similar)
                    <a href="{{ route('posts.show', $similar) }}"
                       class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ Str::limit($similar->title, 40) }}</h6>
                            <small class="text-muted">
                                @if($similar->category)
                                <span class="badge" style="background-color: {{ $similar->category->color ?? '#17a2b8' }}; color: white;">
                                    {{ $similar->category->name }}
                                </span>
                                @endif
                            </small>
                        </div>
                        <small class="text-muted">
                            <i class="fas fa-eye mr-1"></i>{{ $similar->views ?? 0 }} vues
                            • {{ $similar->created_at->diffForHumans() }}
                        </small>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Confirmer la suppression
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cet article ?</p>
                <div class="alert alert-warning">
                    <h6><i class="fas fa-exclamation-circle mr-2"></i>Attention !</h6>
                    <ul class="mb-0">
                        <li>Cette action est irréversible</li>
                        <li>Tous les commentaires associés seront supprimés</li>
                        <li>L'image sera définitivement supprimée</li>
                        <li>Les liens partagés ne fonctionneront plus</li>
                    </ul>
                </div>
                <p class="mb-0">
                    <strong>Titre :</strong> {{ $post->title }}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Annuler
                </button>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash mr-1"></i> Supprimer définitivement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-top: 3px solid #17a2b8;
    }

    .card-header {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border-bottom: 2px solid #dee2e6;
    }

    .badge {
        font-size: 0.85em;
        padding: 5px 10px;
    }

    .article-content {
        font-size: 1.1em;
        line-height: 1.8;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
    }

    .list-group-item {
        border: none;
        padding: 15px 0;
    }

    .list-group-item:first-child {
        padding-top: 0;
    }

    .list-group-item:last-child {
        padding-bottom: 0;
    }

    .border-left-4 {
        border-left: 4px solid #17a2b8 !important;
    }

    .progress {
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar {
        transition: width 0.6s ease;
    }

    .breadcrumb {
        background-color: transparent;
        padding-left: 0;
    }

    .breadcrumb-item.active {
        color: #17a2b8;
        font-weight: 500;
    }

    .img-thumbnail {
        border-radius: 5px;
        border: 1px solid #dee2e6;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(23, 162, 184, 0.05);
    }

    .input-group-text {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Initialiser les tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });

    function copyPermalink() {
        const permalinkInput = document.getElementById('permalink');
        permalinkInput.select();
        permalinkInput.setSelectionRange(0, 99999); // Pour mobile
        document.execCommand('copy');

        Swal.fire({
            icon: 'success',
            title: 'Lien copié !',
            text: 'Le lien de l\'article a été copié dans le presse-papier',
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }

    function toggleStatus() {
        Swal.fire({
            title: '{{ $post->status == 'published' ? 'Dépublier' : 'Publier' }} cet article ?',
            text: "{{ $post->status == 'published' ? 'L\'article ne sera plus visible sur le site' : 'L\'article sera visible sur le site' }}",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '{{ $post->status == 'published' ? 'Oui, dépublier' : 'Oui, publier' }}',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Soumettre le formulaire de changement de statut
                $.ajax({
                    url: '{{ route("posts.toggle-status", $post) }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Traitement en cours...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Succès !',
                            text: response.message || 'Statut modifié avec succès',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur !',
                            text: xhr.responseJSON?.message || 'Une erreur est survenue'
                        });
                    }
                });
            }
        });
    }

    function confirmDelete() {
        $('#deleteModal').modal('show');
    }

    // Soumission du formulaire de suppression
    $('#deleteForm').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Dernière confirmation',
            text: "Êtes-vous absolument sûr ? Cette action ne peut pas être annulée.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer définitivement',
            cancelButtonText: 'Annuler',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Afficher l'animation de chargement
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Suppression...');

                // Soumettre le formulaire
                this.submit();
            }
        });
    });

    // Fonctions de partage sur les réseaux sociaux
    function shareOnFacebook() {
        const url = encodeURIComponent('{{ route("posts.show", $post->slug) }}');
        const text = encodeURIComponent('{{ $post->title }}');
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${text}`, '_blank');
    }

    function shareOnTwitter() {
        const url = encodeURIComponent('{{ route("posts.show", $post->slug) }}');
        const text = encodeURIComponent('{{ $post->title }}');
        window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank');
    }

    function shareOnLinkedIn() {
        const url = encodeURIComponent('{{ route("posts.show", $post->slug) }}');
        const title = encodeURIComponent('{{ $post->title }}');
        const summary = encodeURIComponent('{{ Str::limit(strip_tags($post->content), 100) }}');
        window.open(`https://www.linkedin.com/shareArticle?mini=true&url=${url}&title=${title}&summary=${summary}`, '_blank');
    }

    function shareOnWhatsApp() {
        const url = encodeURIComponent('{{ route("posts.show", $post->slug) }}');
        const text = encodeURIComponent('{{ $post->title }} - ');
        window.open(`https://wa.me/?text=${text}${url}`, '_blank');
    }

    // Export des données
    function exportArticle(format) {
        Swal.fire({
            title: `Exporter en ${format.toUpperCase()} ?`,
            text: 'Génération du fichier en cours...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        window.location.href = `{{ route('posts.export', $post) }}?format=${format}`;

        setTimeout(() => {
            Swal.close();
        }, 3000);
    }

    // Aperçu d'impression
    function printArticle() {
        const printContent = `
            <html>
            <head>
                <title>{{ $post->title }}</title>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; }
                    h1 { color: #333; border-bottom: 2px solid #17a2b8; padding-bottom: 10px; }
                    .meta { color: #666; margin-bottom: 20px; }
                    .content { margin-top: 20px; }
                    @media print {
                        .no-print { display: none; }
                    }
                </style>
            </head>
            <body>
                <h1>{{ $post->title }}</h1>
                <div class="meta">
                    Publié le : {{ $post->published_at ? $post->published_at->format('d/m/Y') : 'Non publié' }}<br>
                    Auteur : {{ $post->author->name ?? 'Inconnu' }}<br>
                    Catégorie : {{ $post->category->name ?? 'Non catégorisé' }}
                </div>
                <div class="content">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </body>
            </html>
        `;

        const printWindow = window.open('', '_blank');
        printWindow.document.write(printContent);
        printWindow.document.close();
        printWindow.print();
    }

    // Notifications
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
