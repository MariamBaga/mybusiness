@extends('adminlte::page')

@section('title', 'Nouvelle Catégorie')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>
        <i class="fas fa-plus-circle text-success mr-2"></i>
        Créer une nouvelle catégorie
    </h1>
    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
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
            <a href="{{ route('categories.index') }}">
                <i class="fas fa-tags"></i> Catégories
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <i class="fas fa-plus-circle"></i> Nouvelle catégorie
        </li>
    </ol>
</nav>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-tag mr-2"></i>
                    Nouvelle catégorie
                </h3>
                <div class="card-tools">
                    <span class="badge badge-light">
                        <i class="fas fa-plus"></i> Nouveau
                    </span>
                </div>
            </div>

            <form action="{{ route('categories.store') }}" method="POST" id="createCategoryForm">
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

                    <div class="form-group">
                        <label for="name" class="font-weight-bold">
                            <i class="fas fa-signature text-success mr-1"></i>
                            Nom de la catégorie
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-tag"></i>
                                </span>
                            </div>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}"
                                   required
                                   maxlength="50"
                                   placeholder="Ex: Technologies, Design, Marketing"
                                   autofocus>
                            @error('name')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>
                        <small class="form-text text-muted">
                            Maximum 50 caractères. Soyez concis et clair.
                            <span class="float-right" id="nameCounter">0/50</span>
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="color" class="font-weight-bold">
                            <i class="fas fa-palette text-success mr-1"></i>
                            Couleur de la catégorie
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-fill-drip"></i>
                                </span>
                            </div>
                            <input type="color"
                                   name="color"
                                   id="color"
                                   class="form-control form-control-color @error('color') is-invalid @enderror"
                                   value="{{ old('color', '#6f42c1') }}"
                                   title="Choisir une couleur">
                            @error('color')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>
                        <small class="form-text text-muted">
                            Utilisée pour les badges et l'identification visuelle
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="description" class="font-weight-bold">
                            <i class="fas fa-align-left text-success mr-1"></i>
                            Description
                        </label>
                        <textarea name="description"
                                  id="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="3"
                                  maxlength="200"
                                  placeholder="Brève description de la catégorie...">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </div>
                        @enderror
                        <small class="form-text text-muted">
                            Optionnel. Maximum 200 caractères.
                            <span class="float-right" id="descriptionCounter">0/200</span>
                        </small>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <h6 class="alert-heading">
                                    <i class="fas fa-lightbulb mr-2"></i>
                                    Bonnes pratiques pour les catégories
                                </h6>
                                <ul class="mb-0">
                                    <li>Utilisez des noms simples et évocateurs</li>
                                    <li>Évitez les doublons et les synonymes</li>
                                    <li>Limitez le nombre de catégories principales</li>
                                    <li>Une catégorie = un thème précis</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                            <i class="fas fa-redo mr-1"></i> Réinitialiser
                        </button>

                        <div>
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times mr-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-success" id="submitBtn">
                                <i class="fas fa-plus-circle mr-1"></i> Créer la catégorie
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

    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40,167,69,.25);
    }

    .form-control-color {
        height: calc(1.5em + 0.75rem + 2px);
        width: 100%;
        cursor: pointer;
    }

    .input-group-text {
        border-right: none;
        transition: all 0.3s;
    }

    .input-group .form-control {
        border-left: none;
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
        // Compteur de caractères pour le nom
        $('#name').on('input', function() {
            const length = $(this).val().length;
            $('#nameCounter').text(length + '/50');

            if (length > 40) {
                $('#nameCounter').addClass('text-warning');
            } else {
                $('#nameCounter').removeClass('text-warning');
            }
        });

        // Compteur de caractères pour la description
        $('#description').on('input', function() {
            const length = $(this).val().length;
            $('#descriptionCounter').text(length + '/200');

            if (length > 180) {
                $('#descriptionCounter').addClass('text-warning');
            } else {
                $('#descriptionCounter').removeClass('text-warning');
            }
        });

        // Validation du formulaire
        $('#createCategoryForm').on('submit', function(e) {
            const name = $('#name').val().trim();

            if (!name) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Nom requis',
                    text: 'Veuillez saisir un nom pour la catégorie',
                    confirmButtonColor: '#dc3545'
                });
                $('#name').focus();
                return false;
            }

            if (name.length > 50) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Nom trop long',
                    text: 'Le nom ne doit pas dépasser 50 caractères',
                    confirmButtonColor: '#dc3545'
                });
                $('#name').focus();
                return false;
            }

            // Confirmation
            Swal.fire({
                title: 'Créer cette catégorie ?',
                html: `
                    <div class="text-left">
                        <p><strong>Nom :</strong> ${name}</p>
                        <p><strong>Couleur :</strong> <span style="color:${$('#color').val()}">${$('#color').val()}</span></p>
                        <p class="text-muted"><small>La catégorie sera immédiatement disponible pour les articles et produits.</small></p>
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
                    // Show loading state
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

        // Initialiser les compteurs
        $('#name').trigger('input');
        $('#description').trigger('input');
    });

    function resetForm() {
        Swal.fire({
            title: 'Réinitialiser le formulaire ?',
            text: "Tous les champs seront vidés",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6c757d',
            cancelButtonColor: '#28a745',
            confirmButtonText: '<i class="fas fa-redo mr-1"></i> Réinitialiser',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#createCategoryForm')[0].reset();
                $('#color').val('#6f42c1');
                $('#nameCounter').text('0/50');
                $('#descriptionCounter').text('0/200');
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
