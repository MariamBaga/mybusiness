@extends('adminlte::page')

@section('title', 'Modifier partenaire')

@section('content_header')
<h1>Modifier partenaire</h1>
@stop

@section('content')
<form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="form-group">
    <label>Nom</label>
    <input type="text" name="name" class="form-control" value="{{ $partner->name }}" required>
</div>
<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ $partner->email }}">
</div>
<div class="form-group">
    <label>Logo</label>
    <input type="file" name="logo" class="form-control">
    @if($partner->logo)
        <img src="{{ asset('StockPiece/partners/'.$partner->logo) }}" width="100" class="mt-2">
    @endif
</div>
<button class="btn btn-primary">Mettre à jour</button>
</form>
@stop
