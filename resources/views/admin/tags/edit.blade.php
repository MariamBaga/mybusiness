@extends('adminlte::page')

@section('title', 'Modifier Tag')

@section('content_header')
<h1>Modifier le tag</h1>
@stop

@section('content')
<form action="{{ route('tags.update', $tag->id) }}" method="POST">
@csrf
@method('PUT')
<div class="form-group">
    <label>Nom du tag</label>
    <input type="text" name="name" class="form-control" value="{{ $tag->name }}" required>
</div>
<button class="btn btn-primary">Mettre à jour</button>
</form>
@stop
