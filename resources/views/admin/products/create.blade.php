@extends('adminlte::page')

@section('title', 'Créer un produit')

@section('content_header')
    <h1>Créer un produit</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produits</a></li>
        <li class="breadcrumb-item active">Créer</li>
    </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulaire de création</h3>
            </div>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf
                <div class="card-body">

                    <!-- Afficher toutes les erreurs en haut du formulaire -->
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5><i class="icon fas fa-ban"></i> Erreurs dans le formulaire</h5>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-8">
                            <!-- Informations de base -->
                            <div class="card" id="basicInfoCard">
                                <div class="card-header bg-primary text-white">
                                    Informations de base
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nom du produit *</label>
                                        <input type="text"
                                               name="name"
                                               id="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}"
                                               required
                                               autofocus>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="partner_id">Partenaire *</label>
                                                <select name="partner_id"
                                                        id="partner_id"
                                                        class="form-control @error('partner_id') is-invalid @enderror"
                                                        required>
                                                    <option value="">-- Sélectionner un partenaire --</option>
                                                    @foreach($partners as $partner)
                                                        <option value="{{ $partner->id }}" {{ old('partner_id') == $partner->id ? 'selected' : '' }}>
                                                            {{ $partner->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('partner_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category_id">Catégorie</label>
                                                <select name="category_id"
                                                        id="category_id"
                                                        class="form-control @error('category_id') is-invalid @enderror">
                                                    <option value="">-- Sans catégorie --</option>
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

                                    <div class="form-group">
                                        <label for="short_description">Description courte</label>
                                        <textarea name="short_description"
                                                  id="short_description"
                                                  class="form-control @error('short_description') is-invalid @enderror"
                                                  rows="3"
                                                  maxlength="255">{{ old('short_description') }}</textarea>
                                        <small class="text-muted float-right"><span id="short_desc_counter">0</span>/255</small>
                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description complète</label>
                                        <textarea name="description"
                                                  id="description"
                                                  class="form-control @error('description') is-invalid @enderror"
                                                  rows="5">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Prix et stock -->
                            <div class="card mt-3" id="priceStockCard">
                                <div class="card-header bg-success text-white">
                                    Prix et stock
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="price">Prix *</label>
                                                <div class="input-group">
                                                    <input type="number"
                                                           name="price"
                                                           id="price"
                                                           class="form-control @error('price') is-invalid @enderror"
                                                           step="0.01"
                                                           min="0"
                                                           value="{{ old('price') }}"
                                                           required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">€</span>
                                                    </div>
                                                </div>
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="old_price">Ancien prix</label>
                                                <div class="input-group">
                                                    <input type="number"
                                                           name="old_price"
                                                           id="old_price"
                                                           class="form-control @error('old_price') is-invalid @enderror"
                                                           step="0.01"
                                                           min="0"
                                                           value="{{ old('old_price') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">€</span>
                                                    </div>
                                                </div>
                                                @error('old_price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="stock">Stock *</label>
                                                <input type="number"
                                                       name="stock"
                                                       id="stock"
                                                       class="form-control @error('stock') is-invalid @enderror"
                                                       min="0"
                                                       value="{{ old('stock', 0) }}"
                                                       required>
                                                @error('stock')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sku">SKU (Référence)</label>
                                                <input type="text"
                                                       name="sku"
                                                       id="sku"
                                                       class="form-control @error('sku') is-invalid @enderror"
                                                       value="{{ old('sku') }}">
                                                @error('sku')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="weight">Poids (kg)</label>
                                                <div class="input-group">
                                                    <input type="number"
                                                           name="weight"
                                                           id="weight"
                                                           class="form-control @error('weight') is-invalid @enderror"
                                                           step="0.01"
                                                           min="0"
                                                           value="{{ old('weight') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">kg</span>
                                                    </div>
                                                </div>
                                                @error('weight')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="dimensions">Dimensions (L x l x H)</label>
                                        <input type="text"
                                               name="dimensions"
                                               id="dimensions"
                                               class="form-control @error('dimensions') is-invalid @enderror"
                                               value="{{ old('dimensions') }}"
                                               placeholder="ex: 20x15x10">
                                        @error('dimensions')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Spécifications -->
                            <div class="card mt-3" id="specificationsCard">
                                <div class="card-header bg-info text-white">
                                    Spécifications <small class="float-right">(Optionnel)</small>
                                </div>
                                <div class="card-body">
                                    <div id="specifications-container">
                                        @php
                                            $specKeys = old('specifications.key', []);
                                            $specValues = old('specifications.value', []);
                                        @endphp

                                        @if(count($specKeys) > 0)
                                            @foreach($specKeys as $index => $key)
                                                <div class="row specification-row">
                                                    <div class="col-md-5">
                                                        <input type="text"
                                                               name="specifications[key][]"
                                                               class="form-control"
                                                               value="{{ $key }}"
                                                               placeholder="Clé (ex: Couleur)">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text"
                                                               name="specifications[value][]"
                                                               class="form-control"
                                                               value="{{ $specValues[$index] ?? '' }}"
                                                               placeholder="Valeur (ex: Rouge)">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button"
                                                                class="btn btn-danger btn-remove-spec">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row specification-row">
                                                <div class="col-md-5">
                                                    <input type="text"
                                                           name="specifications[key][]"
                                                           class="form-control"
                                                           placeholder="Clé (ex: Couleur)">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text"
                                                           name="specifications[value][]"
                                                           class="form-control"
                                                           placeholder="Valeur (ex: Rouge)">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                            class="btn btn-danger btn-remove-spec"
                                                            style="display: none;">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button"
                                            id="add-specification"
                                            class="btn btn-sm btn-secondary mt-2">
                                        <i class="fas fa-plus"></i> Ajouter une spécification
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Image -->
                            <div class="card" id="imageCard">
                                <div class="card-header bg-warning text-white">
                                    Image du produit
                                </div>
                                <div class="card-body text-center">
                                    <div class="form-group">
                                        <div class="image-preview mb-3">
                                            <img id="image-preview"
                                                 src="{{ asset('adminlte/dist/img/default-product.png') }}"
                                                 alt="Aperçu de l'image"
                                                 class="img-fluid img-thumbnail"
                                                 style="max-height: 300px; object-fit: cover;">
                                        </div>
                                        <label for="image">Image *</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                   name="image"
                                                   id="image"
                                                   class="custom-file-input @error('image') is-invalid @enderror"
                                                   accept=".jpg,.jpeg,.png"
                                                   required>
                                            <label class="custom-file-label" for="image" id="image-label">
                                                Choisir une image
                                            </label>
                                        </div>
                                        <small class="form-text text-muted">
                                            Formats acceptés: JPG, JPEG, PNG. Max: 2MB
                                        </small>
                                        @error('image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <div id="image-loading" class="d-none mt-2">
                                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                                <span class="sr-only">Chargement...</span>
                                            </div>
                                            <small class="text-muted ml-2">Chargement de l'image...</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Options -->
                            <div class="card mt-3" id="optionsCard">
                                <div class="card-header bg-secondary text-white">
                                    Options
                                </div>
                                <div class="card-body">
                                    <div class="form-check mb-3">
                                        <input type="hidden" name="status" value="0">
                                        <input type="checkbox"
                                               name="status"
                                               id="status"
                                               class="form-check-input"
                                               value="1"
                                               {{ old('status', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status">
                                            Produit actif
                                        </label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input type="hidden" name="is_featured" value="0">
                                        <input type="checkbox"
                                               name="is_featured"
                                               id="is_featured"
                                               class="form-check-input"
                                               value="1"
                                               {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Produit en vedette
                                        </label>
                                        <small class="form-text text-muted d-block">
                                            Ce produit apparaîtra en avant
                                        </small>
                                    </div>

                                    <div class="form-check">
                                        <input type="hidden" name="is_sponsored" value="0">
                                        <input type="checkbox"
                                               name="is_sponsored"
                                               id="is_sponsored"
                                               class="form-check-input"
                                               value="1"
                                               {{ old('is_sponsored') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_sponsored">
                                            Produit sponsorisé
                                        </label>
                                        <small class="form-text text-muted d-block">
                                            Ce produit sera mis en avant par du sponsoring
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="card mt-3" id="actionsCard">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-success btn-block" id="submitBtn">
                                        <i class="fas fa-save"></i> Créer le produit
                                    </button>
                                    <a href="{{ route('products.index') }}" class="btn btn-default btn-block">
                                        <i class="fas fa-arrow-left"></i> Annuler
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@push('css')
<style>
    .card-header {
        font-weight: bold;
    }
    .image-preview img {
        max-height: 300px;
        object-fit: cover;
        transition: opacity 0.3s ease;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
    }
    .image-preview img.loading {
        opacity: 0.5;
    }
    .specification-row {
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
        transition: all 0.3s ease;
    }
    .specification-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    .custom-file-label::after {
        content: "Parcourir";
    }
    .alert-danger ul {
        margin-bottom: 0;
    }
    .alert-danger li {
        font-size: 0.9em;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@push('scripts')
<script>
// Attendre que le DOM soit chargé
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM chargé - initialisation du formulaire produit');

    // ==================== GESTION DE L'IMAGE ====================
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    const imageLabel = document.getElementById('image-label');
    const imageLoading = document.getElementById('image-loading');

    if (imageInput && imagePreview) {
        console.log('Initialisation du gestionnaire d\'image');

        // Gestion du changement de fichier
        imageInput.addEventListener('change', function(e) {
            console.log('Fichier image sélectionné');
            const file = e.target.files[0];

            if (!file) {
                console.log('Aucun fichier sélectionné');
                imageLabel.textContent = 'Choisir une image';
                imagePreview.src = "{{ asset('adminlte/dist/img/default-product.png') }}";
                return;
            }

            console.log('Fichier sélectionné:', file.name, file.type, file.size);

            // Vérification du type de fichier
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!validTypes.includes(file.type)) {
                alert('Type de fichier non autorisé. Veuillez sélectionner une image JPG, JPEG ou PNG.');
                this.value = '';
                imageLabel.textContent = 'Choisir une image';
                imagePreview.src = "{{ asset('adminlte/dist/img/default-product.png') }}";
                return;
            }

            // Vérification de la taille (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                alert('Le fichier est trop volumineux. La taille maximale autorisée est de 2MB.');
                this.value = '';
                imageLabel.textContent = 'Choisir une image';
                imagePreview.src = "{{ asset('adminlte/dist/img/default-product.png') }}";
                return;
            }

            // Mettre à jour le label
            imageLabel.textContent = file.name;

            // Afficher l'indicateur de chargement
            if (imageLoading) {
                imageLoading.classList.remove('d-none');
                imagePreview.classList.add('loading');
            }

            // Créer un aperçu de l'image
            const reader = new FileReader();

            reader.onload = function(e) {
                console.log('Image chargée avec succès');
                imagePreview.src = e.target.result;

                // Masquer l'indicateur de chargement
                if (imageLoading) {
                    setTimeout(() => {
                        imageLoading.classList.add('d-none');
                        imagePreview.classList.remove('loading');
                    }, 500);
                }
            };

            reader.onerror = function() {
                console.error('Erreur lors de la lecture du fichier');
                alert('Erreur lors de la lecture du fichier image. Veuillez réessayer.');
                imageInput.value = '';
                imageLabel.textContent = 'Choisir une image';
                imagePreview.src = "{{ asset('adminlte/dist/img/default-product.png') }}";

                if (imageLoading) {
                    imageLoading.classList.add('d-none');
                    imagePreview.classList.remove('loading');
                }
            };

            reader.readAsDataURL(file);
        });

        // Gestion du drag & drop (optionnel)
        imagePreview.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = '#007bff';
            this.style.backgroundColor = '#e9ecef';
        });

        imagePreview.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#dee2e6';
            this.style.backgroundColor = '#f8f9fa';
        });

        imagePreview.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#dee2e6';
            this.style.backgroundColor = '#f8f9fa';

            if (e.dataTransfer.files.length) {
                imageInput.files = e.dataTransfer.files;
                const event = new Event('change', { bubbles: true });
                imageInput.dispatchEvent(event);
            }
        });
    }

    // ==================== COMPTEUR DE CARACTÈRES ====================
    const shortDescTextarea = document.getElementById('short_description');
    const shortDescCounter = document.getElementById('short_desc_counter');

    if (shortDescTextarea && shortDescCounter) {
        // Initialiser le compteur avec la valeur existante
        shortDescCounter.textContent = shortDescTextarea.value.length;

        // Mettre à jour le compteur lors de la saisie
        shortDescTextarea.addEventListener('input', function() {
            const length = this.value.length;
            shortDescCounter.textContent = length;

            // Changer la couleur selon la longueur
            if (length > 250) {
                shortDescCounter.classList.add('text-warning');
                shortDescCounter.classList.remove('text-danger');
            } else if (length > 255) {
                shortDescCounter.classList.remove('text-warning');
                shortDescCounter.classList.add('text-danger');
                // Tronquer à 255 caractères
                this.value = this.value.substring(0, 255);
                shortDescCounter.textContent = 255;
            } else {
                shortDescCounter.classList.remove('text-warning', 'text-danger');
            }
        });
    }

    // ==================== GESTION DES SPÉCIFICATIONS ====================
    const addSpecBtn = document.getElementById('add-specification');
    const specsContainer = document.getElementById('specifications-container');

    if (addSpecBtn && specsContainer) {
        // Fonction pour ajouter une ligne de spécification
        function addSpecificationRow(key = '', value = '') {
            const newRow = document.createElement('div');
            newRow.className = 'row specification-row';
            newRow.innerHTML = `
                <div class="col-md-5">
                    <input type="text"
                           name="specifications[key][]"
                           class="form-control"
                           value="${key}"
                           placeholder="Clé (ex: Couleur)">
                </div>
                <div class="col-md-5">
                    <input type="text"
                           name="specifications[value][]"
                           class="form-control"
                           value="${value}"
                           placeholder="Valeur (ex: Rouge)">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-remove-spec">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;

            specsContainer.appendChild(newRow);
            updateRemoveButtons();

            // Focus sur le premier champ de la nouvelle ligne
            setTimeout(() => {
                const firstInput = newRow.querySelector('input');
                if (firstInput) firstInput.focus();
            }, 10);

            return newRow;
        }

        // Événement pour ajouter une spécification
        addSpecBtn.addEventListener('click', function() {
            console.log('Ajout d\'une spécification');
            addSpecificationRow();
        });

        // Événement pour supprimer une spécification (délégation)
        specsContainer.addEventListener('click', function(e) {
            if (e.target.closest('.btn-remove-spec')) {
                console.log('Suppression d\'une spécification');
                const row = e.target.closest('.specification-row');
                const rows = specsContainer.querySelectorAll('.specification-row');

                if (rows.length > 1) {
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(20px)';

                    setTimeout(() => {
                        row.remove();
                        updateRemoveButtons();
                    }, 300);
                }
            }
        });

        // Fonction pour mettre à jour la visibilité des boutons de suppression
        function updateRemoveButtons() {
            const rows = specsContainer.querySelectorAll('.specification-row');
            rows.forEach((row, index) => {
                const removeBtn = row.querySelector('.btn-remove-spec');
                if (removeBtn) {
                    removeBtn.style.display = rows.length > 1 ? 'block' : 'none';
                }
            });
        }

        // Initialiser les boutons de suppression
        updateRemoveButtons();
    }

    // ==================== VALIDATION DES PRIX ====================
    const priceInput = document.getElementById('price');
    const oldPriceInput = document.getElementById('old_price');

    function validatePrices() {
        if (priceInput && oldPriceInput) {
            const price = parseFloat(priceInput.value) || 0;
            const oldPrice = parseFloat(oldPriceInput.value) || 0;

            // Réinitialiser les erreurs
            oldPriceInput.classList.remove('is-invalid');
            const existingError = oldPriceInput.parentNode.querySelector('.invalid-feedback');
            if (existingError) existingError.remove();

            // Valider si l'ancien prix est inférieur ou égal au prix actuel
            if (oldPrice > 0 && oldPrice <= price) {
                oldPriceInput.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback';
                errorDiv.textContent = 'L\'ancien prix doit être supérieur au prix actuel';
                oldPriceInput.parentNode.appendChild(errorDiv);
            }
        }
    }

    if (priceInput) {
        priceInput.addEventListener('input', validatePrices);
    }

    if (oldPriceInput) {
        oldPriceInput.addEventListener('input', validatePrices);
    }

    // ==================== VALIDATION DU FORMULAIRE ====================
    const productForm = document.getElementById('productForm');
    const submitBtn = document.getElementById('submitBtn');

    if (productForm && submitBtn) {
        productForm.addEventListener('submit', function(e) {
            console.log('Soumission du formulaire');

            // Validation des champs obligatoires
            const requiredFields = productForm.querySelectorAll('[required]');
            let hasError = false;

            requiredFields.forEach(field => {
                // Réinitialiser les erreurs
                field.classList.remove('is-invalid');
                const existingError = field.parentNode.querySelector('.invalid-feedback');
                if (existingError) existingError.remove();

                // Vérifier si le champ est vide
                if (!field.value.trim()) {
                    hasError = true;
                    field.classList.add('is-invalid');

                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback';
                    errorDiv.textContent = 'Ce champ est obligatoire';
                    field.parentNode.appendChild(errorDiv);

                    // Scroll vers le premier champ invalide
                    if (!productForm.querySelector('.scroll-done')) {
                        field.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        productForm.classList.add('scroll-done');
                    }
                }
            });

            // Vérification spécifique de l'image
            const imageField = document.getElementById('image');
            if (imageField && !imageField.files.length) {
                hasError = true;
                imageField.classList.add('is-invalid');

                if (!imageField.parentNode.querySelector('.invalid-feedback')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback';
                    errorDiv.textContent = 'Veuillez sélectionner une image';
                    imageField.parentNode.appendChild(errorDiv);
                }
            }

            // Empêcher la soumission si erreur
            if (hasError) {
                e.preventDefault();
                console.log('Erreurs de validation détectées');

                // Afficher un message d'erreur
                if (typeof toastr !== 'undefined') {
                    toastr.error('Veuillez corriger les erreurs dans le formulaire.', 'Erreur de validation');
                } else {
                    alert('Veuillez remplir tous les champs obligatoires correctement.');
                }

                return false;
            }

            // Désactiver le bouton pour éviter les doubles clics
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Création en cours...';

            console.log('Formulaire valide, soumission en cours...');
            return true;
        });
    }

    // ==================== GESTION DES ERREURS SERVEUR ====================
    @if($errors->any())
    console.log('Erreurs serveur détectées:', {!! json_encode($errors->all()) !!});

    // Scroll vers la première erreur
    setTimeout(function() {
        const firstError = document.querySelector('.is-invalid');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // Afficher un toast d'erreur si disponible
        if (typeof toastr !== 'undefined') {
            toastr.error('Veuillez corriger les erreurs dans le formulaire.', 'Erreur de validation');
        }
    }, 500);
    @endif

    // ==================== LOGS DE DÉBOGAGE ====================
    console.log('Formulaire produit initialisé avec succès');
});
</script>
@endpush
