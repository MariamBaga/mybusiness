@extends('adminlte::page')

@section('title', 'Nouvel Utilisateur')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>
            <i class="fas fa-user-plus text-success mr-2"></i>
            Créer un nouvel utilisateur
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
                <i class="fas fa-user-plus"></i> Nouvel utilisateur
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
                    <i class="fas fa-user-circle mr-2"></i>
                    Informations du nouvel utilisateur
                </h3>
                <div class="card-tools">
                    <span class="badge badge-light">
                        <i class="fas fa-database"></i>
                        {{-- Indicateur du SGBD --}}
                        @php
                            $connection = config('database.default');
                            $driver = config("database.connections.{$connection}.driver");
                            $drivers = [
                                'mysql' => 'MySQL',
                                'sqlite' => 'SQLite',
                                'pgsql' => 'PostgreSQL',
                                'sqlsrv' => 'SQL Server'
                            ];
                            echo $drivers[$driver] ?? $driver;
                        @endphp
                    </span>
                </div>
            </div>

            <form action="{{ route('users.store') }}" method="POST" id="createUserForm" autocomplete="off">
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">
                                    <i class="fas fa-user text-success mr-1"></i>
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
                                           value="{{ old('name') }}"
                                           required
                                           maxlength="255"
                                           placeholder="Entrez le nom complet"
                                           autofocus>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Le nom complet de l'utilisateur (max 255 caractères)
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email" class="font-weight-bold">
                                    <i class="fas fa-envelope text-success mr-1"></i>
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
                                           value="{{ old('email') }}"
                                           required
                                           maxlength="255"
                                           placeholder="exemple@domain.com"
                                           autocomplete="new-email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    L'adresse email utilisée pour la connexion (max 255 caractères)
                                </small>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <h6 class="alert-heading">
                                    <i class="fas fa-shield-alt mr-2"></i>
                                    Sécurité du mot de passe
                                </h6>
                                <p class="mb-0">
                                    Le mot de passe doit contenir au minimum 8 caractères avec une combinaison de lettres, chiffres et caractères spéciaux.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="font-weight-bold">
                                    <i class="fas fa-lock text-success mr-1"></i>
                                    Mot de passe
                                    <span class="text-danger">*</span>
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
                                           required
                                           minlength="8"
                                           maxlength="255"
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
                                    <i class="fas fa-lock text-success mr-1"></i>
                                    Confirmation
                                    <span class="text-danger">*</span>
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
                                           class="form-control @error('password') is-invalid @enderror"
                                           required
                                           minlength="8"
                                           maxlength="255"
                                           placeholder="********"
                                           autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <small class="form-text text-muted">
                                    Confirmez le mot de passe
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
                <i class="fas fa-user-tag text-success mr-1"></i>
                Attribuer des rôles
                <span class="text-danger">*</span>
            </label>

            @if($errors->has('roles'))
                <div class="alert alert-danger p-2 mb-2">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $errors->first('roles') }}
                </div>
            @endif

            <div class="row">
                @foreach($roles as $role)
                    <div class="col-md-4 mb-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   id="role_{{ $role->id }}"
                                   name="roles[]"
                                   value="{{ $role->name }}"
                                   @if(in_array($role->name, old('roles', []))) checked @endif
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
            @else
                <small class="form-text text-muted mt-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    Sélectionnez au moins un rôle pour cet utilisateur
                </small>
            @endif
        </div>
    </div>
</div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <i class="fas fa-info-circle text-success mr-1"></i>
                                    Exigences du mot de passe
                                </label>
                                <div class="p-3 bg-light rounded">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1">
                                                <i class="fas fa-check-circle text-success mr-2" id="lengthCheck"></i>
                                                <span id="lengthText">Minimum 8 caractères</span>
                                            </p>
                                            <p class="mb-1">
                                                <i class="fas fa-check-circle text-success mr-2" id="upperCheck"></i>
                                                <span id="upperText">Une lettre majuscule</span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1">
                                                <i class="fas fa-check-circle text-success mr-2" id="numberCheck"></i>
                                                <span id="numberText">Un chiffre</span>
                                            </p>
                                            <p class="mb-1">
                                                <i class="fas fa-check-circle text-success mr-2" id="specialCheck"></i>
                                                <span id="specialText">Un caractère spécial</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">
                                    <i class="fas fa-database text-success mr-1"></i>
                                    Compatibilité base de données
                                </label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-2">
                                        <small class="text-muted">Configuration actuelle :</small>
                                        <strong>{{ $drivers[$driver] ?? $driver }}</strong>
                                    </p>
                                    <p class="mb-0 small text-muted">
                                        <i class="fas fa-check text-success mr-1"></i>
                                        Ce formulaire est compatible avec MySQL, SQLite et PostgreSQL
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                            <i class="fas fa-undo mr-1"></i> Réinitialiser
                        </button>

                        <div>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times mr-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-success" id="submitBtn">
                                <i class="fas fa-user-plus mr-1"></i> Créer l'utilisateur
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

    .input-group-text {
        border-right: none;
        transition: all 0.3s;
    }

    .input-group .form-control {
        border-left: none;
    }

    .input-group .form-control:focus + .input-group-append .input-group-text,
    .input-group .form-control:focus ~ .input-group-prepend .input-group-text {
        border-color: #28a745;
    }

    .breadcrumb {
        background-color: transparent;
        padding-left: 0;
    }

    .breadcrumb-item.active {
        color: #28a745;
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

    .requirement-check {
        transition: all 0.3s;
    }

    .requirement-check.valid {
        color: #28a745;
    }

    .requirement-check.invalid {
        color: #dc3545;
    }
     .has-error {
        border: 1px solid #dc3545;
        border-radius: 5px;
        padding: 10px;
        background-color: rgba(220, 53, 69, 0.05);
    }

    .custom-control-input:checked ~ .custom-control-label .badge {
        border: 2px solid #28a745;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Configuration compatible
        const Config = {
            minPasswordLength: 8,
            maxPasswordLength: 255,
            maxNameLength: 255,
            maxEmailLength: 255
        };

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
        function updatePasswordStrength(password) {
            const $bar = $('#passwordStrengthBar');
            const $text = $('#passwordStrengthText');

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
            } else if (password.length < Config.minPasswordLength) {
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

            $bar.css('width', strength + '%').removeClass().addClass('progress-bar ' + color);
            $text.text(text).removeClass().addClass('form-text ' + (color ? 'text-' + color.split('-')[1] : ''));

            // Update requirement checks
            updateRequirementChecks(password);
        }

        // Update requirement checks
        function updateRequirementChecks(password) {
            const checks = {
                length: password.length >= Config.minPasswordLength,
                upper: /[A-Z]/.test(password),
                lower: /[a-z]/.test(password),
                number: /\d/.test(password),
                special: /[^A-Za-z0-9]/.test(password)
            };

            // Update each check
            Object.keys(checks).forEach(key => {
                const $icon = $(`#${key}Check`);
                const $text = $(`#${key}Text`);

                if (checks[key]) {
                    $icon.removeClass('fa-times-circle text-danger')
                         .addClass('fa-check-circle text-success');
                    $text.css('color', '#28a745');
                } else {
                    $icon.removeClass('fa-check-circle text-success')
                         .addClass('fa-times-circle text-danger');
                    $text.css('color', '#dc3545');
                }
            });
        }

        // Live password strength update
        $('#password').on('input', function() {
            const password = $(this).val();
            updatePasswordStrength(password);
        });

        // Form validation
        function validateForm() {
            let isValid = true;
            const errors = [];

            // Validate name
            const name = $('#name').val().trim();
            if (!name) {
                errors.push('Le nom est requis');
                $('#name').addClass('is-invalid');
                isValid = false;
            } else if (name.length > Config.maxNameLength) {
                errors.push(`Le nom ne peut pas dépasser ${Config.maxNameLength} caractères`);
                $('#name').addClass('is-invalid');
                isValid = false;
            } else {
                $('#name').removeClass('is-invalid');
            }

            // Validate email
            const email = $('#email').val().trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email) {
                errors.push('L\'email est requis');
                $('#email').addClass('is-invalid');
                isValid = false;
            } else if (!emailRegex.test(email)) {
                errors.push('Format d\'email invalide');
                $('#email').addClass('is-invalid');
                isValid = false;
            } else if (email.length > Config.maxEmailLength) {
                errors.push(`L'email ne peut pas dépasser ${Config.maxEmailLength} caractères`);
                $('#email').addClass('is-invalid');
                isValid = false;
            } else {
                $('#email').removeClass('is-invalid');
            }

            // Validate password
            const password = $('#password').val();
            const confirmPassword = $('#password_confirmation').val();

            if (!password) {
                errors.push('Le mot de passe est requis');
                $('#password').addClass('is-invalid');
                isValid = false;
            } else if (password.length < Config.minPasswordLength) {
                errors.push(`Le mot de passe doit contenir au moins ${Config.minPasswordLength} caractères`);
                $('#password').addClass('is-invalid');
                isValid = false;
            } else if (password.length > Config.maxPasswordLength) {
                errors.push(`Le mot de passe ne peut pas dépasser ${Config.maxPasswordLength} caractères`);
                $('#password').addClass('is-invalid');
                isValid = false;
            } else {
                $('#password').removeClass('is-invalid');
            }

            // Validate password confirmation
            if (password !== confirmPassword) {
                errors.push('Les mots de passe ne correspondent pas');
                $('#password_confirmation').addClass('is-invalid');
                isValid = false;
            } else {
                $('#password_confirmation').removeClass('is-invalid');
            }



               // Validate roles
        const checkedRoles = $('input[name="roles[]"]:checked').length;
        if (checkedRoles === 0) {
            errors.push('Veuillez sélectionner au moins un rôle');
            $('.form-group:has(input[name="roles[]"])').addClass('has-error');
            isValid = false;
        } else {
            $('.form-group:has(input[name="roles[]"])').removeClass('has-error');
        }

        return { isValid, errors };
        }

        // Form submission with validation
        $('#createUserForm').on('submit', function(e) {
            e.preventDefault();

            const validation = validateForm();

            if (!validation.isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreurs de validation',
                    html: '<ul class="text-left">' +
                          validation.errors.map(error => `<li>${error}</li>`).join('') +
                          '</ul>',
                    confirmButtonColor: '#dc3545'
                });
                return false;
            }

            // Show confirmation
            Swal.fire({
                title: 'Créer cet utilisateur ?',
                html: `
                    <div class="text-left">
                        <p><strong>Nom :</strong> ${$('#name').val()}</p>
                        <p><strong>Email :</strong> ${$('#email').val()}</p>
                        <p class="text-muted"><small>L'utilisateur pourra se connecter immédiatement après la création.</small></p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-user-plus mr-1"></i> Oui, créer',
                cancelButtonText: '<i class="fas fa-times mr-1"></i> Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    const submitBtn = $('#submitBtn');
                    const originalText = submitBtn.html();
                    submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Création...');

                    // Submit the form
                    $(this).off('submit').submit();
                }
            });
        });

        // Real-time validation
        $('#name, #email, #password, #password_confirmation').on('blur', function() {
            validateForm();
        });

        // Auto-focus on first field with error
        @if($errors->any())
            $('.is-invalid').first().focus();
        @endif

        // Character counter for inputs
        $('input[maxlength]').on('input', function() {
            const max = parseInt($(this).attr('maxlength'));
            const current = $(this).val().length;
            const $counter = $(this).parent().next('.char-counter');

            if ($counter.length === 0) {
                $(this).parent().after(`<small class="form-text text-muted char-counter">${current}/${max}</small>`);
            } else {
                $counter.text(`${current}/${max}`);
            }

            if (current > max * 0.9) {
                $counter.addClass('text-warning');
            } else {
                $counter.removeClass('text-warning');
            }
        });

        // Trigger character counter on load for pre-filled values
        $('input[maxlength]').trigger('input');

        // Generate random password
        $('#generatePassword').click(function() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
            let password = '';

            for (let i = 0; i < 12; i++) {
                password += chars.charAt(Math.floor(Math.random() * chars.length));
            }

            $('#password').val(password);
            $('#password_confirmation').val(password);
            updatePasswordStrength(password);

            Swal.fire({
                icon: 'info',
                title: 'Mot de passe généré',
                text: 'Un mot de passe sécurisé a été généré.',
                timer: 1500,
                showConfirmButton: false
            });
        });
    });


     // Vérification des rôles super-admin
    $(document).ready(function() {
        @if(!auth()->user()->hasRole('super-admin'))
            $('input[value="super-admin"]').prop('disabled', true);

            $('input[type="checkbox"][disabled]').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Permission insuffisante',
                    text: 'Vous n\'avez pas les permissions nécessaires pour attribuer le rôle super-admin',
                    confirmButtonColor: '#28a745'
                });
            });
        @endif
    });

    function resetForm() {
        Swal.fire({
            title: 'Réinitialiser le formulaire ?',
            text: "Tous les champs seront vidés",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6c757d',
            cancelButtonColor: '#28a745',
            confirmButtonText: '<i class="fas fa-undo mr-1"></i> Oui, réinitialiser',
            cancelButtonText: '<i class="fas fa-times mr-1"></i> Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#createUserForm')[0].reset();
                $('#passwordStrengthBar').css('width', '0%').removeClass().addClass('progress-bar');
                $('#passwordStrengthText').text('');
                $('.char-counter').text('0/255');
                $('.requirement-check').removeClass('fa-check-circle text-success fa-times-circle text-danger');
                $('#name').focus();

                Swal.fire({
                    icon: 'success',
                    title: 'Formulaire réinitialisé',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
          // Réinitialiser aussi les rôles
        @foreach($roles as $role)
            $('#role_{{ $role->id }}').prop('checked', false);
        @endforeach
    }

    // Show database compatibility info
    function showDatabaseInfo() {
        Swal.fire({
            title: 'Compatibilité base de données',
            html: `
                <div class="text-left">
                    <p>Ce formulaire est compatible avec :</p>
                    <ul>
                        <li><i class="fab fa-mysql text-primary mr-2"></i> <strong>MySQL/MariaDB</strong></li>
                        <li><i class="fas fa-database text-success mr-2"></i> <strong>SQLite</strong></li>
                        <li><i class="fab fa-aws text-info mr-2"></i> <strong>PostgreSQL</strong></li>
                    </ul>
                    <p class="text-muted small mt-3">
                        Toutes les contraintes de longueur sont configurées pour être compatibles avec ces systèmes.
                    </p>
                </div>
            `,
            icon: 'info',
            confirmButtonColor: '#28a745'
        });
    }
</script>

{{-- Ajouter un bouton pour générer un mot de passe dans le formulaire --}}
@push('scripts')
<script>
    // Add generate password button dynamically
    $(document).ready(function() {
        const generateButton = `
            <button type="button" class="btn btn-outline-info btn-sm mt-2" id="generatePassword">
                <i class="fas fa-random mr-1"></i> Générer un mot de passe sécurisé
            </button>
        `;

        $('#password').parent().append(generateButton);
    });
</script>
@endpush

@stop
