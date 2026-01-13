<!-- ht-header-area start -->
<header class="ht-header-area header-1">
    <!-- ht-top-header area start -->
    <div class="ht-top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left">
                        <p><i class="fa-solid fa-location-dot"></i> 2774 Oak Drive, Plattsburgh, New York</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="right">
                        <li><i class="fa-solid fa-phone"></i><a href="tel:5185643200">518-564-3200</a></li>
                        <li><i class="fa-solid fa-envelope"></i>
                            <a href="mailto:hello@example.com">hello@example.com</a>
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

    <!-- 2. PRESENTATION -->
    <li class="has-dropdown">
        <a href="#">Présentation</a>
        <ul class="sub-menu">
            <li><a href="{{ route('pages.about') }}">À propos</a></li>
            <li><a href="#">Témoignages</a></li>
            <li><a href="{{ route('pages.partners') }}">Partenaires & Sponsors</a></li>
        </ul>
    </li>

    <!-- 3. PRODUIT -->
    <li class="has-dropdown">
        <a href="#">Produit</a>
        <ul class="sub-menu">
            <li><a href="{{ route('pages.features') }}">Fonctionnalités</a></li>
            <li><a href="#">Tarifs</a></li>
            <li><a href="#">Téléchargements</a></li>
        </ul>
    </li>

    <!-- 4. CONTENUS -->
    <li class="has-dropdown">
        <a href="#">Contenus</a>
        <ul class="sub-menu">
            <li><a href="#">Blog / Actualités</a></li>
            <li><a href="{{ route('pages.partners') }}">Cas clients</a></li>
        </ul>
    </li>

    <!-- 5. SUPPORT -->
    <li class="has-dropdown">
        <a href="#">Support</a>
        <ul class="sub-menu">
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Guides</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Tickets</a></li>
        </ul>
    </li>

    <!-- 6. ESPACE CLIENT -->
    <li class="has-dropdown">
        <a href="#">Espace client</a>
        <ul class="sub-menu">
            <li><a href="{{ route('login') }}">Connexion</a></li>
            <li><a href="{{ route('register') }}">Inscription</a></li>
        </ul>
    </li>

    <!-- 7. LEGAL -->
    <li class="has-dropdown">
        <a href="#">Légal</a>
        <ul class="sub-menu">
            <li><a href="{{ route('pages.legal') }}">Mentions légales</a></li>
            <li><a href="{{ route('pages.privacy') }}">Politique de confidentialité</a></li>
        </ul>
    </li>

</ul>

                        </nav>
                    </div>
                </div>
                <div class="ht-menu-right">
                    <a href="#" class="ht-btn d-none d-lg-block">lets get in touch</a>
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
            <a href="{{ route('home') }}" class="ht-offcanvas-logo"><img src="{{ asset('assets/img/logo/logomybusiness.jpg') }}" alt="logo"></a>
            <button class="ht-offcanvas-toggle-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="ht-offcanvas-menu d-xl-none mb-50">
            <nav></nav>
        </div>
        <div class="ht-offcanvas-content d-none d-xl-block mb-50">
            <h2 class="ht-offcanvas-content__title">Hello There!</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
        <div class="ht-offcanvas-info mb-50">
            <h3 class="ht-offcanvas__title">Information</h3>
            <span><a href="#">+ 4 20 7700 1007</a></span>
            <span><a href="#">hello@prozen.com</a></span>
            <span><a href="#">Avenue de Roma 158b, Lisboa</a></span>
        </div>
        <div class="ht-offcanvas-social mb-50">
            <h3 class="ht-offcanvas__title">Follow Us</h3>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
</div>

<!-- offcanvas overlay -->
<div class="ht-offcanvas-overlay"></div>
<!-- ht-header-area end -->
