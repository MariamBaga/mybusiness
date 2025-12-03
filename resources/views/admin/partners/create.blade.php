@extends('adminlte::page')

@section('title', 'Nouveau Partenaire')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>
        <i class="fas fa-handshake text-success mr-2"></i>
        Créer un nouveau partenaire
    </h1>
    <a href="{{ route('partners.index') }}" class="btn btn-outline-secondary">
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
            <a href="{{ route('partners.index') }}">
                <i class="fas fa-handshake"></i> Partenaires
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <i class="fas fa-plus-circle"></i> Nouveau partenaire
        </li>
    </ol>
</nav>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-building mr-2"></i>
                    Informations du nouveau partenaire
                </h3>
                <div class="card-tools">
                    <span class="badge badge-light">
                        <i class="fas fa-plus"></i> Nouveau
                    </span>
                </div>
            </div>

            <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data" id="createPartnerForm">
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">
                                    <i class="fas fa-building text-success mr-1"></i>
                                    Nom du partenaire
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-signature"></i>
                                        </span>
                                    </div>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}"
                                           required
                                           maxlength="255"
                                           placeholder="Entrez le nom du partenaire"
                                           autofocus>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Le nom complet de l'entreprise ou organisation
                                </small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="font-weight-bold">
                                    <i class="fas fa-envelope text-success mr-1"></i>
                                    Email de contact
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-at"></i>
                                        </span>
                                    </div>
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}"
                                           maxlength="255"
                                           placeholder="contact@entreprise.com"
                                           autocomplete="new-email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Email principal de contact
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="font-weight-bold">
                                    <i class="fas fa-phone text-success mr-1"></i>
                                    Téléphone
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-phone-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text"
                                           name="phone"
                                           id="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone') }}"
                                           placeholder="+33 1 23 45 67 89">
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type" class="font-weight-bold">
                                    <i class="fas fa-tag text-success mr-1"></i>
                                    Type de partenaire
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-user-tag"></i>
                                        </span>
                                    </div>
                                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                        <option value="">Sélectionnez un type</option>
                                        <option value="corporate" {{ old('type') == 'corporate' ? 'selected' : '' }}>Entreprise</option>
                                        <option value="individual" {{ old('type') == 'individual' ? 'selected' : '' }}>Individuel</option>
                                        <option value="ngo" {{ old('type') == 'ngo' ? 'selected' : '' }}>ONG</option>
                                        <option value="government" {{ old('type') == 'government' ? 'selected' : '' }}>Gouvernement</option>
                                    </select>
                                    @error('type')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Catégorie du partenaire
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="website" class="font-weight-bold">
                                    <i class="fas fa-globe text-success mr-1"></i>
                                    Site web
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-link"></i>
                                        </span>
                                    </div>
                                    <input type="url"
                                           name="website"
                                           id="website"
                                           class="form-control @error('website') is-invalid @enderror"
                                           value="{{ old('website') }}"
                                           placeholder="https://www.entreprise.com">
                                    @error('website')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="font-weight-bold">
                                    <i class="fas fa-map-marker-alt text-success mr-1"></i>
                                    Adresse
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-map-pin"></i>
                                        </span>
                                    </div>
                                    <input type="text"
                                           name="address"
                                           id="address"
                                           class="form-control @error('address') is-invalid @enderror"
                                           value="{{ old('address') }}"
                                           placeholder="Adresse complète">
                                    @error('address')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description" class="font-weight-bold">
                                    <i class="fas fa-align-left text-success mr-1"></i>
                                    Description
                                </label>
                                <textarea name="description"
                                          id="description"
                                          class="form-control @error('description') is-invalid @enderror"
                                          rows="4"
                                          placeholder="Description du partenaire...">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                                @enderror
                                <small class="form-text text-muted">
                                    Brève description de l'entreprise et de ses activités
                                </small>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold d-block">
                                    <i class="fas fa-image text-success mr-1"></i>
                                    Logo du partenaire
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="logo-upload-area">
                                    <div class="file-upload-wrapper">
                                        <div class="custom-file">
                                            <input type="file"
                                                   name="logo"
                                                   id="logo"
                                                   class="custom-file-input @error('logo') is-invalid @enderror"
                                                   required
                                                   accept="image/jpeg,image/png,image/jpg,image/webp"
                                                   onchange="previewLogo(this)">
                                            <label class="custom-file-label" for="logo" id="logoLabel">
                                                <i class="fas fa-upload mr-1"></i>
                                                Choisir un logo
                                            </label>
                                            @error('logo')
                                            <div class="invalid-feedback">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted">
                                            Formats acceptés : JPG, PNG, WEBP. Taille max : 2MB
                                        </small>

                                        <div id="logoPreview" class="mt-3" style="display: none;">
                                            <p class="text-muted mb-1">Aperçu :</p>
                                            <img id="previewImage" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold d-block">
                                    <i class="fas fa-cog text-success mr-1"></i>
                                    Paramètres
                                </label>

                                <div class="p-3 bg-light rounded">
                                    <div class="custom-control custom-switch mb-3">
                                        <input type="checkbox"
                                               class="custom-control-input"
                                               id="status"
                                               name="status"
                                               value="1"
                                               {{ old('status') ? 'checked' : 'checked' }}>
                                        <label class="custom-control-label font-weight-bold" for="status">
                                            Statut actif
                                        </label>
                                        <small class="form-text text-muted d-block">
                                            Un partenaire inactif ne sera pas affiché sur le site
                                        </small>
                                    </div>

                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                               class="custom-control-input"
                                               id="featured"
                                               name="featured"
                                               value="1"
                                               {{ old('featured') }}>
                                        <label class="custom-control-label font-weight-bold" for="featured">
                                            Partenaire vedette
                                        </label>
                                        <small class="form-text text-muted d-block">
                                            Les partenaires vedettes sont mis en avant sur le site
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <h6 class="alert-heading">
                                    <i class="fas fa-lightbulb mr-2"></i>
                                    Conseils pour un bon logo
                                </h6>
                                <ul class="mb-0">
                                    <li>Format carré recommandé (ex: 500x500px)</li>
                                    <li>Fond transparent pour une meilleure intégration</li>
                                    <li>Haute résolution pour une bonne qualité d'affichage</li>
                                    <li>Taille recommandée : entre 100KB et 500KB</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                            <i class="fas fa-undo mr-1"></i> Réinitialiser
                        </button>

                        <div>
                            <a href="{{ route('partners.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times mr-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-success" id="submitBtn">
                                <i class="fas fa-plus-circle mr-1"></i> Créer le partenaire
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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

    .form-control:focus, .custom-select:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40,167,69,.25);
    }

    .input-group-text {
        border-right: none;
        transition: all 0.3s;
    }

    .input-group .form-control, .input-group .custom-select {
        border-left: none;
    }

    .custom-file-label::after {
        content: "Parcourir";
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }

    .custom-file-input:focus ~ .custom-file-label {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40,167,69,.25);
    }

    .custom-control-input:checked ~ .custom-control-label::before {
        border-color: #28a745;
        background-color: #28a745;
    }

    .custom-switch .custom-control-label::before {
        border-color: #6c757d;
    }

    .custom-switch .custom-control-input:checked ~ .custom-control-label::before {
        border-color: #28a745;
        background-color: #28a745;
    }

    .logo-upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 20px;
        transition: all 0.3s;
    }

    .logo-upload-area:hover {
        border-color: #28a745;
        background-color: rgba(40,167,69,0.05);
    }

    .breadcrumb {
        background-color: transparent;
        padding-left: 0;
    }

    .breadcrumb-item.active {
        color: #28a745;
        font-weight: 500;
    }

    .alert {
        border-radius: 8px;
        border: none;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Afficher le nom du fichier sélectionné
        $('#logo').on('change', function() {
            const fileName = $(this).val().split('\\').pop();
            $('#logoLabel').html('<i class="fas fa-file-image mr-1"></i>' + fileName);
        });

        // Validation du formulaire
        $('#createPartnerForm').on('submit', function(e) {
            const name = $('#name').val().trim();
            const type = $('#type').val();
            const logoFile = $('#logo')[0].files[0];

            let errors = [];

            if (!name) {
                errors.push('Le nom du partenaire est requis');
                $('#name').addClass('is-invalid');
            } else {
                $('#name').removeClass('is-invalid');
            }

            if (!type) {
                errors.push('Le type de partenaire est requis');
                $('#type').addClass('is-invalid');
            } else {
                $('#type').removeClass('is-invalid');
            }

            if (!logoFile) {
                errors.push('Le logo est requis');
                $('#logo').addClass('is-invalid');
            } else {
                $('#logo').removeClass('is-invalid');

                // Vérification de la taille du fichier
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (logoFile.size > maxSize) {
                    errors.push('Le logo ne doit pas dépasser 2MB');
                    $('#logo').addClass('is-invalid');
                }
            }

            if (errors.length > 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Erreurs de validation',
                    html: '<ul class="text-left">' +
                          errors.map(error => `<li>${error}</li>`).join('') +
                          '</ul>',
                    confirmButtonColor: '#dc3545'
                });
                return false;
            }

            // Confirmation avant création
            Swal.fire({
                title: 'Créer ce partenaire ?',
                html: `
                    <div class="text-left">
                        <p><strong>Nom :</strong> ${name}</p>
                        <p><strong>Type :</strong> ${$('#type option:selected').text()}</p>
                        <p><strong>Email :</strong> ${$('#email').val() || 'Non renseigné'}</p>
                        <p class="text-muted"><small>Le partenaire sera immédiatement disponible sur le site.</small></p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-plus-circle mr-1"></i> Oui, créer',
                cancelButtonText: '<i class="fas fa-times mr-1"></i> Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Bouton de chargement
                    const submitBtn = $('#submitBtn');
                    const originalText = submitBtn.html();
                    submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Création...');

                    // Soumettre le formulaire
                    $(this).off('submit').submit();
                } else {
                    e.preventDefault();
                }
            });

            return false;
        });

        // Auto-focus sur le premier champ avec erreur
        @if($errors->any())
            $('.is-invalid').first().focus();
        @endif

        // Compteur de caractères
        $('#name, #description, #address').on('input', function() {
            const max = $(this).attr('maxlength');
            if (max) {
                const current = $(this).val().length;
                const $counter = $(this).parent().find('.char-counter');

                if ($counter.length === 0) {
                    $(this).parent().append(`<small class="form-text text-muted char-counter">${current}/${max}</small>`);
                } else {
                    $counter.text(`${current}/${max}`);
                }
            }
        });

        // Déclencher les compteurs pour les champs pré-remplis
        $('#name, #description, #address').trigger('input');
    });

    function previewLogo(input) {
        const preview = document.getElementById('previewImage');
        const previewContainer = document.getElementById('logoPreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function resetForm() {
        Swal.fire({
            title: 'Réinitialiser le formulaire ?',
            text: "Tous les champs seront vidés",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6c757d',
            cancelButtonColor: '#28a745',
            confirmButtonText: '<i class="fas fa-undo mr-1"></i> Oui, réinitialiser',
            cancelButtonText: '<i class="fas fa-times mr-1"></i> Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#createPartnerForm')[0].reset();
                $('#logoLabel').html('<i class="fas fa-upload mr-1"></i> Choisir un logo');
                $('#logoPreview').hide();
                $('.char-counter').remove();
                $('#status').prop('checked', true);
                $('#featured').prop('checked', false);
                $('#name').focus();

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
