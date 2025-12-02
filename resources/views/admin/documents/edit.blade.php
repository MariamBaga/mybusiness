@extends('adminlte::page')

@section('title', 'Modifier document')

@section('content_header')
<h1>Modifier document</h1>
@stop

@section('content')
<form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="form-group">
    <label>Titre</label>
    <input type="text" name="title" class="form-control" value="{{ $document->title }}" required>
</div>
<div class="form-group">
    <label>Fichier</label>
    <input type="file" name="file" class="form-control">
    @if($document->file)
        <a href="{{ asset('StockPiece/documents/'.$document->file) }}" target="_blank">Voir fichier actuel</a>
    @endif
</div>
<button class="btn btn-primary">Mettre à jour</button>
</form>
@stop
