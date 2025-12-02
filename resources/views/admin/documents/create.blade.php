@extends('adminlte::page')

@section('title', 'Ajouter un document')

@section('content_header')
<h1>Ajouter un document</h1>
@stop

@section('content')
<form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="form-group">
    <label>Titre</label>
    <input type="text" name="title" class="form-control" required>
</div>
<div class="form-group">
    <label>Fichier (PDF, DOC, DOCX)</label>
    <input type="file" name="file" class="form-control" required>
</div>
<button class="btn btn-success">Ajouter</button>
</form>
@stop
