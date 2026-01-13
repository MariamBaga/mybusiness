@extends('layouts.master')

@section('title', 'FAQ - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'FAQ',
        'active' => 'FAQ'
    ])
</section>

<!-- =========================
    FAQ SECTION
========================= -->
<section class="ht-faq-area section-padding fix">
    <div class="container">
        <div class="ht-faq-wrapper">
            <div class="row gy-5">
                <div class="col-xl-6 col-lg-6">
                    <div class="ht-faq-thumb wow fadeInUp" data-wow-delay=".3s">
                        <img src="{{ asset('assets/img/faq/faq-main.jpg') }}" alt="FAQ MyBusiness">
                    </div>
                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-6">
                    <div class="ht-faq-content">
                        <div class="section-title">
                            <span class="subtitle wow fadeInUp" data-wow-delay=".3s">Questions fréquentes</span>
                            <h2 class="title wow fadeInUp" data-wow-delay=".6s">
                                Tout ce que vous devez savoir
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay=".9s">
                                Retrouvez les réponses aux questions les plus posées sur MyBusiness.
                                Si vous ne trouvez pas votre réponse, n'hésitez pas à nous contacter.
                            </p>
                        </div>
                        <div class="accordion" id="faqAccordion">

                            @forelse($faqs as $index => $faq)
                            <div class="accordion-item wow fadeInUp" data-wow-delay="{{ 1.2 + ($index * 0.3) }}s">
                                <h5 class="accordion-header">
                                    <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#faq{{ $faq->id }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="faq{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h5>
                                <div id="faq{{ $faq->id }}"
                                     class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                     data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="alert alert-info">
                                <p class="mb-0">Aucune FAQ n'est disponible pour le moment.</p>
                            </div>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ht faq area end -->

<!-- =========================
    FAQ PAR CATÉGORIES
========================= -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle wow fadeInUp" data-wow-delay=".2s">Par catégorie</span>
            <h2 class="title wow fadeInUp" data-wow-delay=".4s">Explorez nos FAQ par thématique</h2>
        </div>

        <div class="row mt-50">

            <!-- Compte & Abonnement -->
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".2s">
                <div class="faq-category-card p-4 h-100 rounded-3 bg-white shadow-sm">
                    <div class="icon mb-3">
                        <i class="fa-solid fa-user-circle fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Compte & Abonnement</h4>
                    <p class="mb-4">Questions sur la création de compte, gestion d'abonnement et facturation.</p>
                    <ul class="list-unstyled mb-0">
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Création de compte</li>
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Changement de formule</li>
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Facturation et paiement</li>
                    </ul>
                </div>
            </div>

            <!-- Fonctionnalités -->
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".4s">
                <div class="faq-category-card p-4 h-100 rounded-3 bg-white shadow-sm">
                    <div class="icon mb-3">
                        <i class="fa-solid fa-gears fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Fonctionnalités</h4>
                    <p class="mb-4">Comment utiliser les différentes fonctionnalités de MyBusiness.</p>
                    <ul class="list-unstyled mb-0">
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Gestion des ventes</li>
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Suivi des stocks</li>
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Rapports et analyses</li>
                    </ul>
                </div>
            </div>

            <!-- Support Technique -->
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".6s">
                <div class="faq-category-card p-4 h-100 rounded-3 bg-white shadow-sm">
                    <div class="icon mb-3">
                        <i class="fa-solid fa-headset fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Support Technique</h4>
                    <p class="mb-4">Résolution de problèmes techniques et assistance.</p>
                    <ul class="list-unstyled mb-0">
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Problèmes de connexion</li>
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Applications mobiles</li>
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Import/Export de données</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =========================
    TÉMOIGNAGES
========================= -->
<section class="ht-testimonials-area-2 section-padding">
    <div class="container">
        <div class="section-title-area align-items-lg-end mb-30">
            <div class="section-title mb-0">
                <span class="subtitle wow fadeInUp" data-wow-delay=".2s">TÉMOIGNAGES</span>
                <h2 class="title wow fadeInUp" data-wow-delay=".4s">Ce que disent nos clients</h2>
            </div>
            <div class="ht-testi-btn mt-0 wow fadeInUp" data-wow-delay=".6s">
                <button class="ht-testi-prev ht-testi-prev-2"><i class="fa-solid fa-chevron-left"></i></button>
                <button class="ht-testi-next ht-testi-next-2"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
        <div class="ht-testimonials-wrapper-2">
            <div class="swiper ht-testi-slider-2">
                <div class="swiper-wrapper">

                    <!-- Témoignage 1 -->
                    <div class="swiper-slide">
                        <div class="ht-testimonials-item ht-testimonials-item-2">
                            <div class="star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="desc desc-2">"MyBusiness a révolutionné la gestion de ma boutique.
                                Je gagne 2 heures par jour sur l'administration et je peux me concentrer
                                sur le développement de mon activité."
                            </p>
                            <div class="ht-testimonials-author ht-testimonials-author-2">
                                <div class="avatar">
                                    <img src="{{ asset('assets/img/testimonials/1.jpg') }}" alt="Awa Traoré">
                                </div>
                                <div class="author-info">
                                    <h5 class="name">Awa Traoré</h5>
                                    <p class="role">Boutique de vêtements</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Témoignage 2 -->
                    <div class="swiper-slide">
                        <div class="ht-testimonials-item ht-testimonials-item-2">
                            <div class="star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="desc desc-2">"Grâce au suivi des stocks en temps réel,
                                je n'ai plus de rupture. Les rapports automatisés me permettent
                                de prendre de meilleures décisions commerciales."
                            </p>
                            <div class="ht-testimonials-author ht-testimonials-author-2">
                                <div class="avatar">
                                    <img src="{{ asset('assets/img/testimonials/2.jpg') }}" alt="Moussa Diarra">
                                </div>
                                <div class="author-info">
                                    <h5 class="name">Moussa Diarra</h5>
                                    <p class="role">Magasin d'électronique</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Témoignage 3 -->
                    <div class="swiper-slide">
                        <div class="ht-testimonials-item ht-testimonials-item-2">
                            <div class="star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="desc desc-2">"Le support client est exceptionnel.
                                Réactif, compétent et toujours disponible pour nous aider.
                                MyBusiness est bien plus qu'un outil, c'est un partenaire."
                            </p>
                            <div class="ht-testimonials-author ht-testimonials-author-2">
                                <div class="avatar">
                                    <img src="{{ asset('assets/img/testimonials/3.jpg') }}" alt="Fatou Coulibaly">
                                </div>
                                <div class="author-info">
                                    <h5 class="name">Fatou Coulibaly</h5>
                                    <p class="role">Restauratrice</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- ht testimonials 2 area end -->

<!-- =========================
    CTA CONTACT
========================= -->
<section class="section-padding bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Vous ne trouvez pas votre réponse ?</h3>
                <p class="mb-0">Notre équipe support est disponible pour répondre à toutes vos questions.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="#" class="ht-btn style-3">
                    <i class="fa-solid fa-headset me-2"></i>
                    Nous contacter
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .faq-category-card {
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }

    .faq-category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-color: #667eea;
    }

    .faq-category-card .icon {
        height: 60px;
        display: flex;
        align-items: center;
    }

    .faq-category-card h4 {
        color: #333;
        font-size: 20px;
    }

    .faq-category-card ul li {
        margin-bottom: 8px;
        font-size: 15px;
    }

    .accordion-button {
        font-weight: 600;
        color: #333;
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0;
        padding: 15px 20px;
    }

    .accordion-button:not(.collapsed) {
        color: #667eea;
        background-color: rgba(102, 126, 234, 0.05);
        border-color: #667eea;
    }

    .accordion-button:focus {
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        border-color: #667eea;
    }

    .accordion-body {
        padding: 20px;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-top: none;
        border-radius: 0 0 8px 8px;
    }

    .ht-testimonials-item-2 {
        background: #fff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        height: 100%;
    }

    .star i {
        color: #FFC107;
        margin-right: 3px;
    }

    .desc-2 {
        font-size: 16px;
        line-height: 1.6;
        color: #666;
        margin: 20px 0;
    }

    .ht-testimonials-author-2 {
        display: flex;
        align-items: center;
        margin-top: 20px;
    }

    .ht-testimonials-author-2 .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 15px;
    }

    .ht-testimonials-author-2 .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .ht-testimonials-author-2 .name {
        margin: 0;
        font-size: 18px;
        color: #333;
    }

    .ht-testimonials-author-2 .role {
        margin: 0;
        color: #667eea;
        font-size: 14px;
    }
</style>
@endpush

@push('scripts')
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser le slider de témoignages
        const testimonialSwiper = new Swiper('.ht-testi-slider-2', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            speed: 800,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.ht-testi-next-2',
                prevEl: '.ht-testi-prev-2',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                }
            }
        });

        // Gestion des accordéons FAQ
        const accordionButtons = document.querySelectorAll('.accordion-button');

        accordionButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Fermer tous les autres accordéons
                const allButtons = document.querySelectorAll('.accordion-button');
                const allCollapses = document.querySelectorAll('.accordion-collapse');

                allButtons.forEach(btn => {
                    if (btn !== this) {
                        btn.classList.add('collapsed');
                        btn.setAttribute('aria-expanded', 'false');
                    }
                });

                allCollapses.forEach(collapse => {
                    if (collapse.id !== this.getAttribute('data-bs-target').substring(1)) {
                        collapse.classList.remove('show');
                    }
                });
            });
        });

        // Animation au scroll
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

        // Observer les cartes FAQ
        document.querySelectorAll('.faq-category-card').forEach(card => {
            observer.observe(card);
        });
    });
</script>
@endpush
