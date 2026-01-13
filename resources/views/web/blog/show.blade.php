@extends('layouts.master')

@section('title', $post->title . ' - Blog MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Blog',
        'active' => $post->title,
        'links' => [
            ['url' => route('blog.index'), 'label' => 'Blog']
        ]
    ])
</section>

<!-- =========================
    ARTICLE DÉTAILLÉ
========================= -->
<article class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- En-tête de l'article -->
                <div class="article-header mb-5">
                    <div class="article-meta mb-4">
                        <span class="date">{{ $post->created_at->format('d F, Y') }}</span>
                        @if($post->category)
                        <span class="category">{{ $post->category->name }}</span>
                        @endif
                        <span class="reading-time">{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min de lecture</span>
                    </div>

                    <h1 class="article-title mb-4">{{ $post->title }}</h1>

                    <div class="article-author d-flex align-items-center">
                        <div class="author-avatar me-3">
                            <img src="{{ asset('assets/img/team/default.jpg') }}" alt="Auteur" width="50" height="50" class="rounded-circle">
                        </div>
                        <div class="author-info">
                            <h6 class="mb-0">Équipe MyBusiness</h6>
                            <small class="text-muted">Publié par {{ $post->author->name ?? 'Administrateur' }}</small>
                        </div>
                    </div>
                </div>

                <!-- Image principale -->
                @if($post->featured_image)
                <div class="article-featured-image mb-5">
                    <img src="{{ Storage::url($post->featured_image) }}"
                         alt="{{ $post->title }}"
                         class="img-fluid rounded-3 shadow-sm">
                </div>
                @endif

                <!-- Contenu de l'article -->
                <div class="article-content">
                    {!! $post->content !!}
                </div>

                <!-- Tags -->
                @if($post->tags && $post->tags->count() > 0)
                <div class="article-tags mt-5">
                    <h6 class="mb-3">Tags :</h6>
                    <div class="tags-list">
                        @foreach($post->tags as $tag)
                        <a href="#" class="tag-badge">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Partage social -->
                <div class="article-share mt-5 pt-5 border-top">
                    <h6 class="mb-3">Partager cet article :</h6>
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                           target="_blank" class="share-btn facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $post->title }}"
                           target="_blank" class="share-btn twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $post->title }}"
                           target="_blank" class="share-btn linkedin">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="whatsapp://send?text={{ $post->title }} {{ url()->current() }}"
                           target="_blank" class="share-btn whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</article>

<!-- =========================
    ARTICLES CONNEXES
========================= -->
@if($relatedPosts && $relatedPosts->count() > 0)
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-title mb-5">
            <h3 class="title">Articles similaires</h3>
            <p class="mb-0">Découvrez d'autres articles qui pourraient vous intéresser</p>
        </div>

        <div class="row">
            @foreach($relatedPosts as $relatedPost)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="ht-blog-item v2">
                    <div class="ht-blog-thumb">
                        <a href="{{ route('blog.show', $relatedPost->slug) }}">
                            @if($relatedPost->featured_image)
                            <img src="{{ Storage::url($relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}">
                            @else
                            <img src="{{ asset('assets/img/blog/default.jpg') }}" alt="{{ $relatedPost->title }}">
                            @endif
                        </a>
                    </div>
                    <div class="ht-blog-content">
                        <ul class="ht-blog-meta">
                            <li>{{ $relatedPost->created_at->format('d M, Y') }}</li>
                            @if($relatedPost->category)
                            <li>{{ $relatedPost->category->name }}</li>
                            @endif
                        </ul>
                        <a href="{{ route('blog.show', $relatedPost->slug) }}">
                            <h4 class="title">{{ Str::limit($relatedPost->title, 60) }}</h4>
                        </a>
                        <a href="{{ route('blog.show', $relatedPost->slug) }}" class="ht-link">
                            Lire la suite
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- =========================
    NEWSLETTER
========================= -->
<section class="section-padding">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="newsletter-cta p-5 rounded-3 bg-primary text-white">
                    <h3 class="mb-3">Ne manquez aucun article</h3>
                    <p class="mb-4">Inscrivez-vous à notre newsletter pour recevoir nos derniers conseils directement dans votre boîte email.</p>

                    <form class="newsletter-form" id="article-newsletter-form">
                        @csrf
                        <div class="input-group">
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="Votre adresse email"
                                   required>
                            <button class="ht-btn style-3" type="submit">
                                S'inscrire
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .article-header {
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 30px;
    }

    .article-meta {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .article-meta span {
        color: #667eea;
        font-size: 14px;
        position: relative;
    }

    .article-meta span:not(:last-child):after {
        content: "•";
        position: absolute;
        right: -12px;
        color: #ddd;
    }

    .article-title {
        font-size: 2.5rem;
        line-height: 1.2;
        color: #333;
    }

    .article-author {
        margin-top: 30px;
    }

    .author-avatar img {
        border: 3px solid #f8f9fa;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .article-featured-image img {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
    }

    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #444;
    }

    .article-content h2,
    .article-content h3,
    .article-content h4 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #333;
    }

    .article-content p {
        margin-bottom: 1.5rem;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 2rem 0;
    }

    .article-content blockquote {
        border-left: 4px solid #667eea;
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        color: #666;
    }

    .tags-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .tag-badge {
        background: #f8f9fa;
        color: #667eea;
        padding: 5px 15px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s;
        border: 1px solid #e0e0e0;
    }

    .tag-badge:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }

    .share-buttons {
        display: flex;
        gap: 10px;
    }

    .share-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: transform 0.3s;
    }

    .share-btn:hover {
        transform: translateY(-3px);
    }

    .share-btn.facebook { background: #3b5998; }
    .share-btn.twitter { background: #1da1f2; }
    .share-btn.linkedin { background: #0077b5; }
    .share-btn.whatsapp { background: #25d366; }

    .newsletter-cta .input-group {
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .newsletter-cta .form-control {
        border: none;
        padding: 15px 20px;
        height: 55px;
    }

    .newsletter-cta .ht-btn {
        border-radius: 0 10px 10px 0;
        padding: 15px 30px;
    }
</style>
@endpush
