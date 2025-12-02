@extends('adminlte::page')

@section('title', 'FAQ')

@section('content_header')
<h1>FAQ</h1>
<a href="{{ route('faqs.create') }}" class="btn btn-primary mb-3">Ajouter une question</a>
@stop

@section('content')
<table class="table table-bordered table-striped">
<thead>
<tr>
    <th>ID</th><th>Question</th><th>Réponse</th><th>Actions</th>
</tr>
</thead>
<tbody>
@foreach($faqs as $faq)
<tr>
    <td>{{ $faq->id }}</td>
    <td>{{ $faq->question }}</td>
    <td>{{ $faq->answer }}</td>
    <td>
        <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-sm btn-warning">Modifier</a>
        <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette question ?')">Supprimer</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>
{{ $faqs->links() }}
@stop
