<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="@yield('description', 'MyBusiness - Solution digitale pour commerçants et PME en Afrique. Suivi des ventes, gestion des stocks, rapports intelligents.')">
<meta name="keywords" content="@yield('keywords', 'mybusiness, gestion commerce, afrique, vente, stock, PME, digitalisation')">
<meta name="author" content="ConnectiiX">
    <!-- ======== Page title ============ -->
    <title>@yield('title', 'Prozen - Business Consulting')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--<< Favcion >>-->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.svg') }}">

    <!--<< Bootstrap min.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!--<< All Min Css >>-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!--<< Animate.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!--<< Magnific Popup.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <!--<< MeanMenu.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
    <!--<< Swiper Bundle.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <!--<< Nice Select.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <!--<< Main.css >>-->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo/favicon.ico') }}">
<link rel="apple-touch-icon" href="{{ asset('assets/img/logo/apple-touch-icon.png') }}">

    <!-- Styles personnalisés -->
    @stack('styles')
</head>

<body class="body-color">

    <!-- preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <!-- Back To Top Start -->
    <button id="back-top" class="back-to-top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!--<< Mouse Cursor Start >>-->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    @include('partials.header')

    <!-- Contenu principal -->
    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <!--<< All JS Plugins >>-->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <!--<< Viewport Js >>-->
    <script src="{{ asset('assets/js/viewport.jquery.js') }}"></script>
    <!--<< Bootstrap Js >>-->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--<< Nice Select Js >>-->
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <!--<< Waypoints Js >>-->
    <script src="{{ asset('assets/js/jquery.waypoints.js') }}"></script>
    <!--<< Counterup Js >>-->
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <!--<< Swiper Slider Js >>-->
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <!--<< MeanMenu Js >>-->
    <script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
    <!--<< Magnific Popup Js >>-->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!--<< Wow Animation Js >>-->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <!--<< Typed Js >>-->
    <script src="{{ asset('assets/js/typed.min.js') }}"></script>
    <!--<< Main.js >>-->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Scripts personnalisés -->
    @stack('scripts')

    <!-- Initialiser Wow.js -->
    <script>
        new WOW().init();
    </script>
</body>

</html>
