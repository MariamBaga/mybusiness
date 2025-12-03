@extends('adminlte::page')

@section('title', 'Gestion des sponsors')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-handshake text-warning"></i>
            Gestion des sponsors
        </h1>
        <a href="{{ route('sponsors.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un sponsor
        </a>
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3 class="card-title">Liste des sponsors</h3>
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    <button type="button" class="btn btn-success" onclick="toggleOrderMode()" id="toggleOrderBtn">
                        <i class="fas fa-sort"></i> Modifier l'ordre
                    </button>
                    <form action="{{ route('sponsors.index') }}" method="GET" class="d-inline-block ml-2">
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

        <!-- Filtres par niveau -->
        <div class="mb-4">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary {{ !request('level') ? 'active' : '' }}" onclick="window.location.href='{{ route('sponsors.index') }}'">
                    Tous les niveaux
                </button>
                @foreach(['platinum', 'gold', 'silver', 'bronze'] as $level)
                <button type="button" class="btn btn-outline-{{ getLevelColor($level) }} {{ request('level') == $level ? 'active' : '' }}" onclick="window.location.href='{{ route('sponsors.index', ['level' => $level]) }}'">
                    {{ ucfirst($level) }}
                </button>
                @endforeach
            </div>
        </div>

        <!-- Liste des sponsors -->
        <div class="row sponsor-list" id="sponsorList">
            @forelse($sponsors as $sponsor)
            <div class="col-md-6 col-lg-4 mb-4 sponsor-item" data-id="{{ $sponsor->id }}" id="sponsor-{{ $sponsor->id }}">
                <div class="card h-100 shadow-sm border-{{ getLevelColor($sponsor->level) }}" style="border-width: 2px;">
                    <div class="card-header d-flex justify-content-between align-items-center bg-light">
                        <div class="d-flex align-items-center">
                            <!-- Handle pour le drag & drop -->
                            <div class="order-handle mr-2 text-muted" style="display: none; cursor: move;">
                                <i class="fas fa-grip-vertical"></i>
                            </div>

                            <!-- Niveau -->
                            <span class="badge badge-{{ getLevelColor($sponsor->level) }} mr-2">
                                {{ ucfirst($sponsor->level) }}
                            </span>

                            <!-- Statut -->
                            <span class="badge {{ $sponsor->status ? 'badge-success' : 'badge-secondary' }}">
                                {{ $sponsor->status ? 'Actif' : 'Inactif' }}
                            </span>
                        </div>

                        <!-- Ordre -->
                        <span class="badge badge-primary order-badge">
                            #{{ $sponsor->order }}
                        </span>
                    </div>

                    <div class="card-body text-center">
                        <!-- Logo -->
                        <div class="sponsor-logo mb-3">
                            <img src="{{ asset('StockPiece/sponsors/' . $sponsor->logo) }}"
                                 alt="{{ $sponsor->name }}"
                                 class="img-fluid rounded"
                                 style="max-height: 120px; max-width: 200px; object-fit: contain;">
                        </div>

                        <!-- Nom -->
                        <h5 class="card-title">{{ $sponsor->name }}</h5>

                        <!-- Description -->
                        @if($sponsor->description)
                            <p class="card-text text-muted small">
                                {{ Str::limit($sponsor->description, 100) }}
                            </p>
                        @endif

                        <!-- URL -->
                        @if($sponsor->url)
                            <a href="{{ $sponsor->url }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary btn-block mt-2">
                                <i class="fas fa-external-link-alt"></i> Site web
                            </a>
                        @endif
                    </div>

                    <div class="card-footer bg-transparent">
                        <div class="btn-group btn-group-sm w-100" role="group">
                            <a href="{{ route('sponsors.edit', $sponsor->id) }}"
                               class="btn btn-warning"
                               title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button"
                                    class="btn btn-danger"
                                    title="Supprimer"
                                    onclick="confirmDelete({{ $sponsor->id }}, '{{ $sponsor->name }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>

                        <!-- Formulaire de suppression caché -->
                        <form id="delete-form-{{ $sponsor->id }}"
                              action="{{ route('sponsors.destroy', $sponsor->id) }}"
                              method="POST"
                              style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center text-muted py-5">
                    <i class="fas fa-handshake fa-4x mb-3"></i>
                    <h4>Aucun sponsor trouvé</h4>
                    <p class="mb-4">Commencez par ajouter votre premier sponsor</p>
                    <a href="{{ route('sponsors.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Ajouter un sponsor
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($sponsors->hasPages())
        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $sponsors->links() }}
            </div>
            <div class="float-left">
                <small class="text-muted">
                    Affichage de {{ $sponsors->firstItem() }} à {{ $sponsors->lastItem() }} sur {{ $sponsors->total() }} sponsors
                </small>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Instructions pour le drag & drop -->
<div class="card bg-light order-instructions" id="orderInstructions" style="display: none;">
    <div class="card-body text-center">
        <p class="mb-2">
            <i class="fas fa-grip-vertical text-primary"></i>
            <strong>Mode édition d'ordre activé</strong>
        </p>
        <p class="mb-0 small text-muted">
            Glissez-déposez les sponsors pour réorganiser l'ordre d'affichage.
            <br>Cliquez sur "Sauvegarder l'ordre" une fois terminé.
        </p>
        <div class="mt-3">
            <button type="button" class="btn btn-success btn-sm" onclick="saveOrder()">
                <i class="fas fa-save"></i> Sauvegarder l'ordre
            </button>
            <button type="button" class="btn btn-secondary btn-sm" onclick="toggleOrderMode()">
                <i class="fas fa-times"></i> Annuler
            </button>
        </div>
    </div>
</div>
@stop

@php
function getLevelColor($level) {
    switch($level) {
        case 'platinum': return 'secondary';
        case 'gold': return 'warning';
        case 'silver': return 'light';
        case 'bronze': return 'danger';
        default: return 'secondary';
    }
}
@endphp

@section('css')
<style>
    .sponsor-item {
        transition: all 0.3s ease;
    }
    .sponsor-item:hover {
        transform: translateY(-5px);
    }
    .sponsor-logo {
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 10px;
    }
    .sponsor-logo img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }
    .order-handle:hover {
        color: #007bff !important;
    }
    .order-badge {
        font-size: 0.8em;
        min-width: 30px;
        text-align: center;
    }
    .sortable-ghost {
        opacity: 0.4;
    }
    .sortable-chosen {
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .order-instructions {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 300px;
        z-index: 1000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border: 2px solid #28a745;
    }
    .card.border-secondary { border-color: #6c757d !important; }
    .card.border-warning { border-color: #ffc107 !important; }
    .card.border-light { border-color: #f8f9fa !important; }
    .card.border-danger { border-color: #dc3545 !important; }
    .btn-outline-secondary { color: #6c757d; border-color: #6c757d; }
    .btn-outline-secondary.active { background-color: #6c757d; color: white; }
    .btn-outline-warning { color: #ffc107; border-color: #ffc107; }
    .btn-outline-warning.active { background-color: #ffc107; color: #212529; }
    .btn-outline-light { color: #f8f9fa; border-color: #f8f9fa; }
    .btn-outline-light.active { background-color: #f8f9fa; color: #212529; }
    .btn-outline-danger { color: #dc3545; border-color: #dc3545; }
    .btn-outline-danger.active { background-color: #dc3545; color: white; }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
let sortable = null;
let orderMode = false;

// Fonction pour confirmer la suppression
function confirmDelete(id, name) {
    Swal.fire({
        title: 'Confirmer la suppression',
        html: `Êtes-vous sûr de vouloir supprimer le sponsor <strong>"${name}"</strong> ?<br><small class="text-danger">Cette action est irréversible.</small>`,
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

// Fonction pour activer/désactiver le mode édition d'ordre
function toggleOrderMode() {
    orderMode = !orderMode;
    const toggleBtn = document.getElementById('toggleOrderBtn');
    const instructions = document.getElementById('orderInstructions');
    const handles = document.querySelectorAll('.order-handle');
    const items = document.querySelectorAll('.sponsor-item');

    if (orderMode) {
        // Activer le mode édition d'ordre
        toggleBtn.innerHTML = '<i class="fas fa-times"></i> Quitter le mode édition';
        toggleBtn.classList.remove('btn-success');
        toggleBtn.classList.add('btn-danger');
        instructions.style.display = 'block';

        // Afficher les handles
        handles.forEach(handle => {
            handle.style.display = 'block';
        });

        // Rendre les éléments drag & drop
        items.forEach(item => {
            item.style.cursor = 'move';
        });

        // Initialiser Sortable
        if (!sortable) {
            sortable = Sortable.create(document.getElementById('sponsorList'), {
                animation: 150,
                handle: '.order-handle',
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen'
            });
        }

    } else {
        // Désactiver le mode édition d'ordre
        toggleBtn.innerHTML = '<i class="fas fa-sort"></i> Modifier l\'ordre';
        toggleBtn.classList.remove('btn-danger');
        toggleBtn.classList.add('btn-success');
        instructions.style.display = 'none';

        // Masquer les handles
        handles.forEach(handle => {
            handle.style.display = 'none';
        });

        // Restaurer le curseur
        items.forEach(item => {
            item.style.cursor = 'default';
        });

        // Détruire Sortable
        if (sortable) {
            sortable.destroy();
            sortable = null;
        }
    }
}

// Fonction pour sauvegarder l'ordre
function saveOrder() {
    const items = document.querySelectorAll('.sponsor-item');
    const order = [];

    items.forEach(item => {
        order.push(item.dataset.id);
    });

    Swal.fire({
        title: 'Sauvegarde en cours...',
        text: 'Veuillez patienter pendant la mise à jour de l\'ordre',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });

    // Envoyer la requête AJAX
    fetch('{{ route("sponsors.updateOrder") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ order: order })
    })
    .then(response => response.json())
    .then(data => {
        Swal.close();

        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: 'L\'ordre a été mis à jour avec succès',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                location.reload(); // Recharger pour voir les nouveaux numéros d'ordre
            });

        } else {
            throw new Error('Erreur lors de la sauvegarde');
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Une erreur est survenue lors de la sauvegarde de l\'ordre',
        });
    });
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les tooltips
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@stop
