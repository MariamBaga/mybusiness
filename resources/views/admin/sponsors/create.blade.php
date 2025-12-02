@extends('adminlte::page')

@section('title', 'Créer Sponsor')

@section('content_header')
<h1>Créer Sponsor</h1>
@stop

@section('content')
<form action="{{ route('sponsors.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="form-group">
    <label>Nom</label>
    <input type="text" name="name" class="form-control" required>
</div>
<div class="form-group">
    <label>Logo</label>
    <input type="file" name="logo" class="form-control">
</div>
<button class="btn btn-success">Créer</button>
</form>
@stop
