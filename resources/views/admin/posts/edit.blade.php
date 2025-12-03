@extends('adminlte::page')

@section('title', 'Modifier l\'Article')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-edit text-primary mr-2"></i>
            Modifier l'article
        </h1>
        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Retour à la liste
        </a>
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
                <i class="fas fa-edit"></i> Modifier "{{ Str::limit($post->title, 30) }}"
            </li>
        </ol>
    </nav>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier l'article
                </h3>
                <div class="card-tools">
                    <span class="badge badge-light">
                        ID: {{ $post->id }}
                    </span>
                </div>
            </div>

            <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" id="editPostForm">
                @csrf
                @method('PUT')

                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <h5>
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Veuillez corriger les erreurs suivantes
                        </h5>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="title" class="font-weight-bold">
                            <i class="fas fa-heading text-primary mr-1"></i>
                            Titre de l'article
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="title"
                               id="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $post->title) }}"
                               required
                               maxlength="255"
                               placeholder="Entrez le titre de l'article">
                        @error('title')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </div>
                        @enderror
                        <small class="form-text text-muted">
                            Maximum 255 caractères
                            <span class="float-right" id="titleCounter">{{ strlen(old('title', $post->title)) }}/255</span>
                        </small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id" class="font-weight-bold">
                                    <i class="fas fa-tag text-primary mr-1"></i>
                                    Catégorie
                                </label>
                                <select name="category_id"
                                        id="category_id"
                                        class="form-control @error('category_id') is-invalid @enderror select2">
                                    <option value="">-- Choisir une catégorie --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}
                                                data-color="{{ $category->color ?? '#007bff' }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status" class="font-weight-bold">
                                    <i class="fas fa-circle text-primary mr-1"></i>
                                    Statut
                                </label>
                                <select name="status"
                                        id="status"
                                        class="form-control @error('status') is-invalid @enderror">
                                    <option value="draft" {{ old('status', $post->status ?? 'draft') == 'draft' ? 'selected' : '' }}>
                                        <i class="fas fa-edit"></i> Brouillon
                                    </option>
                                    <option value="published" {{ old('status', $post->status ?? 'draft') == 'published' ? 'selected' : '' }}>
                                        <i class="fas fa-check-circle"></i> Publié
                                    </option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tags" class="font-weight-bold">
                            <i class="fas fa-hashtag text-primary mr-1"></i>
                            Tags
                        </label>
                        <select name="tags[]"
                                id="tags"
                                class="form-control @error('tags') is-invalid @enderror select2"
                                multiple="multiple"
                                data-placeholder="Sélectionnez des tags">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}"
                                        {{ in_array($tag->id, old('tags', $postTags ?? [])) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tags')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </div>
                        @enderror
                        <small class="form-text text-muted">
                            Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs tags
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="content" class="font-weight-bold">
                            <i class="fas fa-align-left text-primary mr-1"></i>
                            Contenu de l'article
                            <span class="text-danger">*</span>
                        </label>
                        <textarea name="content"
                                  id="content"
                                  class="form-control @error('content') is-invalid @enderror"
                                  rows="15"
                                  required
                                  placeholder="Rédigez votre article ici...">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </div>
                        @enderror
                        <small class="form-text text-muted">
                            <span id="contentCounter">{{ strlen(old('content', $post->content)) }}</span> caractères
                        </small>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">
                            <i class="fas fa-image text-primary mr-1"></i>
                            Image de l'article
                        </label>
                        <div class="custom-file">
                            <input type="file"
                                   name="image"
                                   id="image"
                                   class="custom-file-input @error('image') is-invalid @enderror"
                                   accept="image/*">
                            <label class="custom-file-label" for="image" id="imageLabel">
                                <i class="fas fa-upload mr-1"></i>Choisir une image
                            </label>
                            @error('image')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>
                        <small class="form-text text-muted">
                            Formats acceptés: JPG, PNG, GIF, WebP | Taille max: 5MB
                        </small>

                        @if($post->image)
                        <div class="mt-3">
                            <p class="font-weight-bold">Image actuelle :</p>
                            <div class="d-flex align-items-center">
                                <img src="{{ Storage::exists('posts/' . $post->image) ? asset('storage/posts/' . $post->image) : asset('StockPiece/posts/' . $post->image) }}"
                                     class="img-thumbnail mr-3"
                                     style="max-width: 150px; max-height: 150px;"
                                     id="currentImage">
                                <div>
                                    <button type="button"
                                            class="btn btn-outline-danger btn-sm"
                                            onclick="removeImage()">
                                        <i class="fas fa-trash mr-1"></i> Supprimer l'image
                                    </button>
                                    <input type="hidden" name="remove_image" id="removeImageField" value="0">
                                    <p class="small text-muted mt-2">
                                        <i class="fas fa-info-circle"></i> Cochez cette option pour supprimer l'image actuelle
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="mt-3" id="imagePreviewContainer" style="display: none;">
                            <p class="font-weight-bold">Aperçu de la nouvelle image :</p>
                            <img id="imagePreview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <i class="fas fa-calendar text-primary mr-1"></i>
                                    Dates
                                </label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-1">
                                        <small class="text-muted">Créé le :</small>
                                        <br>
                                        <strong>
                                            @php
                                                if ($post->created_at instanceof \Carbon\Carbon) {
                                                    echo $post->created_at->format('d/m/Y à H:i');
                                                } else {
                                                    echo date('d/m/Y à H:i', strtotime($post->created_at));
                                                }
                                            @endphp
                                        </strong>
                                    </p>
                                    <p class="mb-0">
                                        <small class="text-muted">Dernière modification :</small>
                                        <br>
                                        <strong>
                                            @php
                                                if ($post->updated_at instanceof \Carbon\Carbon) {
                                                    echo $post->updated_at->format('d/m/Y à H:i');
                                                } else {
                                                    echo date('d/m/Y à H:i', strtotime($post->updated_at));
                                                }
                                            @endphp
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <i class="fas fa-chart-bar text-primary mr-1"></i>
                                    Statistiques
                                </label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-1">
                                        <i class="fas fa-eye mr-2"></i>
                                        <strong>{{ $post->views ?? 0 }}</strong> vues
                                    </p>
                                    <p class="mb-0">
                                        <i class="fas fa-comment mr-2"></i>
                                        <strong>{{ $post->comments_count ?? 0 }}</strong> commentaires
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="button" class="btn btn-outline-secondary" onclick="saveDraft()">
                                <i class="fas fa-save mr-1"></i> Enregistrer comme brouillon
                            </button>
                        </div>

                        <div>
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times mr-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save mr-1"></i> Mettre à jour l'article
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-lightbulb mr-2"></i>
                    Conseils de rédaction
                </h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h6><i class="fas fa-check-circle mr-2"></i>Bonnes pratiques :</h6>
                    <ul class="mb-0">
                        <li>Utilisez des titres accrocheurs</li>
                        <li>Structurez votre contenu avec des paragraphes</li>
                        <li>Ajoutez des images pertinentes</li>
                        <li>Utilisez des tags pertinents</li>
                    </ul>
                </div>

                <div class="alert alert-success">
                    <h6><i class="fas fa-rocket mr-2"></i>Pour le référencement :</h6>
                    <ul class="mb-0">
                        <li>Inclure des mots-clés dans le titre</li>
                        <li>Utiliser des balises H2, H3</li>
                        <li>Optimiser les images (noms, alt)</li>
                        <li>Écrire une méta-description</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card card-warning mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-database mr-2"></i>
                    Compatibilité
                </h3>
            </div>
            <div class="card-body">
                <p class="small text-muted mb-2">
                    <i class="fas fa-check text-success mr-2"></i>
                    Compatible avec MySQL, SQLite et PostgreSQL
                </p>
                <p class="small text-muted mb-2">
                    <i class="fas fa-check text-success mr-2"></i>
                    Gestion des images optimisée
                </p>
                <p class="small text-muted mb-0">
                    <i class="fas fa-check text-success mr-2"></i>
                    Validation multi-base de données
                </p>
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

    .card-header {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border-bottom: 2px solid #dee2e6;
    }

    .form-control:focus, .custom-file-input:focus ~ .custom-file-label {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    .custom-file-label::after {
        content: "Parcourir";
    }

    textarea#content {
        min-height: 300px;
        resize: vertical;
    }

    .img-thumbnail {
        border: 2px dashed #dee2e6;
        padding: 5px;
    }

    .select2-container--default .select2-selection--multiple {
        min-height: 38px;
        border: 1px solid #ced4da;
    }

    .select2-container--default .select2-selection--multiple:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialiser Select2
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%'
        });

        // Compteur de caractères pour le titre
        $('#title').on('input', function() {
            const length = $(this).val().length;
            $('#titleCounter').text(length + '/255');

            if (length > 200) {
                $('#titleCounter').addClass('text-warning');
            } else {
                $('#titleCounter').removeClass('text-warning');
            }
        });

        // Compteur de caractères pour le contenu
        $('#content').on('input', function() {
            const length = $(this).val().length;
            $('#contentCounter').text(length);

            if (length > 10000) {
                $('#contentCounter').addClass('text-warning');
            } else {
                $('#contentCounter').removeClass('text-warning');
            }
        });

        // Aperçu de l'image
        $('#image').on('change', function(e) {
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
                $('#imagePreviewContainer').show();
            }

            if (file) {
                reader.readAsDataURL(file);
            }

            // Mettre à jour le label
            const fileName = $(this).val().split('\\').pop();
            $('#imageLabel').html('<i class="fas fa-file-image mr-1"></i>' + fileName);
        });

        // Validation du formulaire
        $('#editPostForm').on('submit', function(e) {
            const title = $('#title').val().trim();
            const content = $('#content').val().trim();

            if (!title) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Titre requis',
                    text: 'Veuillez saisir un titre pour l\'article',
                    confirmButtonColor: '#dc3545'
                });
                $('#title').focus();
                return false;
            }

            if (!content) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Contenu requis',
                    text: 'Veuillez saisir le contenu de l\'article',
                    confirmButtonColor: '#dc3545'
                });
                $('#content').focus();
                return false;
            }

            // Validation de la taille de l'image
            const imageInput = document.getElementById('image');
            if (imageInput.files.length > 0) {
                const fileSize = imageInput.files[0].size / 1024 / 1024; // en MB
                if (fileSize > 5) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Fichier trop volumineux',
                        text: 'La taille de l\'image ne doit pas dépasser 5MB',
                        confirmButtonColor: '#dc3545'
                    });
                    return false;
                }

                // Validation du type de fichier
                const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!validTypes.includes(imageInput.files[0].type)) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Format non supporté',
                        text: 'Seuls les formats JPG, PNG, GIF et WebP sont acceptés',
                        confirmButtonColor: '#dc3545'
                    });
                    return false;
                }
            }

            // Show loading state
            const submitBtn = $('#submitBtn');
            const originalText = submitBtn.html();
            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Mise à jour...');

            // Réactiver après 15 secondes maximum
            setTimeout(function() {
                submitBtn.prop('disabled', false).html(originalText);
            }, 15000);
        });

        // Initialiser les compteurs
        $('#title').trigger('input');
        $('#content').trigger('input');

        // Auto-save draft (simulation)
        let autoSaveTimer;
        $('#title, #content').on('input', function() {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(function() {
                // Vous pouvez implémenter l'auto-save ici
                console.log('Auto-save...');
            }, 5000);
        });
    });

    function removeImage() {
        Swal.fire({
            title: 'Supprimer l\'image ?',
            text: "L'image actuelle sera supprimée de l'article",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#removeImageField').val('1');
                $('#currentImage').fadeOut(300, function() {
                    $(this).remove();
                    Swal.fire({
                        icon: 'success',
                        title: 'Image supprimée',
                        text: 'L\'image sera supprimée lors de l\'enregistrement',
                        timer: 1500,
                        showConfirmButton: false
                    });
                });
            }
        });
    }

    function saveDraft() {
        $('#status').val('draft');
        $('#editPostForm').submit();
    }

    // Afficher l'image actuelle dans un modal
    function viewCurrentImage() {
        const src = $('#currentImage').attr('src');
        Swal.fire({
            html: `<img src="${src}" class="img-fluid" alt="Image de l'article">`,
            showConfirmButton: false,
            showCloseButton: true,
            width: '80%'
        });
    }
</script>
@stop
