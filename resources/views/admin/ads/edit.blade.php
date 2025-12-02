@extends('adminlte::page')

@section('title', 'Modifier publicité')

@section('content_header')
    <h1>Modifier publicité</h1>
@stop

@section('content')
<form action="{{ route('ads.update', $ad->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Titre</label>
        <input type="text" name="title" class="form-control" value="{{ $ad->title }}" required>
    </div>
    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
        @if($ad->image)
            <img src="{{ asset('StockPiece/ads/'.$ad->image) }}" width="100" class="mt-2">
        @endif
    </div>
    <div class="form-group">
        <label>Date de début</label>
        <input type="date" name="start_date" class="form-control" value="{{ $ad->start_date }}" required>
    </div>
    <div class="form-group">
        <label>Date de fin</label>
        <input type="date" name="end_date" class="form-control" value="{{ $ad->end_date }}" required>
    </div>
    <div class="form-group">
        <label>Placement</label>
        <input type="text" name="placement" class="form-control" value="{{ $ad->placement }}" required>
    </div>
    <button class="btn btn-primary">Mettre à jour</button>
</form>
@stop
