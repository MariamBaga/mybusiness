@extends('layouts.master')

@section('title', 'Ajouter un produit - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Ajouter un produit',
        'parent' => 'Produits',
        'parent_url' => route('partner.products.index'),
        'active' => 'Nouveau produit'
    ])
</section>

<!-- =========================
    FORMULAIRE DE PRODUIT
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>
                            Ajouter un nouveau produit
                        </h4>
                    </div>

                    <div class="card-body p-4">
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

                        <form action="{{ route('partner.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                            @csrf

                            <!-- Informations de base -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    Informations de base
                                </h5>

                                <div class="row g-3">
                                    <!-- Nom du produit -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name" class="form-label fw-bold">
                                                Nom du produit
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   name="name"
                                                   id="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   value="{{ old('name') }}"
                                                   required
                                                   maxlength="255"
                                                   placeholder="Ex: Smartphone XYZ">
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted float-end">
                                                <span id="nameCounter">0/255</span>
                                            </small>
                                        </div>
                                    </div>

                                    <!-- SKU -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku" class="form-label fw-bold">
                                                Référence (SKU)
                                            </label>
                                            <input type="text"
                                                   name="sku"
                                                   id="sku"
                                                   class="form-control @error('sku') is-invalid @enderror"
                                                   value="{{ old('sku') }}"
                                                   placeholder="EXEMPLE-001">
                                            @error('sku')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                Identifiant unique du produit
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Catégorie -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_id" class="form-label fw-bold">
                                                Catégorie
                                            </label>
                                            <select name="category_id"
                                                    id="category_id"
                                                    class="form-control @error('category_id') is-invalid @enderror">
                                                <option value="">-- Choisir une catégorie --</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Prix et stock -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-tags text-primary me-2"></i>
                                    Prix et stock
                                </h5>

                                <div class="row g-3">
                                    <!-- Prix actuel -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price" class="form-label fw-bold">
                                                Prix de vente (FCFA)
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number"
                                                   name="price"
                                                   id="price"
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   value="{{ old('price') }}"
                                                   required
                                                   min="0"
                                                   step="0.01"
                                                   placeholder="Ex: 25000">
                                            @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                Prix actuel du produit
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Prix d'origine -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="old_price" class="form-label fw-bold">
                                                Prix d'origine (FCFA)
                                            </label>
                                            <input type="number"
                                                   name="old_price"
                                                   id="old_price"
                                                   class="form-control @error('old_price') is-invalid @enderror"
                                                   value="{{ old('old_price') }}"
                                                   min="0"
                                                   step="0.01"
                                                   placeholder="Ex: 30000">
                                            @error('old_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                Prix barré (pour promotions)
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Stock -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stock" class="form-label fw-bold">
                                                Quantité en stock
                                            </label>
                                            <input type="number"
                                                   name="stock"
                                                   id="stock"
                                                   class="form-control @error('stock') is-invalid @enderror"
                                                   value="{{ old('stock', 0) }}"
                                                   min="0"
                                                   placeholder="Ex: 100">
                                            @error('stock')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
                                            <small class="form-text text-muted">
                                                Nombre d'unités disponibles
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Poids -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="weight" class="form-label fw-bold">
                                                Poids (kg)
                                            </label>
                                            <input type="number"
                                                   name="weight"
                                                   id="weight"
                                                   class="form-control @error('weight') is-invalid @enderror"
                                                   value="{{ old('weight') }}"
                                                   min="0"
                                                   step="0.01"
                                                   placeholder="Ex: 0.5">
                                            @error('weight')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-align-left text-primary me-2"></i>
                                    Description
                                </h5>

                                <div class="row g-3">
                                    <!-- Description courte -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="short_description" class="form-label fw-bold">
                                                Description courte
                                            </label>
                                            <textarea name="short_description"
                                                      id="short_description"
                                                      class="form-control @error('short_description') is-invalid @enderror"
                                                      rows="2"
                                                      placeholder="Description résumée du produit...">{{ old('short_description') }}</textarea>
                                            @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted float-end">
                                                <span id="shortDescCounter">0/255</span>
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Description longue -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description" class="form-label fw-bold">
                                                Description détaillée
                                            </label>
                                            <textarea name="description"
                                                      id="description"
                                                      class="form-control @error('description') is-invalid @enderror"
                                                      rows="5"
                                                      placeholder="Description complète du produit...">{{ old('description') }}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
                                            <small class="form-text text-muted">
                                                Vous pouvez utiliser du HTML basique
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Images -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-images text-primary me-2"></i>
                                    Images du produit
                                </h5>

                                <div class="form-group">
                                    <label for="images" class="form-label fw-bold">
                                        Image principale
                                        <span class="text-danger">*</span>
                                    </label>

                                    <!-- Zone de téléchargement -->
                                    <div class="upload-area @error('image') border-danger @enderror"
                                         id="uploadArea">
                                        <div class="upload-content text-center py-5">
                                            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                            <h5 class="mb-2">Glissez-déposez l'image principale</h5>
                                            <p class="text-muted mb-3">ou cliquez pour parcourir</p>
                                            <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('image').click()">
                                                <i class="fas fa-folder-open me-2"></i>Choisir une image
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
                                            <img id="previewImage" class="img-fluid rounded border" style="max-height: 300px;">
                                            <div class="preview-actions mt-2">
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">
                                                    <i class="fas fa-trash me-1"></i>Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Images supplémentaires -->
                                <div class="mt-4">
                                    <label class="form-label fw-bold">
                                        Images supplémentaires
                                    </label>
                                    <div id="additionalImages">
                                        <!-- Les images supplémentaires seront ajoutées ici dynamiquement -->
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="addAdditionalImage()">
                                        <i class="fas fa-plus me-1"></i>Ajouter une image
                                    </button>
                                    <small class="form-text text-muted d-block mt-1">
                                        Maximum 5 images supplémentaires
                                    </small>
                                </div>
                            </div>

                            <!-- Caractéristiques -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-list text-primary me-2"></i>
                                    Caractéristiques
                                </h5>

                                <div id="specifications">
                                    <div class="specification-row mb-2">
                                        <div class="row g-2">
                                            <div class="col-md-5">
                                                <input type="text"
                                                       name="specifications[0][key]"
                                                       class="form-control form-control-sm"
                                                       placeholder="Ex: Couleur">
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text"
                                                       name="specifications[0][value]"
                                                       class="form-control form-control-sm"
                                                       placeholder="Ex: Noir">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="removeSpecification(this)">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addSpecification()">
                                    <i class="fas fa-plus me-1"></i>Ajouter une caractéristique
                                </button>
                                <small class="form-text text-muted d-block mt-1">
                                    Ajoutez des caractéristiques spécifiques à votre produit
                                </small>
                            </div>

                            <!-- Options avancées -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-cog text-primary me-2"></i>
                                    Options avancées
                                </h5>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="checkbox"
                                                   name="is_featured"
                                                   id="is_featured"
                                                   class="form-check-input"
                                                   {{ old('is_featured') ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="is_featured">
                                                Mettre en avant
                                            </label>
                                            <small class="form-text text-muted d-block">
                                                Le produit apparaîtra en tête des résultats
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="checkbox"
                                                   name="is_sponsored"
                                                   id="is_sponsored"
                                                   class="form-check-input"
                                                   {{ old('is_sponsored') ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="is_sponsored">
                                                Produit sponsorisé
                                            </label>
                                            <small class="form-text text-muted d-block">
                                                Mise en avant supplémentaire
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input type="checkbox"
                                                   name="status"
                                                   id="status"
                                                   class="form-check-input"
                                                   {{ old('status', true) ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="status">
                                                Produit actif
                                            </label>
                                            <small class="form-text text-muted d-block">
                                                Le produit sera visible sur la marketplace
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Information de contact -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-phone text-primary me-2"></i>
                                    Informations de contact
                                </h5>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="partner_contact_email" class="form-label fw-bold">
                                                Email de contact
                                            </label>
                                            <input type="email"
                                                   name="partner_contact_email"
                                                   id="partner_contact_email"
                                                   class="form-control @error('partner_contact_email') is-invalid @enderror"
                                                   value="{{ old('partner_contact_email', $partner->email) }}">
                                            @error('partner_contact_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="partner_product_url" class="form-label fw-bold">
                                                URL du produit (optionnel)
                                            </label>
                                            <input type="url"
                                                   name="partner_product_url"
                                                   id="partner_product_url"
                                                   class="form-control @error('partner_product_url') is-invalid @enderror"
                                                   value="{{ old('partner_product_url') }}"
                                                   placeholder="https://www.example.com/produit">
                                            @error('partner_product_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
                                            <small class="form-text text-muted">
                                                Lien vers la page du produit sur votre site
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('partner.products.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Annuler
                                </a>
                                <div>
                                    <button type="reset" class="btn btn-outline-danger me-2">
                                        <i class="fas fa-redo me-2"></i>Réinitialiser
                                    </button>
                                    <button type="submit" class="ht-btn style-2">
                                        <i class="fas fa-save me-2"></i>Créer le produit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Guide et informations -->
                <div class="mt-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-3">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Conseils pour un bon produit
                            </h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Utilisez des images de haute qualité (minimum 800x600px)
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Rédigez une description détaillée et précise
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Indiquez toutes les caractéristiques importantes
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Mettez à jour régulièrement les stocks
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Utilisez des prix compétitifs
                                </li>
                            </ul>
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

.image-preview {
    animation: fadeIn 0.5s;
}

.specification-row {
    animation: slideIn 0.3s;
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

.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateY(-10px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}
</style>
@endpush

@push('scripts')
<script>
// Variables globales
let mainImageFile = null;
let additionalImageCount = 0;
let specificationCount = 1;

// Drag & drop pour l'image principale
const uploadArea = document.getElementById('uploadArea');
const imageInput = document.getElementById('image');
const imagePreview = document.getElementById('imagePreview');
const previewImage = document.getElementById('previewImage');

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
        handleMainImageFile(files[0]);
    }
});

uploadArea.addEventListener('click', function() {
    imageInput.click();
});

imageInput.addEventListener('change', function(e) {
    if (this.files.length > 0) {
        handleMainImageFile(this.files[0]);
    }
});

function handleMainImageFile(file) {
    if (!validateImageFile(file)) return;

    mainImageFile = file;

    const reader = new FileReader();
    reader.onload = function(e) {
        previewImage.src = e.target.result;
        imagePreview.style.display = 'block';
    };
    reader.readAsDataURL(file);

    uploadArea.style.display = 'none';
}

function removeImage() {
    mainImageFile = null;
    imageInput.value = '';
    previewImage.src = '';
    imagePreview.style.display = 'none';
    uploadArea.style.display = 'block';
}

// Images supplémentaires
function addAdditionalImage() {
    if (additionalImageCount >= 5) {
        alert('Maximum 5 images supplémentaires');
        return;
    }

    const container = document.getElementById('additionalImages');
    const index = additionalImageCount;

    const imageRow = document.createElement('div');
    imageRow.className = 'image-row mb-3';
    imageRow.innerHTML = `
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 me-3">
                <input type="file"
                       name="additional_images[]"
                       class="form-control form-control-sm"
                       accept="image/*">
            </div>
            <div>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeAdditionalImage(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    `;

    container.appendChild(imageRow);
    additionalImageCount++;
}

function removeAdditionalImage(button) {
    const row = button.closest('.image-row');
    row.remove();
    additionalImageCount--;
}

// Caractéristiques
function addSpecification() {
    const container = document.getElementById('specifications');

    const specRow = document.createElement('div');
    specRow.className = 'specification-row mb-2';
    specRow.innerHTML = `
        <div class="row g-2">
            <div class="col-md-5">
                <input type="text"
                       name="specifications[${specificationCount}][key]"
                       class="form-control form-control-sm"
                       placeholder="Ex: Couleur">
            </div>
            <div class="col-md-5">
                <input type="text"
                       name="specifications[${specificationCount}][value]"
                       class="form-control form-control-sm"
                       placeholder="Ex: Noir">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="removeSpecification(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    `;

    container.appendChild(specRow);
    specificationCount++;

    // Animation
    specRow.style.animation = 'slideIn 0.3s';
}

function removeSpecification(button) {
    const row = button.closest('.specification-row');
    row.style.animation = 'slideIn 0.3s reverse';
    setTimeout(() => {
        row.remove();
    }, 300);
}

// Validation de l'image
function validateImageFile(file) {
    // Vérifier le type
    if (!file.type.match('image.*')) {
        alert('Veuillez sélectionner une image valide (JPG, PNG, WebP)');
        return false;
    }

    // Vérifier la taille
    if (file.size > 5 * 1024 * 1024) {
        alert('L\'image est trop volumineuse (max 5MB)');
        return false;
    }

    return true;
}

// Compteurs de caractères
function setupCounters() {
    // Nom du produit
    const nameInput = document.getElementById('name');
    const nameCounter = document.getElementById('nameCounter');

    nameInput.addEventListener('input', function() {
        nameCounter.textContent = this.value.length + '/255';
        updateCounterColor(nameCounter, this.value.length, 255);
    });

    // Description courte
    const shortDescInput = document.getElementById('short_description');
    const shortDescCounter = document.getElementById('shortDescCounter');

    if (shortDescInput) {
        shortDescInput.addEventListener('input', function() {
            shortDescCounter.textContent = this.value.length + '/255';
            updateCounterColor(shortDescCounter, this.value.length, 255);
        });
    }

    // Initialiser
    nameInput.dispatchEvent(new Event('input'));
    if (shortDescInput) shortDescInput.dispatchEvent(new Event('input'));
}

function updateCounterColor(counterElement, length, max) {
    if (length > max * 0.9) {
        counterElement.style.color = '#dc3545';
    } else if (length > max * 0.8) {
        counterElement.style.color = '#ffc107';
    } else {
        counterElement.style.color = '#6c757d';
    }
}

// Validation du formulaire
document.getElementById('productForm').addEventListener('submit', function(e) {
    // Vérifier l'image principale
    if (!mainImageFile) {
        e.preventDefault();
        alert('Veuillez sélectionner une image principale pour le produit');
        return;
    }

    // Vérifier le prix
    const priceInput = document.getElementById('price');
    const oldPriceInput = document.getElementById('old_price');

    if (parseFloat(priceInput.value) <= 0) {
        e.preventDefault();
        alert('Le prix de vente doit être supérieur à 0');
        priceInput.focus();
        return;
    }

    if (oldPriceInput.value && parseFloat(oldPriceInput.value) <= parseFloat(priceInput.value)) {
        e.preventDefault();
        alert('Le prix d\'origine doit être supérieur au prix de vente');
        oldPriceInput.focus();
        return;
    }

    // Confirmation
    if (!confirm('Êtes-vous sûr de vouloir créer ce produit ?')) {
        e.preventDefault();
    }
});

// Calcul automatique de réduction
document.getElementById('price').addEventListener('input', updateDiscount);
document.getElementById('old_price').addEventListener('input', updateDiscount);

function updateDiscount() {
    const price = parseFloat(document.getElementById('price').value) || 0;
    const oldPrice = parseFloat(document.getElementById('old_price').value) || 0;

    if (oldPrice > price && oldPrice > 0) {
        const discount = ((oldPrice - price) / oldPrice * 100).toFixed(1);
        const discountBadge = document.getElementById('discountBadge') || createDiscountBadge();
        discountBadge.textContent = `-${discount}%`;
    } else {
        const discountBadge = document.getElementById('discountBadge');
        if (discountBadge) discountBadge.remove();
    }
}

function createDiscountBadge() {
    const priceGroup = document.getElementById('price').parentNode;
    const badge = document.createElement('span');
    badge.id = 'discountBadge';
    badge.className = 'badge bg-danger position-absolute top-0 end-0 mt-2 me-2';
    badge.style.transform = 'translateY(-100%)';
    priceGroup.style.position = 'relative';
    priceGroup.appendChild(badge);
    return badge;
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    setupCounters();
    updateDiscount();

    // Prévenir la fermeture de la page si formulaire rempli
    window.addEventListener('beforeunload', function(e) {
        const form = document.getElementById('productForm');
        let hasData = false;

        ['name', 'price', 'short_description', 'description'].forEach(id => {
            if (document.getElementById(id).value.trim()) hasData = true;
        });

        if (mainImageFile || hasData) {
            e.preventDefault();
            e.returnValue = 'Vous avez des modifications non enregistrées. Êtes-vous sûr de vouloir quitter ?';
        }
    });
});
</script>
@endpush
