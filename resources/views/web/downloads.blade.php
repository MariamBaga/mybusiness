@extends('layouts.master')

@section('title', 'Téléchargements - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Téléchargements',
        'active' => 'Téléchargements'
    ])
</section>

<!-- =========================
    DOCUMENTS SECTION
========================= -->
<section class="ht-downloads-area section-padding">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle wow fadeInUp" data-wow-delay=".2s">Ressources</span>
            <h2 class="title wow fadeInUp" data-wow-delay=".4s">
                Documents et ressources à télécharger
            </h2>
            <p class="wow fadeInUp" data-wow-delay=".6s">
                Accédez à tous nos documents officiels, brochures et ressources
                pour mieux comprendre MyBusiness et ses avantages.
            </p>
        </div>

        <div class="row mt-50">

            <!-- Business Plan -->
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".2s">
                <div class="download-card p-4 h-100 rounded-3 shadow-sm">
                    <div class="card-icon mb-4">
                        <i class="fa-solid fa-file-contract fa-3x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Business Plan</h4>
                    <p class="mb-4">
                        Notre plan d'affaires complet avec analyse de marché,
                        stratégie commerciale et projections financières.
                    </p>
                    <div class="download-info">
                        <div class="file-size mb-2">
                            <i class="fa-solid fa-database me-2"></i>
                            <span>2.5 MB • PDF</span>
                        </div>
                        <div class="file-date mb-3">
                            <i class="fa-solid fa-calendar me-2"></i>
                            <span>Mise à jour : 15 Nov 2024</span>
                        </div>
                    </div>
                    <a href="{{ asset('assets/documents/business-plan.pdf') }}"
                       class="ht-btn style-2 w-100"
                       download>
                        <i class="fa-solid fa-download me-2"></i>
                        Télécharger
                    </a>
                </div>
            </div>

            <!-- Brochure Commerciale -->
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".4s">
                <div class="download-card p-4 h-100 rounded-3 shadow-sm">
                    <div class="card-icon mb-4">
                        <i class="fa-solid fa-brochure fa-3x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Brochure Commerciale</h4>
                    <p class="mb-4">
                        Présentation complète de MyBusiness : fonctionnalités,
                        avantages et témoignages clients.
                    </p>
                    <div class="download-info">
                        <div class="file-size mb-2">
                            <i class="fa-solid fa-database me-2"></i>
                            <span>1.8 MB • PDF</span>
                        </div>
                        <div class="file-date mb-3">
                            <i class="fa-solid fa-calendar me-2"></i>
                            <span>Mise à jour : 10 Nov 2024</span>
                        </div>
                    </div>
                    <a href="{{ asset('assets/documents/brochure.pdf') }}"
                       class="ht-btn style-2 w-100"
                       download>
                        <i class="fa-solid fa-download me-2"></i>
                        Télécharger
                    </a>
                </div>
            </div>

            <!-- Fiches Produits -->
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".6s">
                <div class="download-card p-4 h-100 rounded-3 shadow-sm">
                    <div class="card-icon mb-4">
                        <i class="fa-solid fa-clipboard-list fa-3x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Fiches Produits</h4>
                    <p class="mb-4">
                        Détails complets de toutes nos fonctionnalités
                        avec captures d'écran et études de cas.
                    </p>
                    <div class="download-info">
                        <div class="file-size mb-2">
                            <i class="fa-solid fa-database me-2"></i>
                            <span>3.2 MB • PDF</span>
                        </div>
                        <div class="file-date mb-3">
                            <i class="fa-solid fa-calendar me-2"></i>
                            <span>Mise à jour : 5 Nov 2024</span>
                        </div>
                    </div>
                    <a href="{{ asset('assets/documents/fiches-produits.pdf') }}"
                       class="ht-btn style-2 w-100"
                       download>
                        <i class="fa-solid fa-download me-2"></i>
                        Télécharger
                    </a>
                </div>
            </div>

            <!-- Modèles Économiques -->
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".8s">
                <div class="download-card p-4 h-100 rounded-3 shadow-sm">
                    <div class="card-icon mb-4">
                        <i class="fa-solid fa-chart-pie fa-3x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Modèles Économiques</h4>
                    <p class="mb-4">
                        Modèles Excel pour calculer votre ROI et analyser
                        l'impact de MyBusiness sur votre activité.
                    </p>
                    <div class="download-info">
                        <div class="file-size mb-2">
                            <i class="fa-solid fa-database me-2"></i>
                            <span>4.1 MB • XLSX</span>
                        </div>
                        <div class="file-date mb-3">
                            <i class="fa-solid fa-calendar me-2"></i>
                            <span>Mise à jour : 1 Nov 2024</span>
                        </div>
                    </div>
                    <a href="{{ asset('assets/documents/modeles-economiques.xlsx') }}"
                       class="ht-btn style-2 w-100"
                       download>
                        <i class="fa-solid fa-download me-2"></i>
                        Télécharger
                    </a>
                </div>
            </div>

            <!-- Guide d'Implémentation -->
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="1s">
                <div class="download-card p-4 h-100 rounded-3 shadow-sm">
                    <div class="card-icon mb-4">
                        <i class="fa-solid fa-book-open fa-3x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Guide d'Implémentation</h4>
                    <p class="mb-4">
                        Guide étape par étape pour démarrer avec MyBusiness
                        et configurer votre compte.
                    </p>
                    <div class="download-info">
                        <div class="file-size mb-2">
                            <i class="fa-solid fa-database me-2"></i>
                            <span>5.2 MB • PDF</span>
                        </div>
                        <div class="file-date mb-3">
                            <i class="fa-solid fa-calendar me-2"></i>
                            <span>Mise à jour : 25 Oct 2024</span>
                        </div>
                    </div>
                    <a href="{{ asset('assets/documents/guide-implementation.pdf') }}"
                       class="ht-btn style-2 w-100"
                       download>
                        <i class="fa-solid fa-download me-2"></i>
                        Télécharger
                    </a>
                </div>
            </div>

            <!-- Études de Cas -->
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="1.2s">
                <div class="download-card p-4 h-100 rounded-3 shadow-sm">
                    <div class="card-icon mb-4">
                        <i class="fa-solid fa-chart-line fa-3x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Études de Cas Clients</h4>
                    <p class="mb-4">
                        Retours d'expérience et résultats concrets
                        de nos clients utilisant MyBusiness.
                    </p>
                    <div class="download-info">
                        <div class="file-size mb-2">
                            <i class="fa-solid fa-database me-2"></i>
                            <span>2.8 MB • PDF</span>
                        </div>
                        <div class="file-date mb-3">
                            <i class="fa-solid fa-calendar me-2"></i>
                            <span>Mise à jour : 20 Oct 2024</span>
                        </div>
                    </div>
                    <a href="{{ asset('assets/documents/etudes-cas.pdf') }}"
                       class="ht-btn style-2 w-100"
                       download>
                        <i class="fa-solid fa-download me-2"></i>
                        Télécharger
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =========================
    STATISTIQUES TÉLÉCHARGEMENTS
========================= -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row text-center">

            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".2s">
                <div class="stat-card p-4">
                    <h2 class="display-4 text-primary mb-2">2,500+</h2>
                    <p class="mb-0">Téléchargements mensuels</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".4s">
                <div class="stat-card p-4">
                    <h2 class="display-4 text-primary mb-2">15+</h2>
                    <p class="mb-0">Documents disponibles</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".6s">
                <div class="stat-card p-4">
                    <h2 class="display-4 text-primary mb-2">98%</h2>
                    <p class="mb-0">Satisfaction des téléchargeurs</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".8s">
                <div class="stat-card p-4">
                    <h2 class="display-4 text-primary mb-2">24/7</h2>
                    <p class="mb-0">Disponibilité des documents</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =========================
    FAQ TÉLÉCHARGEMENTS
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="section-title text-center">
            <h3 class="mb-4">Questions fréquentes sur les téléchargements</h3>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="downloadsFaq">

                    <div class="accordion-item wow fadeInUp">
                        <h5 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                Les documents sont-ils gratuits ?
                            </button>
                        </h5>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#downloadsFaq">
                            <div class="accordion-body">
                                Oui, tous les documents proposés sur cette page sont entièrement gratuits.
                                Aucun paiement n'est requis pour télécharger nos ressources.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item wow fadeInUp">
                        <h5 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false"
                                aria-controls="faq2">
                                Quels formats de fichiers sont disponibles ?
                            </button>
                        </h5>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#downloadsFaq">
                            <div class="accordion-body">
                                La majorité de nos documents sont au format PDF pour une lecture universelle.
                                Certains documents utilitaires (modèles économiques) sont au format Excel (.xlsx).
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item wow fadeInUp">
                        <h5 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false"
                                aria-controls="faq3">
                                Puis-je partager ces documents avec mon équipe ?
                            </button>
                        </h5>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#downloadsFaq">
                            <div class="accordion-body">
                                Absolument ! Vous êtes encouragé à partager ces ressources avec vos collaborateurs,
                                partenaires ou toute personne intéressée par MyBusiness.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item wow fadeInUp">
                        <h5 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false"
                                aria-controls="faq4">
                                À quelle fréquence les documents sont-ils mis à jour ?
                            </button>
                        </h5>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#downloadsFaq">
                            <div class="accordion-body">
                                Nous mettons à jour nos documents trimestriellement pour refléter les dernières
                                évolutions de MyBusiness. La date de dernière mise à jour est indiquée sur chaque document.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================
    CTA CONTACT
========================= -->
<section class="section-padding bg-primary text-white">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Besoin de documents personnalisés ?</h3>
                <p class="mb-4">
                    Pour les partenaires et entreprises, nous pouvons préparer des documents
                    sur mesure adaptés à vos besoins spécifiques.
                </p>
                <a href="{{ route('support.contact') }}" class="ht-btn style-3">
                    <i class="fa-solid fa-file-circle-question me-2"></i>
                    Demander des documents personnalisés
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .download-card {
        background: white;
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .download-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        border-color: #667eea;
    }

    .card-icon {
        height: 70px;
        display: flex;
        align-items: center;
    }

    .download-card h4 {
        color: #333;
        font-size: 20px;
        min-height: 60px;
    }

    .download-card p {
        color: #666;
        flex-grow: 1;
    }

    .download-info {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .file-size, .file-date {
        display: flex;
        align-items: center;
        font-size: 14px;
        color: #666;
    }

    .file-size i, .file-date i {
        width: 20px;
        color: #667eea;
    }

    .stat-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        transition: all 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .stat-card h2 {
        font-weight: 700;
    }

    .accordion-item {
        border: 1px solid #e0e0e0;
        border-radius: 8px !important;
        margin-bottom: 15px;
        overflow: hidden;
    }

    .accordion-button {
        background-color: #f8f9fa;
        font-weight: 600;
        padding: 15px 20px;
    }

    .accordion-button:not(.collapsed) {
        background-color: rgba(102, 126, 234, 0.05);
        color: #667eea;
    }

    .accordion-body {
        padding: 20px;
        background: white;
    }

    .fa-brochure:before {
        content: "\f02d";
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Suivi des téléchargements
        const downloadButtons = document.querySelectorAll('.download-card a[download]');

        downloadButtons.forEach(button => {
            button.addEventListener('click', function() {
                const fileName = this.getAttribute('href').split('/').pop();

                // Envoyer une statistique (simulation)
                console.log('Document téléchargé :', fileName);

                // Ici, vous pourriez envoyer une requête AJAX à votre backend
                // pour suivre les statistiques de téléchargement

                // Exemple :
                // fetch('/api/track-download', {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type': 'application/json',
                //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                //     },
                //     body: JSON.stringify({ filename: fileName })
                // });
            });
        });

        // Animation des statistiques
        const counters = document.querySelectorAll('.stat-card h2');

        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace(/[^0-9]/g, ''));
            const suffix = counter.textContent.replace(/[0-9]/g, '');
            let current = 0;
            const increment = target / 100;

            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.ceil(current) + suffix;
                    setTimeout(updateCounter, 20);
                } else {
                    counter.textContent = target + suffix;
                }
            };

            // Démarrer l'animation quand la section est visible
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    updateCounter();
                    observer.unobserve(counter.parentElement);
                }
            }, { threshold: 0.5 });

            observer.observe(counter.parentElement);
        });
    });
</script>
@endpush
