@extends('adminlte::page')

@section('title', 'Créer un article')

@section('content_header')
<h1>Créer un article</h1>
@stop

@section('content')
<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Titre</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Catégorie</label>
        <select name="category_id" class="form-control">
            <option value="">-- Choisir --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Tags</label>
        <select name="tags[]" class="form-control" multiple>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Contenu</label>
        <textarea name="content" class="form-control" rows="5" required></textarea>
    </div>
    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button class="btn btn-success">Créer</button>
</form>
@stop
