@extends('adminlte::page')

@section('title', 'Partenaires')

@section('content_header')
<h1>Partenaires</h1>
<a href="{{ route('partners.create') }}" class="btn btn-primary mb-3">Ajouter un partenaire</a>
@stop

@section('content')
<table class="table table-bordered table-striped">
<thead>
<tr>
    <th>ID</th><th>Nom</th><th>Email</th><th>Actions</th>
</tr>
</thead>
<tbody>
@foreach($partners as $partner)
<tr>
    <td>{{ $partner->id }}</td>
    <td>{{ $partner->name }}</td>
    <td>{{ $partner->email ?? 'N/A' }}</td>
    <td>
        <a href="{{ route('partners.edit', $partner->id) }}" class="btn btn-sm btn-warning">Modifier</a>
        <form action="{{ route('partners.destroy', $partner->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce partenaire ?')">Supprimer</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>
{{ $partners->links() }}
@stop
