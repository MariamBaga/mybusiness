@extends('adminlte::page')

@section('title', 'Produits')

@section('content_header')
    <h1>Produits</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Créer un produit</a>
@stop

@section('content')
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th><th>Nom</th><th>Partenaire</th><th>Prix</th><th>Stock</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->partner->name ?? 'N/A' }}</td>
            <td>{{ $product->price ?? 'N/A' }}</td>
            <td>{{ $product->stock ?? 0 }}</td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce produit ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $products->links() }}
@stop
