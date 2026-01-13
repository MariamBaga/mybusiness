@extends('layouts.master')

@section('title', 'Tarifs - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Tarifs',
        'active' => 'Tarifs'
    ])
</section>

<!-- =========================
    PRICING SECTION
========================= -->
<section class="ht-price-area section-padding pb-0">
    <div class="container">
        <div class="ht-price-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ht-price-content">
                        <div class="section-title">
                            <span class="subtitle wow fadeInUp" data-wow-delay=".2s">Formules adaptées</span>
                            <h2 class="title wow fadeInUp" data-wow-delay=".4s">
                                Des tarifs conçus pour chaque entreprise
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay=".6s">
                                MyBusiness propose des formules flexibles pour répondre aux besoins
                                des commerçants, entrepreneurs et PME. Choisissez le plan qui correspond
                                à votre activité et évoluez avec nous.
                            </p>
                        </div>
                        <a href="#" class="ht-btn style-2 wow fadeInUp" data-wow-delay=".8s">
                            Télécharger le business plan
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ht-price-item">

                        <!-- BASIC -->
                        <div class="single-item wow fadeInUp" data-wow-delay=".3s">
                            <div class="left">
                                <span>Basic</span>
                                <h2>15.000 FCFA<span>/mois</span></h2>
                                <a href="#basic-details" class="link" data-bs-toggle="modal">
                                    Voir détails <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="right">
                                <ul class="price-details">
                                    <li><i class="fa-solid fa-check"></i>Suivi des ventes en temps réel</li>
                                    <li><i class="fa-solid fa-check"></i>Gestion simple des stocks</li>
                                    <li><i class="fa-solid fa-check"></i>Rapports basiques</li>
                                    <li><i class="fa-solid fa-check"></i>Support email</li>
                                    <li><i class="fa-solid fa-times"></i>Analyse clients avancée</li>
                                    <li><i class="fa-solid fa-times"></i>Multi-canaux</li>
                                </ul>
                            </div>
                        </div>

                        <!-- PRO (Mise en avant) -->
                        <div class="single-item style-2 wow fadeInUp" data-wow-delay=".6s">
                            <div class="left">
                                <span>Pro <span class="badge bg-warning">Populaire</span></span>
                                <h2>35.000 FCFA<span>/mois</span></h2>
                                <a href="#pro-details" class="link" data-bs-toggle="modal">
                                    Voir détails <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="right">
                                <ul class="price-details">
                                    <li><i class="fa-solid fa-check"></i>Tout le plan Basic</li>
                                    <li><i class="fa-solid fa-check"></i>Rapports détaillés</li>
                                    <li><i class="fa-solid fa-check"></i>Analyse clients</li>
                                    <li><i class="fa-solid fa-check"></i>Gestion multi-utilisateurs (3)</li>
                                    <li><i class="fa-solid fa-check"></i>Support WhatsApp</li>
                                    <li><i class="fa-solid fa-times"></i>Vente en ligne intégrée</li>
                                </ul>
                            </div>
                        </div>

                        <!-- PREMIUM -->
                        <div class="single-item wow fadeInUp" data-wow-delay=".9s">
                            <div class="left">
                                <span>Premium</span>
                                <h2>65.000 FCFA<span>/mois</span></h2>
                                <a href="#premium-details" class="link" data-bs-toggle="modal">
                                    Voir détails <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="right">
                                <ul class="price-details">
                                    <li><i class="fa-solid fa-check"></i>Tout le plan Pro</li>
                                    <li><i class="fa-solid fa-check"></i>Vente multi-canaux</li>
                                    <li><i class="fa-solid fa-check"></i>Boutique en ligne</li>
                                    <li><i class="fa-solid fa-check"></i>Support prioritaire 24/7</li>
                                    <li><i class="fa-solid fa-check"></i>Formation initiale</li>
                                    <li><i class="fa-solid fa-check"></i>Gestion illimitée d'utilisateurs</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ht price area end -->

<!-- =========================
    CTA ABONNEMENT
========================= -->
<section class="section-padding bg-light">
    <div class="container text-center">
        <h3 class="mb-4 wow fadeInUp">Entreprise ? Contactez-nous pour un devis personnalisé</h3>
        <p class="mb-5 wow fadeInUp" data-wow-delay=".2s">
            Pour les grandes entreprises, groupes et réseaux de points de vente, nous proposons
            des solutions sur mesure avec intégration API, formation avancée et support dédié.
        </p>
        <a href="#" class="ht-btn style-2 wow fadeInUp" data-wow-delay=".4s">
            Demander un devis Enterprise
        </a>
    </div>
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
                        <img src="{{ asset('assets/img/faq/pricing-faq.jpg') }}" alt="FAQ MyBusiness">
                    </div>
                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-6">
                    <div class="ht-faq-content">
                        <div class="section-title">
                            <span class="subtitle wow fadeInUp" data-wow-delay=".3s">Questions fréquentes</span>
                            <h2 class="title wow fadeInUp" data-wow-delay=".6s">
                                Tout savoir sur nos tarifs
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay=".9s">
                                Retrouvez ici les réponses aux questions les plus posées
                                concernant nos formules et conditions d'abonnement.
                            </p>
                        </div>
                        <div class="accordion" id="faqAccordion">

                            <div class="accordion-item wow fadeInUp" data-wow-delay="1.2s">
                                <h5 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                        Y A-T-IL UN ESSAI GRATUIT ?
                                    </button>
                                </h5>
                                <div id="faq1" class="accordion-collapse collapse show"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Oui ! Nous offrons une période d'essai de <strong>14 jours</strong>
                                        pour tous nos plans. Aucune carte bancaire requise. Vous pouvez tester
                                        toutes les fonctionnalités de la formule choisie.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item wow fadeInUp" data-wow-delay="1.5s">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false"
                                        aria-controls="faq2">
                                        PUIS-JE CHANGER DE FORMULE ?
                                    </button>
                                </h5>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Absolument. Vous pouvez à tout moment passer à une formule supérieure
                                        ou inférieure. Le changement est effectif immédiatement, avec un
                                        prorata appliqué sur votre facturation mensuelle.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item wow fadeInUp" data-wow-delay="1.8s">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false"
                                        aria-controls="faq3">
                                        QUELS MODES DE PAIEMENT ACCEPTEZ-VOUS ?
                                    </button>
                                </h5>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Nous acceptons les cartes bancaires (Visa, MasterCard), les paiements
                                        mobiles (Orange Money, Moov Money, Wave) et les virements bancaires.
                                        Les paiements sont sécurisés via notre partenaire de paiement.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item wow fadeInUp" data-wow-delay="2.1s">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false"
                                        aria-controls="faq4">
                                        Y A-T-IL DES FRAIS DE RÉSILIATION ?
                                    </button>
                                </h5>
                                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Non. Vous pouvez résilier votre abonnement à tout moment sans frais.
                                        Votre accès reste actif jusqu'à la fin de la période payée.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item wow fadeInUp" data-wow-delay="2.4s">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false"
                                        aria-controls="faq5">
                                        LES DONNÉES SONT- ELLES SÉCURISÉES ?
                                    </button>
                                </h5>
                                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Oui, toutes vos données sont chiffrées et stockées sur des serveurs
                                        sécurisés en Afrique. Nous respectons le RGPD et les lois locales
                                        sur la protection des données.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ht faq area end -->

<!-- =========================
    MODALS POUR DÉTAILS DES FORMULES
========================= -->
@include('web.modals.pricing-details')

@endsection

@push('styles')
<style>
    .single-item.style-2 {
        border: 2px solid #667eea;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.15);
        transform: scale(1.02);
        position: relative;
        z-index: 1;
    }

    .single-item.style-2 .left {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .single-item.style-2 .link {
        color: #fff;
    }

    .single-item.style-2 .price-details li i {
        color: #667eea;
    }

    .badge.bg-warning {
        background-color: #ffc107 !important;
        color: #000;
        font-size: 12px;
        padding: 3px 10px;
        margin-left: 10px;
        border-radius: 20px;
    }

    .price-details li i.fa-check {
        color: #28a745;
        margin-right: 10px;
    }

    .price-details li i.fa-times {
        color: #dc3545;
        margin-right: 10px;
    }

    .price-details li {
        margin-bottom: 8px;
        font-size: 15px;
    }
</style>
@endpush

@push('scripts')
<script>
    // Script pour gérer le modal de souscription
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner un plan
        const planSelectButtons = document.querySelectorAll('.select-plan');

        planSelectButtons.forEach(button => {
            button.addEventListener('click', function() {
                const planName = this.getAttribute('data-plan');
                const planPrice = this.getAttribute('data-price');

                // Mettre à jour le modal de souscription
                document.getElementById('selected-plan').textContent = planName;
                document.getElementById('selected-price').textContent = planPrice;

                // Ouvrir le modal
                const subscriptionModal = new bootstrap.Modal(document.getElementById('subscriptionModal'));
                subscriptionModal.show();
            });
        });

        // Toggle FAQ
        const faqButtons = document.querySelectorAll('.accordion-button');
        faqButtons.forEach(button => {
            button.addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (icon) {
                    if (this.classList.contains('collapsed')) {
                        icon.className = 'fa-solid fa-chevron-up';
                    } else {
                        icon.className = 'fa-solid fa-chevron-down';
                    }
                }
            });
        });
    });
</script>
@endpush
