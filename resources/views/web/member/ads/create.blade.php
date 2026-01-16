@extends('layouts.master')

@section('title', 'Créer une publicité - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Créer une publicité',
        'parent' => 'Mes Publicités',
        'parent_url' => route('member.ads.index'),
        'active' => 'Nouvelle publicité'
    ])
</section>

<!-- =========================
    FORMULAIRE DE CRÉATION
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

                        <form action="{{ route('member.ads.store') }}" method="POST" enctype="multipart/form-data" id="adForm">
                            @csrf

                            <!-- Informations de base -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    Informations de base
                                </h5>

                                <div class="row g-3">
                                    <!-- Titre -->
                                    <div class="col-12">
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
                                            <small class="form-text text-muted float-end">
                                                <span id="titleCounter">0/255</span>
                                            </small>
                                        </div>
                                    </div>

                                    <!-- URL de destination -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="url" class="form-label fw-bold">
                                                URL de destination
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="url"
                                                   name="url"
                                                   id="url"
                                                   class="form-control @error('url') is-invalid @enderror"
                                                   value="{{ old('url') }}"
                                                   required
                                                   placeholder="https://www.votre-site.com/promotion">
                                            @error('url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                Lien vers lequel les utilisateurs seront redirigés
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description" class="form-label fw-bold">
                                                Description (optionnelle)
                                            </label>
                                            <textarea name="description"
                                                      id="description"
                                                      class="form-control @error('description') is-invalid @enderror"
                                                      rows="3"
                                                      placeholder="Décrivez votre offre promotionnelle...">{{ old('description') }}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted float-end">
                                                <span id="descCounter">0/500</span>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Configuration -->
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
                                                Format de placement
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="placement"
                                                    id="placement"
                                                    class="form-control @error('placement') is-invalid @enderror"
                                                    required>
                                                <option value="">-- Choisir un format --</option>
                                                @foreach($pricing as $key => $format)
                                                <option value="{{ $key }}"
                                                        data-price="{{ $format['price'] }}"
                                                        {{ old('placement') == $key ? 'selected' : '' }}>
                                                    {{ $format['name'] }} - {{ number_format($format['price'], 0, ',', ' ') }} FCFA/mois
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
                                                <option value="7" {{ old('duration') == '7' ? 'selected' : '' }}>7 jours</option>
                                                <option value="14" {{ old('duration') == '14' ? 'selected' : '' }}>14 jours</option>
                                                <option value="30" {{ old('duration') == '30' ? 'selected' : '' }}>30 jours</option>
                                                <option value="60" {{ old('duration') == '60' ? 'selected' : '' }}>60 jours</option>
                                                <option value="90" {{ old('duration') == '90' ? 'selected' : '' }}>90 jours</option>
                                            </select>
                                            @error('duration')
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

                                    <!-- Zone de drag & drop -->
                                    <div class="upload-area @error('image') border-danger @enderror"
                                         id="uploadArea">
                                        <div class="upload-content text-center py-5">
                                            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                            <h5 class="mb-2">Glissez-déposez votre image ici</h5>
                                            <p class="text-muted mb-3">ou cliquez pour parcourir</p>
                                            <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('image').click()">
                                                <i class="fas fa-folder-open me-2"></i>Choisir un fichier
                                            </button>
                                            <p class="text-muted mt-3 mb-0">
                                                Formats acceptés: JPG, PNG, WebP<br>
                                                Taille max: 5MB
                                            </p>
                                        </div>
                                        <input type="file"
                                               name="image"
                                               id="image"
                                               class="d-none"
                                               accept="image/*"
                                               required>
                                    </div>
                                    @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                    <!-- Aperçu -->
                                    <div class="image-preview mt-3" id="imagePreview" style="display: none;">
                                        <div class="preview-wrapper">
                                            <img id="previewImage" class="img-fluid rounded border">
                                            <div class="preview-actions mt-2">
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">
                                                    <i class="fas fa-trash me-1"></i>Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Dimensions recommandées -->
                                    <div class="mt-3">
                                        <div class="alert alert-info">
                                            <h6 class="alert-heading">
                                                <i class="fas fa-ruler-combined me-2"></i>
                                                Dimensions recommandées
                                            </h6>
                                            <div class="row mt-2">
                                                <div class="col-md-3">
                                                    <small class="d-block fw-bold">Header</small>
                                                    <small class="text-muted">1200 × 300px</small>
                                                </div>
                                                <div class="col-md-3">
                                                    <small class="d-block fw-bold">Sidebar</small>
                                                    <small class="text-muted">300 × 600px</small>
                                                </div>
                                                <div class="col-md-3">
                                                    <small class="d-block fw-bold">Footer</small>
                                                    <small class="text-muted">1200 × 150px</small>
                                                </div>
                                                <div class="col-md-3">
                                                    <small class="d-block fw-bold">Popup</small>
                                                    <small class="text-muted">800 × 600px</small>
                                                </div>
                                            </div>
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
                                                <div class="price-item d-flex justify-content-between mb-2">
                                                    <span>Format :</span>
                                                    <strong id="formatName">-</strong>
                                                </div>
                                                <div class="price-item d-flex justify-content-between mb-2">
                                                    <span>Prix mensuel :</span>
                                                    <strong id="monthlyPrice">0 FCFA</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="price-item d-flex justify-content-between mb-2">
                                                    <span>Durée :</span>
                                                    <strong id="durationDisplay">0 jour(s)</strong>
                                                </div>
                                                <div class="price-item d-flex justify-content-between mb-2">
                                                    <span>Prix journalier :</span>
                                                    <strong id="dailyPrice">0 FCFA</strong>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3 pt-3 border-top">
                                                <div class="total-price d-flex justify-content-between align-items-center">
                                                    <h4 class="mb-0">Total :</h4>
                                                    <h2 class="mb-0 text-primary" id="totalPrice">0 FCFA</h2>
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
                                        <a href="{{ route('pages.legal') }}" target="_blank" class="text-primary">
                                            conditions générales
                                        </a>
                                        et la
                                        <a href="{{ route('pages.privacy') }}" target="_blank" class="text-primary">
                                            politique de confidentialité
                                        </a>
                                        <span class="text-danger">*</span>
                                    </label>
                                    @error('agree_terms')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('member.ads.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Annuler
                                </a>
                                <div>
                                    <button type="button" class="btn btn-outline-primary me-2" onclick="calculatePrice()">
                                        <i class="fas fa-calculator me-2"></i>Recalculer
                                    </button>
                                    <button type="submit" class="ht-btn style-2">
                                        <i class="fas fa-paper-plane me-2"></i>Créer la publicité
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Informations importantes -->
                <div class="mt-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-3">
                                <i class="fas fa-info-circle text-info me-2"></i>
                                Informations importantes
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            Validation sous 24-48h
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            Paiement après validation
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            Support technique inclus
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            Statistiques détaillées
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            Modifications possibles
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            Pas de frais cachés
                                        </li>
                                    </ul>
                                </div>
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
.upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    background-color: #f8f9fa;
    transition: all 0.3s ease;
    cursor: pointer;
}

.upload-area:hover {
    border-color: #667eea;
    background-color: #f0f2ff;
}

.upload-area.dragover {
    border-color: #28a745;
    background-color: #d4edda;
}

.upload-content i {
    transition: transform 0.3s;
}

.upload-area:hover .upload-content i {
    transform: scale(1.1);
}

.image-preview {
    animation: fadeIn 0.5s;
}

.preview-wrapper {
    max-width: 500px;
    margin: 0 auto;
}

.preview-wrapper img {
    max-height: 300px;
    object-fit: contain;
    border-radius: 8px;
}

.price-summary {
    border-left: 4px solid #667eea;
    animation: slideIn 0.5s;
}

.total-price {
    padding: 15px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateX(-20px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
</style>
@endpush

@push('scripts')
<script>
// Variables globales
let selectedFile = null;

// Drag & drop
const uploadArea = document.getElementById('uploadArea');
const imageInput = document.getElementById('image');
const imagePreview = document.getElementById('imagePreview');
const previewImage = document.getElementById('previewImage');

// Événements drag & drop
uploadArea.addEventListener('dragover', function(e) {
    e.preventDefault();
    e.stopPropagation();
    this.classList.add('dragover');
});

uploadArea.addEventListener('dragleave', function(e) {
    e.preventDefault();
    e.stopPropagation();
    this.classList.remove('dragover');
});

uploadArea.addEventListener('drop', function(e) {
    e.preventDefault();
    e.stopPropagation();
    this.classList.remove('dragover');

    const files = e.dataTransfer.files;
    if (files.length > 0) {
        handleImageFile(files[0]);
    }
});

// Clic sur la zone
uploadArea.addEventListener('click', function() {
    imageInput.click();
});

// Sélection via input file
imageInput.addEventListener('change', function(e) {
    if (this.files.length > 0) {
        handleImageFile(this.files[0]);
    }
});

// Gestion du fichier image
function handleImageFile(file) {
    // Validation
    if (!file.type.match('image.*')) {
        showError('Veuillez sélectionner une image valide (JPG, PNG, WebP)');
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        showError('L\'image est trop volumineuse (max 5MB)');
        return;
    }

    selectedFile = file;

    // Aperçu
    const reader = new FileReader();
    reader.onload = function(e) {
        previewImage.src = e.target.result;
        imagePreview.style.display = 'block';
    };
    reader.readAsDataURL(file);

    // Masquer la zone de téléchargement
    uploadArea.style.display = 'none';
}

// Supprimer l'image
function removeImage() {
    selectedFile = null;
    imageInput.value = '';
    previewImage.src = '';
    imagePreview.style.display = 'none';
    uploadArea.style.display = 'block';
}

// Calcul du prix
function calculatePrice() {
    const placementSelect = document.getElementById('placement');
    const durationSelect = document.getElementById('duration');

    const selectedOption = placementSelect.options[placementSelect.selectedIndex];
    const formatName = selectedOption ? selectedOption.text.split(' - ')[0] : '-';
    const monthlyPrice = selectedOption ? parseFloat(selectedOption.getAttribute('data-price')) || 0 : 0;
    const duration = durationSelect.value ? parseInt(durationSelect.value) : 0;

    // Calculs
    const dailyPrice = monthlyPrice / 30;
    const totalPrice = Math.round(dailyPrice * duration);

    // Mise à jour de l'affichage
    document.getElementById('formatName').textContent = formatName;
    document.getElementById('monthlyPrice').textContent = monthlyPrice.toLocaleString('fr-FR') + ' FCFA';
    document.getElementById('durationDisplay').textContent = duration + ' jour(s)';
    document.getElementById('dailyPrice').textContent = Math.round(dailyPrice).toLocaleString('fr-FR') + ' FCFA';
    document.getElementById('totalPrice').textContent = totalPrice.toLocaleString('fr-FR') + ' FCFA';

    // Animation
    document.querySelector('.price-summary').style.animation = 'none';
    setTimeout(() => {
        document.querySelector('.price-summary').style.animation = 'slideIn 0.5s';
    }, 10);
}

// Compteurs de caractères
function setupCounters() {
    // Titre
    const titleInput = document.getElementById('title');
    const titleCounter = document.getElementById('titleCounter');

    titleInput.addEventListener('input', function() {
        titleCounter.textContent = this.value.length + '/255';

        if (this.value.length > 250) {
            titleCounter.style.color = '#dc3545';
        } else if (this.value.length > 200) {
            titleCounter.style.color = '#ffc107';
        } else {
            titleCounter.style.color = '#6c757d';
        }
    });

    // Description
    const descInput = document.getElementById('description');
    const descCounter = document.getElementById('descCounter');

    descInput.addEventListener('input', function() {
        descCounter.textContent = this.value.length + '/500';

        if (this.value.length > 450) {
            descCounter.style.color = '#dc3545';
        } else if (this.value.length > 400) {
            descCounter.style.color = '#ffc107';
        } else {
            descCounter.style.color = '#6c757d';
        }
    });

    // Initialiser
    titleInput.dispatchEvent(new Event('input'));
    descInput.dispatchEvent(new Event('input'));
}

// Validation du formulaire
document.getElementById('adForm').addEventListener('submit', function(e) {
    let hasError = false;

    // Vérifier l'image
    if (!selectedFile) {
        showError('Veuillez sélectionner une image');
        hasError = true;
    }

    // Vérifier les conditions
    const agreeTerms = document.getElementById('agree_terms');
    if (!agreeTerms.checked) {
        showError('Veuillez accepter les conditions générales');
        agreeTerms.focus();
        hasError = true;
    }

    // Calculer le prix
    calculatePrice();
    const totalPrice = document.getElementById('totalPrice').textContent;

    // Confirmation finale
    if (!hasError && !confirm(`Confirmez-vous la création de cette publicité pour un montant de ${totalPrice} ?`)) {
        e.preventDefault();
    }
});

// Afficher une erreur
function showError(message) {
    alert(message);
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    setupCounters();
    calculatePrice();

    // Recalculer quand les valeurs changent
    document.getElementById('placement').addEventListener('change', calculatePrice);
    document.getElementById('duration').addEventListener('change', calculatePrice);

    // Validation de l'URL
    document.getElementById('url').addEventListener('blur', function() {
        if (this.value && !this.value.startsWith('http')) {
            this.value = 'https://' + this.value;
        }
    });

    // Empêcher la fermeture de la page si formulaire rempli
    window.addEventListener('beforeunload', function(e) {
        const form = document.getElementById('adForm');
        let hasData = false;

        // Vérifier les champs
        ['title', 'url', 'description'].forEach(id => {
            if (document.getElementById(id).value.trim()) hasData = true;
        });
        if (selectedFile) hasData = true;

        if (hasData) {
            e.preventDefault();
            e.returnValue = 'Vous avez des modifications non enregistrées. Êtes-vous sûr de vouloir quitter ?';
        }
    });
});

// Formatage automatique de l'URL
document.getElementById('url').addEventListener('input', function(e) {
    let value = e.target.value.toLowerCase();
    if (!value.startsWith('http://') && !value.startsWith('https://')) {
        value = 'https://' + value;
    }
    e.target.value = value;
});
</script>
@endpush
