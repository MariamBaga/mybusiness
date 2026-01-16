<!-- ht-header-area start -->
<header class="ht-header-area header-1">
    <!-- ht-top-header area start -->
    <div class="ht-top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left">
                        <p><i class="fa-solid fa-location-dot"></i> Abidjan, Côte d'Ivoire</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="right">
                        <li><i class="fa-solid fa-phone"></i><a href="tel:+2250700000000">+225 07 00 00 00 00</a></li>
                        <li><i class="fa-solid fa-envelope"></i>
                            <a href="mailto:contact@mybusiness.ci">contact@mybusiness.ci</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- ht-main-header area start -->
    <div class="ht-main-header header-1" id="header-sticky">
        <div class="container">
            <div class="ht-menu-wrapper">
                <div class="ht-menu-left">
                    <div class="ht-menu-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/img/logo/logomybusiness.jpg') }}" alt="logo" style="max-height:50px;width:auto;">
                        </a>
                    </div>

                    <div class="ht-menu-main d-none d-lg-block">
                        <nav class="ht-mobile-menu-active">
                            <ul>
                                <!-- 1. ACCUEIL -->
                                <li><a href="{{ route('home') }}">Accueil</a></li>

                                <!-- 2. PRÉSENTATION -->
                                <li class="has-dropdown">
                                    <a href="#">Présentation</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('pages.about') }}">À propos</a></li>
                                        <li><a href="{{ route('pages.testimonials') }}">Témoignages</a></li>
                                        <li><a href="{{ route('pages.case-studies') }}">Cas clients</a></li>
                                        <li><a href="{{ route('pages.partners') }}">Partenaires</a></li>
                                        <li><a href="{{ route('pages.sponsors') }}">Sponsors</a></li>
                                    </ul>
                                </li>

                                <!-- 3. PRODUIT -->
                                <li class="has-dropdown">
                                    <a href="#">Produit</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('pages.features') }}">Fonctionnalités</a></li>
                                        <li><a href="{{ route('pages.pricing') }}">Tarifs</a></li>
                                        <li><a href="{{ route('pages.downloads') }}">Téléchargements</a></li>
                                        <li><a href="{{ route('pages.demo') }}">Démo</a></li>
                                    </ul>
                                </li>

                                <!-- 4. MARKETPLACE -->
                                <li><a href="{{ route('marketplace.index') }}">Marketplace</a></li>

                                <!-- 5. PUBLICITÉ -->
                                <li><a href="{{ route('advertise.index') }}">Publicité</a></li>

                                <!-- 6. CONTENUS -->
                                <li class="has-dropdown">
                                    <a href="#">Contenus</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('blog.index') }}">Blog / Actualités</a></li>
                                        <li><a href="{{ route('pages.downloads') }}">Ressources</a></li>
                                        <li><a href="{{ route('support.guides') }}">Guides</a></li>
                                    </ul>
                                </li>

                                <!-- 7. SUPPORT -->
                                <li class="has-dropdown">
                                    <a href="#">Support</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('support.faq') }}">FAQ</a></li>
                                        <li><a href="{{ route('support.guides') }}">Guides</a></li>
                                        <li><a href="{{ route('support.contact') }}">Contact</a></li>
                                        @auth
                                            <li><a href="{{ route('tickets.index') }}">Mes tickets</a></li>
                                        @endauth
                                    </ul>
                                </li>

                                <!-- 8. ESPACE CLIENT -->
                                @auth
                                    <li class="has-dropdown">
                                        <a href="#">
                                            <i class="fas fa-user-circle me-1"></i>
                                            {{ Auth::user()->name }}
                                        </a>
                                        <ul class="sub-menu">
                                            @if(Auth::user()->hasRole('admin'))
                                                <li><a href="{{ route('dashboard') }}">Admin Dashboard</a></li>
                                                <li class="divider"></li>
                                            @endif

                                            @if(Auth::user()->hasRole('partner'))
                                                <li><a href="{{ route('partner.dashboard') }}">Espace Partenaire</a></li>
                                                <li><a href="{{ route('partner.products.index') }}">Mes produits</a></li>
                                                <li class="divider"></li>
                                            @endif

                                            @if(Auth::user()->hasRole('member'))
                                                <li><a href="{{ route('member.ads.index') }}">Mes publicités</a></li>
                                            @endif

                                            <li><a href="{{ route('client.dashboard') }}">Tableau de bord</a></li>
                                            <li><a href="{{ route('client.profile') }}">Mon profil</a></li>
                                            <li><a href="{{ route('client.billing') }}">Facturation</a></li>
                                            <li><a href="{{ route('client.documents') }}">Documents</a></li>
                                            <li class="divider"></li>
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                                    @csrf
                                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li class="has-dropdown">
                                        <a href="#">Espace client</a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ route('login') }}">Connexion</a></li>
                                            <li><a href="{{ route('register') }}">Inscription</a></li>
                                            <li class="divider"></li>
                                            <li><a href="{{ route('pages.pricing') }}">Essai gratuit</a></li>
                                        </ul>
                                    </li>
                                @endauth
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="ht-menu-right">
                    @auth
                        <!-- Notifications -->
                        <div class="dropdown me-3 d-none d-lg-inline-block">
                            <a href="#" class="btn btn-outline-primary btn-sm position-relative" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                @if(Auth::user()->unreadNotifications()->count() > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ Auth::user()->unreadNotifications()->count() }}
                                    </span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 300px;">
                                <div class="dropdown-header">
                                    <h6 class="mb-0">Notifications</h6>
                                    <small class="text-muted">{{ Auth::user()->unreadNotifications()->count() }} non lues</small>
                                </div>
                                <div class="dropdown-body" style="max-height: 300px; overflow-y: auto;">
                                    @foreach(Auth::user()->notifications()->take(5)->get() as $notification)
                                        <a href="#" class="dropdown-item {{ $notification->read_at ? '' : 'fw-bold' }}">
                                            <div class="d-flex w-100 justify-content-between">
                                                <small>{{ $notification->data['title'] ?? 'Notification' }}</small>
                                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                            <small class="text-muted">{{ Str::limit($notification->data['message'] ?? '', 50) }}</small>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="dropdown-footer text-center">
                                    <a href="{{ route('client.notifications') }}" class="btn btn-sm btn-link">Voir toutes</a>
                                </div>
                            </div>
                        </div>

                        <!-- CTA selon le rôle -->
                        @if(Auth::user()->hasRole('partner'))
                            <a href="{{ route('partner.products.create') }}" class="ht-btn d-none d-lg-block">Ajouter un produit</a>
                        @elseif(Auth::user()->hasRole('member'))
                            <a href="{{ route('member.ads.create') }}" class="ht-btn d-none d-lg-block">Créer une pub</a>
                        @else
                            <a href="{{ route('advertise.create') }}" class="ht-btn d-none d-lg-block">Faire une pub</a>
                        @endif
                    @else
                        <a href="{{ route('pages.pricing') }}" class="ht-btn d-none d-lg-block">Essai gratuit</a>
                    @endauth

                    <button class="ht-menu-btn d-lg-none offcanvas-toggle">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- offcanvas for navigation -->
<div class="ht-offcanvas">
    <div class="ht-offcanvas-wrapper">
        <div class="ht-offcanvas-header mb-50">
            <a href="{{ route('home') }}" class="ht-offcanvas-logo">
                <img src="{{ asset('assets/img/logo/logomybusiness.jpg') }}" alt="logo" style="max-height:40px;">
            </a>
            <button class="ht-offcanvas-toggle-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="ht-offcanvas-menu d-xl-none mb-50">
            <nav>
                <ul>
                    <!-- Menu mobile -->
                    <li><a href="{{ route('home') }}">Accueil</a></li>

                    <li class="has-dropdown">
                        <a href="#">Présentation</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('pages.about') }}">À propos</a></li>
                            <li><a href="{{ route('pages.testimonials') }}">Témoignages</a></li>
                            <li><a href="{{ route('pages.case-studies') }}">Cas clients</a></li>
                            <li><a href="{{ route('pages.partners') }}">Partenaires</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown">
                        <a href="#">Produit</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('pages.features') }}">Fonctionnalités</a></li>
                            <li><a href="{{ route('pages.pricing') }}">Tarifs</a></li>
                            <li><a href="{{ route('pages.downloads') }}">Téléchargements</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('marketplace.index') }}">Marketplace</a></li>
                    <li><a href="{{ route('advertise.index') }}">Publicité</a></li>

                    <li class="has-dropdown">
                        <a href="#">Contenus</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('blog.index') }}">Blog</a></li>
                            <li><a href="{{ route('support.guides') }}">Guides</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown">
                        <a href="#">Support</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('support.faq') }}">FAQ</a></li>
                            <li><a href="{{ route('support.contact') }}">Contact</a></li>
                            @auth
                                <li><a href="{{ route('tickets.index') }}">Mes tickets</a></li>
                            @endauth
                        </ul>
                    </li>

                    @auth
                        <li class="has-dropdown">
                            <a href="#">{{ Auth::user()->name }}</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('client.dashboard') }}">Tableau de bord</a></li>
                                <li><a href="{{ route('client.profile') }}">Mon profil</a></li>
                                @if(Auth::user()->hasRole('partner'))
                                    <li><a href="{{ route('partner.dashboard') }}">Espace Partenaire</a></li>
                                @endif
                                @if(Auth::user()->hasRole('member'))
                                    <li><a href="{{ route('member.ads.index') }}">Mes publicités</a></li>
                                @endif
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                            Déconnexion
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="has-dropdown">
                            <a href="#">Espace client</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('login') }}">Connexion</a></li>
                                <li><a href="{{ route('register') }}">Inscription</a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </nav>
        </div>
        <div class="ht-offcanvas-content d-none d-xl-block mb-50">
            <h2 class="ht-offcanvas-content__title">MyBusiness</h2>
            <p>Digitalisez votre entreprise avec notre solution tout-en-un</p>
        </div>
        <div class="ht-offcanvas-info mb-50">
            <h3 class="ht-offcanvas__title">Contact</h3>
            <span><a href="tel:+2250700000000"><i class="fas fa-phone me-2"></i>+225 07 00 00 00 00</a></span>
            <span><a href="mailto:contact@mybusiness.ci"><i class="fas fa-envelope me-2"></i>contact@mybusiness.ci</a></span>
            <span><a href="#"><i class="fas fa-map-marker-alt me-2"></i>Abidjan, Côte d'Ivoire</a></span>
        </div>
        <div class="ht-offcanvas-social mb-50">
            <h3 class="ht-offcanvas__title">Suivez-nous</h3>
            <a href="#" class="me-2"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
            <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
            <a href="#" class="me-2"><i class="fab fa-linkedin-in"></i></a>
            <a href="#" class="me-2"><i class="fab fa-youtube"></i></a>
        </div>
        <div class="ht-offcanvas-cta">
            @auth
                <a href="{{ route('client.dashboard') }}" class="ht-btn w-100 mb-3">Tableau de bord</a>
            @else
                <a href="{{ route('pages.pricing') }}" class="ht-btn w-100 mb-3">Essai gratuit</a>
                <a href="{{ route('advertise.create') }}" class="ht-btn btn-outline w-100">Faire une publicité</a>
            @endauth
        </div>
    </div>
</div>

<!-- offcanvas overlay -->
<div class="ht-offcanvas-overlay"></div>
<!-- ht-header-area end -->

<script>
// Gestion des notifications
document.addEventListener('DOMContentLoaded', function() {
    // Marquer comme lu au clic
    document.querySelectorAll('.dropdown-item[href="#"]').forEach(item => {
        item.addEventListener('click', function(e) {
            const notificationId = this.getAttribute('data-notification-id');
            if (notificationId) {
                fetch(`/notifications/${notificationId}/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                });
            }
        });
    });

    // Auto-refresh des notifications
    setInterval(function() {
        fetch('{{ route("notifications.count") }}')
            .then(response => response.json())
            .then(data => {
                const badge = document.querySelector('.badge.bg-danger');
                if (badge) {
                    if (data.unread > 0) {
                        badge.textContent = data.unread;
                        badge.style.display = 'block';
                    } else {
                        badge.style.display = 'none';
                    }
                }
            });
    }, 60000); // Toutes les minutes

    // Sticky header
    window.addEventListener('scroll', function() {
        const header = document.getElementById('header-sticky');
        if (window.scrollY > 100) {
            header.classList.add('sticky');
        } else {
            header.classList.remove('sticky');
        }
    });

    // Mobile menu toggle
    const offcanvasToggle = document.querySelector('.offcanvas-toggle');
    const offcanvas = document.querySelector('.ht-offcanvas');
    const offcanvasClose = document.querySelector('.ht-offcanvas-toggle-close');
    const offcanvasOverlay = document.querySelector('.ht-offcanvas-overlay');

    offcanvasToggle?.addEventListener('click', function() {
        offcanvas.classList.add('active');
        offcanvasOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    offcanvasClose?.addEventListener('click', function() {
        offcanvas.classList.remove('active');
        offcanvasOverlay.classList.remove('active');
        document.body.style.overflow = '';
    });

    offcanvasOverlay?.addEventListener('click', function() {
        offcanvas.classList.remove('active');
        offcanvasOverlay.classList.remove('active');
        document.body.style.overflow = '';
    });

    // Dropdown mobile
    document.querySelectorAll('.ht-offcanvas-menu .has-dropdown > a').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.parentElement;
            parent.classList.toggle('active');
        });
    });
});
</script>

<style>
/* Styles pour le header */
.sticky {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: white;
    box-shadow: 0 2px 20px rgba(0,0,0,0.1);
    z-index: 1000;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from { transform: translateY(-100%); }
    to { transform: translateY(0); }
}

/* Dropdown notifications */
.dropdown-header {
    padding: 15px;
    border-bottom: 1px solid #dee2e6;
}

.dropdown-body {
    padding: 0;
}

.dropdown-footer {
    padding: 10px;
    border-top: 1px solid #dee2e6;
}

.dropdown-item {
    padding: 10px 15px;
    border-bottom: 1px solid #f8f9fa;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
}

/* Badge notifications */
.badge {
    font-size: 10px;
    padding: 3px 6px;
}

/* Offcanvas mobile */
.ht-offcanvas {
    position: fixed;
    top: 0;
    right: -400px;
    width: 350px;
    height: 100%;
    background: white;
    z-index: 9999;
    transition: right 0.3s ease;
    overflow-y: auto;
}

.ht-offcanvas.active {
    right: 0;
}

.ht-offcanvas-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 9998;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.ht-offcanvas-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* Mobile dropdown */
.ht-offcanvas-menu .has-dropdown > ul {
    display: none;
    padding-left: 20px;
}

.ht-offcanvas-menu .has-dropdown.active > ul {
    display: block;
}

.ht-offcanvas-menu .has-dropdown > a::after {
    content: '\f078';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    float: right;
    transition: transform 0.3s;
}

.ht-offcanvas-menu .has-dropdown.active > a::after {
    transform: rotate(180deg);
}

/* Responsive */
@media (max-width: 991px) {
    .ht-top-header {
        display: none;
    }
}

@media (max-width: 767px) {
    .ht-offcanvas {
        width: 300px;
    }
}

/* Animation pour les notifications */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.badge.bg-danger {
    animation: pulse 2s infinite;
}
</style>
