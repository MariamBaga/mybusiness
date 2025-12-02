@extends('adminlte::page')

@section('title', 'Paramètres')

@section('content_header')
<h1>Paramètres du site</h1>
@stop

@section('content')
<a href="{{ route('settings.edit', 1) }}" class="btn btn-primary mb-3">Modifier les paramètres</a>

<table class="table table-bordered">
<tr><th>Clé</th><th>Valeur</th></tr>
@foreach($settings as $key => $value)
<tr>
    <td>{{ $key }}</td>
    <td>{{ $value }}</td>
</tr>
@endforeach
</table>
@stop
