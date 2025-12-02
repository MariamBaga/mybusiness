@extends('adminlte::page')

@section('title', 'Créer Tag')

@section('content_header')
<h1>Créer un tag</h1>
@stop

@section('content')
<form action="{{ route('tags.store') }}" method="POST">
@csrf
<div class="form-group">
    <label>Nom du tag</label>
    <input type="text" name="name" class="form-control" required>
</div>
<button class="btn btn-success">Créer</button>
</form>
@stop
