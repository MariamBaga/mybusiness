@extends('adminlte::page')

@section('title', 'Créer un produit')

@section('content_header')
<h1>Créer un produit</h1>
@stop

@section('content')
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Nom</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Partenaire</label>
        <select name="partner_id" class="form-control" required>
            <option value="">-- Choisir --</option>
            @foreach($partners as $partner)
                <option value="{{ $partner->id }}">{{ $partner->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Prix</label>
        <input type="number" name="price" class="form-control" step="0.01">
    </div>
    <div class="form-group">
        <label>Stock</label>
        <input type="number" name="stock" class="form-control">
    </div>
    <div class="form-group">
        <label>Catégorie</label>
        <input type="text" name="category" class="form-control">
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group form-check">
        <input type="checkbox" name="is_sponsored" class="form-check-input" id="isSponsored">
        <label class="form-check-label" for="isSponsored">Produit sponsorisé</label>
    </div>
    <button class="btn btn-success">Créer</button>
</form>
@stop
