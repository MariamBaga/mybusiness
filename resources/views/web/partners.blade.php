@extends('layouts.master')

@section('title', 'Partenaires & Sponsors - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Partenaires',
        'active' => 'Partenaires'
    ])
</section>

<!-- =========================
    PARTNERS HERO
========================= -->
<section class="section-padding bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="partners-hero-content">
                    <h1 class="display-5 mb-4">Rejoignez l'écosystème MyBusiness</h1>
                    <p class="lead mb-4">
                        Ensemble, accélérons la digitalisation des PME africaines.
                        Devenez partenaire ou sponsor officiel et bénéficiez d'une visibilité
                        exceptionnelle auprès de notre communauté.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#partners-form" class="ht-btn style-3">
                            Devenir partenaire
                        </a>
                        <a href="#sponsors-form" class="ht-btn style-4">
                            Devenir sponsor
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="partners-hero-img">
                    <img src="{{ asset('assets/img/partners/hero.png') }}"
                         alt="Partenaires MyBusiness"
                         class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================
    PARTENAIRES ACTUELS
========================= -->
<section class="ht-partners-area section-padding">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle wow fadeInUp" data-wow-delay=".2s">Nos Partenaires</span>
            <h2 class="title wow fadeInUp" data-wow-delay=".4s">
                Ils nous font confiance
            </h2>
            <p class="wow fadeInUp" data-wow-delay=".6s">
                Découvrez les entreprises innovantes qui accompagnent notre mission
                de digitalisation des PME africaines.
            </p>
        </div>

        <!-- Partenaires Principaux -->
        <div class="partners-section mt-5">
            <h4 class="text-center mb-5 wow fadeInUp">Partenaires Principaux</h4>
            <div class="row justify-content-center g-4">

                <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="partner-card p-4 text-center h-100">
                        <div class="partner-logo mb-3">
                            <img src="{{ asset('assets/img/partners/banque.jpg') }}"
                                 alt="Banque Partenaire"
                                 height="60">
                        </div>
                        <h5 class="mb-2">Banque Digitale</h5>
                        <p class="small text-muted mb-3">Solutions bancaires innovantes</p>
                        <a href="#" class="partner-link">Visiter le site</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="partner-card p-4 text-center h-100">
                        <div class="partner-logo mb-3">
                            <img src="{{ asset('assets/img/partners/logistique.jpg') }}"
                                 alt="Logistique Partenaire"
                                 height="60">
                        </div>
                        <h5 class="mb-2">Logistique Express</h5>
                        <p class="small text-muted mb-3">Livraison et transport</p>
                        <a href="#" class="partner-link">Visiter le site</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".6s">
                    <div class="partner-card p-4 text-center h-100">
                        <div class="partner-logo mb-3">
                            <img src="{{ asset('assets/img/partners/tech.jpg') }}"
                                 alt="Tech Partenaire"
                                 height="60">
                        </div>
                        <h5 class="mb-2">Solutions Tech</h5>
                        <p class="small text-muted mb-3">Infrastructure cloud</p>
                        <a href="#" class="partner-link">Visiter le site</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".8s">
                    <div class="partner-card p-4 text-center h-100">
                        <div class="partner-logo mb-3">
                            <img src="{{ asset('assets/img/partners/formation.jpg') }}"
                                 alt="Formation Partenaire"
                                 height="60">
                        </div>
                        <h5 class="mb-2">Académie Digitale</h5>
                        <p class="small text-muted mb-3">Formation et certification</p>
                        <a href="#" class="partner-link">Visiter le site</a>
                    </div>
                </div>

            </div>
        </div>

        <!-- Partenaires Institutionnels -->
        <div class="partners-section mt-5 pt-5 border-top">
            <h4 class="text-center mb-5 wow fadeInUp">Partenaires Institutionnels</h4>
            <div class="row justify-content-center g-4">

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="partner-card institutional p-4 text-center h-100">
                        <div class="partner-logo mb-3">
                            <img src="{{ asset('assets/img/partners/gouvernement.jpg') }}"
                                 alt="Gouvernement"
                                 height="50">
                        </div>
                        <h5 class="mb-2">Ministère du Commerce</h5>
                        <p class="small text-muted mb-3">Programme de digitalisation</p>
                        <div class="badge bg-primary">Partenariat Public-Privé</div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="partner-card institutional p-4 text-center h-100">
                        <div class="partner-logo mb-3">
                            <img src="{{ asset('assets/img/partners/chambre.jpg') }}"
                                 alt="Chambre de Commerce"
                                 height="50">
                        </div>
                        <h5 class="mb-2">Chambre de Commerce</h5>
                        <p class="small text-muted mb-3">Réseau d'entreprises</p>
                        <div class="badge bg-primary">Accompagnement</div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                    <div class="partner-card institutional p-4 text-center h-100">
                        <div class="partner-logo mb-3">
                            <img src="{{ asset('assets/img/partners/ong.jpg') }}"
                                 alt="ONG Internationale"
                                 height="50">
                        </div>
                        <h5 class="mb-2">ONG Développement</h5>
                        <p class="small text-muted mb-3">Financement et soutien</p>
                        <div class="badge bg-primary">Coopération Internationale</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- =========================
    AVANTAGES PARTENARIAT
========================= -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="title mb-5">Avantages du partenariat</h2>
        </div>

        <div class="row g-4">

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                <div class="benefit-card p-4 h-100 rounded-3">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-chart-line fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Visibilité accrue</h4>
                    <p class="mb-0">
                        Présence sur notre site, réseaux sociaux et événements.
                        Accès à notre base de +25 000 entreprises.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                <div class="benefit-card p-4 h-100 rounded-3">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-handshake fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Opportunités commerciales</h4>
                    <p class="mb-0">
                        Leads qualifiés, co-marquage, offres bundle et
                        recommandations à notre communauté.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                <div class="benefit-card p-4 h-100 rounded-3">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-users fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Réseau exclusif</h4>
                    <p class="mb-0">
                        Accès à notre réseau de partenaires, événements privés
                        et rencontres business.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                <div class="benefit-card p-4 h-100 rounded-3">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-gem fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Contenu premium</h4>
                    <p class="mb-0">
                        Publication d'articles, études de cas et webinaires
                        conjoints sur nos plateformes.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1s">
                <div class="benefit-card p-4 h-100 rounded-3">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-trophy fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Reconnaissance</h4>
                    <p class="mb-0">
                        Certification "Partenaire Officiel", badge digital
                        et mentions spéciales dans nos communications.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1.2s">
                <div class="benefit-card p-4 h-100 rounded-3">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-headset fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Support dédié</h4>
                    <p class="mb-0">
                        Account manager dédié, support technique prioritaire
                        et formation spécifique.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =========================
    FORMULAIRE PARTENAIRE
========================= -->
<section id="partners-form" class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-wrapper p-5 rounded-3 shadow-sm">
                    <div class="section-title text-center">
                        <h3 class="title mb-3">Devenir Partenaire MyBusiness</h3>
                        <p class="mb-4">
                            Remplissez ce formulaire pour initier un partenariat avec MyBusiness.
                            Notre équipe vous contactera sous 48h.
                        </p>
                    </div>

                    <form id="partnerForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="company" class="form-label">Nom de l'entreprise *</label>
                                <input type="text" class="form-control" id="company" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="website" class="form-label">Site web</label>
                                <input type="url" class="form-control" id="website">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="contact_name" class="form-label">Nom du contact *</label>
                                <input type="text" class="form-control" id="contact_name" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="contact_email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="contact_email" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Téléphone *</label>
                                <input type="tel" class="form-control" id="phone" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sector" class="form-label">Secteur d'activité *</label>
                                <select class="form-control" id="sector" required>
                                    <option value="">Sélectionnez...</option>
                                    <option value="finance">Finance & Banque</option>
                                    <option value="logistics">Logistique & Transport</option>
                                    <option value="technology">Technologie</option>
                                    <option value="formation">Formation & Éducation</option>
                                    <option value="retail">Commerce & Retail</option>
                                    <option value="other">Autre</option>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="message" class="form-label">Message / Proposition *</label>
                                <textarea class="form-control" id="message" rows="4" required
                                          placeholder="Décrivez votre entreprise et votre proposition de partenariat..."></textarea>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label" for="terms">
                                        J'accepte les conditions de partenariat et la politique de confidentialité
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="ht-btn style-2">
                                    <i class="fa-solid fa-paper-plane me-2"></i>
                                    Envoyer la demande
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================
    SPONSORS
========================= -->
<section id="sponsors-form" class="section-padding bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="sponsors-content">
                    <h2 class="mb-4">Devenir Sponsor</h2>
                    <p class="mb-4">
                        Soutenez notre mission et bénéficiez d'une visibilité premium
                        lors de nos événements, dans notre contenu et auprès de notre communauté.
                    </p>

                    <div class="sponsors-benefits">
                        <div class="benefit-item mb-3">
                            <i class="fa-solid fa-check-circle me-2"></i>
                            <span>Logo sur tous nos supports événementiels</span>
                        </div>
                        <div class="benefit-item mb-3">
                            <i class="fa-solid fa-check-circle me-2"></i>
                            <span>Mentions dans nos communications</span>
                        </div>
                        <div class="benefit-item mb-3">
                            <i class="fa-solid fa-check-circle me-2"></i>
                            <span>Accès VIP à nos événements</span>
                        </div>
                        <div class="benefit-item">
                            <i class="fa-solid fa-check-circle me-2"></i>
                            <span>Pack média complet</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="sponsors-form p-4 bg-white rounded-3">
                    <h4 class="text-dark mb-4">Demande de sponsoring</h4>

                    <form id="sponsorForm">
                        @csrf

                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Nom de l'entreprise" required>
                        </div>

                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email" required>
                        </div>

                        <div class="mb-3">
                            <select class="form-control" required>
                                <option value="">Type de sponsoring</option>
                                <option value="event">Événement</option>
                                <option value="content">Contenu</option>
                                <option value="community">Communauté</option>
                                <option value="corporate">Corporate</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <textarea class="form-control" rows="3" placeholder="Votre message" required></textarea>
                        </div>

                        <button type="submit" class="ht-btn style-2 w-100">
                            Demander le dossier de sponsoring
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .partners-hero-content h1 {
        font-weight: 700;
    }

    .partner-card {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .partner-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        border-color: #667eea;
    }

    .partner-card.institutional {
        border-color: #4a6fa5;
    }

    .partner-card.institutional:hover {
        border-color: #3a5a8c;
    }

    .partner-logo {
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .partner-logo img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .partner-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        display: inline-block;
        padding: 5px 0;
        border-bottom: 2px solid transparent;
        transition: all 0.3s;
    }

    .partner-link:hover {
        border-bottom-color: #667eea;
    }

    .benefit-card {
        background: white;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }

    .benefit-card:hover {
        border-color: #667eea;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.1);
    }

    .benefit-icon {
        height: 60px;
        display: flex;
        align-items: center;
    }

    .form-wrapper {
        background: white;
    }

    .form-control {
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .sponsors-form {
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }

    .sponsors-benefits .benefit-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 10px;
    }

    .sponsors-benefits i {
        color: #4cd964;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .badge.bg-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: 500;
    }

    .ht-btn.style-4 {
        background: transparent;
        border: 2px solid white;
        color: white;
    }

    .ht-btn.style-4:hover {
        background: white;
        color: #667eea;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion du formulaire partenaire
        const partnerForm = document.getElementById('partnerForm');
        const sponsorForm = document.getElementById('sponsorForm');

        if (partnerForm) {
            partnerForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;

                // Validation
                const requiredFields = this.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    alert('Veuillez remplir tous les champs obligatoires.');
                    return;
                }

                // Simuler l'envoi
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Envoi en cours...';
                submitBtn.disabled = true;

                setTimeout(() => {
                    alert('Merci pour votre demande de partenariat ! Notre équipe vous contactera sous 48h.');
                    partnerForm.reset();
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;

                    // Scroll vers le haut
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }, 2000);
            });
        }

        if (sponsorForm) {
            sponsorForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;

                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Envoi...';
                submitBtn.disabled = true;

                setTimeout(() => {
                    alert('Merci ! Le dossier de sponsoring vous sera envoyé par email.');
                    sponsorForm.reset();
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 2000);
            });
        }

        // Animation des cartes partenaires
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

        document.querySelectorAll('.partner-card, .benefit-card').forEach(card => {
            observer.observe(card);
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
    });
</script>
@endpush
