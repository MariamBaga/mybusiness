@extends('adminlte::page')

@section('title', 'Sponsors')

@section('content_header')
<h1>Sponsors</h1>
<a href="{{ route('sponsors.create') }}" class="btn btn-primary mb-3">Ajouter un sponsor</a>
@stop

@section('content')
<table class="table table-bordered table-striped">
<thead>
<tr>
    <th>ID</th><th>Nom</th><th>Actions</th>
</tr>
</thead>
<tbody>
@foreach($sponsors as $sponsor)
<tr>
    <td>{{ $sponsor->id }}</td>
    <td>{{ $sponsor->name }}</td>
    <td>
        <a href="{{ route('sponsors.edit', $sponsor->id) }}" class="btn btn-sm btn-warning">Modifier</a>
        <form action="{{ route('sponsors.destroy', $sponsor->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce sponsor ?')">Supprimer</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>
{{ $sponsors->links() }}
@stop
