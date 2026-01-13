@extends('layouts.master')

@section('title', 'Accueil - MyBusiness')

@section('content')

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
<section class="ht-services-area pt-120 pb-80">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle wow fadeInUp" data-wow-delay=".2s">Fonctionnalités clés</span>
            <h2 class="title wow fadeInUp" data-wow-delay=".3s">
                Tout ce dont votre entreprise a besoin
            </h2>
        </div>

        <div class="row mt-50">

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                <div class="ht-services-items mt-30">
                    <div class="icon"><img src="{{ asset('assets/img/icon/sales.svg') }}" alt=""></div>
                    <h3 class="title">Suivi des ventes</h3>
                    <p>Gardez un œil sur toutes vos transactions en temps réel.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="ht-services-items mt-30">
                    <div class="icon"><img src="{{ asset('assets/img/icon/stocks.svg') }}" alt=""></div>
                    <h3 class="title">Gestion des stocks</h3>
                    <p>Identifiez les produits disponibles, les ruptures et les tendances.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                <div class="ht-services-items mt-30">
                    <div class="icon"><img src="{{ asset('assets/img/icon/report.svg') }}" alt=""></div>
                    <h3 class="title">Rapports intelligents</h3>
                    <p>Analyse détaillée des ventes, clients et performances.</p>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ============================
    VIDEO DEMO (placeholder)
============================= -->
<section class="pt-100 pb-100 bg-light">
    <div class="container text-center">
        <h2 class="wow fadeInUp mb-4" data-wow-delay=".2s">Découvrez MyBusiness en vidéo</h2>

        <div class="video-wrapper wow fadeInUp" data-wow-delay=".3s">
            <iframe width="100%" height="450"
                src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                title="Demo Video" frameborder="0" allowfullscreen>
            </iframe>
        </div>
    </div>
</section>


<!-- ============================
    PARTNERS
============================= -->
<section class="pt-60 pb-60">
    <div class="container">
        <h4 class="text-center mb-4 wow fadeInUp">Ils nous font confiance</h4>

        <div class="d-flex justify-content-center gap-4 flex-wrap wow fadeInUp" data-wow-delay=".2s">
            <img src="{{ asset('assets/img/partners/1.png') }}" height="60">
            <img src="{{ asset('assets/img/partners/2.png') }}" height="60">
            <img src="{{ asset('assets/img/partners/3.png') }}" height="60">
            <img src="{{ asset('assets/img/partners/4.png') }}" height="60">
        </div>
    </div>
</section>


<!-- ============================
    TESTIMONIALS
============================= -->
<section class="pt-130 pb-130">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">Témoignages</span>
            <h2 class="title">Ils utilisent déjà MyBusiness</h2>
        </div>

        <div class="row mt-60">

            <div class="col-lg-4 wow fadeInUp" data-wow-delay=".2s">
                <div class="testimonial-box">
                    <p>“Une solution révolutionnaire ! J’ai doublé mes ventes en 3 mois.”</p>
                    <h5 class="name">Awa Traoré</h5>
                    <span>Commerçante</span>
                </div>
            </div>

            <div class="col-lg-4 wow fadeInUp" data-wow-delay=".3s">
                <div class="testimonial-box">
                    <p>“Le suivi des stocks est impeccable, fini les ruptures.”</p>
                    <h5 class="name">Moussa Diarra</h5>
                    <span>Boutique d’électronique</span>
                </div>
            </div>

            <div class="col-lg-4 wow fadeInUp" data-wow-delay=".4s">
                <div class="testimonial-box">
                    <p>“Rapports simples, clairs et rapides. Je recommande !”</p>
                    <h5 class="name">Fatou Coulibaly</h5>
                    <span>Entrepreneure</span>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ============================
    STATISTIQUES
============================= -->
<section class="pt-100 pb-100 bg-light">
    <div class="container">

        <div class="row text-center">

            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".1s">
                <h2><span class="count">25</span>K+</h2>
                <p>Utilisateurs actifs</p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".2s">
                <h2><span class="count">120</span>K+</h2>
                <p>Transactions suivies</p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".3s">
                <h2><span class="count">98</span>%</h2>
                <p>Taux de satisfaction</p>
            </div>

            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                <h2><span class="count">45</span>+</h2>
                <p>Partenaires</p>
            </div>

        </div>
    </div>
</section>

@endsection


@push('scripts')
<script>
    $(document).ready(function() {
        $('.count').counterUp({
            delay: 10,
            time: 800
        });
    });
</script>
@endpush
