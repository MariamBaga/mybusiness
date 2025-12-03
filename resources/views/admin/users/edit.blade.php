@extends('adminlte::page')

@section('title', 'Modifier l\'Utilisateur')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-user-edit text-primary mr-2"></i>
            Modifier l'utilisateur
        </h1>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
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
                <a href="{{ route('users.index') }}">
                    <i class="fas fa-users"></i> Utilisateurs
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-edit"></i> Modifier {{ $user->name }}
            </li>
        </ol>
    </nav>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-circle mr-2"></i>
                    Informations de l'utilisateur
                </h3>
                <div class="card-tools">
                    <span class="badge badge-light">
                        ID: {{ $user->id }}
                    </span>
                </div>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="POST" id="editUserForm">
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">
                                    <i class="fas fa-user text-primary mr-1"></i>
                                    Nom complet
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                    </div>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', $user->name) }}"
                                           required
                                           placeholder="Entrez le nom complet">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Le nom complet de l'utilisateur
                                </small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="font-weight-bold">
                                    <i class="fas fa-envelope text-primary mr-1"></i>
                                    Adresse email
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-at"></i>
                                        </span>
                                    </div>
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email', $user->email) }}"
                                           required
                                           placeholder="exemple@domain.com">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    L'adresse email utilisée pour la connexion
                                </small>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <h6 class="alert-heading">
                                    <i class="fas fa-key mr-2"></i>
                                    Modification du mot de passe
                                </h6>
                                <p class="mb-0">
                                    Remplissez ces champs uniquement si vous souhaitez modifier le mot de passe.
                                    Laissez-les vides pour conserver le mot de passe actuel.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="font-weight-bold">
                                    <i class="fas fa-lock text-primary mr-1"></i>
                                    Nouveau mot de passe
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="********"
                                           autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Minimum 8 caractères
                                </small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation" class="font-weight-bold">
                                    <i class="fas fa-lock text-primary mr-1"></i>
                                    Confirmation du mot de passe
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <input type="password"
                                           name="password_confirmation"
                                           id="password_confirmation"
                                           class="form-control"
                                           placeholder="********"
                                           autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <small class="form-text text-muted">
                                    Confirmez le nouveau mot de passe
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password_strength" class="font-weight-bold">
                                    Force du mot de passe
                                </label>
                                <div class="progress" style="height: 10px;">
                                    <div id="passwordStrengthBar"
                                         class="progress-bar"
                                         role="progressbar"
                                         style="width: 0%">
                                    </div>
                                </div>
                                <small id="passwordStrengthText" class="form-text"></small>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="font-weight-bold">
                <i class="fas fa-user-tag text-primary mr-1"></i>
                Rôles de l'utilisateur
            </label>

            @if($errors->has('roles'))
                <div class="alert alert-danger p-2 mb-2">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $errors->first('roles') }}
                </div>
            @endif

            <div class="row">
                @foreach($roles as $role)
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   id="role_{{ $role->id }}"
                                   name="roles[]"
                                   value="{{ $role->name }}"
                                   @if(in_array($role->name, old('roles', $userRoles))) checked @endif
                                   @if($role->name === 'super-admin' && !auth()->user()->hasRole('super-admin')) disabled @endif>
                            <label class="custom-control-label" for="role_{{ $role->id }}">
                                <span class="badge badge-{{ $role->name === 'admin' ? 'danger' : ($role->name === 'super-admin' ? 'dark' : 'info') }} font-weight-normal">
                                    {{ $role->name }}
                                </span>
                                @if($role->name === 'super-admin')
                                    <small class="text-muted ml-1">
                                        <i class="fas fa-crown"></i>
                                    </small>
                                @endif
                            </label>
                        </div>
                        @if($role->name === 'super-admin')
                            <small class="form-text text-muted">
                                Accessible uniquement aux super-admins
                            </small>
                        @endif
                    </div>
                @endforeach
            </div>

            @if($roles->isEmpty())
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Aucun rôle n'a été créé.
                    <a href="{{ route('roles.create') }}" class="alert-link">
                        Créer des rôles
                    </a>
                </div>
            @endif

            <small class="form-text text-muted mt-2">
                <i class="fas fa-info-circle mr-1"></i>
                Sélectionnez les rôles à attribuer à cet utilisateur
            </small>
        </div>
    </div>
</div>
<hr class="my-4">
                  <div class="row mt-4">
    <div class="col-md-6">
        <div class="form-group">
            <label class="font-weight-bold">
                <i class="fas fa-calendar text-primary mr-1"></i>
                Dates importantes
            </label>
            <div class="p-3 bg-light rounded">
                <p class="mb-1">
                    <small class="text-muted">Créé le :</small>
                    <strong>
                        @php
                            // Formatage compatible toutes bases
                            $createdAt = $user->created_at;
                            if ($createdAt instanceof \Carbon\Carbon) {
                                echo $createdAt->format('d/m/Y H:i');
                            } else {
                                echo date('d/m/Y H:i', strtotime($createdAt));
                            }
                        @endphp
                    </strong>
                </p>
                <p class="mb-0">
                    <small class="text-muted">Dernière mise à jour :</small>
                    <strong>
                        @php
                            // Formatage compatible toutes bases
                            $updatedAt = $user->updated_at;
                            if ($updatedAt instanceof \Carbon\Carbon) {
                                echo $updatedAt->format('d/m/Y H:i');
                            } else {
                                echo date('d/m/Y H:i', strtotime($updatedAt));
                            }
                        @endphp
                    </strong>
                </p>
            </div>
        </div>
    </div>
</div>
                </div>

                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#resetFormModal">
                            <i class="fas fa-undo mr-1"></i> Réinitialiser
                        </button>

                        <div>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary mr-2">
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

    <!-- Modal pour réinitialiser le formulaire -->
    <div class="modal fade" id="resetFormModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Réinitialiser le formulaire
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir réinitialiser tous les champs du formulaire ?</p>
                    <p class="text-danger mb-0">
                        <small>
                            <i class="fas fa-info-circle mr-1"></i>
                            Cette action annulera toutes vos modifications non enregistrées.
                        </small>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Annuler
                    </button>
                    <button type="button" class="btn btn-warning" onclick="resetForm()">
                        <i class="fas fa-undo mr-1"></i> Réinitialiser
                    </button>
                </div>
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
        border-top: 3px solid #007bff;
    }

    .card-header {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border-bottom: 2px solid #dee2e6;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    .input-group-text {
        border-right: none;
        transition: all 0.3s;
    }

    .input-group .form-control {
        border-left: none;
    }

    .input-group .form-control:focus + .input-group-append .input-group-text,
    .input-group .form-control:focus ~ .input-group-prepend .input-group-text {
        border-color: #80bdff;
    }

    .breadcrumb {
        background-color: transparent;
        padding-left: 0;
    }

    .breadcrumb-item.active {
        color: #007bff;
        font-weight: 500;
    }

    .progress {
        border-radius: 5px;
        background-color: #e9ecef;
    }

    .progress-bar {
        transition: width 0.5s ease;
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
        // Toggle password visibility
        $('#togglePassword').click(function() {
            const passwordField = $('#password');
            const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
            $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        });

        $('#togglePasswordConfirmation').click(function() {
            const passwordField = $('#password_confirmation');
            const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
            $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        });

        // Password strength indicator
        $('#password').on('input', function() {
            const password = $(this).val();
            const strengthBar = $('#passwordStrengthBar');
            const strengthText = $('#passwordStrengthText');

            let strength = 0;
            let text = '';
            let color = '';

            if (password.length === 0) {
                strength = 0;
                text = '';
                color = '';
            } else if (password.length < 4) {
                strength = 25;
                text = 'Très faible';
                color = 'bg-danger';
            } else if (password.length < 8) {
                strength = 50;
                text = 'Faible';
                color = 'bg-warning';
            } else {
                // Check for complexity
                const hasUpper = /[A-Z]/.test(password);
                const hasLower = /[a-z]/.test(password);
                const hasNumbers = /\d/.test(password);
                const hasSpecial = /[^A-Za-z0-9]/.test(password);

                let complexity = 0;
                if (hasUpper) complexity++;
                if (hasLower) complexity++;
                if (hasNumbers) complexity++;
                if (hasSpecial) complexity++;

                if (complexity === 4) {
                    strength = 100;
                    text = 'Très fort';
                    color = 'bg-success';
                } else if (complexity >= 3) {
                    strength = 75;
                    text = 'Fort';
                    color = 'bg-info';
                } else {
                    strength = 50;
                    text = 'Moyen';
                    color = 'bg-warning';
                }
            }

            strengthBar.css('width', strength + '%').removeClass().addClass('progress-bar ' + color);
            strengthText.text(text).removeClass().addClass('form-text ' + (color ? 'text-' + color.split('-')[1] : ''));
        });

        // Form submission with confirmation
        $('#editUserForm').on('submit', function(e) {
            const password = $('#password').val();
            const confirmPassword = $('#password_confirmation').val();

            if (password && password !== confirmPassword) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Les mots de passe ne correspondent pas',
                    confirmButtonColor: '#dc3545'
                });
                return false;
            }

            // Validation de base pour les champs requis
            const name = $('#name').val().trim();
            const email = $('#email').val().trim();

            if (!name) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Champ requis',
                    text: 'Le nom est obligatoire',
                    confirmButtonColor: '#dc3545'
                });
                $('#name').focus();
                return false;
            }

            if (!email) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Champ requis',
                    text: 'L\'email est obligatoire',
                    confirmButtonColor: '#dc3545'
                });
                $('#email').focus();
                return false;
            }

            // Validation basique d'email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Email invalide',
                    text: 'Veuillez entrer une adresse email valide',
                    confirmButtonColor: '#dc3545'
                });
                $('#email').focus();
                return false;
            }

            // Show loading state
            const submitBtn = $('#submitBtn');
            const originalText = submitBtn.html();
            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Mise à jour...');

            // Réactiver le bouton après 10 secondes maximum (sécurité)
            setTimeout(function() {
                submitBtn.prop('disabled', false).html(originalText);
            }, 10000);
        });

        // Auto-focus on first field with error
        @if($errors->any())
            $('.is-invalid').first().focus();
        @endif

        // Gestion des caractères spéciaux dans les noms
        $('#name').on('input', function() {
            // Autoriser les lettres, espaces, apostrophes et tirets
            this.value = this.value.replace(/[^a-zA-ZÀ-ÿ\s'-]/g, '');
        });
    });


      // Vérification des rôles super-admin
    $(document).ready(function() {
        @if(!auth()->user()->hasRole('super-admin'))
            // Désactiver la case super-admin si l'utilisateur n'est pas super-admin
            $('input[value="super-admin"]').prop('disabled', true);

            // Avertissement si on essaie de cocher un rôle désactivé
            $('input[type="checkbox"][disabled]').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Permission insuffisante',
                    text: 'Vous n\'avez pas les permissions nécessaires pour attribuer le rôle super-admin',
                    confirmButtonColor: '#007bff'
                });
            });
        @endif

        // Empêcher de décocher tous les rôles
        $('#editUserForm').on('submit', function(e) {
            const checkedRoles = $('input[name="roles[]"]:checked').length;
            if (checkedRoles === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Aucun rôle sélectionné',
                    text: 'Veuillez sélectionner au moins un rôle pour cet utilisateur',
                    confirmButtonColor: '#007bff'
                });
            }
        });
    });

    function resetForm() {
        $('#resetFormModal').modal('hide');

        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Toutes les modifications seront perdues",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, réinitialiser',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Réinitialiser aux valeurs d'origine
                $('#name').val("{{ old('name', $user->name) }}");
                $('#email').val("{{ old('email', $user->email) }}");
                $('#password').val('');
                $('#password_confirmation').val('');
                $('#passwordStrengthBar').css('width', '0%').removeClass().addClass('progress-bar');
                $('#passwordStrengthText').text('');
                $('#name').focus();

                Swal.fire({
                    icon: 'success',
                    title: 'Réinitialisé !',
                    text: 'Le formulaire a été réinitialisé',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
           // Réinitialiser aussi les rôles
        @foreach($roles as $role)
            $('#role_{{ $role->id }}').prop('checked', {{ in_array($role->name, $userRoles) ? 'true' : 'false' }});
        @endforeach
    }

    // Gestion des erreurs serveur
    @if($errors->any())
        $(document).ready(function() {
            const errors = {!! json_encode($errors->all()) !!};
            if (errors.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreurs de validation',
                    html: '<ul class="text-left">' +
                          errors.map(error => `<li>${error}</li>`).join('') +
                          '</ul>',
                    confirmButtonColor: '#dc3545'
                });
            }
        });
    @endif
</script>
@stop
