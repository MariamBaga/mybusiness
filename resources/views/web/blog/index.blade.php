@extends('layouts.master')

@section('title', 'Blog & Actualités - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Blog',
        'active' => 'Blog'
    ])
</section>

<!-- =========================
    BLOG SECTION
========================= -->
<section class="ht-blog-area section-padding fix">
    <div class="container">
        <div class="ht-blog-wrapper">
            <div class="row">

                @forelse($posts as $index => $post)
                <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="{{ .2 + ($index * 0.2) }}s">
                    <div class="ht-blog-item v2 mt-20">
                        <div class="ht-blog-thumb">
                            <a href="{{ route('blog.show', $post->slug) }}">
                                @if($post->featured_image)
                                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}">
                                @else
                                <img src="{{ asset('assets/img/blog/default.jpg') }}" alt="{{ $post->title }}">
                                @endif
                            </a>
                        </div>
                        <div class="ht-blog-content">
                            <ul class="ht-blog-meta">
                                <li>{{ $post->created_at->format('d F, Y') }}</li>
                                @if($post->category)
                                <li>{{ $post->category->name }}</li>
                                @endif
                            </ul>
                            <a href="{{ route('blog.show', $post->slug) }}">
                                <h3 class="title">{{ $post->title }}</h3>
                            </a>
                            <p class="excerpt">{{ Str::limit(strip_tags($post->excerpt ?: $post->content), 100) }}</p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="ht-link">
                                Lire la suite <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="empty-state">
                        <i class="fa-solid fa-newspaper fa-3x text-muted mb-4"></i>
                        <h4>Aucun article disponible</h4>
                        <p class="text-muted">Revenez bientôt pour découvrir nos prochains articles.</p>
                    </div>
                </div>
                @endforelse

            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
            <div class="page-nav-wrap text-center mt-50">
                <ul class="pagination">
                    <!-- Previous Page Link -->
                    @if($posts->onFirstPage())
                    <li class="disabled"><span class="page-numbers"><i class="fa-solid fa-chevron-left"></i></span></li>
                    @else
                    <li><a class="page-numbers" href="{{ $posts->previousPageUrl() }}"><i class="fa-solid fa-chevron-left"></i></a></li>
                    @endif

                    <!-- Pagination Elements -->
                    @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                        @if($page == $posts->currentPage())
                        <li class="active"><span class="page-numbers">{{ $page }}</span></li>
                        @else
                        <li><a class="page-numbers" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    <!-- Next Page Link -->
                    @if($posts->hasMorePages())
                    <li><a class="page-numbers" href="{{ $posts->nextPageUrl() }}"><i class="fa-solid fa-chevron-right"></i></a></li>
                    @else
                    <li class="disabled"><span class="page-numbers"><i class="fa-solid fa-chevron-right"></i></span></li>
                    @endif
                </ul>
            </div>
            @endif

        </div>
    </div>
</section>
<!-- ht blog area end -->

<!-- =========================
    NEWSLETTER
========================= -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="newsletter-content">
                    <h3 class="mb-3">Restez informé</h3>
                    <p class="mb-0">
                        Inscrivez-vous à notre newsletter pour recevoir nos derniers articles,
                        conseils business et offres exclusives.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <form class="newsletter-form" id="newsletter-form">
                    @csrf
                    <div class="input-group">
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="Votre adresse email"
                               required>
                        <button class="ht-btn style-2" type="submit">
                            S'inscrire
                        </button>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="newsletter-privacy" required>
                        <label class="form-check-label small" for="newsletter-privacy">
                            J'accepte de recevoir la newsletter MyBusiness
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- =========================
    CATÉGORIES POPULAIRES
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle wow fadeInUp" data-wow-delay=".2s">Catégories</span>
            <h2 class="title wow fadeInUp" data-wow-delay=".4s">Explorez par thématique</h2>
        </div>

        <div class="row mt-40">
            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".2s">
                <div class="category-card text-center p-4 rounded-3">
                    <div class="icon mb-3">
                        <i class="fa-solid fa-chart-line fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-2">Gestion d'entreprise</h4>
                    <p class="small text-muted">Conseils pour optimiser votre gestion</p>
                    <a href="#" class="ht-link small">Voir les articles</a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".4s">
                <div class="category-card text-center p-4 rounded-3">
                    <div class="icon mb-3">
                        <i class="fa-solid fa-mobile-screen fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-2">Digitalisation</h4>
                    <p class="small text-muted">Transformer votre business avec le digital</p>
                    <a href="#" class="ht-link small">Voir les articles</a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".6s">
                <div class="category-card text-center p-4 rounded-3">
                    <div class="icon mb-3">
                        <i class="fa-solid fa-lightbulb fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-2">Conseils pratiques</h4>
                    <p class="small text-muted">Astuces et bonnes pratiques</p>
                    <a href="#" class="ht-link small">Voir les articles</a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".8s">
                <div class="category-card text-center p-4 rounded-3">
                    <div class="icon mb-3">
                        <i class="fa-solid fa-newspaper fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-2">Actualités</h4>
                    <p class="small text-muted">Nouveautés et mises à jour MyBusiness</p>
                    <a href="#" class="ht-link small">Voir les articles</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .ht-blog-item.v2 {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
    }

    .ht-blog-item.v2:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .ht-blog-thumb {
        height: 220px;
        overflow: hidden;
    }

    .ht-blog-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .ht-blog-item.v2:hover .ht-blog-thumb img {
        transform: scale(1.05);
    }

    .ht-blog-content {
        padding: 25px;
    }

    .ht-blog-meta {
        list-style: none;
        padding: 0;
        margin: 0 0 15px 0;
        display: flex;
        gap: 15px;
    }

    .ht-blog-meta li {
        font-size: 14px;
        color: #667eea;
        position: relative;
    }

    .ht-blog-meta li:not(:last-child):after {
        content: "|";
        position: absolute;
        right: -10px;
        color: #ddd;
    }

    .ht-blog-content .title {
        font-size: 18px;
        line-height: 1.4;
        margin-bottom: 10px;
        color: #333;
    }

    .ht-blog-content .title:hover {
        color: #667eea;
    }

    .ht-blog-content .excerpt {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .ht-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s;
    }

    .ht-link:hover {
        color: #764ba2;
        transform: translateX(5px);
    }

    .ht-link i {
        font-size: 12px;
        transition: transform 0.3s;
    }

    .ht-link:hover i {
        transform: translateX(3px);
    }

    .page-nav-wrap ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    .page-numbers {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: #fff;
        color: #333;
        text-decoration: none;
        font-weight: 500;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }

    .page-numbers:hover,
    .page-numbers.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: transparent;
    }

    .category-card {
        background: #fff;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }

    .category-card:hover {
        border-color: #667eea;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.1);
    }

    .category-card .icon {
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-state {
        padding: 50px 20px;
    }

    .empty-state i {
        opacity: 0.5;
    }

    .newsletter-form .input-group {
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        border-radius: 10px;
        overflow: hidden;
    }

    .newsletter-form .form-control {
        border: none;
        padding: 15px 20px;
        height: 55px;
    }

    .newsletter-form .ht-btn {
        border-radius: 0 10px 10px 0;
        padding: 15px 30px;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion de la newsletter
        const newsletterForm = document.getElementById('newsletter-form');

        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;

                // Afficher le loader
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Inscription...';
                submitBtn.disabled = true;

                // Simulation d'envoi (à remplacer par une requête AJAX réelle)
                setTimeout(() => {
                    alert('Merci pour votre inscription à notre newsletter !');
                    newsletterForm.reset();
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 1500);
            });
        }

        // Animation au scroll pour les articles
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);

        // Observer les articles de blog
        document.querySelectorAll('.ht-blog-item').forEach(item => {
            observer.observe(item);
        });

        // Pagination active
        const currentPage = {{ $posts->currentPage() }};
        const paginationItems = document.querySelectorAll('.page-numbers');

        paginationItems.forEach(item => {
            if (item.textContent == currentPage && !item.querySelector('i')) {
                item.closest('li').classList.add('active');
            }
        });
    });
</script>
@endpush
