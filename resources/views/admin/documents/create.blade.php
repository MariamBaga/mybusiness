@extends('adminlte::page')

@section('title', 'Ajouter un document')

@section('content_header')
    <h1>
        <i class="fas fa-file-upload text-success"></i>
        Ajouter un document
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('documents.index') }}">Documents</a></li>
        <li class="breadcrumb-item active">Ajouter</li>
    </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="card-title">Formulaire d'ajout</h3>
            </div>

            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" id="documentForm">
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
                            <!-- Informations du document -->
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <i class="fas fa-info-circle"></i> Informations du document
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Titre du document *</label>
                                        <input type="text"
                                               name="title"
                                               id="title"
                                               class="form-control @error('title') is-invalid @enderror"
                                               value="{{ old('title') }}"
                                               required
                                               autofocus>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description"
                                                  id="description"
                                                  class="form-control @error('description') is-invalid @enderror"
                                                  rows="4">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">
                                            Décrivez brièvement le contenu du document
                                        </small>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="type">Type de document *</label>
                                                <select name="type"
                                                        id="type"
                                                        class="form-control @error('type') is-invalid @enderror"
                                                        required>
                                                    <option value="">-- Sélectionner un type --</option>
                                                    <option value="pdf" {{ old('type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                                                    <option value="doc" {{ old('type') == 'doc' ? 'selected' : '' }}>Document Word</option>
                                                    <option value="excel" {{ old('type') == 'excel' ? 'selected' : '' }}>Feuille de calcul Excel</option>
                                                    <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Image (JPG, PNG, etc.)</option>
                                                    <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Vidéo (MP4, etc.)</option>
                                                    <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Autre type</option>
                                                </select>
                                                @error('type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
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
                                                        Document actif
                                                    </label>
                                                </div>
                                                <small class="text-muted">
                                                    Les documents inactifs ne seront pas visibles
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Upload du fichier -->
                            <div class="card">
                                <div class="card-header bg-warning text-white">
                                    <i class="fas fa-upload"></i> Fichier à uploader
                                </div>
                                <div class="card-body text-center">
                                    <div class="form-group">
                                        <div class="file-upload-area mb-4">
                                            <div class="file-upload-preview border rounded p-4 mb-3" id="filePreview">
                                                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">Glissez-déposez votre fichier ici</h5>
                                                <p class="text-muted small">ou cliquez pour parcourir</p>
                                            </div>

                                            <div class="custom-file">
                                                <input type="file"
                                                       name="file"
                                                       id="file"
                                                       class="custom-file-input @error('file') is-invalid @enderror"
                                                       required
                                                       accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.mp4,.webp">
                                                <label class="custom-file-label" for="file" id="fileLabel">
                                                    Choisir un fichier
                                                </label>
                                            </div>
                                            @error('file')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <div class="file-info mt-3" id="fileInfo" style="display: none;">
                                                <div class="alert alert-info">
                                                    <h6><i class="fas fa-file"></i> <span id="fileName"></span></h6>
                                                    <p class="mb-0">
                                                        Type: <span id="fileType" class="badge badge-info"></span><br>
                                                        Taille: <span id="fileSize"></span>
                                                    </p>
                                                </div>
                                            </div>

                                            <small class="form-text text-muted">
                                                Formats acceptés: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG, MP4, WEBP<br>
                                                Taille maximale: 10 MB
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Aperçu selon le type de fichier -->
                                    <div id="previewContainer" style="display: none;">
                                        <hr>
                                        <h6 class="text-muted">Aperçu:</h6>
                                        <div id="previewContent" class="mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="card mt-3">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-success btn-block" id="submitBtn">
                                        <i class="fas fa-save"></i> Enregistrer le document
                                    </button>
                                    <a href="{{ route('documents.index') }}" class="btn btn-default btn-block">
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
@stop

@section('css')
<style>
    .file-upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 5px;
        padding: 20px;
        transition: all 0.3s;
    }
    .file-upload-area.dragover {
        border-color: #007bff;
        background-color: rgba(0, 123, 255, 0.05);
    }
    .file-upload-preview {
        background-color: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s;
    }
    .file-upload-preview:hover {
        background-color: #e9ecef;
    }
    .file-icon-large {
        font-size: 4rem;
    }
    .custom-file-label::after {
        content: "Parcourir";
    }
    #previewContent img, #previewContent video {
        max-width: 100%;
        max-height: 200px;
        border-radius: 5px;
    }
</style>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('file');
    const fileLabel = document.getElementById('fileLabel');
    const filePreview = document.getElementById('filePreview');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');
    const fileType = document.getElementById('fileType');
    const fileSize = document.getElementById('fileSize');
    const previewContainer = document.getElementById('previewContainer');
    const previewContent = document.getElementById('previewContent');
    const typeSelect = document.getElementById('type');
    const submitBtn = document.getElementById('submitBtn');

    // Fonction pour formater la taille du fichier
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Gestion du drag & drop
    filePreview.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('dragover');
    });

    filePreview.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
    });

    filePreview.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');

        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            handleFileSelect(e.dataTransfer.files[0]);
        }
    });

    // Clic sur la zone d'upload
    filePreview.addEventListener('click', function() {
        fileInput.click();
    });

    // Changement de fichier
    fileInput.addEventListener('change', function(e) {
        if (this.files.length) {
            handleFileSelect(this.files[0]);
        }
    });

    // Fonction pour gérer la sélection de fichier
    function handleFileSelect(file) {
        console.log('Fichier sélectionné:', file.name, file.type, file.size);

        // Vérification de la taille
        const maxSize = 10 * 1024 * 1024; // 10 MB
        if (file.size > maxSize) {
            Swal.fire({
                icon: 'error',
                title: 'Fichier trop volumineux',
                text: 'La taille maximale autorisée est de 10 MB',
            });
            fileInput.value = '';
            return;
        }

        // Mettre à jour le label
        fileLabel.textContent = file.name;

        // Afficher les informations du fichier
        fileName.textContent = file.name;
        fileType.textContent = file.type || 'Inconnu';
        fileSize.textContent = formatFileSize(file.size);
        fileInfo.style.display = 'block';

        // Mettre à jour l'icône de prévisualisation
        updateFilePreview(file);

        // Mettre à jour automatiquement le type si vide
        if (!typeSelect.value) {
            const fileExtension = file.name.split('.').pop().toLowerCase();
            if (['pdf'].includes(fileExtension)) {
                typeSelect.value = 'pdf';
            } else if (['doc', 'docx'].includes(fileExtension)) {
                typeSelect.value = 'doc';
            } else if (['xls', 'xlsx'].includes(fileExtension)) {
                typeSelect.value = 'excel';
            } else if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension)) {
                typeSelect.value = 'image';
            } else if (['mp4', 'avi', 'mov', 'wmv'].includes(fileExtension)) {
                typeSelect.value = 'video';
            } else {
                typeSelect.value = 'other';
            }
        }
    }

    // Fonction pour mettre à jour l'aperçu
    function updateFilePreview(file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewContent.innerHTML = '';

            if (file.type.includes('image')) {
                previewContent.innerHTML = `
                    <img src="${e.target.result}" alt="Aperçu" class="img-thumbnail">
                `;
                previewContainer.style.display = 'block';
            } else if (file.type.includes('pdf')) {
                previewContent.innerHTML = `
                    <div class="alert alert-info">
                        <i class="fas fa-file-pdf fa-2x text-danger"></i>
                        <p class="mt-2">PDF - Aperçu non disponible</p>
                    </div>
                `;
                previewContainer.style.display = 'block';
            } else if (file.type.includes('video')) {
                previewContent.innerHTML = `
                    <video controls class="w-100">
                        <source src="${e.target.result}" type="${file.type}">
                        Votre navigateur ne supporte pas la lecture vidéo.
                    </video>
                `;
                previewContainer.style.display = 'block';
            } else {
                // Pour les autres types, on affiche juste une icône
                previewContent.innerHTML = `
                    <div class="text-center">
                        <i class="fas fa-file fa-3x text-secondary"></i>
                        <p class="mt-2">${file.name}</p>
                    </div>
                `;
                previewContainer.style.display = 'block';
            }
        };

        reader.readAsDataURL(file);
    }

    // Validation du formulaire
    const form = document.getElementById('documentForm');
    form.addEventListener('submit', function(e) {
        // Vérifier si un fichier est sélectionné
        if (!fileInput.files.length) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Fichier manquant',
                text: 'Veuillez sélectionner un fichier à uploader',
            });
            return;
        }

        // Vérifier la taille du fichier
        const file = fileInput.files[0];
        const maxSize = 10 * 1024 * 1024;
        if (file.size > maxSize) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Fichier trop volumineux',
                text: 'La taille maximale autorisée est de 10 MB',
            });
            return;
        }

        // Désactiver le bouton pour éviter les doubles clics
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Upload en cours...';

        // Si tout est bon, le formulaire s'envoie
    });

    // Définir l'icône par défaut
    function updateFileIcon(type) {
        let icon = 'fa-file';
        let color = 'text-secondary';

        switch(type) {
            case 'pdf':
                icon = 'fa-file-pdf';
                color = 'text-danger';
                break;
            case 'doc':
                icon = 'fa-file-word';
                color = 'text-primary';
                break;
            case 'excel':
                icon = 'fa-file-excel';
                color = 'text-success';
                break;
            case 'image':
                icon = 'fa-file-image';
                color = 'text-info';
                break;
            case 'video':
                icon = 'fa-file-video';
                color = 'text-warning';
                break;
        }

        filePreview.innerHTML = `
            <i class="fas ${icon} ${color} file-icon-large mb-3"></i>
            <h5 class="text-muted">Glissez-déposez votre fichier ici</h5>
            <p class="text-muted small">ou cliquez pour parcourir</p>
        `;
    }

    // Mettre à jour l'icône quand le type change
    typeSelect.addEventListener('change', function() {
        if (this.value) {
            updateFileIcon(this.value);
        }
    });

    // Initialiser avec le type par défaut si défini
    if (typeSelect.value) {
        updateFileIcon(typeSelect.value);
    }
});
</script>
@stop
