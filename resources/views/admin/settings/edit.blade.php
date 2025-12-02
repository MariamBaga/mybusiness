@extends('adminlte::page')

@section('title', 'Modifier Paramètres')

@section('content_header')
<h1>Modifier Paramètres</h1>
@stop

@section('content')
<form action="{{ route('settings.update', $setting->id) }}" method="POST">
@csrf
@method('PUT')
@foreach($setting->toArray() as $key => $value)
    @if($key != 'id' && $key != 'created_at' && $key != 'updated_at')
    <div class="form-group">
        <label>{{ ucfirst($key) }}</label>
        <input type="text" name="{{ $key }}" class="form-control" value="{{ $value }}">
    </div>
    @endif
@endforeach
<button class="btn btn-primary">Mettre à jour</button>
</form>
@stop
