@extends('adminlte::page')

@section('title', 'Modifier Tag')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>
        <i class="fas fa-edit text-primary mr-2"></i>
        Modifier le tag
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
            <i class="fas fa-edit"></i> Modifier "{{ Str::limit($tag->name, 20) }}"
        </li>
    </ol>
</nav>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-hashtag mr-2"></i>
                    Modifier le tag
                </h3>
                <div class="card-tools">
                    <span class="badge badge-light">
                        ID: {{ $tag->id }}
                    </span>
                </div>
            </div>

            <form action="{{ route('tags.update', $tag) }}" method="POST" id="editTagForm">
                @csrf
                @method('PUT')

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

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="name" class="font-weight-bold">
                            <i class="fas fa-tag text-primary mr-1"></i>
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
                                   value="{{ old('name', $tag->name) }}"
                                   required
                                   maxlength="30"
                                   placeholder="Ex: Laravel, Vue.js, Design">
                            @error('name')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>
                        <small class="form-text text-muted">
                            Maximum 30 caractères
                            <span class="float-right" id="nameCounter">{{ strlen(old('name', $tag->name)) }}/30</span>
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="color" class="font-weight-bold">
                            <i class="fas fa-palette text-primary mr-1"></i>
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
                                   value="{{ old('color', $tag->color ?? '#fd7e14') }}"
                                   title="Choisir une couleur">
                            @error('color')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>
                        <small class="form-text text-muted">
                            Aperçu : <span class="badge" style="background-color: {{ old('color', $tag->color ?? '#fd7e14') }}; color: white;">Exemple</span>
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="description" class="font-weight-bold">
                            <i class="fas fa-align-left text-primary mr-1"></i>
                            Description
                        </label>
                        <textarea name="description"
                                  id="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="3"
                                  maxlength="150"
                                  placeholder="Brève description du tag (optionnel)...">{{ old('description', $tag->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </div>
                        @enderror
                        <small class="form-text text-muted">
                            Optionnel. Maximum 150 caractères.
                            <span class="float-right" id="descriptionCounter">{{ strlen(old('description', $tag->description ?? '')) }}/150</span>
                        </small>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <i class="fas fa-info-circle text-primary mr-1"></i>
                                    Informations
                                </label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-2">
                                        <small class="text-muted">Slug :</small>
                                        <br>
                                        <code>{{ $tag->slug }}</code>
                                    </p>
                                    <p class="mb-2">
                                        <small class="text-muted">Créé le :</small>
                                        <br>
                                        <strong>{{ $tag->created_at->format('d/m/Y à H:i') }}</strong>
                                    </p>
                                    <p class="mb-2">
                                        <small class="text-muted">Dernière modification :</small>
                                        <br>
                                        <strong>{{ $tag->updated_at->format('d/m/Y à H:i') }}</strong>
                                    </p>
                                    <p class="mb-0">
                                        <small class="text-muted">Utilisation :</small>
                                        <br>
                                        <span class="badge badge-info">
                                            <i class="fas fa-file-alt mr-1"></i>
                                            {{ $tag->posts_count ?? 0 }} articles
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    Attention
                                </h6>
                                <p class="mb-0">
                                    La modification du nom d'un tag affectera tous les articles qui l'utilisent.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-danger" onclick="resetForm()">
                            <i class="fas fa-undo mr-1"></i> Réinitialiser
                        </button>

                        <div>
                            <a href="{{ route('tags.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times mr-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save mr-1"></i> Mettre à jour
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
        border-top: 3px solid #007bff;
    }

    .card-header {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border-bottom: 2px solid #dee2e6;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
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
        color: #007bff;
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

        // Mettre à jour l'aperçu de la couleur
        $('#color').on('input', function() {
            $('.badge[style*="background-color"]').css('background-color', $(this).val());
        });

        // Validation du formulaire
        $('#editTagForm').on('submit', function(e) {
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

            // Show loading state
            const submitBtn = $('#submitBtn');
            const originalText = submitBtn.html();
            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Mise à jour...');

            // Réactiver après 10 secondes maximum
            setTimeout(function() {
                submitBtn.prop('disabled', false).html(originalText);
            }, 10000);
        });

        // Auto-focus sur le premier champ avec erreur
        @if($errors->any())
            $('.is-invalid').first().focus();
        @endif

        // Initialiser les compteurs
        $('#name').trigger('input');
        $('#description').trigger('input');
    });

    function resetForm() {
        Swal.fire({
            title: 'Réinitialiser le formulaire ?',
            text: "Toutes les modifications seront perdues",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#007bff',
            confirmButtonText: 'Oui, réinitialiser',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Réinitialiser aux valeurs originales
                $('#name').val("{{ old('name', $tag->name) }}");
                $('#color').val("{{ old('color', $tag->color ?? '#fd7e14') }}");
                $('#description').val("{{ old('description', $tag->description) }}");

                // Mettre à jour les compteurs
                $('#name').trigger('input');
                $('#description').trigger('input');

                // Focus sur le premier champ
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
