@extends('adminlte::page')

@section('title', 'Nouvel Article')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-plus-circle text-success mr-2"></i>
            Créer un nouvel article
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
                <i class="fas fa-plus-circle"></i> Nouvel article
            </li>
        </ol>
    </nav>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Nouvel article
                </h3>
                <div class="card-tools">
                    <span class="badge badge-light">
                        <i class="fas fa-database"></i>
                        @php
                            $connection = config('database.default');
                            $driver = config("database.connections.{$connection}.driver");
                            $drivers = [
                                'mysql' => 'MySQL',
                                'sqlite' => 'SQLite',
                                'pgsql' => 'PostgreSQL'
                            ];
                            echo $drivers[$driver] ?? $driver;
                        @endphp
                    </span>
                </div>
            </div>

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" id="createPostForm">
                @csrf

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

                    <div class="form-group">
                        <label for="title" class="font-weight-bold">
                            <i class="fas fa-heading text-success mr-1"></i>
                            Titre de l'article
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="title"
                               id="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}"
                               required
                               maxlength="255"
                               placeholder="Entrez un titre accrocheur"
                               autofocus>
                        @error('title')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </div>
                        @enderror
                        <small class="form-text text-muted">
                            Maximum 255 caractères
                            <span class="float-right" id="titleCounter">0/255</span>
                        </small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id" class="font-weight-bold">
                                    <i class="fas fa-tag text-success mr-1"></i>
                                    Catégorie
                                </label>
                                <select name="category_id"
                                        id="category_id"
                                        class="form-control @error('category_id') is-invalid @enderror select2">
                                    <option value="">-- Choisir une catégorie --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                                                data-color="{{ $category->color ?? '#28a745' }}">
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
                                    <i class="fas fa-circle text-success mr-1"></i>
                                    Statut
                                </label>
                                <select name="status"
                                        id="status"
                                        class="form-control @error('status') is-invalid @enderror">
                                    <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>
                                        <i class="fas fa-edit"></i> Brouillon
                                    </option>
                                    <option value="published" {{ old('status', 'draft') == 'published' ? 'selected' : '' }}>
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
                            <i class="fas fa-hashtag text-success mr-1"></i>
                            Tags
                        </label>
                        <select name="tags[]"
                                id="tags"
                                class="form-control @error('tags') is-invalid @enderror select2"
                                multiple="multiple"
                                data-placeholder="Sélectionnez des tags">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}"
                                        {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
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
                            Appuyez sur Entrée pour ajouter un nouveau tag
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="content" class="font-weight-bold">
                            <i class="fas fa-align-left text-success mr-1"></i>
                            Contenu de l'article
                            <span class="text-danger">*</span>
                        </label>
                        <textarea name="content"
                                  id="content"
                                  class="form-control @error('content') is-invalid @enderror"
                                  rows="15"
                                  required
                                  placeholder="Rédigez votre article ici...">{{ old('content') }}</textarea>
                        @error('content')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </div>
                        @enderror
                        <small class="form-text text-muted">
                            <span id="contentCounter">0</span> caractères
                            <button type="button" class="btn btn-outline-info btn-sm float-right" onclick="formatText('bold')">
                                <i class="fas fa-bold"></i>
                            </button>
                            <button type="button" class="btn btn-outline-info btn-sm float-right mr-1" onclick="formatText('italic')">
                                <i class="fas fa-italic"></i>
                            </button>
                            <button type="button" class="btn btn-outline-info btn-sm float-right mr-1" onclick="formatText('underline')">
                                <i class="fas fa-underline"></i>
                            </button>
                        </small>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">
                            <i class="fas fa-image text-success mr-1"></i>
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

                        <div class="mt-3" id="imagePreviewContainer" style="display: none;">
                            <p class="font-weight-bold">Aperçu de l'image :</p>
                            <img id="imagePreview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                <i class="fas fa-redo mr-1"></i> Réinitialiser
                            </button>
                            <button type="button" class="btn btn-outline-info ml-2" onclick="saveDraft()">
                                <i class="fas fa-save mr-1"></i> Enregistrer comme brouillon
                            </button>
                        </div>

                        <div>
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times mr-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-success" id="submitBtn">
                                <i class="fas fa-plus-circle mr-1"></i> Créer l'article
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
                    <i class="fas fa-magic mr-2"></i>
                    Assistant de création
                </h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <button class="btn btn-outline-primary btn-block mb-2" onclick="generateTitle()">
                        <i class="fas fa-lightbulb mr-1"></i> Générer un titre
                    </button>
                    <button class="btn btn-outline-secondary btn-block" onclick="suggestTags()">
                        <i class="fas fa-hashtag mr-1"></i> Suggérer des tags
                    </button>
                </div>

                <div class="alert alert-warning">
                    <h6><i class="fas fa-exclamation-triangle mr-2"></i>À vérifier :</h6>
                    <ul class="mb-0 small">
                        <li>Orthographe et grammaire</li>
                        <li>Liens fonctionnels</li>
                        <li>Attributs ALT des images</li>
                        <li>Méta-description</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card card-warning mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-history mr-2"></i>
                    Récents articles
                </h3>
            </div>
            <div class="card-body">
                @if($recentPosts && $recentPosts->count() > 0)
                    <ul class="list-unstyled">
                        @foreach($recentPosts as $recent)
                        <li class="mb-2">
                            <a href="{{ route('posts.edit', $recent->id) }}" class="text-dark">
                                <i class="fas fa-file-alt mr-2"></i>
                                {{ Str::limit($recent->title, 40) }}
                            </a>
                            <br>
                            <small class="text-muted">
                                @php
                                    if ($recent->created_at instanceof \Carbon\Carbon) {
                                        echo $recent->created_at->format('d/m');
                                    } else {
                                        echo date('d/m', strtotime($recent->created_at));
                                    }
                                @endphp
                                @if($recent->category)
                                    • <span class="badge badge-sm" style="background-color: {{ $recent->category->color ?? '#28a745' }}; color: white;">
                                        {{ $recent->category->name }}
                                    </span>
                                @endif
                            </small>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted text-center">
                        <i class="fas fa-inbox fa-2x mb-2"></i><br>
                        Aucun article récent
                    </p>
                @endif
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
        border-top: 3px solid #28a745;
    }

    .card-header {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border-bottom: 2px solid #dee2e6;
    }

    .form-control:focus, .custom-file-input:focus ~ .custom-file-label {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40,167,69,.25);
    }

    .custom-file-label::after {
        content: "Parcourir";
    }

    textarea#content {
        min-height: 300px;
        resize: vertical;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .btn-outline-info {
        border-width: 1px;
    }

    .select2-container--default .select2-selection--multiple {
        min-height: 38px;
        border: 1px solid #ced4da;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialiser Select2 avec création de tags
         $('#tags').select2({
            theme: 'bootstrap4',
            width: '100%',
            tags: true,
            createTag: function(params) {
                const term = $.trim(params.term);
                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term + ' (nouveau)',
                    newTag: true
                };
            }
        });

        $('#category_id').select2({
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
        $('#createPostForm').on('submit', function(e) {
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

            // Confirmation pour publication immédiate
            if ($('#status').val() === 'published') {
                e.preventDefault();

                Swal.fire({
                    title: 'Publier immédiatement ?',
                    html: `
                        <div class="text-left">
                            <p>L'article sera visible par tous les visiteurs.</p>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="scheduleCheck">
                                <label class="form-check-label" for="scheduleCheck">
                                    Programmer la publication
                                </label>
                            </div>
                            <div id="scheduleFields" class="mt-2" style="display: none;">
                                <input type="datetime-local" class="form-control" id="publishDate">
                            </div>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-check mr-1"></i> Publier',
                    cancelButtonText: '<i class="fas fa-edit mr-1"></i> Enregistrer comme brouillon'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading state
                        const submitBtn = $('#submitBtn');
                        const originalText = submitBtn.html();
                        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Publication...');

                        // Submit the form
                        $(this).off('submit').submit();
                    } else {
                        $('#status').val('draft');
                        $(this).submit();
                    }
                });

                // Toggle schedule fields
                $('#scheduleCheck').on('change', function() {
                    if ($(this).is(':checked')) {
                        $('#scheduleFields').show();
                    } else {
                        $('#scheduleFields').hide();
                    }
                });

                return false;
            }

            // Show loading state for draft
            const submitBtn = $('#submitBtn');
            const originalText = submitBtn.html();
            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Création...');

            // Réactiver après 15 secondes maximum
            setTimeout(function() {
                submitBtn.prop('disabled', false).html(originalText);
            }, 15000);
        });

        // Initialiser les compteurs
        $('#title').trigger('input');
        $('#content').trigger('input');
    });

    function resetForm() {
        Swal.fire({
            title: 'Réinitialiser le formulaire ?',
            text: "Tous les champs seront vidés",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6c757d',
            cancelButtonColor: '#28a745',
            confirmButtonText: '<i class="fas fa-redo mr-1"></i> Réinitialiser',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#createPostForm')[0].reset();
                $('#tags').val(null).trigger('change');
                $('#category_id').val(null).trigger('change');
                $('#titleCounter').text('0/255');
                $('#contentCounter').text('0');
                $('#imagePreviewContainer').hide();
                $('.custom-file-label').html('<i class="fas fa-upload mr-1"></i>Choisir une image');
                $('#title').focus();

                Swal.fire({
                    icon: 'success',
                    title: 'Formulaire réinitialisé',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }

    function saveDraft() {
        $('#status').val('draft');
        $('#createPostForm').submit();
    }

    function generateTitle() {
        const titles = [
            "Guide complet : ",
            "10 astuces pour ",
            "Les meilleures pratiques de ",
            "Comment réussir votre ",
            "Tout ce que vous devez savoir sur ",
            "Le futur de ",
            "Découvrez notre analyse de "
        ];

        const randomTitle = titles[Math.floor(Math.random() * titles.length)];
        const currentTitle = $('#title').val();

        if (currentTitle) {
            $('#title').val(randomTitle + currentTitle);
        } else {
            $('#title').val(randomTitle + '[votre sujet]');
        }

        $('#title').trigger('input');
        $('#title').focus();

        Swal.fire({
            icon: 'info',
            title: 'Titre généré',
            text: 'N\'oubliez pas de le personnaliser !',
            timer: 1500,
            showConfirmButton: false
        });
    }

    function suggestTags() {
        const content = $('#content').val().toLowerCase();
        const commonWords = ['le', 'la', 'les', 'un', 'une', 'des', 'et', 'ou', 'où', 'à', 'au', 'aux', 'de', 'du', 'des', 'dans', 'par', 'pour', 'sur', 'avec', 'sans', 'sous'];

        // Extraire les mots significatifs
        const words = content.split(/\s+/)
            .filter(word => word.length > 3)
            .filter(word => !commonWords.includes(word))
            .map(word => word.replace(/[^a-zA-ZÀ-ÿ]/g, '').toLowerCase());

        // Compter les occurrences
        const wordCount = {};
        words.forEach(word => {
            if (wordCount[word]) {
                wordCount[word]++;
            } else {
                wordCount[word] = 1;
            }
        });

        // Obtenir les mots les plus fréquents
        const suggestedTags = Object.keys(wordCount)
            .sort((a, b) => wordCount[b] - wordCount[a])
            .slice(0, 5);

        if (suggestedTags.length > 0) {
            const $tagsSelect = $('#tags');
            const currentTags = $tagsSelect.val() || [];

            suggestedTags.forEach(tag => {
                if (!currentTags.includes(tag)) {
                    // Vérifier si le tag existe déjà
                    const exists = Array.from($tagsSelect.find('option')).some(option => option.text.toLowerCase().includes(tag));
                    if (!exists) {
                        // Ajouter le nouveau tag
                        const $newOption = $('<option>').val(tag).text(tag).attr('selected', true);
                        $tagsSelect.append($newOption);
                    }
                }
            });

            $tagsSelect.trigger('change');

            Swal.fire({
                title: 'Tags suggérés',
                html: `
                    <div class="text-left">
                        <p>Basés sur votre contenu :</p>
                        <ul>
                            ${suggestedTags.map(tag => `<li><strong>${tag}</strong></li>`).join('')}
                        </ul>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'OK'
            });
        } else {
            Swal.fire({
                icon: 'info',
                title: 'Pas assez de contenu',
                text: 'Rédigez plus de contenu pour obtenir des suggestions de tags',
                confirmButtonText: 'OK'
            });
        }
    }

    function formatText(command) {
        const textarea = document.getElementById('content');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const selectedText = textarea.value.substring(start, end);

        let formattedText = '';

        switch(command) {
            case 'bold':
                formattedText = `**${selectedText}**`;
                break;
            case 'italic':
                formattedText = `*${selectedText}*`;
                break;
            case 'underline':
                formattedText = `__${selectedText}__`;
                break;
            default:
                formattedText = selectedText;
        }

        textarea.value = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
        textarea.focus();
        textarea.setSelectionRange(start + formattedText.length, start + formattedText.length);
        $('#content').trigger('input');
    }
</script>
@stop
