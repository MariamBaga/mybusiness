@extends('layouts.master')

@section('title', 'MyBusiness - Pilotez votre activité en toute simplicité')
@section('content')

    <!-- ============================
        HERO SECTION
    ============================= -->
 <!-- ============================
    HERO SECTION
============================= -->
<section class="ht-hero-area" data-bg-src="{{ asset('assets/img/hero/hero-bg.jpg') }}">
    <div class="container">
        <div class="ht-hero-content">
            <h1 class="wow fadeInUp" data-wow-delay=".2s">
                MyBusiness : <br>
                Pilotez votre activité <span>en toute simplicité</span>
            </h1>

            <p class="desc wow fadeInUp" data-wow-delay=".4s">
                Suivez vos ventes en temps réel, gérez vos stocks, analysez vos performances
                et développez votre entreprise comme jamais auparavant.
            </p>

            <div class="mt-4">
                <a href="#" class="ht-btn style-2 wow fadeInUp me-3" data-wow-delay=".5s">
                    Tester gratuitement
                </a>
                <a href="#" class="ht-btn wow fadeInUp" data-wow-delay=".6s">
                    Demander une démo
                </a>
            </div>
        </div>

        <div class="ht-hero-img">
            <img class="wow fadeInUp" data-wow-delay=".3s"
                 src="{{ asset('assets/img/hero/mockup.png') }}" alt="MyBusiness App">
        </div>
    </div>
</section>

    <!-- ============================
        BENEFICES / FEATURE HIGHLIGHTS
    ============================= -->
    <section id="features" class="ht-services-area pt-120 pb-80">
        <div class="container">
            <div class="section-title text-center">
                <span class="subtitle wow fadeInUp" data-wow-delay=".2s">Pourquoi choisir MyBusiness</span>
                <h2 class="title wow fadeInUp" data-wow-delay=".3s">
                    Tout ce dont votre entreprise a besoin, <br>dans une seule plateforme
                </h2>
                <p class="lead mt-3 wow fadeInUp" data-wow-delay=".4s">
                    Conçu spécifiquement pour les défis du marché africain
                </p>
            </div>

            <div class="row mt-50 g-4">

                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="ht-services-items card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="icon mb-3">
                                <img src="{{ asset('assets/img/icon/sales.svg') }}" alt="Suivi des ventes" width="60">
                            </div>
                            <h3 class="title h5">Suivi des ventes</h3>
                            <p class="mb-0">Gardez un œil sur toutes vos transactions en temps réel, même hors ligne.</p>
                            <a href="{{ route('pages.features') }}#ventes" class="btn btn-link mt-3">
                                En savoir plus <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="ht-services-items card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="icon mb-3">
                                <img src="{{ asset('assets/img/icon/stocks.svg') }}" alt="Gestion des stocks"
                                    width="60">
                            </div>
                            <h3 class="title h5">Gestion des stocks</h3>
                            <p class="mb-0">Identifiez les produits disponibles, les ruptures et les tendances.</p>
                            <a href="{{ route('pages.features') }}#stocks" class="btn btn-link mt-3">
                                En savoir plus <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="ht-services-items card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="icon mb-3">
                                <img src="{{ asset('assets/img/icon/report.svg') }}" alt="Rapports intelligents"
                                    width="60">
                            </div>
                            <h3 class="title h5">Rapports intelligents</h3>
                            <p class="mb-0">Analyse détaillée des ventes, clients et performances par canal.</p>
                            <a href="{{ route('pages.features') }}#rapports" class="btn btn-link mt-3">
                                En savoir plus <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="ht-services-items card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="icon mb-3">
                                <img src="{{ asset('assets/img/icon/multi-channel.svg') }}" alt="Multi-canaux"
                                    width="60">
                            </div>
                            <h3 class="title h5">Vente multi-canaux</h3>
                            <p class="mb-0">Gérez boutique physique, Facebook, WhatsApp dans un seul tableau.</p>
                            <a href="{{ route('pages.features') }}#multi-canaux" class="btn btn-link mt-3">
                                En savoir plus <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-center mt-5">
                <a href="{{ route('pages.features') }}" class="ht-btn style-3">
                    <i class="fas fa-list me-2"></i>Voir toutes les fonctionnalités
                </a>
            </div>
        </div>
    </section>


    <!-- ============================
        STATISTIQUES
    ============================= -->
    <section class="pt-100 pb-100 bg-gradient-primary text-white">
        <div class="container">
            <div class="row text-center g-4">

                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".1s">
                    <div class="stat-card">
                        <h2 class="display-4 fw-bold"><span class="count">25</span>K+</h2>
                        <p class="mb-0">Commerçants actifs</p>
                        <small class="text-light">Dans 12 pays africains</small>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="stat-card">
                        <h2 class="display-4 fw-bold"><span class="count">120</span>M+</h2>
                        <p class="mb-0">Transactions suivies</p>
                        <small class="text-light">Plus de 1.2 milliards FCFA</small>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="stat-card">
                        <h2 class="display-4 fw-bold"><span class="count">98</span>%</h2>
                        <p class="mb-0">Taux de satisfaction</p>
                        <small class="text-light">Basé sur 5 000 avis clients</small>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="stat-card">
                        <h2 class="display-4 fw-bold"><span class="count">45</span>+</h2>
                        <p class="mb-0">Partenaires stratégiques</p>
                        <small class="text-light">Banques, fournisseurs, institutions</small>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ============================
        VIDEO DEMO + TÉMOIGNAGES
    ============================= -->
    <section class="pt-120 pb-120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="pe-lg-4">
                        <span class="subtitle">Démonstration</span>
                        <h2 class="title mb-4">Découvrez MyBusiness<br>en moins de 2 minutes</h2>

                        <p class="mb-4">
                            Voyez comment MyBusiness transforme la gestion de votre commerce avec une interface
                            simple et des fonctionnalités puissantes.
                        </p>

                        <div class="video-wrapper wow fadeInUp" data-wow-delay=".3s">
                            <div class="ratio ratio-16x9">
                                <div class="video-placeholder bg-dark rounded-3 position-relative">
                                    <img src="{{ asset('assets/img/demo/video-thumbnail.jpg') }}"
                                        alt="Démonstration MyBusiness" class="img-fluid rounded-3">
                                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="video-play-btn"
                                        data-fancybox>
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ps-lg-4 mt-5 mt-lg-0">
                        <span class="subtitle">Ils nous font confiance</span>
                        <h2 class="title mb-4">Ce que disent nos utilisateurs</h2>

                        <div class="testimonial-slider">
                            @foreach ($testimonials as $testimonial)
                                <div class="testimonial-box">
                                    <div class="rating mb-3">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fas fa-star text-warning"></i>
                                        @endfor
                                    </div>
                                    <p class="fs-5">"{{ $testimonial->content }}"</p>
                                    <div class="d-flex align-items-center mt-4">
                                        <img src="{{ asset($testimonial->avatar) }}" alt="{{ $testimonial->name }}"
                                            class="rounded-circle me-3" width="50">
                                        <div>
                                            <h5 class="name mb-1">{{ $testimonial->name }}</h5>
                                            <span class="text-muted">{{ $testimonial->position }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================
        MARKETPLACE PARTENAIRES (Section 13.3)
    ============================= -->
    @if ($featuredProducts->count() > 0)
        <section class="pt-100 pb-100 bg-light">
            <div class="container">
                <div class="section-title text-center">
                    <span class="subtitle">Marketplace</span>
                    <h2 class="title">Découvrez nos produits partenaires</h2>
                    <p class="lead">Des produits sélectionnés pour votre entreprise</p>
                </div>

                <div class="row mt-50 g-4">
                    @foreach ($featuredProducts->take(4) as $product)
                        <div class="col-lg-3 col-md-6">
                            <div class="product-card card h-100 border-0 shadow-sm">
                                @if ($product->is_sponsored)
                                    <span class="badge bg-danger position-absolute top-0 start-0 m-3">Sponsorisé</span>
                                @endif

                                <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}"
                                    loading="lazy">

                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text text-muted small">{{ Str::limit($product->description, 80) }}</p>

                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span
                                            class="h5 text-primary mb-0">{{ number_format($product->price, 0, ',', ' ') }}
                                            FCFA</span>
                                        <a href="{{ route('marketplace.show', $product->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            Voir le produit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('marketplace.index') }}" class="ht-btn">
                        <i class="fas fa-store me-2"></i>Visiter la marketplace
                    </a>
                </div>
            </div>
        </section>
    @endif


    <!-- ============================
        ESPACE PUBLICITÉ (Section 13.2)
    ============================= -->
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="pe-lg-4">
                        <span class="badge bg-info mb-3">Nouveau</span>
                        <h2 class="title mb-4">Votre publicité sur MyBusiness</h2>

                        <p class="mb-4">
                            Atteignez des milliers de commerçants et entrepreneurs. Achetez un espace
                            publicitaire ciblé sur notre plateforme.
                        </p>

                        <ul class="list-check mb-4">
                            <li><i class="fas fa-check-circle text-success me-2"></i> Audience ciblée : commerçants et PME
                            </li>
                            <li><i class="fas fa-check-circle text-success me-2"></i> Formats multiples : bannières,
                                encarts, newsletters</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i> Statistiques détaillées en temps réel
                            </li>
                            <li><i class="fas fa-check-circle text-success me-2"></i> Paiement sécurisé en ligne</li>
                        </ul>

                        <div class="d-flex gap-3">
                            <a href="{{ route('advertise.index') }}" class="ht-btn style-2">
                                <i class="fas fa-bullhorn me-2"></i>Publicité
                            </a>
                            <a href="{{ route('pages.partners') }}" class="ht-btn btn-outline-primary">
                                Devenir partenaire
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ps-lg-4 mt-5 mt-lg-0">
                        <div class="ad-preview">
                            <div class="ad-banner mb-4">
                                <div class="ad-label">Espace publicitaire</div>
                                <div class="ad-content">
                                    <h5>Votre annonce ici</h5>
                                    <p>Atteignez 25 000+ commerçants mensuellement</p>
                                    <span class="ad-cta">En savoir plus →</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="ad-box small">
                                        <small>Encart latéral</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="ad-box small">
                                        <small>Bannière footer</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================
        PARTENAIRES & SPONSORS
    ============================= -->
    @if ($sponsors->count() > 0)
        <section class="pt-80 pb-80 bg-white">
            <div class="container">
                <div class="section-title text-center">
                    <span class="subtitle">Nos partenaires</span>
                    <h2 class="title">Ils soutiennent MyBusiness</h2>
                </div>

                <div class="partner-slider mt-50">
                    @foreach ($sponsors as $sponsor)
                        <div class="partner-item text-center">
                            <a href="{{ $sponsor->website }}" target="_blank" class="d-block">
                                <img src="{{ asset($sponsor->logo) }}" alt="{{ $sponsor->name }}" class="img-fluid"
                                    height="60" loading="lazy">
                                @if ($sponsor->is_featured)
                                    <span class="badge bg-warning mt-2">Partenaire Officiel</span>
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    <!-- ============================
        CTA FINAL
    ============================= -->
    <section class="pt-120 pb-120 bg-dark text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="display-5 fw-bold mb-4">
                        Prêt à transformer votre gestion commerciale ?
                    </h2>

                    <p class="lead mb-5">
                        Rejoignez les milliers de commerçants qui utilisent déjà MyBusiness pour développer
                        leur activité. Aucune carte bancaire requise pour l'essai gratuit.
                    </p>

                    <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                        <a href="{{ route('pages.pricing') }}#free-trial" class="ht-btn btn-lg style-2">
                            <i class="fas fa-rocket me-2"></i>Commencer l'essai gratuit
                        </a>

                        <a href="{{ route('support.contact') }}" class="ht-btn btn-lg btn-outline-light">
                            <i class="fas fa-calendar me-2"></i>Réserver une démo
                        </a>
                    </div>

                    <div class="mt-5">
                        <div class="row justify-content-center g-3">
                            <div class="col-auto">
                                <i class="fas fa-clock text-warning me-2"></i>
                                <small>Configuration en 5 minutes</small>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-globe text-info me-2"></i>
                                <small>Disponible dans 12 pays</small>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments text-success me-2"></i>
                                <small>Support en Français & Anglais</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================
        BLOG RÉCENT (Section 5.4)
    ============================= -->
    @if ($posts->count() > 0)
        <section class="pt-100 pb-100">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <span class="subtitle">Actualités</span>
                        <h2 class="title mb-0">Derniers articles du blog</h2>
                    </div>
                    <a href="{{ route('blog.index') }}" class="btn btn-link">
                        Voir tous <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="row g-4">
                    @foreach ($posts as $post)
                        <div class="col-lg-4">
                            <div class="card blog-card border-0 shadow-sm h-100">
                                <div class="position-relative">
                                    <img src="{{ asset($post->image ?? 'assets/img/blog/default.jpg') }}"
                                        class="card-img-top" alt="{{ $post->title }}" loading="lazy">
                                    <span class="badge bg-primary position-absolute top-0 start-0 m-3">
                                        {{ $post->category->name ?? 'Général' }}
                                    </span>
                                </div>

                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <small class="text-muted">
                                            <i class="far fa-calendar me-1"></i>
                                            {{ $post->created_at->format('d/m/Y') }}
                                        </small>
                                        <span class="mx-2">•</span>
                                        <small class="text-muted">
                                            <i class="far fa-clock me-1"></i>
                                            {{ $post->reading_time }} min
                                        </small>
                                    </div>

                                    <h5 class="card-title">
                                        <a href="{{ route('blog.show', $post->slug) }}" class="text-dark">
                                            {{ Str::limit($post->title, 60) }}
                                        </a>
                                    </h5>

                                    <p class="card-text text-muted">
                                        {{ Str::limit($post->excerpt, 120) }}
                                    </p>
                                </div>

                                <div class="card-footer bg-transparent border-top-0">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-link p-0">
                                        Lire l'article <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection


