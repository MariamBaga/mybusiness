@extends('adminlte::page')

@section('title', 'Modifier le sponsor')

@section('content_header')
    <h1>
        <i class="fas fa-edit text-warning"></i>
        Modifier le sponsor
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sponsors.index') }}">Sponsors</a></li>
        <li class="breadcrumb-item active">Modifier</li>
    </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-warning">
                <h3 class="card-title">Modification de : {{ $sponsor->name }}</h3>
            </div>

            <form action="{{ route('sponsors.update', $sponsor->id) }}" method="POST" enctype="multipart/form-data" id="sponsorForm">
                @csrf
                @method('PUT')

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
                                               value="{{ old('name', $sponsor->name) }}"
                                               required>
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
                                                    <option value="platinum" {{ old('level', $sponsor->level) == 'platinum' ? 'selected' : '' }}>Platinum</option>
                                                    <option value="gold" {{ old('level', $sponsor->level) == 'gold' ? 'selected' : '' }}>Gold</option>
                                                    <option value="silver" {{ old('level', $sponsor->level) == 'silver' ? 'selected' : '' }}>Silver</option>
                                                    <option value="bronze" {{ old('level', $sponsor->level) == 'bronze' ? 'selected' : '' }}>Bronze</option>
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
                                                       value="{{ old('url', $sponsor->url) }}"
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
                                                  rows="3">{{ old('description', $sponsor->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Statut</label>
                                        <div class="custom-control custom-switch mt-2">
                                            <input type="checkbox"
                                                   name="status"
                                                   class="custom-control-input"
                                                   id="status"
                                                   value="1"
                                                   {{ old('status', $sponsor->status) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status">
                                                Sponsor actif
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Informations actuelles -->
                                    <div class="card mt-4">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0"><i class="fas fa-info-circle"></i> Informations actuelles</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1">
                                                        <strong>Ordre:</strong>
                                                        <span class="badge badge-primary">{{ $sponsor->order }}</span>
                                                    </p>
                                                    <p class="mb-1">
                                                        <strong>Créé le:</strong>
                                                        {{ $sponsor->created_at->format('d/m/Y H:i') }}
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    @if($sponsor->updated_at != $sponsor->created_at)
                                                    <p class="mb-1">
                                                        <strong>Modifié le:</strong>
                                                        {{ $sponsor->updated_at->format('d/m/Y H:i') }}
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Logo actuel -->
                            <div class="card mb-4">
                                <div class="card-header bg-info text-white">
                                    <i class="fas fa-image"></i> Logo actuel
                                </div>
                                <div class="card-body text-center">
                                    <div class="current-logo mb-3">
                                        <img src="{{ asset('StockPiece/sponsors/' . $sponsor->logo) }}"
                                             alt="{{ $sponsor->name }}"
                                             class="img-fluid rounded"
                                             style="max-height: 150px; max-width: 250px; object-fit: contain;">
                                    </div>
                                    <p class="small text-muted mb-0">
                                        Fichier: {{ $sponsor->logo }}
                                    </p>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="previewLogo()">
                                            <i class="fas fa-eye"></i> Voir en grand
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Nouveau logo (optionnel) -->
                            <div class="card mb-4">
                                <div class="card-header bg-warning text-white">
                                    <i class="fas fa-sync-alt"></i> Changer le logo
                                </div>
                                <div class="card-body text-center">
                                    <div class="form-group">
                                        <div class="logo-upload-area mb-4">
                                            <div class="logo-upload-preview border rounded p-4 mb-3" id="logoPreview">
                                                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">Glissez-déposez le nouveau logo</h5>
                                                <p class="text-muted small">ou cliquez pour parcourir</p>
                                                <p class="text-warning small mt-2">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    Laisser vide pour conserver le logo actuel
                                                </p>
                                            </div>

                                            <div class="custom-file">
                                                <input type="file"
                                                       name="logo"
                                                       id="logo"
                                                       class="custom-file-input @error('logo') is-invalid @enderror"
                                                       accept=".jpg,.jpeg,.png,.webp">
                                                <label class="custom-file-label" for="logo" id="logoLabel">
                                                    Choisir un nouveau logo
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
                                                Taille maximale: 2 MB
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Aperçu du nouveau logo -->
                                    <div id="logoPreviewContainer" style="display: none;">
                                        <hr>
                                        <h6 class="text-muted">Aperçu du nouveau logo:</h6>
                                        <div id="previewContent" class="mt-2 text-center">
                                            <img id="logoImagePreview" class="img-fluid rounded" style="max-height: 150px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="card">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-warning btn-block" id="submitBtn">
                                        <i class="fas fa-save"></i> Mettre à jour
                                    </button>
                                    <a href="{{ route('sponsors.index') }}" class="btn btn-default btn-block">
                                        <i class="fas fa-times"></i> Annuler
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour voir le logo en grand -->
<div class="modal fade" id="logoModal" tabindex="-1" role="dialog" aria-labelledby="logoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoModalLabel">Logo de {{ $sponsor->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('StockPiece/sponsors/' . $sponsor->logo) }}"
                     alt="{{ $sponsor->name }}"
                     class="img-fluid">
                <div class="mt-3">
                    <a href="{{ asset('StockPiece/sponsors/' . $sponsor->logo) }}"
                       download="{{ $sponsor->name }}.jpg"
                       class="btn btn-sm btn-primary">
                        <i class="fas fa-download"></i> Télécharger
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
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
    .current-logo {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
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

    // Fonction pour prévisualiser le logo actuel
    window.previewLogo = function() {
        $('#logoModal').modal('show');
    };

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
        } else {
            // Si aucun fichier sélectionné, masquer les infos
            logoInfo.style.display = 'none';
            logoPreviewContainer.style.display = 'none';
        }
    });

    // Fonction pour gérer la sélection de logo
    function handleLogoSelect(file) {
        console.log('Nouveau logo sélectionné:', file.name, file.type, file.size);

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
        // Vérifier si un nouveau logo est sélectionné
        if (logoInput.files.length) {
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
        }

        // Désactiver le bouton pour éviter les doubles clics
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mise à jour...';
    });
});
</script>
@stop
