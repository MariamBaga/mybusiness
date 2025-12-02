@extends('adminlte::page')

@section('title', 'Tags')

@section('content_header')
<h1>Tags</h1>
<a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Ajouter un tag</a>
@stop

@section('content')
<table class="table table-bordered table-striped">
<thead>
<tr>
    <th>ID</th><th>Nom</th><th>Actions</th>
</tr>
</thead>
<tbody>
@foreach($tags as $tag)
<tr>
    <td>{{ $tag->id }}</td>
    <td>{{ $tag->name }}</td>
    <td>
        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-warning">Modifier</a>
        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce tag ?')">Supprimer</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>
{{ $tags->links() }}
@stop
