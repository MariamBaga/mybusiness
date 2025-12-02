@extends('adminlte::page')

@section('title', 'Utilisateurs')

@section('content_header')
    <h1>Utilisateurs</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Ajouter un utilisateur</a>
@stop

@section('content')
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th><th>Nom</th><th>Email</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
@stop
