@extends('adminlte::page')

@section('title', 'Modifier produit')

@section('content_header')
<h1>Modifier produit</h1>
@stop

@section('content')
<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nom</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>
    <div class="form-group">
        <label>Partenaire</label>
        <select name="partner_id" class="form-control" required>
            <option value="">-- Choisir --</option>
            @foreach($partners as $partner)
                <option value="{{ $partner->id }}" {{ $product->partner_id == $partner->id ? 'selected' : '' }}>{{ $partner->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Prix</label>
        <input type="number" name="price" class="form-control" step="0.01" value="{{ $product->price }}">
    </div>
    <div class="form-group">
        <label>Stock</label>
        <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
    </div>
    <div class="form-group">
        <label>Catégorie</label>
        <input type="text" name="category" class="form-control" value="{{ $product->category }}">
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
    </div>
    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
        @if($product->image)
            <img src="{{ asset('StockPiece/products/'.$product->image) }}" width="100" class="mt-2">
        @endif
    </div>
    <div class="form-group form-check">
        <input type="checkbox" name="is_sponsored" class="form-check-input" id="isSponsored" {{ $product->is_sponsored ? 'checked' : '' }}>
        <label class="form-check-label" for="isSponsored">Produit sponsorisé</label>
    </div>
    <button class="btn btn-primary">Mettre à jour</button>
</form>
@stop
