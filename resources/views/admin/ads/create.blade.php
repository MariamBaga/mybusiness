@extends('adminlte::page')

@section('title', 'Nouvelle Publicité')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-plus-circle text-success mr-2"></i>
            Créer une nouvelle publicité
        </h1>
        <a href="{{ route('ads.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Retour à la liste
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-ad mr-2"></i>
                        Informations de la publicité
                    </h3>
                </div>

                <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
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
                                Titre de la publicité
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}"
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
                                        <i class="fas fa-th-large text-success mr-1"></i>
                                        Emplacement
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="placement"
                                            id="placement"
                                            class="form-control @error('placement') is-invalid @enderror"
                                            required>
                                        <option value="">-- Choisir un emplacement --</option>
                                        <option value="header" {{ old('placement') == 'header' ? 'selected' : '' }}>Header</option>
                                        <option value="sidebar" {{ old('placement') == 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                                        <option value="footer" {{ old('placement') == 'footer' ? 'selected' : '' }}>Footer</option>
                                        <option value="popup" {{ old('placement') == 'popup' ? 'selected' : '' }}>Popup</option>
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
                                        <i class="fas fa-tag text-success mr-1"></i>
                                        Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="type"
                                            id="type"
                                            class="form-control @error('type') is-invalid @enderror"
                                            required>
                                        <option value="">-- Choisir un type --</option>
                                        <option value="banner" {{ old('type') == 'banner' ? 'selected' : '' }}>Bannière</option>
                                        <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Vidéo</option>
                                        <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Texte</option>
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
                                        <i class="fas fa-calendar-plus text-success mr-1"></i>
                                        Date de début
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date"
                                           name="start_date"
                                           id="start_date"
                                           class="form-control @error('start_date') is-invalid @enderror"
                                           value="{{ old('start_date') }}"
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
                                        <i class="fas fa-calendar-minus text-success mr-1"></i>
                                        Date de fin
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date"
                                           name="end_date"
                                           id="end_date"
                                           class="form-control @error('end_date') is-invalid @enderror"
                                           value="{{ old('end_date') }}"
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
                                        <i class="fas fa-flag text-success mr-1"></i>
                                        Priorité
                                    </label>
                                    <input type="number"
                                           name="priority"
                                           id="priority"
                                           class="form-control @error('priority') is-invalid @enderror"
                                           value="{{ old('priority', 0) }}"
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
                                        <i class="fas fa-link text-success mr-1"></i>
                                        URL de destination
                                    </label>
                                    <input type="url"
                                           name="url"
                                           id="url"
                                           class="form-control @error('url') is-invalid @enderror"
                                           value="{{ old('url') }}"
                                           placeholder="https://exemple.com">
                                    @error('url')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">
                                <i class="fas fa-image text-success mr-1"></i>
                                Image de la publicité
                                <span class="text-danger">*</span>
                            </label>
                            <div class="custom-file">
                                <input type="file"
                                       name="image"
                                       id="image"
                                       class="custom-file-input @error('image') is-invalid @enderror"
                                       accept="image/*"
                                       required>
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
                                Formats acceptés: JPG, PNG, WebP | Taille max: 5MB
                            </small>

                            <div class="mt-3" id="imagePreviewContainer" style="display: none;">
                                <p class="font-weight-bold">Aperçu de l'image :</p>
                                <img id="imagePreview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox"
                                   name="status"
                                   id="status"
                                   class="form-check-input"
                                   {{ old('status', true) ? 'checked' : '' }}>
                            <label class="form-check-label font-weight-bold" for="status">
                                <i class="fas fa-toggle-on text-success mr-1"></i>
                                Publicité active
                            </label>
                            <small class="form-text text-muted d-block">
                                Une publicité inactive ne sera pas affichée sur le site
                            </small>
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                <i class="fas fa-redo mr-1"></i> Réinitialiser
                            </button>

                            <div>
                                <a href="{{ route('ads.index') }}" class="btn btn-secondary mr-2">
                                    <i class="fas fa-times mr-1"></i> Annuler
                                </a>
                                <button type="submit" class="btn btn-success" id="submitBtn">
                                    <i class="fas fa-save mr-1"></i> Créer la publicité
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
                        Conseils
                    </h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-ruler mr-2"></i>Dimensions recommandées :</h6>
                        <ul class="mb-0">
                            <li><strong>Header :</strong> 1920×200 px</li>
                            <li><strong>Sidebar :</strong> 300×250 px</li>
                            <li><strong>Footer :</strong> 1920×150 px</li>
                            <li><strong>Popup :</strong> 600×400 px</li>
                        </ul>
                    </div>

                    <div class="alert alert-success">
                        <h6><i class="fas fa-chart-line mr-2"></i>Pour optimiser les performances :</h6>
                        <ul class="mb-0">
                            <li>Utilisez des images optimisées</li>
                            <li>Choisissez des dates précises</li>
                            <li>Testez les liens avant publication</li>
                            <li>Surveillez les statistiques</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

    .img-thumbnail {
        border: 2px dashed #dee2e6;
        padding: 5px;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
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

        // Validation des dates
        $('#start_date').on('change', function() {
            const startDate = new Date($(this).val());
            const endDateInput = $('#end_date');
            const endDate = new Date(endDateInput.val());

            if (endDateInput.val() && endDate <= startDate) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Date invalide',
                    text: 'La date de fin doit être postérieure à la date de début',
                    confirmButtonColor: '#ffc107'
                });
                endDateInput.val('');
                endDateInput.focus();
            }
        });

        // Validation du formulaire
        $('form').on('submit', function(e) {
            const startDate = new Date($('#start_date').val());
            const endDate = new Date($('#end_date').val());

            if (endDate <= startDate) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Dates invalides',
                    text: 'La date de fin doit être postérieure à la date de début',
                    confirmButtonColor: '#dc3545'
                });
                $('#end_date').focus();
                return false;
            }

            // Show loading state
            const submitBtn = $('#submitBtn');
            const originalText = submitBtn.html();
            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Création...');

            // Réactiver après 10 secondes maximum
            setTimeout(function() {
                submitBtn.prop('disabled', false).html(originalText);
            }, 10000);
        });
    });

    function resetForm() {
        Swal.fire({
            title: 'Réinitialiser le formulaire ?',
            text: "Tous les champs seront vidés",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6c757d',
            cancelButtonColor: '#28a745',
            confirmButtonText: '<i class="fas fa-redo mr-1"></i> Oui, réinitialiser',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $('form')[0].reset();
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
</script>
@stop
