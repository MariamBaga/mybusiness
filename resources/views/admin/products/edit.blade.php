@extends('adminlte::page')

@section('title', 'Modifier le produit')

@section('content_header')
    <h1>Modifier le produit : {{ $product->name }}</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produits</a></li>
        <li class="breadcrumb-item active">Modifier</li>
    </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulaire de modification</h3>
            </div>
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Informations de base -->
                            <div class="card">
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
                                               value="{{ old('name', $product->name) }}"
                                               required>
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
                                                        <option value="{{ $partner->id }}" {{ old('partner_id', $product->partner_id) == $partner->id ? 'selected' : '' }}>
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
                                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                                                  rows="3">{{ old('short_description', $product->short_description) }}</textarea>
                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description complète</label>
                                        <textarea name="description"
                                                  id="description"
                                                  class="form-control @error('description') is-invalid @enderror"
                                                  rows="5">{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Prix et stock -->
                            <div class="card mt-3">
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
                                                           value="{{ old('price', $product->price) }}"
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
                                                           value="{{ old('old_price', $product->old_price) }}">
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
                                                       value="{{ old('stock', $product->stock) }}"
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
                                                       value="{{ old('sku', $product->sku) }}">
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
                                                           value="{{ old('weight', $product->weight) }}">
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
                                               value="{{ old('dimensions', $product->dimensions) }}"
                                               placeholder="ex: 20x15x10">
                                        @error('dimensions')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Spécifications -->
                            <div class="card mt-3">
                                <div class="card-header bg-info text-white">
                                    Spécifications
                                </div>
                                <div class="card-body">
                                    <div id="specifications-container">
                                        @php
                                            $specifications = old('specifications', $product->specifications ?? []);
                                            $keys = $specifications['key'] ?? [];
                                            $values = $specifications['value'] ?? [];
                                        @endphp

                                        @if(count($keys) > 0)
                                            @for($i = 0; $i < count($keys); $i++)
                                                <div class="row specification-row">
                                                    <div class="col-md-5">
                                                        <input type="text"
                                                               name="specifications[key][]"
                                                               class="form-control"
                                                               value="{{ $keys[$i] }}"
                                                               placeholder="Clé (ex: Couleur)">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text"
                                                               name="specifications[value][]"
                                                               class="form-control"
                                                               value="{{ $values[$i] }}"
                                                               placeholder="Valeur (ex: Rouge)">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button"
                                                                class="btn btn-danger btn-remove-spec">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endfor
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
                            <div class="card">
                                <div class="card-header bg-warning text-white">
                                    Image du produit
                                </div>
                                <div class="card-body text-center">
                                    <div class="form-group">
                                        <div class="image-preview mb-3">
                                            @if($product->image)
    <img src="{{ asset('StockPiece/products/'.$product->image) }}"
         width="100"
         class="mt-2 img-thumbnail">
@endif
                                                
                                        </div>
                                        <label for="image">Nouvelle image</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                   name="image"
                                                   id="image"
                                                   class="custom-file-input @error('image') is-invalid @enderror"
                                                   accept="image/jpeg,image/png,image/jpg">
                                            <label class="custom-file-label" for="image">Changer l'image</label>
                                        </div>
                                        <small class="form-text text-muted">
                                            Formats acceptés: JPG, JPEG, PNG. Max: 2MB
                                        </small>
                                        @error('image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        @if($product->image)
                                            <div class="mt-2">
                                                <small class="text-muted">
                                                    Image actuelle : {{ $product->image }}
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Options -->
                            <div class="card mt-3">
                                <div class="card-header bg-secondary text-white">
                                    Options
                                </div>
                                <div class="card-body">
                                    <div class="form-check mb-3">
                                        <input type="checkbox"
                                               name="status"
                                               id="status"
                                               class="form-check-input"
                                               {{ old('status', $product->status) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status">
                                            Produit actif
                                        </label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input type="checkbox"
                                               name="is_featured"
                                               id="is_featured"
                                               class="form-check-input"
                                               {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Produit en vedette
                                        </label>
                                        <small class="form-text text-muted d-block">
                                            Ce produit apparaîtra en avant
                                        </small>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox"
                                               name="is_sponsored"
                                               id="is_sponsored"
                                               class="form-check-input"
                                               {{ old('is_sponsored', $product->is_sponsored) ? 'checked' : '' }}>
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
                            <div class="card mt-3">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-save"></i> Mettre à jour
                                    </button>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-block">
                                        <i class="fas fa-eye"></i> Voir le produit
                                    </a>
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

@section('js')
<script>
    // Aperçu de l'image
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('image-preview');
        const label = document.querySelector('.custom-file-label');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
            label.textContent = file.name;
        }
    });

    // Gestion des spécifications
    document.getElementById('add-specification').addEventListener('click', function() {
        const container = document.getElementById('specifications-container');
        const newRow = document.querySelector('.specification-row').cloneNode(true);

        // Réinitialiser les valeurs
        newRow.querySelectorAll('input').forEach(input => input.value = '');

        // Afficher le bouton de suppression
        newRow.querySelector('.btn-remove-spec').style.display = 'block';

        container.appendChild(newRow);
    });

    // Suppression d'une spécification
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-remove-spec') || e.target.closest('.btn-remove-spec')) {
            const btn = e.target.closest('.btn-remove-spec');
            const row = btn.closest('.specification-row');
            if (document.querySelectorAll('.specification-row').length > 1) {
                row.remove();
            }
        }
    });

    // Validation des prix
    document.getElementById('price').addEventListener('change', function() {
        const oldPrice = document.getElementById('old_price');
        if (oldPrice.value && parseFloat(oldPrice.value) <= parseFloat(this.value)) {
            alert('L\'ancien prix doit être supérieur au prix actuel');
            oldPrice.value = '';
        }
    });

    document.getElementById('old_price').addEventListener('change', function() {
        const currentPrice = document.getElementById('price');
        if (this.value && parseFloat(this.value) <= parseFloat(currentPrice.value)) {
            alert('L\'ancien prix doit être supérieur au prix actuel');
            this.value = '';
        }
    });
</script>

@if($errors->any())
<script>
    $(document).ready(function() {
        toastr.error('Veuillez corriger les erreurs dans le formulaire.');
    });
</script>
@endif
@stop
