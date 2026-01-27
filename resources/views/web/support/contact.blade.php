@extends('layouts.master')

@section('title', 'Contact - MyBusiness')

@section('content')

<!-- =========================
    BREADCRUMB
========================= -->
<section class="ht-breadcrumb-area">
    @include('components.breadcrumb', [
        'title' => 'Contact',
        'active' => 'Contact'
    ])
</section>

<!-- =========================
    CONTACT INFO SECTION
========================= -->
<section class="ht-contact-info-area section-padding">
    <div class="container">
        <div class="contact-info-wrapper">
            <div class="row gy-5">

                <!-- Téléphone -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="contact-info-item">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/phone.svg') }}" alt="icon">
                        </div>
                        <div class="content">
                            <span>Téléphone</span>
                            <h4>+225 05 64 51 59 16</h4>
                            <p class="mt-2 text-muted">Lun - Ven : 8h - 18h</p>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                    <div class="contact-info-item">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/comment.svg') }}" alt="icon">
                        </div>
                        <div class="content">
                            <span>Email</span>
                            <a href="mailto:contact@mybusiness.ci">
                                <h4>contact@mybusiness.ci</h4>
                            </a>
                            <p class="mt-2 text-muted">Réponse sous 24h</p>
                        </div>
                    </div>
                </div>

                <!-- Adresse -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".9s">
                    <div class="contact-info-item">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/location.svg') }}" alt="icon">
                        </div>
                        <div class="content">
                            <span>Adresse</span>
                            <h4>Abidjan, Plateau</h4>
                            <p class="mt-2 text-muted">Tour B, 12ème étage</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- ht contact info area -->

<!-- =========================
    WHATSAPP CTA
========================= -->
<section class="section-padding bg-light">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="whatsapp-cta p-5 rounded-3 shadow-sm">
                    <div class="icon mb-4">
                        <i class="fab fa-whatsapp fa-3x text-success"></i>
                    </div>
                    <h3 class="mb-3">Support WhatsApp Business</h3>
                    <p class="mb-4">
                        Pour un support rapide, contactez-nous directement sur WhatsApp.
                        Notre équipe est disponible du lundi au vendredi de 8h à 18h.
                    </p>
                    <a href="https://wa.me/2250700000000?text=Bonjour%20MyBusiness,%20je%20souhaite%20obtenir%20des%20informations"
                       target="_blank" class="ht-btn style-2">
                        <i class="fab fa-whatsapp me-2"></i>Envoyer un message
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================
    CONTACT FORM
========================= -->
<section class="ht-contact-form-area section-padding">
    <div class="container">
        <div class="section-title text-center">
            <span class="subtitle wow fadeInUp" data-wow-delay=".2s">Contactez-nous</span>
            <h2 class="title wow fadeInUp text-black" data-wow-delay=".5s">
                Une question ? <br>
                Écrivez-nous !
            </h2>
            <p class="wow fadeInUp" data-wow-delay=".7s">
                Remplissez le formulaire ci-dessous et notre équipe vous répondra dans les plus brefs délais.
            </p>
        </div>

        <div class="ht-contact-wrapper">
           <form action="{{ route('support.contact.submit') }}" method="POST" id="contact-form" enctype="multipart/form-data">
    @csrf

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="row">

                            <!-- Nom -->
                            <div class="col-md-6 mb-4">
                                <input type="text"
                                       name="name"
                                       placeholder="Votre nom *"
                                       value="{{ old('name') }}"
                                       required
                                       class="@error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-4">
                                <input type="email"
                                       name="email"
                                       placeholder="Adresse email *"
                                       value="{{ old('email') }}"
                                       required
                                       class="@error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Téléphone -->
                            <div class="col-md-6 mb-4">
                                <input type="tel"
                                       name="phone"
                                       placeholder="Téléphone"
                                       value="{{ old('phone') }}"
                                       class="@error('phone') is-invalid @enderror">
                                @error('phone')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sujet -->
                            <div class="col-md-6 mb-4">
                                <select name="subject"
                                        required
                                        class="@error('subject') is-invalid @enderror">
                                    <option value="">Sélectionnez un sujet *</option>
                                    <option value="Demande d'information" {{ old('subject') == "Demande d'information" ? 'selected' : '' }}>Demande d'information</option>
                                    <option value="Support technique" {{ old('subject') == "Support technique" ? 'selected' : '' }}>Support technique</option>
                                    <option value="Devenir partenaire" {{ old('subject') == "Devenir partenaire" ? 'selected' : '' }}>Devenir partenaire</option>
                                    <option value="Demande de démo" {{ old('subject') == "Demande de démo" ? 'selected' : '' }}>Demande de démo</option>
                                    <option value="Proposition commerciale" {{ old('subject') == "Proposition commerciale" ? 'selected' : '' }}>Proposition commerciale</option>
                                    <option value="Autre" {{ old('subject') == "Autre" ? 'selected' : '' }}>Autre</option>
                                </select>
                                @error('subject')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div class="col-12 mb-4">
                                <textarea name="message"
                                          placeholder="Votre message *"
                                          rows="6"
                                          required
                                          class="@error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pièce jointe -->
                            <div class="col-12 mb-4">
                                <div class="file-upload">
                                    <label for="attachment" class="form-label">
                                        <i class="fa-solid fa-paperclip me-2"></i>
                                        Pièce jointe (optionnelle)
                                    </label>
                                    <input type="file"
                                           name="attachment"
                                           id="attachment"
                                           class="form-control"
                                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                    <small class="text-muted">Formats acceptés : PDF, Word, JPG, PNG (Max: 5MB)</small>
                                </div>
                            </div>

                            <!-- RGPD -->
                            <div class="col-12 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input @error('privacy') is-invalid @enderror"
                                           type="checkbox"
                                           name="privacy"
                                           id="privacy"
                                           {{ old('privacy') ? 'checked' : '' }}
                                           required>
                                    <label class="form-check-label" for="privacy">
                                        J'accepte que mes données soient traitées conformément à la
                                        <a href="{{ route('pages.privacy') }}" target="_blank">politique de confidentialité</a> *
                                    </label>
                                    @error('privacy')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Bouton -->
                            <div class="col-12 text-center">
                                <button type="submit" class="ht-btn style-2">
                                    <i class="fa-solid fa-paper-plane me-2"></i>
                                    ENVOYER LE MESSAGE
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- ht contact form area -->

<!-- =========================
    MAP SECTION
========================= -->
<section class="section-padding pt-0">
    <div class="container">
        <div class="map-wrapper rounded-3 overflow-hidden shadow-sm">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.408711304987!2d-4.021901525043946!3d5.332268394681432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ebbb2d56d9e5%3A0x1e48a88b5b42e2a8!2sPlateau%2C%20Abidjan%2C%20C%C3%B4te%20d&#39;Ivoire!5e0!3m2!1sfr!2sfr!4v1698765432105!5m2!1sfr!2sfr"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<!-- =========================
    CONTACT SUPPLEMENTAIRE
========================= -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row g-5">

            <!-- Support technique -->
            <div class="col-lg-6">
                <div class="support-card p-4 h-100 rounded-3">
                    <div class="icon mb-3">
                        <i class="fa-solid fa-headset fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Support technique</h4>
                    <p class="mb-3">
                        Besoin d'aide avec votre compte MyBusiness ? Notre équipe support
                        est là pour vous accompagner.
                    </p>
                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Assistance par ticket</li>
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Guides et tutoriels</li>
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Webinaires réguliers</li>
                    </ul>
                    <a href="{{ route('support.faq') }}" class="ht-btn style-4 mt-3">
                        Consulter la FAQ
                    </a>
                </div>
            </div>

            <!-- Commercial -->
            <div class="col-lg-6">
                <div class="support-card p-4 h-100 rounded-3">
                    <div class="icon mb-3">
                        <i class="fa-solid fa-handshake fa-2x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Service commercial</h4>
                    <p class="mb-3">
                        Vous souhaitez devenir partenaire, sponsor ou discuter d'une solution
                        personnalisée pour votre entreprise ?
                    </p>
                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Solutions sur mesure</li>
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Devis personnalisés</li>
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Accompagnement dédié</li>
                    </ul>
                    <a href="{{ route('pages.partners') }}" class="ht-btn style-4 mt-3">
                        Devenir partenaire
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .contact-info-item {
        background: #fff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
        height: 100%;
    }

    .contact-info-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .contact-info-item .icon {
        margin-bottom: 20px;
        height: 60px;
        display: flex;
        align-items: center;
    }

    .contact-info-item .icon img {
        height: 50px;
    }

    .contact-info-item .content span {
        color: #667eea;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .contact-info-item .content h4 {
        margin-top: 10px;
        font-size: 22px;
        color: #333;
    }

    .contact-info-item .content a {
        text-decoration: none;
        color: inherit;
    }

    .whatsapp-cta {
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        color: white;
    }

    .whatsapp-cta .icon i {
        font-size: 48px;
    }

    .ht-contact-wrapper form input,
    .ht-contact-wrapper form select,
    .ht-contact-wrapper form textarea {
        width: 100%;
        padding: 15px 20px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s;
        background: #fff;
    }

    .ht-contact-wrapper form input:focus,
    .ht-contact-wrapper form select:focus,
    .ht-contact-wrapper form textarea:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .ht-contact-wrapper form textarea {
        min-height: 150px;
        resize: vertical;
    }

    .support-card {
        background: white;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }

    .support-card:hover {
        border-color: #667eea;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.1);
    }

    .file-upload input[type="file"] {
        padding: 10px;
        border: 2px dashed #ddd;
        border-radius: 8px;
    }

    .file-upload input[type="file"]:hover {
        border-color: #667eea;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validation du formulaire
        const form = document.getElementById('contact-form');
        const phoneInput = document.querySelector('input[name="phone"]');

        // Format du téléphone
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                value = '+' + value;
            }
            e.target.value = value;
        });

        // Validation avant envoi
        form.addEventListener('submit', function(e) {
            let isValid = true;

            // Validation de base
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            // Validation email
            const emailField = form.querySelector('input[type="email"]');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailField.value && !emailRegex.test(emailField.value)) {
                emailField.classList.add('is-invalid');
                isValid = false;
            }

            // Validation fichier
            const fileInput = document.getElementById('attachment');
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const validTypes = ['application/pdf', 'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'image/jpeg', 'image/jpg', 'image/png'];
                const maxSize = 5 * 1024 * 1024; // 5MB

                if (!validTypes.includes(file.type)) {
                    alert('Format de fichier non supporté. Formats acceptés : PDF, Word, JPG, PNG.');
                    isValid = false;
                }

                if (file.size > maxSize) {
                    alert('Le fichier est trop volumineux. Taille maximale : 5MB.');
                    isValid = false;
                }
            }

            if (!isValid) {
                e.preventDefault();
                alert('Veuillez corriger les erreurs dans le formulaire.');
            } else {
                // Afficher loader
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Envoi en cours...';
                submitBtn.disabled = true;
            }
        });

        // Auto-hide alerts après 5 secondes
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
@endpush
