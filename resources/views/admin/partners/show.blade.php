@extends('adminlte::page')

@section('title', $partner->name . ' - Détails du Partenaire')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>
        <i class="fas fa-handshake text-info mr-2"></i>
        Détails du partenaire
    </h1>
    <div>
        <a href="{{ route('partners.edit', $partner) }}" class="btn btn-warning mr-2">
            <i class="fas fa-edit mr-1"></i> Modifier
        </a>
        <a href="{{ route('partners.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Retour
        </a>
    </div>
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
            <i class="fas fa-eye"></i> {{ $partner->name }}
        </li>
    </ol>
</nav>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <!-- Carte d'information du partenaire -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-id-card mr-2"></i>
                    Profil du partenaire
                </h3>
                <div class="card-tools">
                    <span class="badge badge-light">
                        ID: {{ $partner->id }}
                    </span>
                </div>
            </div>
            <div class="card-body text-center">
                <!-- Logo -->
                <div class="mb-4">
                    @if($partner->logo)
                        <img src="{{ asset('StockPiece/partners/' . $partner->logo) }}"
                             alt="{{ $partner->name }}"
                             class="img-fluid rounded-circle border"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                             style="width: 150px; height: 150px;">
                            <i class="fas fa-building text-muted fa-4x"></i>
                        </div>
                    @endif
                </div>

                <!-- Nom -->
                <h3 class="mb-1">{{ $partner->name }}</h3>

                <!-- Badges -->
                <div class="mb-3">
                    @switch($partner->type)
                        @case('corporate')
                            <span class="badge badge-primary">Entreprise</span>
                            @break
                        @case('individual')
                            <span class="badge badge-info">Individuel</span>
                            @break
                        @case('ngo')
                            <span class="badge badge-success">ONG</span>
                            @break
                        @case('government')
                            <span class="badge badge-secondary">Gouvernement</span>
                            @break
                    @endswitch

                    @if($partner->featured)
                        <span class="badge badge-warning ml-1">
                            <i class="fas fa-star mr-1"></i> Vedette
                        </span>
                    @endif

                    @if($partner->status)
                        <span class="badge badge-success ml-1">
                            <i class="fas fa-check-circle mr-1"></i> Actif
                        </span>
                    @else
                        <span class="badge badge-danger ml-1">
                            <i class="fas fa-times-circle mr-1"></i> Inactif
                        </span>
                    @endif
                </div>

                <!-- Statistiques -->
                <div class="row text-center mb-4">
                    <div class="col-6">
                        <div class="p-3 bg-light rounded">
                            <h4 class="mb-0 text-info">{{ $partner->products_count }}</h4>
                            <small class="text-muted">Produits</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded">
                            <h4 class="mb-0 text-success">
                                @php
                                    $activeProducts = $partner->products()->where('status', 1)->count();
                                @endphp
                                {{ $activeProducts }}
                            </h4>
                            <small class="text-muted">Produits actifs</small>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="btn-group-vertical w-100 mb-3">
                    @if($partner->email)
                    <a href="mailto:{{ $partner->email }}" class="btn btn-outline-primary mb-2">
                        <i class="fas fa-envelope mr-1"></i> Envoyer un email
                    </a>
                    @endif

                    @if($partner->website)
                    <a href="{{ $partner->website }}" target="_blank" class="btn btn-outline-info mb-2">
                        <i class="fas fa-external-link-alt mr-1"></i> Visiter le site
                    </a>
                    @endif

                    @if($partner->phone)
                    <a href="tel:{{ $partner->phone }}" class="btn btn-outline-success mb-2">
                        <i class="fas fa-phone mr-1"></i> Appeler
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Informations de contact -->
        <div class="card card-info mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-address-book mr-2"></i>
                    Informations de contact
                </h3>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @if($partner->email)
                    <li class="list-group-item d-flex align-items-center">
                        <i class="fas fa-envelope text-info mr-3" style="width: 20px;"></i>
                        <div>
                            <strong>Email</strong>
                            <div class="text-muted">
                                <a href="mailto:{{ $partner->email }}">{{ $partner->email }}</a>
                            </div>
                        </div>
                    </li>
                    @endif

                    @if($partner->phone)
                    <li class="list-group-item d-flex align-items-center">
                        <i class="fas fa-phone text-info mr-3" style="width: 20px;"></i>
                        <div>
                            <strong>Téléphone</strong>
                            <div class="text-muted">
                                <a href="tel:{{ $partner->phone }}">{{ $partner->phone }}</a>
                            </div>
                        </div>
                    </li>
                    @endif

                    @if($partner->website)
                    <li class="list-group-item d-flex align-items-center">
                        <i class="fas fa-globe text-info mr-3" style="width: 20px;"></i>
                        <div>
                            <strong>Site web</strong>
                            <div class="text-muted">
                                <a href="{{ $partner->website }}" target="_blank">{{ $partner->website }}</a>
                            </div>
                        </div>
                    </li>
                    @endif

                    @if($partner->address)
                    <li class="list-group-item d-flex align-items-start">
                        <i class="fas fa-map-marker-alt text-info mr-3 mt-1" style="width: 20px;"></i>
                        <div>
                            <strong>Adresse</strong>
                            <div class="text-muted">{{ $partner->address }}</div>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <!-- Description et informations -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    Description et informations
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mb-3">
                            <i class="fas fa-align-left text-info mr-2"></i>
                            Description
                        </h5>
                        @if($partner->description)
                            <div class="p-3 bg-light rounded">
                                {{ $partner->description }}
                            </div>
                        @else
                            <div class="alert alert-light">
                                <i class="fas fa-info-circle mr-2"></i>
                                Aucune description fournie
                            </div>
                        @endif
                    </div>
                </div>

                <hr class="my-4">

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">
                            <i class="fas fa-calendar-alt text-info mr-2"></i>
                            Dates importantes
                        </h5>
                        <div class="p-3 bg-light rounded">
                            <p class="mb-2">
                                <strong>Création :</strong><br>
                                <span class="text-muted">{{ $partner->created_at->format('d/m/Y à H:i') }}</span>
                            </p>
                            <p class="mb-0">
                                <strong>Dernière modification :</strong><br>
                                <span class="text-muted">{{ $partner->updated_at->format('d/m/Y à H:i') }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">
                            <i class="fas fa-chart-bar text-info mr-2"></i>
                            Statistiques
                        </h5>
                        <div class="p-3 bg-light rounded">
                            <p class="mb-2">
                                <strong>Type :</strong>
                                <span class="badge badge-{{ $partner->type == 'corporate' ? 'primary' : ($partner->type == 'individual' ? 'info' : ($partner->type == 'ngo' ? 'success' : 'secondary')) }}">
                                    {{ ucfirst($partner->type) }}
                                </span>
                            </p>
                            <p class="mb-2">
                                <strong>Statut :</strong>
                                @if($partner->status)
                                    <span class="badge badge-success">Actif</span>
                                @else
                                    <span class="badge badge-danger">Inactif</span>
                                @endif
                            </p>
                            <p class="mb-0">
                                <strong>Vedette :</strong>
                                @if($partner->featured)
                                    <span class="badge badge-warning">Oui</span>
                                @else
                                    <span class="badge badge-light">Non</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mb-3">
                            <i class="fas fa-qrcode text-info mr-2"></i>
                            Partage rapide
                        </h5>
                        <div class="p-3 bg-light rounded text-center">
                            <p class="text-muted mb-3">Partagez ce partenaire via ce lien unique :</p>
                            <div class="input-group mb-3">
                                <input type="text"
                                       class="form-control"
                                       id="partnerUrl"
                                       value="{{ route('partners.show', $partner) }}"
                                       readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-info" onclick="copyPartnerUrl()">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Copiez ce lien pour partager la fiche du partenaire
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des produits -->
        <div class="card card-info mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-boxes mr-2"></i>
                    Produits associés ({{ $partner->products_count }})
                </h3>
                @if($partner->products_count > 0)
                <div class="card-tools">
                    <button class="btn btn-tool" type="button" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                @endif
            </div>
            <div class="card-body">
                @if($partner->products_count > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Catégorie</th>
                                    <th>Prix</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($partner->products as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($product->image)
                                            <img src="{{ asset('StockPiece/products/' . $product->image) }}"
                                                 alt="{{ $product->name }}"
                                                 class="img-thumbnail mr-2"
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center mr-2"
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-box text-muted"></i>
                                            </div>
                                            @endif
                                            <div>
                                                <strong>{{ $product->name }}</strong><br>
                                                <small class="text-muted">{{ Str::limit($product->description, 30) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($product->category)
                                            <span class="badge badge-secondary">{{ $product->category->name }}</span>
                                        @else
                                            <span class="badge badge-light">Non catégorisé</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-success">{{ number_format($product->price, 2, ',', ' ') }} €</span>
                                    </td>
                                    <td>
                                        @if($product->status)
                                            <span class="badge badge-success">Actif</span>
                                        @else
                                            <span class="badge badge-danger">Inactif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('products.show', $product->slug) }}"
                                           class="btn btn-sm btn-outline-info"
                                           data-toggle="tooltip"
                                           title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($partner->products_count > 5)
                    <div class="text-center mt-3">
                        <a href="{{ route('products.index', ['partner' => $partner->id]) }}"
                           class="btn btn-outline-info">
                            <i class="fas fa-list mr-1"></i> Voir tous les produits
                        </a>
                    </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Aucun produit associé</h5>
                        <p class="text-muted">Ce partenaire n'a pas encore de produits dans le catalogue.</p>
                        <a href="{{ route('products.create') }}" class="btn btn-info">
                            <i class="fas fa-plus mr-1"></i> Ajouter un produit
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="card card-info mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bolt mr-2"></i>
                    Actions rapides
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <button class="btn btn-outline-warning btn-block" onclick="toggleStatus()">
                            <i class="fas fa-toggle-{{ $partner->status ? 'off' : 'on' }} mr-1"></i>
                            {{ $partner->status ? 'Désactiver' : 'Activer' }}
                        </button>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button class="btn btn-outline-primary btn-block" onclick="toggleFeatured()">
                            <i class="fas fa-star mr-1"></i>
                            {{ $partner->featured ? 'Retirer des vedettes' : 'Mettre en vedette' }}
                        </button>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button class="btn btn-outline-danger btn-block" onclick="confirmDelete()">
                            <i class="fas fa-trash mr-1"></i> Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Confirmer la suppression
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer ce partenaire ?</p>
                <div class="alert alert-warning">
                    <h6><i class="fas fa-exclamation-circle mr-2"></i>Attention !</h6>
                    <ul class="mb-0">
                        <li>Cette action est irréversible</li>
                        <li>Tous les produits associés seront orphelins</li>
                        <li>Le logo sera définitivement supprimé</li>
                        @if($partner->products_count > 0)
                        <li class="text-danger font-weight-bold">
                            Ce partenaire a {{ $partner->products_count }} produit(s) associé(s)
                        </li>
                        @endif
                    </ul>
                </div>
                <p class="mb-0">
                    <strong>Nom du partenaire :</strong> {{ $partner->name }}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Annuler
                </button>
                <form action="{{ route('partners.destroy', $partner) }}" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash mr-1"></i> Supprimer définitivement
                    </button>
                </form>
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
        border-top: 3px solid #17a2b8;
    }

    .card-header {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border-bottom: 2px solid #dee2e6;
    }

    .badge {
        font-size: 0.85em;
        padding: 5px 10px;
    }

    .list-group-item {
        border: none;
        padding: 15px 0;
    }

    .list-group-item:first-child {
        padding-top: 0;
    }

    .list-group-item:last-child {
        padding-bottom: 0;
    }

    .btn-group-vertical .btn {
        border-radius: 5px;
        text-align: left;
        padding-left: 20px;
    }

    .breadcrumb {
        background-color: transparent;
        padding-left: 0;
    }

    .breadcrumb-item.active {
        color: #17a2b8;
        font-weight: 500;
    }

    .img-thumbnail {
        border-radius: 5px;
        border: 1px solid #dee2e6;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(23, 162, 184, 0.05);
    }

    .input-group-text {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Initialiser les tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });

    function copyPartnerUrl() {
        const urlInput = document.getElementById('partnerUrl');
        urlInput.select();
        urlInput.setSelectionRange(0, 99999); // Pour mobile
        document.execCommand('copy');

        Swal.fire({
            icon: 'success',
            title: 'Lien copié !',
            text: 'Le lien du partenaire a été copié dans le presse-papier',
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }

    function toggleStatus() {
        Swal.fire({
            title: '{{ $partner->status ? 'Désactiver' : 'Activer' }} ce partenaire ?',
            text: "{{ $partner->status ? 'Le partenaire ne sera plus visible sur le site' : 'Le partenaire sera visible sur le site' }}",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '{{ $partner->status ? 'Oui, désactiver' : 'Oui, activer' }}',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Soumettre le formulaire de changement de statut
                $.ajax({
                    url: '{{ route("partners.toggle-status", $partner) }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Traitement en cours...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Succès !',
                            text: response.message || 'Statut modifié avec succès',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur !',
                            text: xhr.responseJSON?.message || 'Une erreur est survenue'
                        });
                    }
                });
            }
        });
    }

    function toggleFeatured() {
        Swal.fire({
            title: '{{ $partner->featured ? 'Retirer des vedettes' : 'Mettre en vedette' }} ?',
            text: "{{ $partner->featured ? 'Ce partenaire ne sera plus mis en avant' : 'Ce partenaire sera mis en avant sur le site' }}",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '{{ $partner->featured ? 'Oui, retirer' : 'Oui, mettre en vedette' }}',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Soumettre le formulaire de changement de vedette
                $.ajax({
                    url: '{{ route("partners.toggle-featured", $partner) }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Traitement en cours...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Succès !',
                            text: response.message || 'Statut vedette modifié',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur !',
                            text: xhr.responseJSON?.message || 'Une erreur est survenue'
                        });
                    }
                });
            }
        });
    }

    function confirmDelete() {
        $('#deleteModal').modal('show');
    }

    // Soumission du formulaire de suppression
    $('#deleteForm').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Dernière confirmation',
            text: "Êtes-vous absolument sûr ? Cette action ne peut pas être annulée.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer définitivement',
            cancelButtonText: 'Annuler',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Afficher l'animation de chargement
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Suppression...');

                // Soumettre le formulaire
                this.submit();
            }
        });
    });

    // Export des données
    function exportData(format) {
        Swal.fire({
            title: `Exporter en ${format.toUpperCase()} ?`,
            text: 'Génération du fichier en cours...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        window.location.href = `{{ route('partners.export', $partner) }}?format=${format}`;

        setTimeout(() => {
            Swal.close();
        }, 3000);
    }

    // Notifications
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Succès !',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif

    @if(session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Attention !',
            text: '{{ session('warning') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif
</script>
@stop
