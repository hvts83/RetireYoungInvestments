<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Retire Young</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <!-- Favicons -->
        <link href="{{ asset('img/favicon.png')}}" rel="icon">
        <link href="{{ asset('img/apple-touch-icon.png')}}" rel="apple-touch-icon">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
        <!-- Bootstrap CSS File -->
        <link href="{{asset ('lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Libraries CSS Files -->
        <link href="{{ asset('lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{ asset('lib/animate/animate.min.css')}}" rel="stylesheet">
        <link href="{{ asset('lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
        <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
        <link href="{{ asset('lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
        <!-- Main Stylesheet File -->
        <link href="{{ asset('css/style_landing.css')}}" rel="stylesheet">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-29624893-11"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-29624893-11');
        </script>
        @yield('css')
    </head>

    <body>

        <!--==========================
        Header
        ============================-->
        <header id="header">
            <div class="container-fluid">
            <div id="logo" class="pull-left">
                <h1><a href="{{ url('/') }}" class="scrollto"><img src="{{ asset('img/ry-logo.png')}}" class="img-fluid" alt=""/></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                <li><a href="{{ url('/') }}">Inicio</a></li>
                <!-- <li><a href="{{ url('equipo')}}">Quienes Somos</a></li> -->
                <li><a href="https://akademy.teachable.com" target="_blank">Akademy</a></li>
                <li><a href="{{ url('contacto')}}">Contacto</a></li>
                <li class="ghost-button"><a href="{{ url('register')}}">Registro</a></li>
                <li class="ghost-button"><a href="{{ url('login')}}" >Iniciar Sesi&oacute;n</a></li>
                <li><a href="https://twitter.com/RetireYoung_" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li><a href="https://www.instagram.com/retire.young/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                <li><a href="https://www.facebook.com/Retire-Young-425618037905353/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                </ul>
            </nav>
            <!-- #nav-menu-container -->
            </div>
        </header>
        <!-- #header -->

        @yield('body')

        <!--==========================
        Footer
        ============================-->
        <footer id="footer">
            <div class="container py-3">
            <div class="row">
                <div class="col-lg-12 text-center">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="{{ url('privacidad')}}">Politica de Privacidad</li></a>
                    <li class="list-inline-item"><a href="{{ url('terminos')}}">Terminos y Condiciones</a></li>
                </ul>
                <img src="{{ asset('img/ry-logo.png')}}" class="img-fluid" alt=""/>
                <p>©Copyright 2018 Retire Young</p>
                </div>
            </div>
            </div>
        </footer>
        <!-- #footer -->

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="{{ asset('lib/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('lib/jquery/jquery-migrate.min.js')}}"></script>
        <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('lib/easing/easing.min.js')}}"></script>
        <script src="{{ asset('lib/superfish/hoverIntent.js')}}"></script>
        <script src="{{ asset('lib/superfish/superfish.min.js')}}"></script>
        <script src="{{ asset('lib/wow/wow.min.js')}}"></script>
        <script src="{{ asset('lib/waypoints/waypoints.min.js')}}"></script>
        <script src="{{ asset('lib/counterup/counterup.min.js')}}"></script>
        <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
        <script src="{{ asset('lib/isotope/isotope.pkgd.min.js')}}"></script>
        <script src="{{ asset('lib/lightbox/js/lightbox.min.js')}}"></script>
        <script src="{{ asset('lib/touchSwipe/jquery.touchSwipe.min.js')}}"></script>
        <!-- Contact Form JavaScript File -->
        <script src="{{ asset('contactform/contactform.js')}}"></script>

        <!-- Template Main Javascript File -->
        <script src="{{ asset('js/main.js')}}"></script>
        @yield('scripts')
    </body>
</html>
