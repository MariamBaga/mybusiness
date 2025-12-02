@extends('adminlte::page')

@section('title', 'Modifier Sponsor')

@section('content_header')
<h1>Modifier Sponsor</h1>
@stop

@section('content')
<form action="{{ route('sponsors.update', $sponsor->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="form-group">
    <label>Nom</label>
    <input type="text" name="name" class="form-control" value="{{ $sponsor->name }}" required>
</div>
<div class="form-group">
    <label>Logo</label>
    <input type="file" name="logo" class="form-control">
    @if($sponsor->logo)
        <img src="{{ asset('StockPiece/sponsors/'.$sponsor->logo) }}" width="100" class="mt-2">
    @endif
</div>
<button class="btn btn-primary">Mettre à jour</button>
</form>
@stop
