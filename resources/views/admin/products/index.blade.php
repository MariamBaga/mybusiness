@extends('adminlte::page')

@section('title', 'Produits')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Produits</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Créer un produit
        </a>
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Partenaire</th>
                    <th>Catégorie</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                   <td>
    @if($product->image)
        <img src="{{ asset('StockPiece/products/' . $product->image) }}"
             alt="{{ $product->name }}"
             width="50"
             height="50"
             class="img-thumbnail">
    @else
        <span class="text-muted">Aucune image</span>
    @endif
</td>
                    <td>
                        <strong>{{ $product->name }}</strong>
                        @if($product->is_featured)
                            <span class="badge badge-warning ml-2">En vedette</span>
                        @endif
                        @if($product->is_sponsored)
                            <span class="badge badge-info ml-2">Sponsorisé</span>
                        @endif
                    </td>
                    <td>{{ $product->partner->name ?? 'N/A' }}</td>
                    <td>{{ $product->category->name ?? 'Non catégorisé' }}</td>
                    <td>
                        <strong>{{ number_format($product->price, 2, ',', ' ') }} €</strong>
                        @if($product->old_price)
                            <br><small class="text-muted"><s>{{ number_format($product->old_price, 2, ',', ' ') }} €</s></small>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $product->stock > 10 ? 'badge-success' : ($product->stock > 0 ? 'badge-warning' : 'badge-danger') }}">
                            {{ $product->stock }} unités
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $product->status ? 'badge-success' : 'badge-secondary' }}">
                            {{ $product->status ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('products.show', $product->slug) }}"
                               class="btn btn-sm btn-info"
                               title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product->slug) }}"
                               class="btn btn-sm btn-warning"
                               title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->slug) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">
                        Aucun produit trouvé. <a href="{{ route('products.create') }}">Créer le premier produit</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .img-thumbnail {
        object-fit: cover;
    }
    .badge {
        font-size: 0.85em;
    }
    .btn-group .btn {
        margin-right: 5px;
    }
    .btn-group .btn:last-child {
        margin-right: 0;
    }
</style>
@stop
