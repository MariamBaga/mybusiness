@extends('adminlte::page')

@section('title', 'Modifier Catégorie')

@section('content_header')
<h1>Modifier la catégorie</h1>
@stop

@section('content')
<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nom de la catégorie</label>
        <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
    </div>
    <button class="btn btn-primary">Mettre à jour</button>
</form>
@stop
