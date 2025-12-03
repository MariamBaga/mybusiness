@extends('adminlte::page')

@section('title', 'Modifier Partenaire')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>
        <i class="fas fa-handshake text-warning mr-2"></i>
        Modifier le partenaire
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
            <i class="fas fa-edit"></i> Modifier {{ $partner->name }}
        </li>
    </ol>
</nav>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-building mr-2"></i>
                    Informations du partenaire
                </h3>
                <div class="card-tools">
                    <span class="badge badge-light">
                        ID: {{ $partner->id }}
                    </span>
                </div>
            </div>

            <form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data" id="editPartnerForm">
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">
                                    <i class="fas fa-building text-warning mr-1"></i>
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
                                           value="{{ old('name', $partner->name) }}"
                                           required
                                           maxlength="255"
                                           placeholder="Entrez le nom du partenaire">
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
                                    <i class="fas fa-envelope text-warning mr-1"></i>
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
                                           value="{{ old('email', $partner->email) }}"
                                           maxlength="255"
                                           placeholder="contact@entreprise.com">
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
                                    <i class="fas fa-phone text-warning mr-1"></i>
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
                                           value="{{ old('phone', $partner->phone) }}"
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
                                    <i class="fas fa-tag text-warning mr-1"></i>
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
                                        <option value="corporate" {{ old('type', $partner->type) == 'corporate' ? 'selected' : '' }}>Entreprise</option>
                                        <option value="individual" {{ old('type', $partner->type) == 'individual' ? 'selected' : '' }}>Individuel</option>
                                        <option value="ngo" {{ old('type', $partner->type) == 'ngo' ? 'selected' : '' }}>ONG</option>
                                        <option value="government" {{ old('type', $partner->type) == 'government' ? 'selected' : '' }}>Gouvernement</option>
                                    </select>
                                    @error('type')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="website" class="font-weight-bold">
                                    <i class="fas fa-globe text-warning mr-1"></i>
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
                                           value="{{ old('website', $partner->website) }}"
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
                                    <i class="fas fa-map-marker-alt text-warning mr-1"></i>
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
                                           value="{{ old('address', $partner->address) }}"
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
                                    <i class="fas fa-align-left text-warning mr-1"></i>
                                    Description
                                </label>
                                <textarea name="description"
                                          id="description"
                                          class="form-control @error('description') is-invalid @enderror"
                                          rows="4"
                                          placeholder="Description du partenaire...">{{ old('description', $partner->description) }}</textarea>
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
                                    <i class="fas fa-image text-warning mr-1"></i>
                                    Logo du partenaire
                                </label>

                                <div class="logo-upload-area">
                                    @if($partner->logo)
                                    <div class="current-logo mb-3">
                                        <p class="text-muted mb-1">Logo actuel :</p>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('StockPiece/partners/' . $partner->logo) }}"
                                                 alt="{{ $partner->name }}"
                                                 class="img-thumbnail mr-3"
                                                 style="width: 100px; height: 100px; object-fit: contain;">
                                            <div>
                                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeCurrentLogo()">
                                                    <i class="fas fa-trash-alt mr-1"></i> Supprimer ce logo
                                                </button>
                                                <input type="hidden" name="remove_logo" id="removeLogo" value="0">
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="file-upload-wrapper">
                                        <div class="custom-file">
                                            <input type="file"
                                                   name="logo"
                                                   id="logo"
                                                   class="custom-file-input @error('logo') is-invalid @enderror"
                                                   accept="image/jpeg,image/png,image/jpg,image/webp"
                                                   onchange="previewLogo(this)">
                                            <label class="custom-file-label" for="logo" id="logoLabel">
                                                <i class="fas fa-upload mr-1"></i>
                                                Choisir un nouveau logo
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
                                    <i class="fas fa-cog text-warning mr-1"></i>
                                    Paramètres
                                </label>

                                <div class="p-3 bg-light rounded">
                                    <div class="custom-control custom-switch mb-3">
                                        <input type="checkbox"
                                               class="custom-control-input"
                                               id="status"
                                               name="status"
                                               value="1"
                                               {{ old('status', $partner->status) ? 'checked' : '' }}>
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
                                               {{ old('featured', $partner->featured) ? 'checked' : '' }}>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <i class="fas fa-info-circle text-warning mr-1"></i>
                                    Informations supplémentaires
                                </label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-2">
                                        <small class="text-muted">Produits associés :</small>
                                        <span class="badge badge-info">{{ $partner->products_count }}</span>
                                    </p>
                                    <p class="mb-2">
                                        <small class="text-muted">Date de création :</small>
                                        <strong>{{ $partner->created_at->format('d/m/Y H:i') }}</strong>
                                    </p>
                                    <p class="mb-0">
                                        <small class="text-muted">Dernière modification :</small>
                                        <strong>{{ $partner->updated_at->format('d/m/Y H:i') }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-danger" onclick="resetForm()">
                            <i class="fas fa-undo mr-1"></i> Réinitialiser
                        </button>

                        <div>
                            <a href="{{ route('partners.index') }}" class="btn btn-secondary mr-2">
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
</div>
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

    .form-control:focus, .custom-select:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255,193,7,.25);
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
        background-color: #ffc107;
        border-color: #ffc107;
        color: #000;
    }

    .custom-file-input:focus ~ .custom-file-label {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255,193,7,.25);
    }

    .custom-control-input:checked ~ .custom-control-label::before {
        border-color: #ffc107;
        background-color: #ffc107;
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
        border-color: #ffc107;
        background-color: rgba(255,193,7,0.05);
    }

    .breadcrumb {
        background-color: transparent;
        padding-left: 0;
    }

    .breadcrumb-item.active {
        color: #ffc107;
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
        $('#editPartnerForm').on('submit', function(e) {
            const name = $('#name').val().trim();
            const type = $('#type').val();

            if (!name) {
                e.preventDefault();
                showError('Le nom du partenaire est requis');
                $('#name').focus();
                return false;
            }

            if (!type) {
                e.preventDefault();
                showError('Le type de partenaire est requis');
                $('#type').focus();
                return false;
            }

            // Vérification de la taille du fichier
            const logoFile = $('#logo')[0].files[0];
            if (logoFile) {
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (logoFile.size > maxSize) {
                    e.preventDefault();
                    showError('Le logo ne doit pas dépasser 2MB');
                    return false;
                }
            }

            // Bouton de chargement
            const submitBtn = $('#submitBtn');
            const originalText = submitBtn.html();
            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Mise à jour...');

            // Réactiver le bouton après 10 secondes
            setTimeout(() => {
                submitBtn.prop('disabled', false).html(originalText);
            }, 10000);
        });

        // Auto-focus sur le premier champ avec erreur
        @if($errors->any())
            $('.is-invalid').first().focus();
        @endif
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

    function removeCurrentLogo() {
        Swal.fire({
            title: 'Supprimer le logo actuel ?',
            text: "Le logo actuel sera supprimé lors de l'enregistrement",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#removeLogo').val('1');
                $('.current-logo').hide();
                Swal.fire(
                    'Logo marqué pour suppression',
                    'Le logo sera supprimé lors de la mise à jour',
                    'success'
                );
            }
        });
    }

    function resetForm() {
        Swal.fire({
            title: 'Réinitialiser le formulaire ?',
            text: "Toutes les modifications seront perdues",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, réinitialiser',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Réinitialiser aux valeurs originales
                @php
                    $originalValues = [
                        'name' => $partner->name,
                        'email' => $partner->email,
                        'phone' => $partner->phone,
                        'website' => $partner->website,
                        'address' => $partner->address,
                        'description' => $partner->description,
                        'type' => $partner->type,
                        'status' => $partner->status,
                        'featured' => $partner->featured
                    ];
                @endphp

                $('#name').val("{{ $originalValues['name'] }}");
                $('#email').val("{{ $originalValues['email'] }}");
                $('#phone').val("{{ $originalValues['phone'] }}");
                $('#website').val("{{ $originalValues['website'] }}");
                $('#address').val("{{ $originalValues['address'] }}");
                $('#description').val("{{ $originalValues['description'] }}");
                $('#type').val("{{ $originalValues['type'] }}");
                $('#status').prop('checked', {{ $originalValues['status'] ? 'true' : 'false' }});
                $('#featured').prop('checked', {{ $originalValues['featured'] ? 'true' : 'false' }});

                // Réinitialiser le logo
                $('#logo').val('');
                $('#logoLabel').html('<i class="fas fa-upload mr-1"></i> Choisir un nouveau logo');
                $('#logoPreview').hide();
                $('#removeLogo').val('0');
                $('.current-logo').show();

                // Focus sur le premier champ
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

    function showError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: message,
            confirmButtonColor: '#dc3545'
        });
    }

    // Gestion des erreurs serveur
    @if($errors->any())
        $(document).ready(function() {
            const errors = {!! json_encode($errors->all()) !!};
            if (errors.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreurs de validation',
                    html: '<ul class="text-left">' +
                          errors.map(error => `<li>${error}</li>`).join('') +
                          '</ul>',
                    confirmButtonColor: '#dc3545'
                });
            }
        });
    @endif
</script>
@stop
