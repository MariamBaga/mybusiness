@extends('adminlte::page')

@section('title', 'Gestion des FAQ')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-question-circle text-info"></i>
            Gestion des FAQ
        </h1>
        <a href="{{ route('faqs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter une FAQ
        </a>
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3 class="card-title">Liste des questions fréquentes</h3>
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    <button type="button" class="btn btn-success" onclick="toggleOrderMode()" id="toggleOrderBtn">
                        <i class="fas fa-sort"></i> Modifier l'ordre
                    </button>
                    <form action="{{ route('faqs.index') }}" method="GET" class="d-inline-block ml-2">
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

        <!-- Filtrer par catégorie -->
        @if($categories->count() > 0)
        <div class="mb-4">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary {{ !request('category') ? 'active' : '' }}" onclick="window.location.href='{{ route('faqs.index') }}'">
                    Toutes les catégories
                </button>
                @foreach($categories as $cat)
                <button type="button" class="btn btn-outline-secondary {{ request('category') == $cat ? 'active' : '' }}" onclick="window.location.href='{{ route('faqs.index', ['category' => $cat]) }}'">
                    {{ $cat }}
                </button>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Liste des FAQ -->
        <div class="faq-list" id="faqList">
            @forelse($faqs as $faq)
            <div class="card mb-3 faq-item" data-id="{{ $faq->id }}" id="faq-{{ $faq->id }}">
                <div class="card-header d-flex justify-content-between align-items-center" style="cursor: pointer;" onclick="toggleFaq({{ $faq->id }})">
                    <div class="d-flex align-items-center">
                        <!-- Handle pour le drag & drop (visible seulement en mode édition d'ordre) -->
                        <div class="order-handle mr-2 text-muted" style="display: none; cursor: move;">
                            <i class="fas fa-grip-vertical fa-lg"></i>
                        </div>

                        <!-- Numéro d'ordre -->
                        <span class="badge badge-primary mr-2 order-badge">
                            {{ $faq->order }}
                        </span>

                        <!-- Question -->
                        <h5 class="mb-0">
                            {{ $faq->question }}
                            @if($faq->category)
                                <span class="badge badge-secondary ml-2">{{ $faq->category }}</span>
                            @endif
                        </h5>
                    </div>

                    <div class="d-flex align-items-center">
                        <!-- Statut -->
                        <span class="badge {{ $faq->status ? 'badge-success' : 'badge-secondary' }} mr-2">
                            {{ $faq->status ? 'Active' : 'Inactive' }}
                        </span>

                        <!-- Actions -->
                        <div class="btn-group btn-group-sm actions" role="group">
                            <a href="{{ route('faqs.edit', $faq->id) }}"
                               class="btn btn-warning"
                               title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button"
                                    class="btn btn-danger"
                                    title="Supprimer"
                                    onclick="confirmDelete({{ $faq->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>

                        <!-- Icône de toggle -->
                        <i class="fas fa-chevron-down ml-2 toggle-icon"></i>
                    </div>
                </div>

                <!-- Réponse (masquée par défaut) -->
                <div class="card-body faq-answer" id="answer-{{ $faq->id }}" style="display: none;">
                    <div class="faq-answer-content">
                        {!! nl2br(e($faq->answer)) !!}
                    </div>

                    <!-- Métadonnées -->
                    <div class="mt-3 text-muted small">
                        <i class="fas fa-calendar-alt"></i> Créée le {{ $faq->created_at->format('d/m/Y') }}
                        @if($faq->updated_at != $faq->created_at)
                            | <i class="fas fa-sync-alt"></i> Modifiée le {{ $faq->updated_at->format('d/m/Y') }}
                        @endif
                    </div>
                </div>

                <!-- Formulaire de suppression caché -->
                <form id="delete-form-{{ $faq->id }}"
                      action="{{ route('faqs.destroy', $faq->id) }}"
                      method="POST"
                      style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            @empty
            <div class="text-center text-muted py-5">
                <i class="fas fa-question-circle fa-4x mb-3"></i>
                <h4>Aucune FAQ trouvée</h4>
                <p class="mb-4">Commencez par ajouter votre première question fréquente</p>
                <a href="{{ route('faqs.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajouter une FAQ
                </a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($faqs->hasPages())
        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $faqs->links() }}
            </div>
            <div class="float-left">
                <small class="text-muted">
                    Affichage de {{ $faqs->firstItem() }} à {{ $faqs->lastItem() }} sur {{ $faqs->total() }} FAQ
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
            Glissez-déposez les questions pour réorganiser l'ordre d'affichage.
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

@section('css')
<style>
    .faq-item {
        transition: all 0.3s ease;
        border-left: 4px solid #007bff;
    }
    .faq-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .faq-answer-content {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        border-left: 3px solid #28a745;
    }
    .order-handle:hover {
        color: #007bff !important;
    }
    .order-badge {
        font-size: 0.8em;
        min-width: 30px;
        text-align: center;
    }
    .actions .btn {
        margin-right: 2px;
    }
    .actions .btn:last-child {
        margin-right: 0;
    }
    .sortable-ghost {
        opacity: 0.4;
        background-color: #f8f9fa;
    }
    .sortable-chosen {
        background-color: #e9ecef;
        border-color: #007bff !important;
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
    .faq-item.collapsed .toggle-icon {
        transform: rotate(0deg);
    }
    .faq-item:not(.collapsed) .toggle-icon {
        transform: rotate(180deg);
    }
    .toggle-icon {
        transition: transform 0.3s ease;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
let sortable = null;
let orderMode = false;

// Fonction pour basculer l'affichage d'une FAQ
function toggleFaq(id) {
    const answer = document.getElementById(`answer-${id}`);
    const faqItem = document.getElementById(`faq-${id}`);

    if (answer.style.display === 'none') {
        answer.style.display = 'block';
        faqItem.classList.remove('collapsed');
    } else {
        answer.style.display = 'none';
        faqItem.classList.add('collapsed');
    }
}

// Fonction pour confirmer la suppression
function confirmDelete(id) {
    Swal.fire({
        title: 'Confirmer la suppression',
        html: 'Êtes-vous sûr de vouloir supprimer cette FAQ ?<br><small class="text-danger">Cette action est irréversible.</small>',
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
    const badges = document.querySelectorAll('.order-badge');
    const faqHeaders = document.querySelectorAll('.faq-item .card-header');

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

        // Rendre les badges plus visibles
        badges.forEach(badge => {
            badge.classList.add('badge-primary');
            badge.classList.remove('badge-secondary');
        });

        // Désactiver le clic sur les en-têtes FAQ
        faqHeaders.forEach(header => {
            header.style.cursor = 'move';
            header.onclick = null;
        });

        // Initialiser Sortable
        if (!sortable) {
            sortable = Sortable.create(document.getElementById('faqList'), {
                animation: 150,
                handle: '.order-handle',
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                onUpdate: function() {
                    updateOrderNumbers();
                }
            });
        }

        // Fermer toutes les réponses
        document.querySelectorAll('.faq-answer').forEach(answer => {
            answer.style.display = 'none';
        });
        document.querySelectorAll('.faq-item').forEach(item => {
            item.classList.add('collapsed');
        });

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

        // Restaurer l'apparence des badges
        badges.forEach(badge => {
            badge.classList.remove('badge-primary');
            badge.classList.add('badge-secondary');
        });

        // Réactiver le clic sur les en-têtes FAQ
        faqHeaders.forEach(header => {
            header.style.cursor = 'pointer';
            const faqId = header.closest('.faq-item').dataset.id;
            header.onclick = () => toggleFaq(faqId);
        });

        // Détruire Sortable
        if (sortable) {
            sortable.destroy();
            sortable = null;
        }
    }
}

// Fonction pour mettre à jour les numéros d'ordre
function updateOrderNumbers() {
    const items = document.querySelectorAll('.faq-item');
    items.forEach((item, index) => {
        const badge = item.querySelector('.order-badge');
        if (badge) {
            badge.textContent = index + 1;
        }
    });
}

// Fonction pour sauvegarder l'ordre
function saveOrder() {
    const items = document.querySelectorAll('.faq-item');
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
    fetch('{{ route("faqs.updateOrder") }}', {
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
            });

            // Désactiver le mode édition après sauvegarde
            setTimeout(() => {
                toggleOrderMode();
            }, 1000);

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
    // Récupérer les catégories uniques pour le filtre
    const categoryButtons = document.querySelectorAll('.btn-group .btn');
    categoryButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            categoryButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Initialiser les tooltips
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@stop
