@extends('adminlte::page')

@section('title', 'Créer une publicité')

@section('content_header')
    <h1>Créer une publicité</h1>
@stop

@section('content')
<form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Titre</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Date de début</label>
        <input type="date" name="start_date" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Date de fin</label>
        <input type="date" name="end_date" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Placement</label>
        <input type="text" name="placement" class="form-control" required>
    </div>
    <button class="btn btn-success">Créer</button>
</form>
@stop
