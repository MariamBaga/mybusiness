@extends('adminlte::page')

@section('title', 'Tickets Support')

@section('content_header')
<h1>Tickets Support</h1>
@stop

@section('content')
<table class="table table-bordered table-striped">
<thead>
<tr>
    <th>ID</th><th>Titre</th><th>Statut</th><th>Actions</th>
</tr>
</thead>
<tbody>
@foreach($tickets as $ticket)
<tr>
    <td>{{ $ticket->id }}</td>
    <td>{{ $ticket->title }}</td>
    <td>{{ $ticket->status }}</td>
    <td>
        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-info">Voir</a>
        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-warning">Modifier</a>
        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce ticket ?')">Supprimer</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>
{{ $tickets->links() }}
@stop
