@extends('layouts.master')

@section('title', 'Mon Profil - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Mon Profil',
        'parent' => 'Espace Client',
        'parent_url' => route('client.dashboard'),
        'active' => 'Profil'
    ])
</section>

<!-- =========================
    PROFIL UTILISATEUR
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <!-- Menu latéral -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('client.dashboard') }}"
                               class="list-group-item list-group-item-action">
                                <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
                            </a>
                            <a href="{{ route('client.profile') }}"
                               class="list-group-item list-group-item-action active">
                                <i class="fas fa-user me-2"></i>Mon Profil
                            </a>
                            <a href="{{ route('client.billing') }}"
                               class="list-group-item list-group-item-action">
                                <i class="fas fa-credit-card me-2"></i>Facturation
                            </a>
                            <a href="{{ route('client.documents') }}"
                               class="list-group-item list-group-item-action">
                                <i class="fas fa-file-alt me-2"></i>Documents
                            </a>
                            <a href="{{ route('client.notifications') }}"
                               class="list-group-item list-group-item-action">
                                <i class="fas fa-bell me-2"></i>Notifications
                            </a>
                            <a href="{{ route('profile.edit') }}"
                               class="list-group-item list-group-item-action">
                                <i class="fas fa-cog me-2"></i>Paramètres
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Statut du compte -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="avatar-lg mx-auto mb-3">
                            @if(auth()->user()->avatar)
                                <img src="{{ Storage::url(auth()->user()->avatar) }}"
                                     alt="{{ auth()->user()->name }}"
                                     class="rounded-circle"
                                     width="100"
                                     height="100">
                            @else
                                <div class="avatar-placeholder rounded-circle d-inline-flex align-items-center justify-content-center bg-primary text-white"
                                     style="width: 100px; height: 100px; font-size: 40px;">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                        <p class="text-muted mb-2">{{ auth()->user()->email }}</p>
                        <span class="badge bg-{{ auth()->user()->hasRole('admin') ? 'danger' : 'success' }}">
                            {{ auth()->user()->getRoleNames()->first() ?? 'Utilisateur' }}
                        </span>
                        <div class="mt-3">
                            <p class="mb-1">
                                <small class="text-muted">Membre depuis</small><br>
                                <strong>{{ auth()->user()->created_at->format('d/m/Y') }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <!-- Informations du profil -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h4 class="mb-0">
                            <i class="fas fa-user-edit me-2"></i>
                            Informations personnelles
                        </h4>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('client.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <!-- Avatar -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Photo de profil</label>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                @if(auth()->user()->avatar)
                                                    <img src="{{ Storage::url(auth()->user()->avatar) }}"
                                                         alt="Avatar"
                                                         class="rounded-circle"
                                                         width="80"
                                                         height="80">
                                                @else
                                                    <div class="avatar-placeholder rounded-circle d-inline-flex align-items-center justify-content-center bg-secondary text-white"
                                                         style="width: 80px; height: 80px; font-size: 30px;">
                                                        {{ substr(auth()->user()->name, 0, 1) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1">
                                                <input type="file"
                                                       name="avatar"
                                                       id="avatar"
                                                       class="form-control @error('avatar') is-invalid @enderror"
                                                       accept="image/*">
                                                @error('avatar')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">
                                                    Formats acceptés: JPG, PNG | Taille max: 2MB
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nom complet -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label fw-bold">
                                            Nom complet
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               name="name"
                                               id="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name', auth()->user()->name) }}"
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label fw-bold">
                                            Adresse email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email"
                                               name="email"
                                               id="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email', auth()->user()->email) }}"
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Téléphone -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-label fw-bold">
                                            Téléphone
                                        </label>
                                        <input type="tel"
                                               name="phone"
                                               id="phone"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone', auth()->user()->phone) }}"
                                               placeholder="+225 05 64 51 59 16">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Entreprise -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company" class="form-label fw-bold">
                                            Entreprise
                                        </label>
                                        <input type="text"
                                               name="company"
                                               id="company"
                                               class="form-control @error('company') is-invalid @enderror"
                                               value="{{ old('company', auth()->user()->company) }}">
                                        @error('company')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Site web -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website" class="form-label fw-bold">
                                            Site web
                                        </label>
                                        <input type="url"
                                               name="website"
                                               id="website"
                                               class="form-control @error('website') is-invalid @enderror"
                                               value="{{ old('website', auth()->user()->website) }}"
                                               placeholder="https://www.example.com">
                                        @error('website')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Adresse -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address" class="form-label fw-bold">
                                            Adresse
                                        </label>
                                        <input type="text"
                                               name="address"
                                               id="address"
                                               class="form-control @error('address') is-invalid @enderror"
                                               value="{{ old('address', auth()->user()->address) }}">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Ville -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city" class="form-label fw-bold">
                                            Ville
                                        </label>
                                        <input type="text"
                                               name="city"
                                               id="city"
                                               class="form-control @error('city') is-invalid @enderror"
                                               value="{{ old('city', auth()->user()->city) }}">
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Pays -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country" class="form-label fw-bold">
                                            Pays
                                        </label>
                                        <input type="text"
                                               name="country"
                                               id="country"
                                               class="form-control @error('country') is-invalid @enderror"
                                               value="{{ old('country', auth()->user()->country) }}">
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Code postal -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="postal_code" class="form-label fw-bold">
                                            Code postal
                                        </label>
                                        <input type="text"
                                               name="postal_code"
                                               id="postal_code"
                                               class="form-control @error('postal_code') is-invalid @enderror"
                                               value="{{ old('postal_code', auth()->user()->postal_code) }}">
                                        @error('postal_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Bio -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="bio" class="form-label fw-bold">
                                            Bio / Description
                                        </label>
                                        <textarea name="bio"
                                                  id="bio"
                                                  class="form-control @error('bio') is-invalid @enderror"
                                                  rows="3"
                                                  placeholder="Parlez-nous de vous...">{{ old('bio', auth()->user()->bio) }}</textarea>
                                        @error('bio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Maximum 500 caractères
                                        </small>
                                    </div>
                                </div>

                                <!-- Boutons -->
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('client.dashboard') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-arrow-left me-2"></i>Retour
                                        </a>
                                        <div>
                                            <button type="reset" class="btn btn-outline-danger me-2">
                                                <i class="fas fa-redo me-2"></i>Réinitialiser
                                            </button>
                                            <button type="submit" class="ht-btn style-2">
                                                <i class="fas fa-save me-2"></i>Enregistrer les modifications
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sécurité -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white border-bottom">
                        <h4 class="mb-0">
                            <i class="fas fa-shield-alt me-2"></i>
                            Sécurité du compte
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Mot de passe</h6>
                                <p class="text-muted mb-3">
                                    Votre mot de passe a été défini il y a
                                    {{ auth()->user()->password_changed_at ? auth()->user()->password_changed_at->diffForHumans() : 'longtemps' }}.
                                </p>
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-key me-1"></i>Changer le mot de passe
                                </a>
                            </div>
                            <div class="col-md-6">
                                <h6>Authentification à deux facteurs</h6>
                                <p class="text-muted mb-3">
                                    Ajoutez une couche de sécurité supplémentaire à votre compte.
                                </p>
                                <button class="btn btn-outline-secondary btn-sm" disabled>
                                    <i class="fas fa-mobile-alt me-1"></i>Configurer 2FA
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.avatar-placeholder {
    background: linear-gradient(45deg, #667eea, #764ba2);
}

.list-group-item.active {
    background: linear-gradient(45deg, #667eea, #764ba2);
    border-color: #667eea;
}

.card-header {
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
}

.ht-btn.style-2 {
    background: linear-gradient(45deg, #667eea, #764ba2);
    border: none;
    color: white;
    padding: 10px 25px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.ht-btn.style-2:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}
</style>
@endpush

@push('scripts')
<script>
// Aperçu de l'avatar
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const avatarImg = document.querySelector('.avatar-placeholder');
            if (avatarImg) {
                avatarImg.innerHTML = `<img src="${e.target.result}" class="rounded-circle" width="80" height="80">`;
            }
        }
        reader.readAsDataURL(file);
    }
});

// Validation du formulaire
document.querySelector('form').addEventListener('submit', function(e) {
    const phoneInput = document.getElementById('phone');
    const websiteInput = document.getElementById('website');

    // Validation du téléphone
    if (phoneInput.value && !/^(\+225|225)?\s?[0-9]{2}\s?[0-9]{2}\s?[0-9]{2}\s?[0-9]{2}$/.test(phoneInput.value)) {
        e.preventDefault();
        alert('Veuillez saisir un numéro de téléphone valide (format: +225 00 00 00 00)');
        phoneInput.focus();
        return;
    }

    // Validation du site web
    if (websiteInput.value && !websiteInput.value.startsWith('http')) {
        websiteInput.value = 'https://' + websiteInput.value;
    }
});

// Compteur de caractères pour la bio
const bioTextarea = document.getElementById('bio');
if (bioTextarea) {
    const bioCounter = document.createElement('small');
    bioCounter.className = 'form-text text-muted float-end';
    bioCounter.textContent = '0/500';
    bioTextarea.parentNode.appendChild(bioCounter);

    bioTextarea.addEventListener('input', function() {
        const remaining = 500 - this.value.length;
        bioCounter.textContent = this.value.length + '/500 caractères';

        if (remaining < 50) {
            bioCounter.style.color = remaining < 20 ? '#dc3545' : '#ffc107';
        } else {
            bioCounter.style.color = '#6c757d';
        }
    });

    // Initialiser le compteur
    bioTextarea.dispatchEvent(new Event('input'));
}
</script>
@endpush
