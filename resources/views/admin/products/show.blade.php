@extends('adminlte::page')

@section('title', $product->name)

@section('content_header')
    <h1>Détails du produit : {{ $product->name }}</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produits</a></li>
        <li class="breadcrumb-item active">Détails</li>
    </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Informations générales</h3>
                    <div>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Image et statuts -->
                        <div class="text-center mb-4">
                           @if($product->image)
    <img src="{{ asset('StockPiece/products/' . $product->image) }}"
         alt="{{ $product->name }}"
         class="img-fluid rounded shadow"
         style="max-height: 300px;">
@else
    <div class="bg-light rounded d-flex align-items-center justify-content-center"
         style="height: 300px;">
        <span class="text-muted">Aucune image</span>
    </div>
@endif
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Statuts</h5>
                                <div class="mb-2">
                                    <span class="badge {{ $product->status ? 'badge-success' : 'badge-secondary' }} p-2">
                                        {{ $product->status ? 'Actif' : 'Inactif' }}
                                    </span>
                                </div>
                                @if($product->is_featured)
                                    <div class="mb-2">
                                        <span class="badge badge-warning p-2">
                                            <i class="fas fa-star"></i> En vedette
                                        </span>
                                    </div>
                                @endif
                                @if($product->is_sponsored)
                                    <div class="mb-2">
                                        <span class="badge badge-info p-2">
                                            <i class="fas fa-ad"></i> Sponsorisé
                                        </span>
                                    </div>
                                @endif

                                <div class="mt-3">
                                    <strong>Stock :</strong>
                                    <span class="badge {{ $product->stock > 10 ? 'badge-success' : ($product->stock > 0 ? 'badge-warning' : 'badge-danger') }} p-2">
                                        {{ $product->stock }} unités
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Informations de base -->
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Informations de base</h5>
                                <table class="table table-sm">
                                    <tr>
                                        <th>ID :</th>
                                        <td>{{ $product->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>SKU :</th>
                                        <td>{{ $product->sku ?? 'Non défini' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Partenaire :</th>
                                        <td>{{ $product->partner->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Catégorie :</th>
                                        <td>{{ $product->category->name ?? 'Non catégorisé' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Créé le :</th>
                                        <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Modifié le :</th>
                                        <td>{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <!-- Détails du produit -->
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">{{ $product->name }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h5 class="text-muted">Prix actuel</h5>
                                                <h3 class="text-success">{{ number_format($product->price, 2, ',', ' ') }} €</h3>
                                                @if($product->old_price)
                                                    <h6 class="text-muted">
                                                        <s>Ancien prix : {{ number_format($product->old_price, 2, ',', ' ') }} €</s>
                                                    </h6>
                                                    <span class="badge badge-danger">
                                                        Économisez {{ number_format($product->old_price - $product->price, 2, ',', ' ') }} €
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h5 class="text-muted">Dimensions et poids</h5>
                                                <p class="mb-1">
                                                    <strong>Dimensions :</strong> {{ $product->dimensions ?? 'Non spécifié' }}
                                                </p>
                                                <p class="mb-0">
                                                    <strong>Poids :</strong> {{ $product->weight ? $product->weight . ' kg' : 'Non spécifié' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-4">
                                    <h5>Description courte</h5>
                                    <div class="p-3 bg-light rounded">
                                        {{ $product->short_description ?? 'Aucune description courte' }}
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h5>Description complète</h5>
                                    <div class="p-3 bg-light rounded">
                                        {!! nl2br(e($product->description ?? 'Aucune description')) !!}
                                    </div>
                                </div>

                                <!-- Spécifications -->
                                @if($product->specifications && count($product->specifications) > 0)
                                    <div class="mb-4">
                                        <h5>Spécifications</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Caractéristique</th>
                                                        <th>Valeur</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($product->specifications as $key => $value)
                                                        <tr>
                                                            <td><strong>{{ $key }}</strong></td>
                                                            <td>{{ $value }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Actions rapides -->
                        <div class="card mt-3">
                            <div class="card-body text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ? Cette action est irréversible.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                    <a href="{{ route('products.index') }}" class="btn btn-default">
                                        <i class="fas fa-list"></i> Liste des produits
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .badge {
        font-size: 1em;
        padding: 0.5em 1em;
    }
    .card {
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .card-header {
        border-bottom: 2px solid rgba(0,0,0,0.1);
    }
</style>
@stop

@section('js')
<script>
    // Confirmation de suppression
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer ce produit ? Cette action est irréversible.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@stop
