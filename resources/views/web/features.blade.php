@extends('layouts.master')

@section('title', 'Fonctionnalités - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Fonctionnalités',
        'active' => 'Fonctionnalités'
    ])
</section>

<!-- =========================
    SECTION INTRODUCTION
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle wow fadeInUp" data-wow-delay=".2s">Puissant & Simple</span>
            <h2 class="title wow fadeInUp" data-wow-delay=".3s">
                Toutes les fonctionnalités pour piloter votre entreprise
            </h2>
            <p class="wow fadeInUp" data-wow-delay=".4s">
                MyBusiness combine simplicité d'utilisation et puissance d'analyse.
                Découvrez comment nos outils vous aident à prendre les bonnes décisions.
            </p>
        </div>
    </div>
</section>

<!-- =========================
    FONCTIONNALITÉS PRINCIPALES
========================= -->
<section class="section-padding bg-light">
    <div class="container">

        <!-- Ventes -->
        <div class="row align-items-center mb-100">
            <div class="col-lg-6">
                <div class="feature-img wow fadeInUp" data-wow-delay=".2s">
                    <img src="{{ asset('assets/img/features/ventes.png') }}"
                         alt="Suivi des ventes MyBusiness" class="rounded shadow">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="feature-content ps-lg-5">
                    <span class="badge bg-primary mb-3">Fonctionnalité 1</span>
                    <h3 class="mb-4">Suivi des ventes en temps réel</h3>
                    <p>
                        Visualisez toutes vos transactions au moment où elles se produisent.
                        Obtenez une vue d'ensemble de votre chiffre d'affaires, suivez les tendances
                        et identifiez vos meilleurs produits.
                    </p>
                    <ul class="feature-list mt-4">
                        <li><i class="fas fa-check-circle text-success me-2"></i> Tableau de bord temps réel</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Analyse par période (jour/semaine/mois)</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Graphiques interactifs</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Export des données (PDF, Excel)</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Stocks -->
        <div class="row align-items-center mb-100 flex-lg-row-reverse">
            <div class="col-lg-6">
                <div class="feature-img wow fadeInUp" data-wow-delay=".2s">
                    <img src="{{ asset('assets/img/features/stocks.png') }}"
                         alt="Gestion des stocks MyBusiness" class="rounded shadow">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="feature-content pe-lg-5">
                    <span class="badge bg-primary mb-3">Fonctionnalité 2</span>
                    <h3 class="mb-4">Gestion intelligente des stocks</h3>
                    <p>
                        Ne manquez plus jamais de produits. Recevez des alertes automatiques
                        lorsque vos stocks sont bas et optimisez vos commandes.
                    </p>
                    <ul class="feature-list mt-4">
                        <li><i class="fas fa-check-circle text-success me-2"></i> Alertes de rupture de stock</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Suivi des mouvements (entrées/sorties)</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Gestion multi-entrepôts</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Scanner par code-barres (mobile)</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Clients -->
        <div class="row align-items-center mb-100">
            <div class="col-lg-6">
                <div class="feature-img wow fadeInUp" data-wow-delay=".2s">
                    <img src="{{ asset('assets/img/features/clients.png') }}"
                         alt="Gestion clients MyBusiness" class="rounded shadow">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="feature-content ps-lg-5">
                    <span class="badge bg-primary mb-3">Fonctionnalité 3</span>
                    <h3 class="mb-4">Analyse approfondie de votre clientèle</h3>
                    <p>
                        Connaissez mieux vos clients pour fidéliser et développer votre business.
                        Segmentation, historique d'achat et campagnes ciblées.
                    </p>
                    <ul class="feature-list mt-4">
                        <li><i class="fas fa-check-circle text-success me-2"></i> Profil client complet</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Segmentation par comportement</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Historique d'achats</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Marketing automatisé (SMS/Email)</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Rapports -->
        <div class="row align-items-center mb-100 flex-lg-row-reverse">
            <div class="col-lg-6">
                <div class="feature-img wow fadeInUp" data-wow-delay=".2s">
                    <img src="{{ asset('assets/img/features/rapports.png') }}"
                         alt="Rapports MyBusiness" class="rounded shadow">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="feature-content pe-lg-5">
                    <span class="badge bg-primary mb-3">Fonctionnalité 4</span>
                    <h3 class="mb-4">Rapports détaillés et automatiques</h3>
                    <p>
                        Des rapports clairs et complets générés automatiquement.
                        Prenez des décisions éclairées basées sur des données fiables.
                    </p>
                    <ul class="feature-list mt-4">
                        <li><i class="fas fa-check-circle text-success me-2"></i> Rapports financiers</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Analyse de rentabilité</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Indicateurs de performance (KPI)</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Programmation d'envoi automatique</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Multi-canaux -->
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="feature-img wow fadeInUp" data-wow-delay=".2s">
                    <img src="{{ asset('assets/img/features/multicanal.png') }}"
                         alt="Vente multi-canaux MyBusiness" class="rounded shadow">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="feature-content ps-lg-5">
                    <span class="badge bg-primary mb-3">Fonctionnalité 5</span>
                    <h3 class="mb-4">Gestion multi-canaux intégrée</h3>
                    <p>
                        Vendez en magasin, en ligne et sur les réseaux sociaux depuis une seule plateforme.
                        Synchronisation automatique de tous vos points de vente.
                    </p>
                    <ul class="feature-list mt-4">
                        <li><i class="fas fa-check-circle text-success me-2"></i> Boutique en ligne intégrée</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Connexion aux réseaux sociaux</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Synchronisation automatique</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Gestion des commandes unique</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- =========================
    TABLEAU COMPARATIF
========================= -->
<section class="section-padding">
    <div class="container">
        <div class="section-title text-center">
            <h3 class="mb-5">Fonctionnalités par formule</h3>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover comparison-table">
                <thead>
                    <tr>
                        <th>Fonctionnalité</th>
                        <th class="text-center">Basic</th>
                        <th class="text-center">Pro</th>
                        <th class="text-center">Premium</th>
                        <th class="text-center">Enterprise</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Suivi des ventes</td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Gestion des stocks</td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Rapports détaillés</td>
                        <td class="text-center"><i class="fas fa-times text-muted"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Analyse clients avancée</td>
                        <td class="text-center"><i class="fas fa-times text-muted"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Vente multi-canaux</td>
                        <td class="text-center"><i class="fas fa-times text-muted"></i></td>
                        <td class="text-center"><i class="fas fa-times text-muted"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Support prioritaire</td>
                        <td class="text-center"><i class="fas fa-times text-muted"></i></td>
                        <td class="text-center"><i class="fas fa-times text-muted"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Formation personnalisée</td>
                        <td class="text-center"><i class="fas fa-times text-muted"></i></td>
                        <td class="text-center"><i class="fas fa-times text-muted"></i></td>
                        <td class="text-center"><i class="fas fa-times text-muted"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-5">
            <a href="#" class="ht-btn style-2">
                Voir les tarifs détaillés
            </a>
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
                <h3 class="mb-3">Prêt à transformer votre gestion d'entreprise ?</h3>
                <p class="mb-0">Commencez votre essai gratuit dès aujourd'hui. Aucune carte bancaire requise.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="#" class="ht-btn style-3">
                    Tester gratuitement
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .feature-list li {
        margin-bottom: 10px;
        font-size: 16px;
    }

    .comparison-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .comparison-table td, .comparison-table th {
        padding: 15px;
        vertical-align: middle;
    }

    .badge.bg-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 6px 15px;
        border-radius: 30px;
        font-weight: 500;
    }
</style>
@endpush
