continuer cette blade @extends('layouts.master')

@section('title', 'Créer une publicité - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Créer une publicité',
        'parent' => 'Publicité',
        'parent_url' => route('advertise.index'),
        'active' => 'Nouvelle publicité'
    ])
</section>

<!-- =========================
    FORMULAIRE PUBLICITÉ
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>
                            Créer une nouvelle publicité
                        </h4>
                    </div>

                    <div class="card-body p-4">
                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('advertise.store') }}" method="POST" enctype="multipart/form-data" id="adForm">
                            @csrf

                            <!-- Informations de base -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    Informations de base
                                </h5>

                                <div class="row g-3">
                                    <!-- Titre -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="form-label fw-bold">
                                                Titre de la publicité
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   name="title"
                                                   id="title"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   value="{{ old('title') }}"
                                                   required
                                                   maxlength="255"
                                                   placeholder="Ex: Promotion spéciale été 2024">
                                            @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Nom de l'entreprise -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_name" class="form-label fw-bold">
                                                Nom de l'entreprise
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   name="company_name"
                                                   id="company_name"
                                                   class="form-control @error('company_name') is-invalid @enderror"
                                                   value="{{ old('company_name', $user->company ?? '') }}"
                                                   required
                                                   placeholder="Votre entreprise">
                                            @error('company_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label fw-bold">
                                                Email de contact
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="email"
                                                   name="email"
                                                   id="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   value="{{ old('email', $user->email ?? '') }}"
                                                   required
                                                   placeholder="contact@entreprise.com">
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
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="tel"
                                                   name="phone"
                                                   id="phone"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   value="{{ old('phone', $user->phone ?? '') }}"
                                                   required
                                                   placeholder="+225 00 00 00 00">
                                            @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Site web -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="website" class="form-label fw-bold">
                                                Site web
                                            </label>
                                            <input type="url"
                                                   name="website"
                                                   id="website"
                                                   class="form-control @error('website') is-invalid @enderror"
                                                   value="{{ old('website', $user->website ?? '') }}"
                                                   placeholder="https://www.votre-site.com">
                                            @error('website')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Configuration de la publicité -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-sliders-h text-primary me-2"></i>
                                    Configuration
                                </h5>

                                <div class="row g-3">
                                    <!-- Format -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="placement" class="form-label fw-bold">
                                                Format
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="placement"
                                                    id="placement"
                                                    class="form-control @error('placement') is-invalid @enderror"
                                                    required>
                                                <option value="">-- Choisir un format --</option>
                                                @foreach($formats as $key => $format)
                                                <option value="{{ $key }}"
                                                        {{ old('placement', request('format')) == $key ? 'selected' : '' }}
                                                        data-price="{{ $prices[$key] ?? 50000 }}">
                                                    {{ $format }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('placement')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Durée -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="duration" class="form-label fw-bold">
                                                Durée (jours)
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="duration"
                                                    id="duration"
                                                    class="form-control @error('duration') is-invalid @enderror"
                                                    required>
                                                <option value="">-- Choisir une durée --</option>
                                                @foreach($durations as $days => $label)
                                                <option value="{{ $days }}" {{ old('duration') == $days ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('duration')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- URL de destination -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="target_url" class="form-label fw-bold">
                                                URL de destination
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="url"
                                                   name="target_url"
                                                   id="target_url"
                                                   class="form-control @error('target_url') is-invalid @enderror"
                                                   value="{{ old('target_url') }}"
                                                   required
                                                   placeholder="https://www.votre-site.com/promotion">
                                            @error('target_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description" class="form-label fw-bold">
                                                Description
                                            </label>
                                            <textarea name="description"
                                                      id="description"
                                                      class="form-control @error('description') is-invalid @enderror"
                                                      rows="3"
                                                      placeholder="Décrivez votre offre promotionnelle...">{{ old('description') }}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Image -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-image text-primary me-2"></i>
                                    Image publicitaire
                                </h5>

                                <div class="form-group">
                                    <label for="image" class="form-label fw-bold">
                                        Image
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="custom-file-upload">
                                        <input type="file"
                                               name="image"
                                               id="image"
                                               class="form-control @error('image') is-invalid @enderror"
                                               accept="image/*"
                                               required
                                               onchange="previewImage(event)">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Formats acceptés: JPG, PNG, WebP | Taille max: 5MB
                                        </small>
                                    </div>

                                    <!-- Aperçu de l'image -->
                                    <div class="image-preview mt-3" id="imagePreviewContainer" style="display: none;">
                                        <p class="fw-bold mb-2">Aperçu :</p>
                                        <div class="preview-wrapper">
                                            <img id="imagePreview" class="img-fluid rounded border">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Calcul du prix -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-calculator text-primary me-2"></i>
                                    Calcul du prix
                                </h5>

                                <div class="price-summary card border-0 bg-light">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="price-item">
                                                    <span>Format :</span>
                                                    <strong id="formatPrice">0 FCFA</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="price-item">
                                                    <span>Durée :</span>
                                                    <strong id="durationDisplay">0 jour(s)</strong>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="total-price">
                                                    <h4 class="mb-0">
                                                        Total :
                                                        <span id="totalPrice" class="text-primary">0 FCFA</span>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Conditions -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input type="checkbox"
                                           name="agree_terms"
                                           id="agree_terms"
                                           class="form-check-input @error('agree_terms') is-invalid @enderror"
                                           required>
                                    <label class="form-check-label" for="agree_terms">
                                        J'accepte les
                                        <a href="{{ route('pages.legal') }}" target="_blank">conditions générales                                            </a>
                                            <a href="{{ route('pages.privacy') }}" target="_blank" class="text-primary">
                                                de confidentialité
                                            </a>
                                        </label>
                                        @error('agree_terms')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="#" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Retour
                                </a>
                                <div>
                                    <button type="button" class="btn btn-outline-primary me-2" onclick="calculatePrice()">
                                        <i class="fas fa-calculator me-2"></i>Recalculer
                                    </button>
                                    <button type="submit" class="ht-btn style-2">
                                        <i class="fas fa-paper-plane me-2"></i>Soumettre la publicité
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Informations additionnelles -->
                <div class="mt-4">
                    <div class="alert alert-info">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="alert-heading">Informations importantes</h5>
                                <ul class="mb-0">
                                    <li>Les publicités sont soumises à validation avant publication</li>
                                    <li>La validation prend généralement 24 à 48 heures</li>
                                    <li>Les formats d'image recommandés sont : JPG, PNG, WebP</li>
                                    <li>Le paiement s'effectue après validation de votre annonce</li>
                                    <li>Vous recevrez un email de confirmation avec les détails de paiement</li>
                                </ul>
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
.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.custom-file-upload {
    position: relative;
}

.custom-file-upload input[type="file"] {
    padding: 10px;
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    background-color: #f8f9fa;
    transition: all 0.3s ease;
}

.custom-file-upload input[type="file"]:hover {
    border-color: #667eea;
    background-color: #f0f2ff;
}

.image-preview {
    padding: 15px;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    background-color: #f8f9fa;
}

.preview-wrapper {
    max-width: 400px;
    margin: 0 auto;
}

.preview-wrapper img {
    max-height: 200px;
    object-fit: contain;
}

.price-summary {
    border-left: 4px solid #667eea;
}

.price-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #eaeaea;
}

.price-item:last-child {
    border-bottom: none;
}

.total-price {
    padding: 15px;
    background-color: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #28a745;
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

.card-header {
    background: linear-gradient(45deg, #667eea, #764ba2) !important;
}

.form-label {
    color: #333;
    font-weight: 600;
    margin-bottom: 8px;
}

.text-danger {
    color: #dc3545 !important;
}

.invalid-feedback {
    font-size: 0.875em;
    color: #dc3545;
}

.was-validated .form-control:invalid {
    border-color: #dc3545;
    padding-right: calc(1.5em + 0.75rem);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}
</style>
@endpush

@push('scripts')
<script>
// Aperçu de l'image
function previewImage(event) {
    const input = event.target;
    const previewContainer = document.getElementById('imagePreviewContainer');
    const preview = document.getElementById('imagePreview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        }

        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.style.display = 'none';
    }
}

// Calcul du prix
function calculatePrice() {
    const placementSelect = document.getElementById('placement');
    const durationSelect = document.getElementById('duration');

    const selectedOption = placementSelect.options[placementSelect.selectedIndex];
    const formatPrice = selectedOption ? parseFloat(selectedOption.getAttribute('data-price')) || 50000 : 50000;
    const duration = durationSelect.value ? parseInt(durationSelect.value) : 0;

    // Calcul du prix total (prix journalier × nombre de jours)
    // On suppose que le prix du format est pour 30 jours
    const dailyPrice = formatPrice / 30;
    const totalPrice = Math.round(dailyPrice * duration);

    // Mise à jour de l'affichage
    document.getElementById('formatPrice').textContent = formatPrice.toLocaleString('fr-FR') + ' FCFA';
    document.getElementById('durationDisplay').textContent = duration + ' jour(s)';
    document.getElementById('totalPrice').textContent = totalPrice.toLocaleString('fr-FR') + ' FCFA';
}

// Validation du formulaire
document.getElementById('adForm').addEventListener('submit', function(event) {
    const agreeTerms = document.getElementById('agree_terms');

    if (!agreeTerms.checked) {
        event.preventDefault();
        alert('Veuillez accepter les conditions générales et la politique de confidentialité.');
        agreeTerms.focus();
    }
});

// Initialisation des événements
document.addEventListener('DOMContentLoaded', function() {
    // Calcul initial
    calculatePrice();

    // Recalculer quand les sélections changent
    document.getElementById('placement').addEventListener('change', calculatePrice);
    document.getElementById('duration').addEventListener('change', calculatePrice);

    // Masquer/afficher l'aperçu
    const imageInput = document.getElementById('image');
    if (imageInput.files.length > 0) {
        previewImage({target: imageInput});
    }

    // Formatage du téléphone
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');

        if (value.length > 0) {
            // Format pour la Côte d'Ivoire
            if (value.startsWith('225')) {
                value = '+225 ' + value.substring(3);
            } else if (value.length <= 2) {
                value = '+225 ' + value;
            }

            // Ajout des espaces
            value = value.replace(/(\d{2})(?=\d)/g, '$1 ');
            e.target.value = value;
        }
    });

    // Validation de l'URL
    const websiteInput = document.getElementById('website');
    websiteInput.addEventListener('blur', function(e) {
        if (e.target.value && !e.target.value.startsWith('http')) {
            e.target.value = 'https://' + e.target.value;
        }
    });

    const targetUrlInput = document.getElementById('target_url');
    targetUrlInput.addEventListener('blur', function(e) {
        if (e.target.value && !e.target.value.startsWith('http')) {
            e.target.value = 'https://' + e.target.value;
        }
    });

    // Limiteur de caractères
    const titleInput = document.getElementById('title');
    const titleCounter = document.createElement('small');
    titleCounter.className = 'form-text text-muted float-end';
    titleCounter.textContent = '0/255';
    titleInput.parentNode.appendChild(titleCounter);

    titleInput.addEventListener('input', function() {
        const remaining = 255 - this.value.length;
        titleCounter.textContent = this.value.length + '/255 caractères';

        if (remaining < 50) {
            titleCounter.style.color = remaining < 20 ? '#dc3545' : '#ffc107';
        } else {
            titleCounter.style.color = '#6c757d';
        }
    });

    // Afficher le prix du format sélectionné dans le placeholder du format
    const placementSelect = document.getElementById('placement');
    placementSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const formatName = selectedOption.textContent;
        const formatPrice = selectedOption.getAttribute('data-price');

        // Mettre à jour le tooltip ou autre affichage
        const formatLabel = this.parentNode.querySelector('label');
        const originalText = 'Format';
        if (selectedOption.value) {
            formatLabel.innerHTML = `${originalText} <span class="badge bg-success ms-2">${parseInt(formatPrice).toLocaleString('fr-FR')} FCFA/mois</span>`;
        } else {
            formatLabel.textContent = originalText;
        }
    });

    // Désactiver les dates passées
    const today = new Date().toISOString().split('T')[0];
    document.querySelectorAll('input[type="date"]').forEach(input => {
        input.min = today;
    });
});

// Gestion des erreurs côté client
function showError(field, message) {
    const formGroup = field.closest('.form-group');
    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback d-block';
    errorDiv.textContent = message;

    // Supprimer l'ancien message d'erreur
    const oldError = formGroup.querySelector('.invalid-feedback');
    if (oldError) {
        oldError.remove();
    }

    field.classList.add('is-invalid');
    formGroup.appendChild(errorDiv);
}

function clearError(field) {
    field.classList.remove('is-invalid');
    const formGroup = field.closest('.form-group');
    const errorDiv = formGroup.querySelector('.invalid-feedback');
    if (errorDiv) {
        errorDiv.remove();
    }
}

// Validation en temps réel
document.querySelectorAll('#adForm input, #adForm select, #adForm textarea').forEach(element => {
    element.addEventListener('blur', function() {
        if (!this.checkValidity()) {
            showError(this, this.validationMessage);
        } else {
            clearError(this);
        }
    });
});

// Confirmation avant de quitter la page
window.addEventListener('beforeunload', function(e) {
    const form = document.getElementById('adForm');
    const hasData = Array.from(form.elements).some(element => {
        return (element.type !== 'submit' && element.value.trim() !== '') ||
               (element.type === 'file' && element.files.length > 0);
    });

    if (hasData) {
        e.preventDefault();
        e.returnValue = 'Vous avez des modifications non enregistrées. Êtes-vous sûr de vouloir quitter ?';
        return e.returnValue;
    }
});

// API de géolocalisation pour le téléphone
async function getCountryCode() {
    try {
        const response = await fetch('https://ipapi.co/json/');
        const data = await response.json();

        if (data.country_code === 'CI') {
            const phoneInput = document.getElementById('phone');
            if (!phoneInput.value.startsWith('+225')) {
                phoneInput.value = '+225 ' + phoneInput.value.replace(/^\+225\s*/g, '');
            }
        }
    } catch (error) {
        console.log('Impossible de détecter la localisation');
    }
}

// Appeler la détection de pays au chargement
getCountryCode();

// Drag and drop pour l'image
const imageDropZone = document.querySelector('.custom-file-upload');
const imageInput = document.getElementById('image');

imageDropZone.addEventListener('dragover', function(e) {
    e.preventDefault();
    e.stopPropagation();
    this.style.borderColor = '#667eea';
    this.style.backgroundColor = '#f0f2ff';
});

imageDropZone.addEventListener('dragleave', function(e) {
    e.preventDefault();
    e.stopPropagation();
    this.style.borderColor = '#dee2e6';
    this.style.backgroundColor = '#f8f9fa';
});

imageDropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    e.stopPropagation();

    this.style.borderColor = '#dee2e6';
    this.style.backgroundColor = '#f8f9fa';

    const files = e.dataTransfer.files;
    if (files.length > 0) {
        const file = files[0];

        // Vérifier le type de fichier
        if (!file.type.match('image.*')) {
            showError(imageInput, 'Veuillez sélectionner une image valide (JPG, PNG, WebP)');
            return;
        }

        // Vérifier la taille
        if (file.size > 5 * 1024 * 1024) {
            showError(imageInput, 'L\'image est trop volumineuse (max 5MB)');
            return;
        }

        // Mettre à jour l'input file
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        imageInput.files = dataTransfer.files;

        // Déclencher l'aperçu
        previewImage({target: imageInput});
        clearError(imageInput);
    }
});
</script>
@endpush
