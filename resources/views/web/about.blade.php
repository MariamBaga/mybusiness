@extends('layouts.master')

@section('title', 'À propos - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'À propos',
        'active' => 'À propos'
    ])
</section>


<!-- =========================
    PRESENTATION MYBUSINESS
========================= -->
<section class="ht-about-area section-padding fix">
    <div class="container">
        <div class="ht-about-wrapper">
            <div class="row align-items-center g-5">

                <div class="col-lg-6">
                    <div class="ht-about-img wow fadeInUp" data-wow-delay=".3s">
                        <img src="{{ asset('assets/img/about/mybusiness.jpg') }}" alt="MyBusiness">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ht-about-content">

                        <div class="section-title">
                            <span class="subtitle wow fadeInUp" data-wow-delay=".2s">Présentation</span>

                            <h2 class="title wow fadeInUp" data-wow-delay=".4s">
                                MyBusiness : Une solution digitale pensée pour les commerçants et PME africaines
                            </h2>

                            <p class="wow fadeInUp" data-wow-delay=".6s">
                                MyBusiness est une solution conçue par ConnectiiX pour aider les commerçants,
                                entrepreneurs et PME à gérer plus efficacement leurs activités. Dans un marché
                                en pleine évolution, MyBusiness offre un accès simple, rapide et intuitif aux données
                                essentielles de votre entreprise.
                            </p>

                            <p class="wow fadeInUp" data-wow-delay=".7s">
                                L’objectif : permettre à chaque acteur économique, même le plus petit,
                                d’accéder aux outils professionnels utilisés par les grandes entreprises.
                            </p>
                        </div>

                        <a href="#" class="ht-btn style-3 wow fadeInUp" data-wow-delay=".9s">
                            Contactez-nous
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- =========================
    MISSION - VISION - VALEURS
========================= -->
<section class="inner-two section-padding fix">
    <div class="container">

        <div class="section-title text-center">
            <span class="subtitle wow fadeInUp" data-wow-delay=".2s">Notre identité</span>
            <h2 class="title wow fadeInUp" data-wow-delay=".4s">Vision, Mission & Valeurs</h2>
        </div>

        <div class="row justify-content-between mt-50">

            <div class="col-lg-4 wow fadeInUp" data-wow-delay=".2s">
                <div class="ht-process-item two mt-25">
                    <span class="step">Vision</span>
                    <p>
                        Accélérer la digitalisation des commerçants et PME africaines, en rendant la technologie
                        accessible à tous.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 wow fadeInUp" data-wow-delay=".4s">
                <div class="ht-process-item two mt-25">
                    <span class="step">Mission</span>
                    <p>
                        Fournir des outils simples, intelligents et abordables pour permettre aux entreprises
                        locales de mieux gérer leurs ventes, stocks, clients et performances.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 wow fadeInUp" data-wow-delay=".6s">
                <div class="ht-process-item two mt-25">
                    <span class="step">Valeurs</span>
                    <p>
                        Innovation — Accessibilité — Transparence
                        Réactivité — Accompagnement personnalisé
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- =========================
    STATISTIQUES / CHIFFRES
========================= -->
<section class="ht-stats-area section-padding fix">
    <div class="container">

        <div class="ht-stats-wrapper wow fadeInUp" data-wow-delay=".3s">

            <div class="ht-stats-items">
                <h2 class="number"><span class="count">25</span>K+</h2>
                <h4>Entreprises accompagnées</h4>
                <p>Commerçants — PME — Entrepreneurs</p>
            </div>

            <div class="ht-stats-items">
                <h2 class="number"><span class="count">120</span>K+</h2>
                <h4>Transactions analysées</h4>
                <p>Une vue claire et fiable sur votre activité.</p>
            </div>

            <div class="ht-stats-items">
                <h2 class="number"><span class="count">98</span>%</h2>
                <h4>Satisfaction client</h4>
                <p>Une plateforme adoptée et approuvée.</p>
            </div>

        </div>

    </div>
</section>


<!-- =========================
    POURQUOI CHOISIR MYBUSINESS
========================= -->
<section class="ht-choose-area section-padding">
    <div class="container">
        <div class="ht-choose-wrapper">

            <div class="row gy-5">

                <div class="col-xl-7 col-lg-6">
                    <div class="ht-choose-left">

                        <div class="content">
                            <h2 class="wow fadeInUp" data-wow-delay=".2s">
                                Pourquoi choisir MyBusiness ?
                            </h2>

                            <p class="wow fadeInUp" data-wow-delay=".4s">
                                MyBusiness propose une solution sécurisée, flexible et moderne pour accompagner
                                les entreprises africaines dans leur transformation digitale.
                                Nous mettons à disposition des outils professionnels, simples d'utilisation
                                et accessibles financièrement.
                            </p>

                            <a href="{{ route('pages.features') }}" class="ht-btn style-4 wow fadeInUp" data-wow-delay=".6s">
                                Découvrir les fonctionnalités
                            </a>
                        </div>

                        <div class="thumb wow fadeInUp" data-wow-delay=".8s">
                            <img src="{{ asset('assets/img/choose/1.jpg') }}" alt="thumb">
                        </div>

                    </div>
                </div>

                <div class="col-xl-5 col-lg-6">
                    <div class="ht-choose-right">

                        <div class="single-item wow fadeInUp" data-wow-delay=".3s">
                            <div class="icon"><img src="{{ asset('assets/img/icon/secure-shield.svg') }}"></div>
                            <div class="content">
                                <h3>Sécurité renforcée</h3>
                                <p>Vos données sont protégées selon les standards internationaux.</p>
                            </div>
                        </div>

                        <div class="single-item wow fadeInUp" data-wow-delay=".6s">
                            <div class="icon"><img src="{{ asset('assets/img/icon/report.svg') }}"></div>
                            <div class="content">
                                <h3>Outils professionnels</h3>
                                <p>Analyse des ventes, stocks, clients et performances.</p>
                            </div>
                        </div>

                        <div class="single-item wow fadeInUp" data-wow-delay=".9s">
                            <div class="icon"><img src="{{ asset('assets/img/icon/support.svg') }}"></div>
                            <div class="content">
                                <h3>Support dédié</h3>
                                <p>Une équipe toujours disponible pour vous accompagner.</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</section>


<!-- =========================
    SPONSORS / PARTENAIRES
========================= -->
<section class="pt-100 pb-100 bg-light">
    <div class="container text-center">

        <h4 class="mb-4 wow fadeInUp">Nos partenaires & sponsors</h4>

        <div class="d-flex justify-content-center gap-4 flex-wrap wow fadeInUp" data-wow-delay=".2s">
            <img src="{{ asset('assets/img/partners/1.png') }}" height="60">
            <img src="{{ asset('assets/img/partners/2.png') }}" height="60">
            <img src="{{ asset('assets/img/partners/3.png') }}" height="60">
            <img src="{{ asset('assets/img/partners/4.png') }}" height="60">
        </div>

    </div>
</section>

@endsection


@push('scripts')
<script>
    $(document).ready(function() {
        $('.count').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script>
@endpush
