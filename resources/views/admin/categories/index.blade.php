@extends('adminlte::page')

@section('title', 'Catégories')

@section('content_header')
<h1>Catégories</h1>
<a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Ajouter une catégorie</a>
@stop

@section('content')
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th><th>Nom</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette catégorie ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $categories->links() }}
@stop
