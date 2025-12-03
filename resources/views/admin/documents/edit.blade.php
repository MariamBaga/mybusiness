@extends('adminlte::page')

@section('title', 'Modifier le document')

@section('content_header')
    <h1>
        <i class="fas fa-edit text-warning"></i>
        Modifier le document
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('documents.index') }}">Documents</a></li>
        <li class="breadcrumb-item active">Modifier</li>
    </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-warning">
                <h3 class="card-title">Modification du document : {{ $document->title }}</h3>
            </div>

            <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data" id="documentForm">
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
                                               value="{{ old('title', $document->title) }}"
                                               required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description"
                                                  id="description"
                                                  class="form-control @error('description') is-invalid @enderror"
                                                  rows="4">{{ old('description', $document->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
                                                    <option value="pdf" {{ old('type', $document->type) == 'pdf' ? 'selected' : '' }}>PDF</option>
                                                    <option value="doc" {{ old('type', $document->type) == 'doc' ? 'selected' : '' }}>Document Word</option>
                                                    <option value="excel" {{ old('type', $document->type) == 'excel' ? 'selected' : '' }}>Feuille de calcul Excel</option>
                                                    <option value="image" {{ old('type', $document->type) == 'image' ? 'selected' : '' }}>Image (JPG, PNG, etc.)</option>
                                                    <option value="video" {{ old('type', $document->type) == 'video' ? 'selected' : '' }}>Vidéo (MP4, etc.)</option>
                                                    <option value="other" {{ old('type', $document->type) == 'other' ? 'selected' : '' }}>Autre type</option>
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
                                                           {{ old('status', $document->status) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="status">
                                                        Document actif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informations sur le fichier actuel -->
                                    <div class="card mt-3">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0"><i class="fas fa-file"></i> Fichier actuel</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    @switch($document->type)
                                                        @case('pdf')
                                                            <i class="fas fa-file-pdf text-danger fa-3x"></i>
                                                            @break
                                                        @case('doc')
                                                            <i class="fas fa-file-word text-primary fa-3x"></i>
                                                            @break
                                                        @case('excel')
                                                            <i class="fas fa-file-excel text-success fa-3x"></i>
                                                            @break
                                                        @case('image')
                                                            <i class="fas fa-file-image text-info fa-3x"></i>
                                                            @break
                                                        @case('video')
                                                            <i class="fas fa-file-video text-warning fa-3x"></i>
                                                            @break
                                                        @default
                                                            <i class="fas fa-file text-secondary fa-3x"></i>
                                                    @endswitch
                                                </div>
                                                <div>
                                                    <h6>{{ $document->file }}</h6>
                                                    <p class="mb-1">
                                                        <strong>Type:</strong>
                                                        <span class="badge badge-{{ $document->type == 'pdf' ? 'danger' : ($document->type == 'doc' ? 'primary' : ($document->type == 'excel' ? 'success' : ($document->type == 'image' ? 'info' : ($document->type == 'video' ? 'warning' : 'secondary')))) }}">
                                                            {{ $document->file_type }}
                                                        </span>
                                                    </p>
                                                    <p class="mb-1">
                                                        <strong>Taille:</strong>
                                                        {{ $document->file_size ? number_format($document->file_size / 1024, 2) . ' KB' : 'Inconnue' }}
                                                    </p>
                                                    <p class="mb-0">
                                                        <strong>Téléchargements:</strong>
                                                        <span class="badge badge-info">{{ $document->download_count }}</span>
                                                    </p>
                                                    <div class="mt-2">
                                                        <a href="{{ route('documents.download', $document->id) }}"
                                                           class="btn btn-sm btn-info"
                                                           target="_blank">
                                                            <i class="fas fa-download"></i> Télécharger
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-sm btn-secondary"
                                                                onclick="previewCurrentFile()">
                                                            <i class="fas fa-eye"></i> Prévisualiser
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Nouveau fichier (optionnel) -->
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <i class="fas fa-sync-alt"></i> Remplacer le fichier
                                </div>
                                <div class="card-body text-center">
                                    <div class="form-group">
                                        <div class="file-upload-area mb-4">
                                            <div class="file-upload-preview border rounded p-4 mb-3" id="filePreview">
                                                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">Glissez-déposez le nouveau fichier</h5>
                                                <p class="text-muted small">ou cliquez pour parcourir</p>
                                                <p class="text-warning small mt-2">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    Laisser vide pour conserver le fichier actuel
                                                </p>
                                            </div>

                                            <div class="custom-file">
                                                <input type="file"
                                                       name="file"
                                                       id="file"
                                                       class="custom-file-input @error('file') is-invalid @enderror"
                                                       accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.mp4,.webp">
                                                <label class="custom-file-label" for="file" id="fileLabel">
                                                    Choisir un nouveau fichier
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

                                    <!-- Aperçu du nouveau fichier -->
                                    <div id="previewContainer" style="display: none;">
                                        <hr>
                                        <h6 class="text-muted">Aperçu du nouveau fichier:</h6>
                                        <div id="previewContent" class="mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="card mt-3">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-warning btn-block" id="submitBtn">
                                        <i class="fas fa-save"></i> Mettre à jour
                                    </button>
                                    <a href="{{ route('documents.show', $document->id) }}" class="btn btn-info btn-block">
                                        <i class="fas fa-eye"></i> Voir le document
                                    </a>
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

<!-- Modal d'aperçu du fichier actuel -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Aperçu de {{ $document->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center" id="previewModalContent">
                @if($document->type == 'pdf')
                    <iframe src="{{ asset('StockPiece/documents/' . $document->file) }}" width="100%" height="500px"></iframe>
                @elseif($document->type == 'image')
                    <img src="{{ asset('StockPiece/documents/' . $document->file) }}" class="img-fluid" alt="Aperçu">
                @elseif($document->type == 'video')
                    <video controls class="w-100">
                        <source src="{{ asset('StockPiece/documents/' . $document->file) }}" type="{{ $document->file_type }}">
                        Votre navigateur ne supporte pas la lecture vidéo.
                    </video>
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle fa-2x"></i>
                        <h5 class="mt-3">Aperçu non disponible</h5>
                        <p>Ce type de fichier ne peut pas être prévisualisé dans le navigateur.</p>
                        <a href="{{ route('documents.download', $document->id) }}" class="btn btn-primary">
                            <i class="fas fa-download"></i> Télécharger pour visualiser
                        </a>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <a href="{{ route('documents.download', $document->id) }}" class="btn btn-primary">
                    <i class="fas fa-download"></i> Télécharger
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
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
    const submitBtn = document.getElementById('submitBtn');

    // Fonction pour prévisualiser le fichier actuel
    window.previewCurrentFile = function() {
        $('#previewModal').modal('show');
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
        } else {
            // Si aucun fichier sélectionné, masquer les infos
            fileInfo.style.display = 'none';
            previewContainer.style.display = 'none';
        }
    });

    // Fonction pour gérer la sélection de fichier
    function handleFileSelect(file) {
        console.log('Nouveau fichier sélectionné:', file.name, file.type, file.size);

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

        // Mettre à jour l'aperçu
        updateFilePreview(file);
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
        // Vérifier si un nouveau fichier est sélectionné
        if (fileInput.files.length) {
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
        }

        // Désactiver le bouton pour éviter les doubles clics
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mise à jour...';

        // Si tout est bon, le formulaire s'envoie
    });
});
</script>
@stop
