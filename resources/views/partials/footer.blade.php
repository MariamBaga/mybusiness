<!-- ht-footer-area-start -->
<footer class="ht-footer-area fix">
    <div class="container">
        <div class="ht-footer-top-wrapper">
            <div class="ht-footer-top-left wow fadeInUp" data-wow-delay=".2s">
                <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo/logomybusiness.jpg') }}" alt="logo" style="max-height:50px;width:auto;"></a>
                <p class="desc">MyBusiness : La solution digitale pour digitaliser la gestion de vos commerces, boutiques et PME en Afrique.</p>
            </div>
            <div class="ht-footer-top-right wow fadeInUp" data-wow-delay=".4s">
                <ul class="footer-social">
                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-whatsapp"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="ht-footer-widget-wrapper">
            <div class="ht-footer-widget">
                <div class="ht-footer-widget-items wow fadeInUp" data-wow-delay=".3s">
                    <h5 class="head">Fonctionnalités</h5>
                    <ul class="link-list">
                        <li><a href="{{ route('pages.features') }}">Suivi des ventes</a></li>
                        <li><a href="{{ route('pages.features') }}">Gestion des stocks</a></li>
                        <li><a href="{{ route('pages.features') }}">Clients & Rapports</a></li>
                        <li><a href="{{ route('pages.features') }}">Multi-canaux</a></li>
                    </ul>
                </div>
                <div class="ht-footer-widget-items wow fadeInUp" data-wow-delay=".6s">
                    <h5 class="head">Navigation</h5>
                    <ul class="link-list">
                        <li><a href="{{ route('blog.index') }}">Blog & Actualités</a></li>
                        <li><a href="{{ route('pages.downloads') }}">Téléchargements</a></li>
                        <li><a href="{{ route('pages.pricing') }}">Tarifs</a></li>
                        <li><a href="#">Marketplace</a></li>
                    </ul>
                </div>
                <div class="ht-footer-widget-items wow fadeInUp" data-wow-delay=".9s">
                    <h5 class="head">Entreprise</h5>
                    <ul class="link-list">
                        <li><a href="{{ route('pages.about') }}">À propos</a></li>
                        <li><a href="{{ route('pages.partners') }}">Partenaires</a></li>
                        <li><a href="{{ route('pages.sponsors') }}">Sponsors</a></li>
                        <li><a href="{{ route('pages.testimonials') }}">Témoignages</a></li>
                    </ul>
                </div>
                <div class="ht-footer-widget-items wow fadeInUp" data-wow-delay="1.2s">
                    <h5 class="head">Support</h5>
                    <ul class="link-list">
                        <li><a href="{{ route('support.faq') }}">FAQ</a></li>
                        <li><a href="{{ route('support.contact') }}">Contact</a></li>
                        <li><a href="{{ route('support.guides') }}">Guides</a></li>
                        <li><a href="{{ route('tickets.create') }}">Ouvrir un ticket</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="ht-footer-copyright wow fadeInUp" data-wow-delay=".2s">
            <p>©{{ date('Y') }} <span>MyBusiness by ConnectiiX</span>. Tous droits réservés.
                <a href="{{ route('pages.legal') }}">Mentions légales</a> |
                <a href="{{ route('pages.privacy') }}">Politique de confidentialité</a> |
                <a href="{{ route('pages.cookies') }}">Cookies</a> |
                <a href="{{ route('pages.gdpr') }}">RGPD</a>
            </p>
        </div>
    </div>
</footer>
<!-- ht-footer-area-end -->
