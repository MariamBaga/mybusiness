@extends('adminlte::page')

@section('title', 'Nouveau Tag')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>
        <i class="fas fa-plus-circle text-success mr-2"></i>
        Créer un nouveau tag
    </h1>
    <a href="{{ route('tags.index') }}" class="btn btn-outline-secondary">
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
            <a href="{{ route('tags.index') }}">
                <i class="fas fa-hashtag"></i> Tags
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <i class="fas fa-plus-circle"></i> Nouveau tag
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
                    <i class="fas fa-hashtag mr-2"></i>
                    Nouveau tag
                </h3>
                <div class="card-tools">
                    <span class="badge badge-light">
                        <i class="fas fa-plus"></i> Nouveau
                    </span>
                </div>
            </div>

            <form action="{{ route('tags.store') }}" method="POST" id="createTagForm">
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
                            <i class="fas fa-tag text-success mr-1"></i>
                            Nom du tag
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-hashtag"></i>
                                </span>
                            </div>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}"
                                   required
                                   maxlength="30"
                                   placeholder="Ex: Laravel, Vue.js, Design"
                                   autofocus>
                            @error('name')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>
                        <small class="form-text text-muted">
                            Maximum 30 caractères, pas d'espaces spéciaux.
                            <span class="float-right" id="nameCounter">0/30</span>
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="color" class="font-weight-bold">
                            <i class="fas fa-palette text-success mr-1"></i>
                            Couleur du tag
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
                                   value="{{ old('color', '#fd7e14') }}"
                                   title="Choisir une couleur">
                            @error('color')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>
                        <small class="form-text text-muted">
                            Format hexadécimal (ex: #fd7e14). Utilisée pour les badges.
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
                                  maxlength="150"
                                  placeholder="Brève description du tag (optionnel)...">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </div>
                        @enderror
                        <small class="form-text text-muted">
                            Optionnel. Maximum 150 caractères.
                            <span class="float-right" id="descriptionCounter">0/150</span>
                        </small>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <h6 class="alert-heading">
                                    <i class="fas fa-lightbulb mr-2"></i>
                                    Bonnes pratiques pour les tags
                                </h6>
                                <ul class="mb-0">
                                    <li>Utilisez des noms courts et évocateurs</li>
                                    <li>Évitez les doublons et les synonymes</li>
                                    <li>Maximum 2-3 mots par tag</li>
                                    <li>Utilisez des couleurs distinctives</li>
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
                            <a href="{{ route('tags.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times mr-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-success" id="submitBtn">
                                <i class="fas fa-plus-circle mr-1"></i> Créer le tag
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
            $('#nameCounter').text(length + '/30');

            if (length > 25) {
                $('#nameCounter').addClass('text-warning');
            } else {
                $('#nameCounter').removeClass('text-warning');
            }
        });

        // Compteur de caractères pour la description
        $('#description').on('input', function() {
            const length = $(this).val().length;
            $('#descriptionCounter').text(length + '/150');

            if (length > 130) {
                $('#descriptionCounter').addClass('text-warning');
            } else {
                $('#descriptionCounter').removeClass('text-warning');
            }
        });

        // Validation du formulaire
        $('#createTagForm').on('submit', function(e) {
            const name = $('#name').val().trim();

            if (!name) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Nom requis',
                    text: 'Veuillez saisir un nom pour le tag',
                    confirmButtonColor: '#dc3545'
                });
                $('#name').focus();
                return false;
            }

            if (name.length > 30) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Nom trop long',
                    text: 'Le nom ne doit pas dépasser 30 caractères',
                    confirmButtonColor: '#dc3545'
                });
                $('#name').focus();
                return false;
            }

            // Confirmation
            Swal.fire({
                title: 'Créer ce tag ?',
                html: `
                    <div class="text-left">
                        <p><strong>Nom :</strong> ${name}</p>
                        <p><strong>Couleur :</strong> <span style="color:${$('#color').val()}">${$('#color').val()}</span></p>
                        <p class="text-muted"><small>Le tag sera immédiatement disponible pour les articles.</small></p>
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
                $('#createTagForm')[0].reset();
                $('#color').val('#fd7e14');
                $('#nameCounter').text('0/30');
                $('#descriptionCounter').text('0/150');
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
