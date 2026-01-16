@extends('layouts.master')

@section('title', 'Modifier le produit - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Modifier le produit',
        'parent' => 'Produits',
        'parent_url' => route('partner.products.index'),
        'active' => $product->name
    ])
</section>

<!-- =========================
    FORMULAIRE DE MODIFICATION
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Modifier le produit
                        </h4>
                    </div>

                    <div class="card-body p-4">
                        <!-- Statistiques rapides -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="text-muted">Vues</h6>
                                    <h3 class="text-primary">{{ $product->views ?? 0 }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="text-muted">Clics</h6>
                                    <h3 class="text-success">{{ $product->clicks ?? 0 }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="text-muted">CTR</h6>
                                    <h3 class="text-info">
                                        {{ $product->views > 0 ? round(($product->clicks / $product->views) * 100, 2) : 0 }}%
                                    </h3>
                                </div>
                            </div>
                        </div>

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

                        <form action="{{ route('partner.products.update', $product) }}" method="POST" enctype="multipart/form-data" id="productForm">
                            @csrf
                            @method('PUT')

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
                                                   value="{{ old('name', $product->name) }}"
                                                   required
                                                   maxlength="255"
                                                   placeholder="Ex: Smartphone XYZ">
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted float-end">
                                                <span id="nameCounter">{{ strlen($product->name) }}/255</span>
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Slug (lecture seule) -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="slug" class="form-label fw-bold">
                                                URL du produit
                                            </label>
                                            <input type="text"
                                                   id="slug"
                                                   class="form-control bg-light"
                                                   value="{{ $product->slug }}"
                                                   readonly>
                                            <small class="form-text text-muted">
                                                Généré automatiquement
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
                                                   value="{{ old('sku', $product->sku) }}"
                                                   placeholder="EXEMPLE-001">
                                            @error('sku')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
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
                                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
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
                                                   value="{{ old('price', $product->price) }}"
                                                   required
                                                   min="0"
                                                   step="0.01"
                                                   placeholder="Ex: 25000">
                                            @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
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
                                                   value="{{ old('old_price', $product->old_price) }}"
                                                   min="0"
                                                   step="0.01"
                                                   placeholder="Ex: 30000">
                                            @error('old_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
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
                                                   value="{{ old('stock', $product->stock) }}"
                                                   min="0"
                                                   placeholder="Ex: 100">
                                            @error('stock')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
                                            <small class="form-text text-muted">
                                                Actuellement: {{ $product->stock }} unités
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
                                                   value="{{ old('weight', $product->weight) }}"
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
                                                      placeholder="Description résumée du produit...">{{ old('short_description', $product->short_description) }}</textarea>
                                            @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
                                            <small class="form-text text-muted float-end">
                                                <span id="shortDescCounter">{{ strlen($product->short_description ?? '') }}/255</span>
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
                                                      placeholder="Description complète du produit...">{{ old('description', $product->description) }}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
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
                                    <label for="image" class="form-label fw-bold">
                                        Image principale
                                    </label>

                                    <!-- Image actuelle -->
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center">
                                            @if($product->image)
                                            <div class="current-image me-3">
                                                <img src="{{ Storage::url($product->image) }}"
                                                     alt="{{ $product->name }}"
                                                     class="img-thumbnail"
                                                     width="150">
                                                <div class="mt-2">
                                                    <small class="text-muted">Image actuelle</small>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="flex-grow-1">
                                                <div class="upload-area @error('image') border-danger @enderror"
                                                     id="uploadArea">
                                                    <div class="upload-content text-center py-3">
                                                        <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                                        <p class="text-muted mb-2">Changer l'image principale</p>
                                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('image').click()">
                                                            <i class="fas fa-folder-open me-1"></i>Choisir une image
                                                        </button>
                                                        <p class="text-muted mt-2 mb-0">
                                                            Formats: JPG, PNG, WebP | Max: 5MB
                                                        </p>
                                                    </div>
                                                    <input type="file"
                                                           name="image"
                                                           id="image"
                                                           class="d-none"
                                                           accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror>

                                    <!-- Aperçu de la nouvelle image -->
                                    <div class="image-preview mt-3" id="imagePreview" style="display: none;">
                                        <div class="preview-wrapper">
                                            <h6>Nouvelle image :</h6>
                                            <img id="previewImage" class="img-fluid rounded border" style="max-height: 200px;">
                                            <div class="preview-actions mt-2">
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeNewImage()">
                                                    <i class="fas fa-trash me-1"></i>Annuler le changement
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Caractéristiques -->
                            <div class="mb-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-list text-primary me-2"></i>
                                    Caractéristiques
                                </h5>

                                <div id="specifications">
                                    @php
                                        $specifications = $product->specifications ? json_decode($product->specifications, true) : [];
                                        $specIndex = 0;
                                    @endphp

                                    @if(!empty($specifications))
                                        @foreach($specifications as $key => $value)
                                        <div class="specification-row mb-2">
                                            <div class="row g-2">
                                                <div class="col-md-5">
                                                    <input type="text"
                                                           name="specifications[{{ $specIndex }}][key]"
                                                           class="form-control form-control-sm"
                                                           value="{{ old("specifications.$specIndex.key", $key) }}"
                                                           placeholder="Ex: Couleur">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text"
                                                           name="specifications[{{ $specIndex }}][value]"
                                                           class="form-control form-control-sm"
                                                           value="{{ old("specifications.$specIndex.value", $value) }}"
                                                           placeholder="Ex: Noir">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="removeSpecification(this)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @php $specIndex++; @endphp
                                        @endforeach
                                    @else
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
                                    @endif
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
                                                   {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
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
                                                   {{ old('is_sponsored', $product->is_sponsored) ? 'checked' : '' }}>
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
                                                   {{ old('status', $product->status) ? 'checked' : '' }}>
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
                                                   value="{{ old('partner_contact_email', $product->partner_contact_email) }}">
                                            @error('partner_contact_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="partner_product_url" class="form-label fw-bold">
                                                URL du produit
                                            </label>
                                            <input type="url"
                                                   name="partner_product_url"
                                                   id="partner_product_url"
                                                   class="form-control @error('partner_product_url') is-invalid @enderror"
                                                   value="{{ old('partner_product_url', $product->partner_product_url) }}"
                                                   placeholder="https://www.example.com/produit">
                                            @error('partner_product_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="d-flex justify-content-between mt-4">
                                <div>
                                    <a href="{{ route('partner.products.index') }}" class="btn btn-outline-secondary me-2">
                                        <i class="fas fa-arrow-left me-2"></i>Annuler
                                    </a>
                                    <a href="{{ route('marketplace.show', $product->slug) }}"
                                       target="_blank"
                                       class="btn btn-outline-info">
                                        <i class="fas fa-external-link-alt me-2"></i>Voir sur le site
                                    </a>
                                </div>
                                <div>
                                    <button type="reset" class="btn btn-outline-danger me-2">
                                        <i class="fas fa-redo me-2"></i>Réinitialiser
                                    </button>
                                    <button type="submit" class="ht-btn style-2">
                                        <i class="fas fa-save me-2"></i>Enregistrer les modifications
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Actions supplémentaires -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <h5 class="mb-3">
                            <i class="fas fa-tools text-warning me-2"></i>
                            Actions supplémentaires
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <form action="{{ route('partner.products.duplicate', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary w-100">
                                        <i class="fas fa-copy me-2"></i>Dupliquer ce produit
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('partner.products.toggle-status', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-warning w-100">
                                        @if($product->status)
                                        <i class="fas fa-pause me-2"></i>Désactiver le produit
                                        @else
                                        <i class="fas fa-play me-2"></i>Activer le produit
                                        @endif
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('partner.product.stats', $product) }}" class="btn btn-outline-info w-100">
                                    <i class="fas fa-chart-line me-2"></i>Voir les statistiques
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('partner.products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-outline-danger w-100"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ? Cette action est irréversible.')">
                                        <i class="fas fa-trash me-2"></i>Supprimer le produit
                                    </button>
                                </form>
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

.current-image img {
    border: 2px solid #dee2e6;
    border-radius: 8px;
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
let newImageFile = null;
let specificationCount = {{ count($specifications ?? []) }};

// Gestion de l'image
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
        handleImageFile(files[0]);
    }
});

uploadArea.addEventListener('click', function() {
    imageInput.click();
});

imageInput.addEventListener('change', function(e) {
    if (this.files.length > 0) {
        handleImageFile(this.files[0]);
    }
});

function handleImageFile(file) {
    if (!validateImageFile(file)) return;

    newImageFile = file;

    const reader = new FileReader();
    reader.onload = function(e) {
        previewImage.src = e.target.result;
        imagePreview.style.display = 'block';
    };
    reader.readAsDataURL(file);
}

function removeNewImage() {
    newImageFile = null;
    imageInput.value = '';
    previewImage.src = '';
    imagePreview.style.display = 'none';
}

function validateImageFile(file) {
    if (!file.type.match('image.*')) {
        alert('Veuillez sélectionner une image valide (JPG, PNG, WebP)');
        return false;
    }

    if (file.size > 5 * 1024 * 1024) {
        alert('L\'image est trop volumineuse (max 5MB)');
        return false;
    }

    return true;
}

// Gestion des caractéristiques
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

    specRow.style.animation = 'slideIn 0.3s';
}

function removeSpecification(button) {
    const row = button.closest('.specification-row');
    row.style.animation = 'slideIn 0.3s reverse';
    setTimeout(() => {
        row.remove();
    }, 300);
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

// Calcul de réduction
function updateDiscount() {
    const price = parseFloat(document.getElementById('price').value) || 0;
    const oldPrice = parseFloat(document.getElementById('old_price').value) || 0;

    if (oldPrice > price && oldPrice > 0) {
        const discount = ((oldPrice - price) / oldPrice * 100).toFixed(1);
        let discountBadge = document.getElementById('discountBadge');

        if (!discountBadge) {
            discountBadge = createDiscountBadge();
        }

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

// Validation du formulaire
document.getElementById('productForm').addEventListener('submit', function(e) {
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

    // Confirmation si changements importants
    const nameChanged = document.getElementById('name').value !== "{{ $product->name }}";
    const priceChanged = document.getElementById('price').value !== "{{ $product->price }}";

    if (nameChanged || priceChanged) {
        if (!confirm('Êtes-vous sûr de vouloir modifier ce produit ?')) {
            e.preventDefault();
        }
    }
});

// Écouteurs pour la mise à jour de la réduction
document.getElementById('price').addEventListener('input', updateDiscount);
document.getElementById('old_price').addEventListener('input', updateDiscount);

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    setupCounters();
    updateDiscount();

    // Afficher le badge de réduction initial si nécessaire
    @if($product->old_price && $product->old_price > $product->price)
    updateDiscount();
    @endif

    // Prévenir la fermeture de la page si modifications
    window.addEventListener('beforeunload', function(e) {
        const form = document.getElementById('productForm');
        let hasChanges = false;

        // Vérifier les modifications
        const fields = ['name', 'price', 'old_price', 'stock', 'short_description', 'description'];
        fields.forEach(id => {
            const element = document.getElementById(id);
            const originalValue = "{{ old(id, $product->{str_replace('.', '_', id)}) }}";
            if (element && element.value !== originalValue) {
                hasChanges = true;
            }
        });

        if (newImageFile || hasChanges) {
            e.preventDefault();
            e.returnValue = 'Vous avez des modifications non enregistrées. Êtes-vous sûr de vouloir quitter ?';
        }
    });
});

// Génération automatique du slug à partir du nom
document.getElementById('name').addEventListener('blur', function() {
    if (!this.value) return;

    // Juste pour l'affichage, pas pour la modification
    const slugPreview = this.value
        .toLowerCase()
        .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim();

    // Montrer à l'utilisateur à quoi ressemblera le slug
    const slugInfo = document.getElementById('slugInfo') || createSlugInfo();
    slugInfo.textContent = `Le slug deviendra : ${slugPreview}`;
});

function createSlugInfo() {
    const info = document.createElement('small');
    info.id = 'slugInfo';
    info.className = 'form-text text-info';
    document.getElementById('name').parentNode.appendChild(info);
    return info;
}
</script>
@endpush
