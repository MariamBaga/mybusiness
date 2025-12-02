@extends('adminlte::page')

@section('title', 'Modifier FAQ')

@section('content_header')
<h1>Modifier FAQ</h1>
@stop

@section('content')
<form action="{{ route('faqs.update', $faq->id) }}" method="POST">
@csrf
@method('PUT')
<div class="form-group">
    <label>Question</label>
    <input type="text" name="question" class="form-control" value="{{ $faq->question }}" required>
</div>
<div class="form-group">
    <label>Réponse</label>
    <textarea name="answer" class="form-control" rows="3" required>{{ $faq->answer }}</textarea>
</div>
<button class="btn btn-primary">Mettre à jour</button>
</form>
@stop
