@extends('adminlte::page')

@section('title', 'Modifier utilisateur')

@section('content_header')
    <h1>Modifier utilisateur</h1>
@stop

@section('content')
<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nom</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="form-group">
        <label>Nouveau mot de passe (laisser vide si inchangé)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label>Confirmer mot de passe</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
    <button class="btn btn-primary">Mettre à jour</button>
</form>
@stop
