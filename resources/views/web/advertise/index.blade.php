@extends('layouts.master')

@section('title', 'Publicité sur MyBusiness - Atteignez des milliers de commerçants')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Publicité',
        'active' => 'Promouvoir votre entreprise'
    ])
</section>

<!-- =========================
    HERO PUBLICITÉ
========================= -->
<section class="ht-hero-area advertise-hero" data-bg-src="{{ asset('assets/img/advertise/hero-bg.jpg') }}">
    <div class="container">
        <div class="ht-hero-content text-center text-white">
            <h1 class="wow fadeInUp" data-wow-delay=".2s">
                Votre publicité sur MyBusiness
            </h1>
            <p class="desc wow fadeInUp" data-wow-delay=".4s">
                Atteignez des milliers de commerçants, entrepreneurs et PME africains.<br>
                La plateforme idéale pour promouvoir vos produits et services.
            </p>
            <div class="mt-4 wow fadeInUp" data-wow-delay=".6s">
                <a href="{{ route('advertise.create') }}" class="ht-btn style-2 me-3">
                    <i class="fas fa-bullhorn me-2"></i>Créer une publicité
                </a>
                <a href="#pricing" class="ht-btn btn-outline-light">
                    <i class="fas fa-tags me-2"></i>Voir les tarifs
                </a>
            </div>
        </div>
    </div>
</section>

<!-- =========================
    STATISTIQUES AUDIENCE
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">Notre audience</span>
            <h2 class="title">Pourquoi choisir MyBusiness ?</h2>
        </div>

        <div class="row mt-5 g-4">
            @foreach($stats as $key => $stat)
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                <div class="audience-card text-center p-4 rounded-3 shadow-sm border">
                    @php
                        $icons = [
                            'monthly_visitors' => 'fas fa-users',
                            'audience' => 'fas fa-chart-line',
                            'countries' => 'fas fa-globe-africa',
                            'satisfaction' => 'fas fa-star'
                        ];
                        $colors = [
                            'monthly_visitors' => 'text-primary',
                            'audience' => 'text-success',
                            'countries' => 'text-info',
                            'satisfaction' => 'text-warning'
                        ];
                    @endphp
                    <div class="audience-icon mb-3">
                        <i class="{{ $icons[$key] }} fa-3x {{ $colors[$key] }}"></i>
                    </div>
                    <h3 class="display-5 fw-bold mb-2">{{ $stat }}</h3>
                    @switch($key)
                        @case('monthly_visitors')
                            <p class="mb-0">Visiteurs mensuels</p>
                            @break
                        @case('audience')
                            <p class="mb-0">Audience ciblée</p>
                            @break
                        @case('countries')
                            <p class="mb-0">Pays couverts</p>
                            @break
                        @case('satisfaction')
                            <p class="mb-0">Taux de satisfaction</p>
                            @break
                    @endswitch
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =========================
    FORMATS PUBLICITAIRES
========================= -->
<section class="section-padding bg-light" id="formats">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">Nos formats</span>
            <h2 class="title">Choisissez le format qui vous convient</h2>
            <p class="lead">Différents formats pour différentes stratégies</p>
        </div>

        <div class="row mt-5 g-4">
            @foreach($formats as $key => $format)
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                <div class="format-card card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="format-badge mb-3">
                            @switch($key)
                                @case('sidebar')
                                    <i class="fas fa-columns fa-3x text-primary"></i>
                                    @break
                                @case('header')
                                    <i class="fas fa-header fa-3x text-success"></i>
                                    @break
                                @case('footer')
                                    <i class="fas fa-window-minimize fa-3x text-info"></i>
                                    @break
                                @case('popup')
                                    <i class="fas fa-expand fa-3x text-warning"></i>
                                    @break
                            @endswitch
                        </div>
                        <h4 class="card-title mb-3">{{ $format['name'] }}</h4>
                        <p class="card-text text-muted mb-3">
                            {{ $format['description'] }}
                        </p>
                        <div class="format-size">
                            <span class="badge bg-secondary">{{ $format['size'] }}</span>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('advertise.pricing') }}#{{ $key }}"
                               class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-tag me-1"></i>Voir tarif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =========================
    TARIFS (Section)
========================= -->
<section class="section-padding" id="pricing">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">Nos tarifs</span>
            <h2 class="title">Des tarifs adaptés à vos besoins</h2>
            <p class="lead">Transparent et compétitif</p>
        </div>

        <div class="row mt-5 justify-content-center g-4">
            @foreach($pricing as $key => $plan)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.2 }}s">
                <div class="pricing-card card h-100 border-0 shadow-lg {{ $key == 'header' ? 'popular' : '' }}">
                    @if($key == 'header')
                    <div class="popular-badge">
                        <span class="badge bg-warning">Le plus populaire</span>
                    </div>
                    @endif

                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h4 class="card-title mb-3">{{ $plan['name'] }}</h4>
                            <div class="price-display">
                                <h2 class="display-4 fw-bold text-primary mb-0">
                                    {{ $plan['price'] }}
                                </h2>
                                <p class="text-muted">{{ $plan['period'] }}</p>
                            </div>
                        </div>

                        <ul class="list-unstyled mb-4">
                            @foreach($plan['features'] as $feature)
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>

                        <div class="text-center mt-4">
                            <a href="{{ route('advertise.create') }}?format={{ $key }}"
                               class="ht-btn w-100 {{ $key == 'header' ? 'style-2' : 'btn-outline-primary' }}">
                                <i class="fas fa-rocket me-2"></i>
                                Choisir ce format
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('advertise.pricing') }}" class="ht-btn style-3">
                <i class="fas fa-file-invoice-dollar me-2"></i>Voir tous les détails tarifaires
            </a>
        </div>
    </div>
</section>

<!-- =========================
    PROCÉDURE
========================= -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">Comment ça marche ?</span>
            <h2 class="title">3 étapes simples</h2>
        </div>

        <div class="row mt-5 g-4">
            <div class="col-lg-4 wow fadeInUp" data-wow-delay=".2s">
                <div class="process-card text-center p-4">
                    <div class="process-number mb-3">
                        <span class="number-circle">1</span>
                    </div>
                    <h4 class="mb-3">Choisissez votre format</h4>
                    <p class="text-muted">
                        Sélectionnez le format publicitaire qui correspond à vos besoins
                        et à votre budget.
                    </p>
                    <div class="process-icon mt-3">
                        <i class="fas fa-mouse-pointer fa-2x text-primary"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 wow fadeInUp" data-wow-delay=".4s">
                <div class="process-card text-center p-4">
                    <div class="process-number mb-3">
                        <span class="number-circle">2</span>
                    </div>
                    <h4 class="mb-3">Configurez votre annonce</h4>
                    <p class="text-muted">
                        Téléchargez votre visuel, ajoutez votre message
                        et définissez la période de diffusion.
                    </p>
                    <div class="process-icon mt-3">
                        <i class="fas fa-edit fa-2x text-success"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 wow fadeInUp" data-wow-delay=".6s">
                <div class="process-card text-center p-4">
                    <div class="process-number mb-3">
                        <span class="number-circle">3</span>
                    </div>
                    <h4 class="mb-3">Publiez et suivez</h4>
                    <p class="text-muted">
                        Procédez au paiement et suivez les performances
                        de votre campagne en temps réel.
                    </p>
                    <div class="process-icon mt-3">
                        <i class="fas fa-chart-line fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================
    TEMOIGNAGES ANNONCEURS
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle">Ils nous font confiance</span>
            <h2 class="title">Ce que disent nos annonceurs</h2>
        </div>

        <div class="row mt-5 g-4">
            @for($i = 1; $i <= 3; $i++)
            <div class="col-lg-4 wow fadeInUp" data-wow-delay="{{ ($i-1) * 0.2 }}s">
                <div class="testimonial-card card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="rating mb-3">
                            @for($j = 1; $j <= 5; $j++)
                            <i class="fas fa-star text-warning"></i>
                            @endfor
                        </div>
                        <p class="mb-4">
                            "Grâce à MyBusiness, nous avons augmenté notre visibilité
                            auprès des commerçants locaux. Les résultats dépassent
                            nos attentes !"
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="avatar me-3">
                                <img src="{{ asset('assets/img/testimonials/advertiser-' . $i . '.jpg') }}"
                                     alt="Annonceur"
                                     class="rounded-circle"
                                     width="50"
                                     height="50">
                            </div>
                            <div>
                                <h6 class="mb-1">Entreprise {{ $i }}</h6>
                                <small class="text-muted">Annonceur depuis 2023</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- =========================
    CTA FINAL
========================= -->
<section class="section-padding bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Prêt à lancer votre campagne ?</h3>
                <p class="mb-0">
                    Rejoignez les entreprises qui utilisent déjà MyBusiness
                    pour atteindre leur audience idéale.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('advertise.create') }}" class="ht-btn style-3">
                    <i class="fas fa-rocket me-2"></i>Commencer maintenant
                </a>
            </div>
        </div>
    </div>
</section>

<!-- =========================
    FAQ
========================= -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-title text-center">
            <h3 class="mb-4">Questions fréquentes</h3>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="accordion" id="faqAccordion">
                    @php
                        $faqs = [
                            [
                                'question' => 'Quels formats d\'images sont acceptés ?',
                                'answer' => 'Nous acceptons les formats JPG, PNG et WebP. La taille maximale est de 5MB. Les dimensions recommandées varient selon le format choisi.'
                            ],
                            [
                                'question' => 'Combien de temps prend la validation d\'une publicité ?',
                                'answer' => 'La validation est généralement effectuée dans les 24 heures ouvrables. Une fois validée, votre publicité est immédiatement mise en ligne.'
                            ],
                            [
                                'question' => 'Puis-je modifier ma publicité après publication ?',
                                'answer' => 'Oui, vous pouvez modifier votre publicité à tout moment depuis votre espace annonceur. Les modifications sont soumises à validation.'
                            ],
                            [
                                'question' => 'Comment suivre les performances de ma campagne ?',
                                'answer' => 'Un tableau de bord détaillé vous est fourni avec les statistiques de vues, clics et taux d\'engagement en temps réel.'
                            ],
                            [
                                'question' => 'Quels sont les modes de paiement acceptés ?',
                                'answer' => 'Nous acceptons Orange Money, MTN Mobile Money, Wave et les cartes bancaires via un paiement sécurisé.'
                            ]
                        ];
                    @endphp

                    @foreach($faqs as $index => $faq)
                    <div class="accordion-item border-0 mb-3">
                        <h5 class="accordion-header">
                            <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq{{ $index }}">
                                {{ $faq['question'] }}
                            </button>
                        </h5>
                        <div id="faq{{ $index }}"
                             class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                             data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ $faq['answer'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.advertise-hero {
    background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7));
    padding: 100px 0;
}

.advertise-hero .ht-hero-content h1 {
    color: white;
    font-size: 3.5rem;
    margin-bottom: 1.5rem;
}

.audience-card {
    transition: all 0.3s ease;
    background: white;
}

.audience-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    border-color: #667eea !important;
}

.audience-icon i {
    transition: transform 0.3s;
}

.audience-card:hover .audience-icon i {
    transform: scale(1.1);
}

.format-card {
    transition: all 0.3s ease;
    border: 1px solid #eaeaea;
}

.format-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border-color: #667eea;
}

.format-badge i {
    transition: transform 0.3s;
}

.format-card:hover .format-badge i {
    transform: scale(1.1);
}

.pricing-card {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.pricing-card.popular {
    border: 2px solid #ffc107;
    transform: scale(1.05);
}

.pricing-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.popular-badge {
    position: absolute;
    top: 20px;
    right: 20px;
}

.popular-badge .badge {
    font-size: 0.8rem;
    padding: 5px 10px;
}

.price-display {
    padding: 20px 0;
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    border-radius: 10px;
    margin-bottom: 20px;
}

.process-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: all 0.3s;
}

.process-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.number-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
    border-radius: 50%;
    font-size: 24px;
    font-weight: bold;
}

.testimonial-card {
    transition: all 0.3s ease;
    border: 1px solid #eaeaea;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border-color: #ffc107;
}

.rating i {
    margin-right: 2px;
}

.accordion-button {
    background-color: white;
    font-weight: 600;
    padding: 15px 20px;
    border-radius: 8px !important;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.accordion-button:not(.collapsed) {
    background-color: white;
    color: #667eea;
    box-shadow: 0 2px 10px rgba(102, 126, 234, 0.1);
}

.accordion-button:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.accordion-body {
    background-color: #f8f9fa;
    border-radius: 0 0 8px 8px;
    padding: 20px;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des nombres
    const statsNumbers = document.querySelectorAll('.audience-card h3');

    statsNumbers.forEach(stat => {
        const text = stat.textContent;
        const value = parseFloat(text.replace(/[^0-9]/g, ''));
        const suffix = text.replace(/[0-9]/g, '');

        if (!isNaN(value)) {
            let current = 0;
            const increment = value / 50;

            const updateStat = () => {
                if (current < value) {
                    current += increment;
                    stat.textContent = Math.ceil(current).toLocaleString('fr-FR') + suffix;
                    setTimeout(updateStat, 30);
                } else {
                    stat.textContent = value.toLocaleString('fr-FR') + suffix;
                }
            };

            // Observer pour déclencher l'animation quand visible
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    updateStat();
                    observer.unobserve(stat);
                }
            });

            observer.observe(stat.parentElement.parentElement);
        }
    });

    // Animation des prix
    const priceElements = document.querySelectorAll('.price-display h2');

    priceElements.forEach(price => {
        const text = price.textContent;
        const value = parseFloat(text.replace(/[^0-9]/g, ''));
        const suffix = text.replace(/[0-9,]/g, '');

        if (!isNaN(value)) {
            let current = 0;
            const increment = value / 100;

            const updatePrice = () => {
                if (current < value) {
                    current += increment;
                    price.textContent = Math.ceil(current).toLocaleString('fr-FR') + suffix;
                    setTimeout(updatePrice, 20);
                } else {
                    price.textContent = value.toLocaleString('fr-FR') + suffix;
                }
            };

            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    updatePrice();
                    observer.unobserve(price);
                }
            });

            observer.observe(price.parentElement.parentElement);
        }
    });

    // Smooth scroll pour les ancres
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Initialiser les tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endpush
