@extends('adminlte::page')

@section('title', 'Modifier article')

@section('content_header')
<h1>Modifier article</h1>
@stop

@section('content')
<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Titre</label>
        <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
    </div>
    <div class="form-group">
        <label>Catégorie</label>
        <select name="category_id" class="form-control">
            <option value="">-- Choisir --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Tags</label>
        <select name="tags[]" class="form-control" multiple>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" {{ in_array($tag->id, $postTags) ? 'selected' : '' }}>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Contenu</label>
        <textarea name="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
    </div>
    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
        @if($post->image)
            <img src="{{ asset('StockPiece/posts/'.$post->image) }}" width="100" class="mt-2">
        @endif
    </div>
    <button class="btn btn-primary">Mettre à jour</button>
</form>
@stop
