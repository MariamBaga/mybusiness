@extends('adminlte::page')

@section('title', 'Publicités')

@section('content_header')
    <h1>Publicités</h1>
    <a href="{{ route('ads.create') }}" class="btn btn-primary mb-3">Créer une publicité</a>
@stop

@section('content')
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th><th>Titre</th><th>Placement</th><th>Dates</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ads as $ad)
        <tr>
            <td>{{ $ad->id }}</td>
            <td>{{ $ad->title }}</td>
            <td>{{ $ad->placement }}</td>
            <td>{{ $ad->start_date }} - {{ $ad->end_date }}</td>
            <td>
                <a href="{{ route('ads.edit', $ad->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('ads.destroy', $ad->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette publicité ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $ads->links() }}
@stop
