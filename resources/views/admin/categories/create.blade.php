@extends('adminlte::page')

@section('title', 'Créer Catégorie')

@section('content_header')
<h1>Créer une catégorie</h1>
@stop

@section('content')
<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nom de la catégorie</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <button class="btn btn-success">Créer</button>
</form>
@stop
