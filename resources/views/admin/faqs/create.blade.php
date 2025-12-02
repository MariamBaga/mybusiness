@extends('adminlte::page')

@section('title', 'Ajouter FAQ')

@section('content_header')
<h1>Ajouter FAQ</h1>
@stop

@section('content')
<form action="{{ route('faqs.store') }}" method="POST">
@csrf
<div class="form-group">
    <label>Question</label>
    <input type="text" name="question" class="form-control" required>
</div>
<div class="form-group">
    <label>Réponse</label>
    <textarea name="answer" class="form-control" rows="3" required></textarea>
</div>
<button class="btn btn-success">Ajouter</button>
</form>
@stop
