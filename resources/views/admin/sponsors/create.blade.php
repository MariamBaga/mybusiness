@extends('adminlte::page')

@section('title', 'Ajouter un sponsor')

@section('content_header')
    <h1>
        <i class="fas fa-plus-circle text-success"></i>
        Ajouter un sponsor
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sponsors.index') }}">Sponsors</a></li>
        <li class="breadcrumb-item active">Ajouter</li>
    </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="card-title">Nouveau sponsor</h3>
            </div>

            <form action="{{ route('sponsors.store') }}" method="POST" enctype="multipart/form-data" id="sponsorForm">
                @csrf

                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5><i class="icon fas fa-ban"></i> Erreurs dans le formulaire</h5>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-8">
                            <!-- Informations de base -->
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <i class="fas fa-info-circle"></i> Informations du sponsor
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nom du sponsor *</label>
                                        <input type="text"
                                               name="name"
                                               id="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}"
                                               required
                                               autofocus>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="level">Niveau *</label>
                                                <select name="level"
                                                        id="level"
                                                        class="form-control @error('level') is-invalid @enderror"
                                                        required>
                                                    <option value="">-- Sélectionner un niveau --</option>
                                                    <option value="platinum" {{ old('level') == 'platinum' ? 'selected' : '' }}>Platinum</option>
                                                    <option value="gold" {{ old('level') == 'gold' ? 'selected' : '' }}>Gold</option>
                                                    <option value="silver" {{ old('level') == 'silver' ? 'selected' : '' }}>Silver</option>
                                                    <option value="bronze" {{ old('level') == 'bronze' ? 'selected' : '' }}>Bronze</option>
                                                </select>
                                                @error('level')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="url">Site web</label>
                                                <input type="url"
                                                       name="url"
                                                       id="url"
                                                       class="form-control @error('url') is-invalid @enderror"
                                                       value="{{ old('url') }}"
                                                       placeholder="https://example.com">
                                                @error('url')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description"
                                                  id="description"
                                                  class="form-control @error('description') is-invalid @enderror"
                                                  rows="3">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">
                                            Description courte du sponsor (optionnel)
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label>Statut</label>
                                        <div class="custom-control custom-switch mt-2">
                                            <input type="checkbox"
                                                   name="status"
                                                   class="custom-control-input"
                                                   id="status"
                                                   value="1"
                                                   {{ old('status', true) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status">
                                                Sponsor actif
                                            </label>
                                        </div>
                                        <small class="text-muted">
                                            Les sponsors inactifs ne seront pas affichés sur le site
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Logo -->
                            <div class="card mb-4">
                                <div class="card-header bg-warning text-white">
                                    <i class="fas fa-image"></i> Logo du sponsor *
                                </div>
                                <div class="card-body text-center">
                                    <div class="form-group">
                                        <div class="logo-upload-area mb-4">
                                            <div class="logo-upload-preview border rounded p-4 mb-3" id="logoPreview">
                                                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">Glissez-déposez le logo ici</h5>
                                                <p class="text-muted small">ou cliquez pour parcourir</p>
                                            </div>

                                            <div class="custom-file">
                                                <input type="file"
                                                       name="logo"
                                                       id="logo"
                                                       class="custom-file-input @error('logo') is-invalid @enderror"
                                                       required
                                                       accept=".jpg,.jpeg,.png,.webp">
                                                <label class="custom-file-label" for="logo" id="logoLabel">
                                                    Choisir un logo
                                                </label>
                                            </div>
                                            @error('logo')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <div class="logo-info mt-3" id="logoInfo" style="display: none;">
                                                <div class="alert alert-info">
                                                    <h6><i class="fas fa-image"></i> <span id="logoName"></span></h6>
                                                    <p class="mb-0">
                                                        Dimensions: <span id="logoDimensions"></span><br>
                                                        Taille: <span id="logoSize"></span>
                                                    </p>
                                                </div>
                                            </div>

                                            <small class="form-text text-muted">
                                                Formats acceptés: JPG, JPEG, PNG, WEBP<br>
                                                Taille maximale: 2 MB<br>
                                                Dimensions recommandées: 400x200 pixels
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Aperçu du logo -->
                                    <div id="logoPreviewContainer" style="display: none;">
                                        <hr>
                                        <h6 class="text-muted">Aperçu du logo:</h6>
                                        <div id="previewContent" class="mt-2 text-center">
                                            <img id="logoImagePreview" class="img-fluid rounded" style="max-height: 150px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations sur les niveaux -->
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <i class="fas fa-star"></i> Niveaux de sponsoring
                                </div>
                                <div class="card-body">
                                    <div class="small">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge badge-secondary mr-2">Platinum</span>
                                            <span>Niveau supérieur</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge badge-warning mr-2">Gold</span>
                                            <span>Niveau principal</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge badge-light mr-2">Silver</span>
                                            <span>Niveau standard</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-danger mr-2">Bronze</span>
                                            <span>Niveau basique</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success" id="submitBtn">
                        <i class="fas fa-save"></i> Enregistrer le sponsor
                    </button>
                    <a href="{{ route('sponsors.index') }}" class="btn btn-default">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .logo-upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 5px;
        padding: 20px;
        transition: all 0.3s;
    }
    .logo-upload-area.dragover {
        border-color: #007bff;
        background-color: rgba(0, 123, 255, 0.05);
    }
    .logo-upload-preview {
        background-color: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s;
    }
    .logo-upload-preview:hover {
        background-color: #e9ecef;
    }
    .custom-file-label::after {
        content: "Parcourir";
    }
    #logoImagePreview {
        max-width: 100%;
        max-height: 150px;
        object-fit: contain;
    }
</style>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoInput = document.getElementById('logo');
    const logoLabel = document.getElementById('logoLabel');
    const logoPreview = document.getElementById('logoPreview');
    const logoInfo = document.getElementById('logoInfo');
    const logoName = document.getElementById('logoName');
    const logoDimensions = document.getElementById('logoDimensions');
    const logoSize = document.getElementById('logoSize');
    const logoPreviewContainer = document.getElementById('logoPreviewContainer');
    const logoImagePreview = document.getElementById('logoImagePreview');
    const submitBtn = document.getElementById('submitBtn');
    const levelSelect = document.getElementById('level');

    // Fonction pour formater la taille du fichier
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Gestion du drag & drop
    logoPreview.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('dragover');
    });

    logoPreview.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
    });

    logoPreview.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');

        if (e.dataTransfer.files.length) {
            logoInput.files = e.dataTransfer.files;
            handleLogoSelect(e.dataTransfer.files[0]);
        }
    });

    // Clic sur la zone d'upload
    logoPreview.addEventListener('click', function() {
        logoInput.click();
    });

    // Changement de fichier
    logoInput.addEventListener('change', function(e) {
        if (this.files.length) {
            handleLogoSelect(this.files[0]);
        }
    });

    // Fonction pour gérer la sélection de logo
    function handleLogoSelect(file) {
        console.log('Logo sélectionné:', file.name, file.type, file.size);

        // Vérification de la taille
        const maxSize = 2 * 1024 * 1024; // 2 MB
        if (file.size > maxSize) {
            Swal.fire({
                icon: 'error',
                title: 'Logo trop volumineux',
                text: 'La taille maximale autorisée est de 2 MB',
            });
            logoInput.value = '';
            return;
        }

        // Vérification du type
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            Swal.fire({
                icon: 'error',
                title: 'Format non supporté',
                text: 'Seuls les formats JPG, PNG et WEBP sont acceptés',
            });
            logoInput.value = '';
            return;
        }

        // Mettre à jour le label
        logoLabel.textContent = file.name;

        // Afficher les informations du logo
        logoName.textContent = file.name;
        logoSize.textContent = formatFileSize(file.size);

        // Obtenir les dimensions de l'image
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = new Image();
            img.onload = function() {
                logoDimensions.textContent = `${this.width} × ${this.height} px`;
                logoInfo.style.display = 'block';

                // Afficher l'aperçu
                logoImagePreview.src = e.target.result;
                logoPreviewContainer.style.display = 'block';
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    // Validation du formulaire
    const form = document.getElementById('sponsorForm');
    form.addEventListener('submit', function(e) {
        // Vérifier si un logo est sélectionné
        if (!logoInput.files.length) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Logo manquant',
                text: 'Veuillez sélectionner un logo pour le sponsor',
            });
            return;
        }

        // Vérifier la taille du logo
        const logo = logoInput.files[0];
        const maxSize = 2 * 1024 * 1024;
        if (logo.size > maxSize) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Logo trop volumineux',
                text: 'La taille maximale autorisée est de 2 MB',
            });
            return;
        }

        // Désactiver le bouton pour éviter les doubles clics
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';

        // Si tout est bon, le formulaire s'envoie
    });

    // Mettre à jour l'apparence de la zone d'upload selon le niveau
    function updatePreviewStyle(level) {
        let color = '#dee2e6';

        switch(level) {
            case 'platinum': color = '#6c757d'; break;
            case 'gold': color = '#ffc107'; break;
            case 'silver': color = '#f8f9fa'; break;
            case 'bronze': color = '#dc3545'; break;
        }

        logoPreview.style.borderColor = color;
    }

    // Écouter les changements de niveau
    levelSelect.addEventListener('change', function() {
        updatePreviewStyle(this.value);
    });

    // Initialiser avec la valeur par défaut
    if (levelSelect.value) {
        updatePreviewStyle(levelSelect.value);
    }
});
</script>
@stop
