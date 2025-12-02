@extends('adminlte::page')

@section('title', 'Détail Ticket')

@section('content_header')
<h1>Détail Ticket</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3>{{ $ticket->title }}</h3>
    </div>
    <div class="card-body">
        <p><strong>Description:</strong> {{ $ticket->description }}</p>
        <p><strong>Statut:</strong> {{ $ticket->status }}</p>
        <p><strong>Utilisateur:</strong> {{ $ticket->user->name }}</p>
    </div>
</div>
@stop
