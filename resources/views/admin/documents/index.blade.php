@extends('adminlte::page')

@section('title', 'Documents')

@section('content_header')
<h1>Documents</h1>
<a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">Ajouter un document</a>
@stop

@section('content')
<table class="table table-bordered table-striped">
<thead>
<tr>
    <th>ID</th><th>Titre</th><th>Fichier</th><th>Actions</th>
</tr>
</thead>
<tbody>
@foreach($documents as $document)
<tr>
    <td>{{ $document->id }}</td>
    <td>{{ $document->title }}</td>
    <td>
        @if($document->file)
            <a href="{{ asset('StockPiece/documents/'.$document->file) }}" target="_blank">Voir</a>
        @endif
    </td>
    <td>
        <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-sm btn-warning">Modifier</a>
        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce document ?')">Supprimer</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>
{{ $documents->links() }}
@stop
