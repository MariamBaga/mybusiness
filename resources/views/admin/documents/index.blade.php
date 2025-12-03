@extends('adminlte::page')

@section('title', 'Gestion des documents')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-file-alt text-primary"></i>
            Gestion des documents
        </h1>
        <a href="{{ route('documents.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un document
        </a>
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3 class="card-title">Liste des documents</h3>
            </div>
            <div class="col-md-6">
                <form action="{{ route('documents.index') }}" method="GET" class="float-right">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th width="50">ID</th>
                        <th>Document</th>
                        <th>Titre</th>
                        <th>Type</th>
                        <th>Taille</th>
                        <th>Téléchargements</th>
                        <th>Statut</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $document)
                    <tr>
                        <td class="text-center">{{ $document->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    @switch($document->type)
                                        @case('pdf')
                                            <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                            @break
                                        @case('doc')
                                            <i class="fas fa-file-word text-primary fa-2x"></i>
                                            @break
                                        @case('excel')
                                            <i class="fas fa-file-excel text-success fa-2x"></i>
                                            @break
                                        @case('image')
                                            <i class="fas fa-file-image text-info fa-2x"></i>
                                            @break
                                        @case('video')
                                            <i class="fas fa-file-video text-warning fa-2x"></i>
                                            @break
                                        @default
                                            <i class="fas fa-file text-secondary fa-2x"></i>
                                    @endswitch
                                </div>
                                <div>
                                    <small class="text-muted d-block">{{ $document->file }}</small>
                                    <small class="text-muted">{{ $document->file_type }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong>{{ $document->title }}</strong>
                            @if($document->description)
                                <small class="d-block text-muted mt-1">{{ Str::limit($document->description, 50) }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $document->type == 'pdf' ? 'danger' : ($document->type == 'doc' ? 'primary' : ($document->type == 'excel' ? 'success' : ($document->type == 'image' ? 'info' : ($document->type == 'video' ? 'warning' : 'secondary')))) }}">
                                {{ strtoupper($document->type) }}
                            </span>
                        </td>
                        <td>
                            {{ $document->size_formatted }}
                        </td>
                        <td class="text-center">
                            <span class="badge badge-info p-2">
                                <i class="fas fa-download mr-1"></i>
                                {{ $document->download_count }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $document->status ? 'success' : 'secondary' }}">
                                {{ $document->status ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('documents.download', $document->id) }}"
                                   class="btn btn-info"
                                   title="Télécharger"
                                   onclick="incrementDownload({{ $document->id }})">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="{{ route('documents.edit', $document->id) }}"
                                   class="btn btn-warning"
                                   title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-danger"
                                        title="Supprimer"
                                        onclick="confirmDelete({{ $document->id }}, '{{ $document->title }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                            <!-- Formulaire de suppression caché -->
                            <form id="delete-form-{{ $document->id }}"
                                  action="{{ route('documents.destroy', $document->id) }}"
                                  method="POST"
                                  style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fas fa-folder-open fa-2x mb-3"></i>
                            <h5>Aucun document trouvé</h5>
                            <p>Commencez par ajouter votre premier document</p>
                            <a href="{{ route('documents.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Ajouter un document
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($documents->hasPages())
        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $documents->links() }}
            </div>
            <div class="float-left">
                <small class="text-muted">
                    Affichage de {{ $documents->firstItem() }} à {{ $documents->lastItem() }} sur {{ $documents->total() }} documents
                </small>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal d'aperçu -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Aperçu du document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center" id="previewContent">
                <!-- Le contenu sera chargé ici dynamiquement -->
            </div>
            <div class="modal-footer">
                <a href="#" id="downloadLink" class="btn btn-primary">
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
    .file-icon {
        font-size: 2.5rem;
    }
    .badge {
        font-size: 0.9em;
        padding: 0.4em 0.8em;
    }
    .btn-group .btn {
        margin-right: 2px;
    }
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    .table tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    .modal-body iframe {
        width: 100%;
        height: 500px;
        border: none;
    }
</style>
@stop

@section('js')
<script>
    // Fonction pour formater les bytes en format lisible
    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];

        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    // Appliquer le formatage à tous les éléments avec la classe file-size
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.file-size').forEach(function(el) {
            const bytes = parseInt(el.getAttribute('data-bytes'));
            el.textContent = formatBytes(bytes);
        });
    });

    // Fonction de confirmation de suppression
    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Confirmer la suppression',
            html: `Êtes-vous sûr de vouloir supprimer le document <strong>"${title}"</strong> ?<br><small class="text-danger">Cette action est irréversible.</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }

    // Fonction pour prévisualiser un document
    function previewDocument(fileUrl, fileType, downloadUrl) {
        const modal = document.getElementById('previewModal');
        const previewContent = document.getElementById('previewContent');
        const downloadLink = document.getElementById('downloadLink');

        previewContent.innerHTML = '';

        // Afficher selon le type de fichier
        if (fileType.includes('pdf')) {
            previewContent.innerHTML = `
                <iframe src="${fileUrl}"></iframe>
            `;
        } else if (fileType.includes('image')) {
            previewContent.innerHTML = `
                <img src="${fileUrl}" class="img-fluid" alt="Aperçu">
            `;
        } else if (fileType.includes('video')) {
            previewContent.innerHTML = `
                <video controls class="w-100">
                    <source src="${fileUrl}" type="${fileType}">
                    Votre navigateur ne supporte pas la lecture vidéo.
                </video>
            `;
        } else {
            previewContent.innerHTML = `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    L'aperçu n'est pas disponible pour ce type de fichier.
                </div>
                <p class="mt-3">
                    <i class="fas fa-download fa-2x text-primary"></i><br>
                    Veuillez télécharger le fichier pour le consulter.
                </p>
            `;
        }

        // Mettre à jour le lien de téléchargement
        downloadLink.href = downloadUrl;

        // Afficher le modal
        $(modal).modal('show');
    }

    // Incrémenter le compteur de téléchargements (simulation)
    function incrementDownload(id) {
        // Vous pourriez faire une requête AJAX ici pour incrémenter le compteur
        // Pour l'instant, on laisse le contrôleur le gérer
        console.log('Téléchargement du document ID:', id);
    }

    // Initialiser les tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@stop
