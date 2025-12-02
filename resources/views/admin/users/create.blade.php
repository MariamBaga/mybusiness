@extends('adminlte::page')

@section('title', 'Créer un utilisateur')

@section('content_header')
    <h1>Créer un utilisateur</h1>
@stop

@section('content')
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nom</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Confirmer mot de passe</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    <button class="btn btn-success">Créer</button>
</form>
@stop
