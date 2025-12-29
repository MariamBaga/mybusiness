@extends('adminlte::page')

@section('title', 'Modifier Publicité')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-edit text-warning mr-2"></i>
            Modifier la publicité
        </h1>
        <a href="{{ route('ads.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Retour à la liste
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit mr-2"></i>
                        Modifier la publicité : <strong>{{ $ad->title }}</strong>
                    </h3>
                </div>

                <form action="{{ route('ads.update', $ad) }}" method="POST" enctype="multipart/form-data">
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

                        <div class="form-group">
                            <label for="title" class="font-weight-bold">
                                <i class="fas fa-heading text-warning mr-1"></i>
                                Titre de la publicité
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $ad->title) }}"
                                   required
                                   maxlength="255"
                                   placeholder="Entrez le titre de la publicité"
                                   autofocus>
                            @error('title')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                            <small class="form-text text-muted">
                                Maximum 255 caractères
                            </small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="placement" class="font-weight-bold">
                                        <i class="fas fa-th-large text-warning mr-1"></i>
                                        Emplacement
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="placement"
                                            id="placement"
                                            class="form-control @error('placement') is-invalid @enderror"
                                            required>
                                        <option value="">-- Choisir un emplacement --</option>
                                        <option value="header" {{ old('placement', $ad->placement) == 'header' ? 'selected' : '' }}>Header</option>
                                        <option value="sidebar" {{ old('placement', $ad->placement) == 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                                        <option value="footer" {{ old('placement', $ad->placement) == 'footer' ? 'selected' : '' }}>Footer</option>
                                        <option value="popup" {{ old('placement', $ad->placement) == 'popup' ? 'selected' : '' }}>Popup</option>
                                    </select>
                                    @error('placement')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type" class="font-weight-bold">
                                        <i class="fas fa-tag text-warning mr-1"></i>
                                        Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="type"
                                            id="type"
                                            class="form-control @error('type') is-invalid @enderror"
                                            required>
                                        <option value="">-- Choisir un type --</option>
                                        <option value="banner" {{ old('type', $ad->type) == 'banner' ? 'selected' : '' }}>Bannière</option>
                                        <option value="video" {{ old('type', $ad->type) == 'video' ? 'selected' : '' }}>Vidéo</option>
                                        <option value="text" {{ old('type', $ad->type) == 'text' ? 'selected' : '' }}>Texte</option>
                                    </select>
                                    @error('type')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date" class="font-weight-bold">
                                        <i class="fas fa-calendar-plus text-warning mr-1"></i>
                                        Date de début
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date"
                                           name="start_date"
                                           id="start_date"
                                           class="form-control @error('start_date') is-invalid @enderror"
                                           value="{{ old('start_date', $ad->start_date->format('Y-m-d')) }}"
                                           required>
                                    @error('start_date')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date" class="font-weight-bold">
                                        <i class="fas fa-calendar-minus text-warning mr-1"></i>
                                        Date de fin
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date"
                                           name="end_date"
                                           id="end_date"
                                           class="form-control @error('end_date') is-invalid @enderror"
                                           value="{{ old('end_date', $ad->end_date->format('Y-m-d')) }}"
                                           required>
                                    @error('end_date')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="priority" class="font-weight-bold">
                                        <i class="fas fa-flag text-warning mr-1"></i>
                                        Priorité
                                    </label>
                                    <input type="number"
                                           name="priority"
                                           id="priority"
                                           class="form-control @error('priority') is-invalid @enderror"
                                           value="{{ old('priority', $ad->priority) }}"
                                           min="0"
                                           max="10">
                                    @error('priority')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        0 = basse priorité, 10 = haute priorité
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="url" class="font-weight-bold">
                                        <i class="fas fa-link text-warning mr-1"></i>
                                        URL de destination
                                    </label>
                                    <input type="url"
                                           name="url"
                                           id="url"
                                           class="form-control @error('url') is-invalid @enderror"
                                           value="{{ old('url', $ad->url) }}"
                                           placeholder="https://exemple.com">
                                    @error('url')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Image actuelle -->
                        <div class="form-group">
                            <label class="font-weight-bold d-block">
                                <i class="fas fa-image text-warning mr-1"></i>
                                Image actuelle
                            </label>
                            @if($ad->image)
                                <div class="mb-3">
                                    <img src="{{ file_exists(public_path('StockPiece/ads/' . $ad->image)) ? asset('StockPiece/ads/' . $ad->image) : asset('images/default-ad.jpg') }}"
                                         class="img-thumbnail current-image"
                                         style="max-width: 200px; max-height: 150px; object-fit: cover;"
                                         alt="{{ $ad->title }}">
                                    <div class="mt-2">
                                        @if(file_exists(public_path('StockPiece/ads/' . $ad->image)))
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                Taille : {{ round(filesize(public_path('StockPiece/ads/' . $ad->image)) / 1024) }} Ko
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    Aucune image trouvée
                                </div>
                            @endif
                        </div>

                        <!-- Nouvelle image -->
                        <div class="form-group">
                            <label for="image" class="font-weight-bold">
                                <i class="fas fa-upload text-warning mr-1"></i>
                                Nouvelle image (optionnel)
                            </label>
                            <div class="custom-file">
                                <input type="file"
                                       name="image"
                                       id="image"
                                       class="custom-file-input @error('image') is-invalid @enderror"
                                       accept="image/*">
                                <label class="custom-file-label" for="image" id="imageLabel">
                                    <i class="fas fa-upload mr-1"></i>Choisir une nouvelle image
                                </label>
                                @error('image')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                Laisser vide pour conserver l'image actuelle<br>
                                Formats acceptés: JPG, PNG, WebP | Taille max: 5MB
                            </small>

                            <div class="mt-3" id="imagePreviewContainer" style="display: none;">
                                <p class="font-weight-bold mb-2">Aperçu de la nouvelle image :</p>
                                <img id="imagePreview" class="img-thumbnail" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                            </div>
                        </div>

                        <div class="form-check mb-3">
    <!-- Champ caché avec valeur 0 -->
    <input type="hidden" name="status" value="0">

    <input type="checkbox"
           name="status"
           id="status"
           class="form-check-input"
           value="1"
           {{ old('status', $ad->status ?? true) ? 'checked' : '' }}>
    <label class="form-check-label font-weight-bold" for="status">
        <i class="fas fa-toggle-on text-warning mr-1"></i>
        Publicité active
    </label>
    <small class="form-text text-muted d-block">
        Une publicité inactive ne sera pas affichée sur le site
    </small>
</div>

                        <!-- Statistiques -->
                        <div class="card card-info mt-4">
                            <div class="card-header">
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-chart-line mr-2"></i>
                                    Statistiques
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="display-4 text-primary">{{ $ad->views }}</div>
                                        <small class="text-muted">Vues</small>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="display-4 text-success">{{ $ad->clicks }}</div>
                                        <small class="text-muted">Clics</small>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="display-4 text-warning">
                                            {{ $ad->views > 0 ? number_format(($ad->clicks / $ad->views) * 100, 2) : 0 }}%
                                        </div>
                                        <small class="text-muted">CTR</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                                    <i class="fas fa-trash mr-1"></i> Supprimer
                                </button>

                                <button type="button" class="btn btn-outline-secondary ml-2" onclick="resetForm()">
                                    <i class="fas fa-redo mr-1"></i> Réinitialiser
                                </button>
                            </div>

                            <div>
                                <a href="{{ route('ads.index') }}" class="btn btn-secondary mr-2">
                                    <i class="fas fa-times mr-1"></i> Annuler
                                </a>
                                <button type="submit" class="btn btn-warning" id="submitBtn">
                                    <i class="fas fa-save mr-1"></i> Mettre à jour
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
                        Informations
                    </h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-calendar-alt mr-2"></i>Dates importantes :</h6>
                        <ul class="mb-0">
                            <li><strong>Créée le :</strong> {{ $ad->created_at->format('d/m/Y H:i') }}</li>
                            <li><strong>Modifiée le :</strong> {{ $ad->updated_at->format('d/m/Y H:i') }}</li>
                            <li><strong>Statut actuel :</strong>
                                @if($ad->isActive())
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </li>
                        </ul>
                    </div>

                    <div class="alert alert-warning">
                        <h6><i class="fas fa-ruler mr-2"></i>Dimensions recommandées :</h6>
                        <ul class="mb-0">
                            <li><strong>Header :</strong> 1920×200 px</li>
                            <li><strong>Sidebar :</strong> 300×250 px</li>
                            <li><strong>Footer :</strong> 1920×150 px</li>
                            <li><strong>Popup :</strong> 600×400 px</li>
                        </ul>
                    </div>

                    <div class="alert alert-success">
                        <h6><i class="fas fa-chart-line mr-2"></i>Conseils :</h6>
                        <ul class="mb-0">
                            <li>Optimisez les images pour le web</li>
                            <li>Vérifiez les liens régulièrement</li>
                            <li>Adaptez la priorité selon l'importance</li>
                            <li>Surveillez les statistiques</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire de suppression caché -->
    <form action="{{ route('ads.destroy', $ad) }}" method="POST" id="deleteForm">
        @csrf
        @method('DELETE')
    </form>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-top: 3px solid #ffc107;
    }

    .card-header {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border-bottom: 2px solid #dee2e6;
    }

    .form-control:focus, .custom-file-input:focus ~ .custom-file-label {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255,193,7,.25);
    }

    .custom-file-label::after {
        content: "Parcourir";
    }

    .img-thumbnail {
        border: 2px dashed #dee2e6;
        padding: 5px;
        transition: transform 0.3s;
    }

    .img-thumbnail:hover {
        transform: scale(1.05);
    }

    .current-image {
        border: 2px solid #ffc107;
    }

    .display-4 {
        font-size: 2.5rem;
        font-weight: 300;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Aperçu de la nouvelle image
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

        // Validation des dates
        $('#start_date, #end_date').on('change', function() {
            validateDates();
        });

        // Validation du formulaire
        $('form').on('submit', function(e) {
            if (!validateDates()) {
                e.preventDefault();
                return false;
            }

            // Afficher l'état de chargement
            const submitBtn = $('#submitBtn');
            const originalText = submitBtn.html();
            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Mise à jour...');

            // Réactiver après 10 secondes maximum
            setTimeout(function() {
                submitBtn.prop('disabled', false).html(originalText);
            }, 10000);
        });

        // Vérifier les dates au chargement
        validateDates();
    });

    function validateDates() {
        const startDate = new Date($('#start_date').val());
        const endDate = new Date($('#end_date').val());

        if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime())) {
            if (endDate <= startDate) {
                $('#end_date').addClass('is-invalid');
                Swal.fire({
                    icon: 'error',
                    title: 'Dates invalides',
                    text: 'La date de fin doit être postérieure à la date de début',
                    confirmButtonColor: '#dc3545'
                });
                return false;
            }
        }

        return true;
    }

    function resetForm() {
        Swal.fire({
            title: 'Réinitialiser les modifications ?',
            text: "Tous les changements non enregistrés seront perdus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6c757d',
            cancelButtonColor: '#ffc107',
            confirmButtonText: '<i class="fas fa-redo mr-1"></i> Oui, réinitialiser',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Réinitialiser le formulaire
                document.querySelector('form').reset();
                $('#imagePreviewContainer').hide();
                $('#imageLabel').html('<i class="fas fa-upload mr-1"></i>Choisir une nouvelle image');

                // Remettre les valeurs originales
                document.getElementById('title').value = "{{ addslashes($ad->title) }}";
                document.getElementById('start_date').value = "{{ $ad->start_date->format('Y-m-d') }}";
                document.getElementById('end_date').value = "{{ $ad->end_date->format('Y-m-d') }}";
                document.getElementById('priority').value = "{{ $ad->priority }}";
                document.getElementById('url').value = "{{ addslashes($ad->url ?? '') }}";
                document.getElementById('status').checked = {{ $ad->status ? 'true' : 'false' }};

                // Pour les selects
                document.getElementById('placement').value = "{{ $ad->placement }}";
                document.getElementById('type').value = "{{ $ad->type }}";

                Swal.fire({
                    icon: 'success',
                    title: 'Formulaire réinitialisé',
                    text: 'Les valeurs ont été restaurées',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }

    function confirmDelete() {
        Swal.fire({
            title: 'Supprimer cette publicité ?',
            html: `<strong>"{{ $ad->title }}"</strong><br>
                   Cette action supprimera également l'image et toutes les statistiques associées.<br>
                   <span class="text-danger">Cette action est irréversible !</span>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#ffc107',
            confirmButtonText: '<i class="fas fa-trash mr-1"></i> Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm').submit();
            }
        });
    }
</script>
@stop
