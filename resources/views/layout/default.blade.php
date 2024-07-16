<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <!-- Site Title-->
    <title>Direction Général du Commerce | Gabon</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('front/images/dgc.png') }}" type="image/x-icon">
    <link rel="stylesheet" type="text/css"
        href="//fonts.googleapis.com/css?family=Poppins:400,500,700%7CNoto+Sans:400,700">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">

    <style>
        .ie-panel {
            display: none;
            background: #212121;
            padding: 10px 0;
            box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, .3);
            clear: both;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        html.ie-10 .ie-panel,
        html.lt-ie-10 .ie-panel {
            display: block;
        }

        /* Alertes de succès */
        .alert-success {
            background-color: #D1E7DD;
            border-color: #53A287;
            color: #155724;
        }

        /* Alertes d'erreur */
        .alert-danger {
            background-color: #F8D7DA;
            border-color: #E3342F;
            color: #721C24;
        }

        /* Alertes d'avertissement */
        .alert-warning {
            background-color: #FFF3CD;
            border-color: #FFD93C;
            color: #856404;
        }

        /* Alertes d'information */
        .alert-info {
            background-color: #D1E7F7;
            border-color: #4CA6CF;
            color: #0C5460;
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="ie-panel"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img
                src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820"
                alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a>
    </div>
    <div class="page-loader">
        <div>
            <div class="page-loader-body">
                <div class="preloader-container">
                    <img src="{{ asset('front/images/dgc_wb.png') }}" alt="DGC">
                </div>
            </div>
        </div>
    </div>
    <div class="page text-center text-md-left">
        <!-- Page Header-->
        <header class="page-head">
            <div class="rd-navbar-wrap">
                <nav class="rd-navbar rd-navbar-secondary" data-stick-up-clone="true" data-layout="rd-navbar-fixed"
                    data-sm-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed"
                    data-md-layout="rd-navbar-static" data-md-device-layout="rd-navbar-fixed"
                    data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static"
                    data-lg-stick-up-offset="252px">
                    <div class="rd-navbar-inner"><span class="small">Bienvenue à la Direction Générale du Commerce du
                            Gabon</span>
                        <ul class="list-inline list-inline-lg offset-top-0">
                            <li><a class="ioon icon-sm icon-silver-chalice fa-facebook" href="#"></a></li>
                            <li><a class="ioon icon-sm icon-silver-chalice fa-twitter" href="#"></a></li>
                        </ul>
                    </div>
                    <div class="rd-navbar-inner">
                        <!-- RD Navbar Panel-->
                        <div class="rd-navbar-panel">
                            <!-- RD Navbar Toggle-->
                            <button class="rd-navbar-toggle"
                                data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                            <button class="rd-navbar-collapse-toggle"
                                data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></button>
                            <div class="rd-navbar-brand"><a class="brand-name" href="{{ url('/') }}"><img
                                        class="brand-device" src="{{ asset('front/images/dgc_wb.png') }}" width="100"
                                        alt="Home service"><img class="brand-mobile"
                                        src="{{ asset('front/images/dgc_wb.png') }}" width="100"
                                        alt="Home service"></a></div>
                        </div>
                        <div class="rd-navbar-collapse animated">
                            <div class="rd-navbar-collapse-items">
                                <ul class="list-inline">
                                    <li>
                                        <div class="unit flex-row unit-spacing-xs">
                                            <div class="unit-left"><span class="icon icon-primary fa-phone"></span>
                                            </div>
                                            <div class="unit-body">
                                                <div class="title"><span class="small">TÉLÉPHONE</span>
                                                </div>
                                                <h6><a href="tel:#">+241 11 76 61 67</a></h6>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="unit flex-row unit-spacing-xs">
                                            <div class="unit-left"><span class="icon icon-primary fa-map-marker"></span>
                                            </div>
                                            <div class="unit-body">
                                                <div class="title"><span class="small">ADRESSE</span></div>
                                                <h6><a href="#">Rue François de Paul Vane UBISSANI, Libreville</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="unit flex-row unit-spacing-xs">
                                            <div class="unit-left"><span class="icon icon-primary fa-clock-o"></span>
                                            </div>
                                            <div class="unit-body">
                                                <div class="title"><span class="small">HORAIRES </span></div>
                                                <h6>Lun - Ven : 08:00 - 15:00</h6>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="rd-navbar-collapse-items">
                                <ul class="list-inline list-inline-lg offset-top-0">
                                    <li><a class="ioon icon-sm icon-silver-chalice fa-facebook" href="#"></a>
                                    </li>
                                    <li><a class="ioon icon-sm icon-silver-chalice fa-twitter" href="#"></a>
                                    </li>
                                    <li><a class="ioon icon-sm icon-silver-chalice fa-instagram" href="#"></a>
                                    </li>
                                    <li><a class="ioon icon-sm icon-silver-chalice fa-google-plus" href="#"></a>
                                    </li>
                                    <li><a class="ioon icon-sm icon-silver-chalice fa-pinterest-p" href="#"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="rd-navbar-inner">
                        <div class="rd-navbar-nav-wrap">
                            <!-- RD Navbar Nav-->
                            <ul class="rd-navbar-nav">
                                <li><a href="{{ url('/') }}">Déclaration d'importation</a></li>
                                <li><a href="{{ url('form/stock') }}">Déclaration de stock</a></li>
                                {{-- <li><a href="{{ url('events') }}">Évènements</a></li> --}}
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        @yield('content')

        <!-- Page Footer-->
        <footer class="page-footer page-footer-classic">
            <section class="section-75 section-sm-80 section-md-100 section-xl-150">
                <div class="container">
                    <div class="row text-md-left row-55">
                        <div class="col-md-6 col-xl-3 col-xxl-4"><a href="{{ url('/') }}"><img
                                    class="img-responsive" src="{{ asset('front/images/dgc_wb.png') }}"
                                    alt="DGC" width="100" height="58" /></a>
                            <p class="offset-top-20 offset-md-top-35 inset-xxl-right-30">La Direction Générale du
                                Commerce est une entité du Ministère des Petites et Moyennes Entreprises, de l'Artisanat
                                et du Commerce.
                            </p>
                        </div>

                        <div class="col-sm-6 col-md-3 col-xl-2 col-lg-3"><span
                                class="small text-spacing-340 text-white text-uppercase font-weight-bold page-footer-classic-title">INFORMATION</span>
                            <ul class="list list-marked offset-top-30 list-xs offset-md-top-40">
                                <li><a class="text-white" href="#">Contact</a></li>
                                <li><a class="text-white" href="#">Politique de Confidentialité</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-xl-2 col-lg-5">
                            <div class="inset-xl-right-30"><span
                                    class="small text-spacing-340 text-white text-uppercase font-weight-bold page-footer-classic-title">CONTACTEZ
                                    NOUS
                                </span>
                                <ul class="list offset-top-30 text-left offset-md-top-40">
                                    <li>
                                        <div class="unit flex-row unit-spacing-xs">
                                            <div class="unit-left"><span
                                                    class="icon icon--school-bus-yellow fa-map-marker"></span></div>
                                            <div class="unit-body"><a class="text-school-bus-yellow-white"
                                                    href="#">Rue François de Paul Vane UBISSANI<br
                                                        class="d-none d-md-block"> Libreville, Gabon</a></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="unit flex-row unit-spacing-xs">
                                            <div class="unit-left"><span
                                                    class="icon icon--school-bus-yellow fa-phone"></span></div>
                                            <div class="unit-body"><a class="text-school-bus-yellow-white"
                                                    href="tel:#">+241 11 76 61 67</a></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="unit flex-row unit-spacing-xs">
                                            <div class="unit-left"><span
                                                    class="icon icon--school-bus-yellow fa-envelope"></span></div>
                                            <div class="unit-body"><a class="text-school-bus-yellow-white"
                                                    href="mailto:#">dgcommercegabon@gmail.com</a></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 col-xxl-2 col-lg-5">
                            <div class="inset-xl-right-30"><span
                                    class="small text-spacing-340 text-white text-uppercase font-weight-bold page-footer-classic-title">SUIVEZ
                                    NOUS</span>
                                <ul class="list-inline list-inline-lg offset-top-30 offset-md-top-40">
                                    <li><a class="ioon icon-sm icon--school-bus-yellow-white fa-facebook"
                                            href="#"></a></li>
                                    <li><a class="ioon icon-sm icon--school-bus-yellow-white fa-twitter"
                                            href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section-25 bg-black-2">
                <div class="container">
                    <div class="row align-items-md-center row-30">
                        <div class="col-md-8 text-md-left">
                            <p class="small-xs">Copyright © <span class="copyright-year"></span> - Tous Droits
                                Réservés
                            </p>
                        </div>
                        <div class="col-md-4 text-md-right">

                        </div>
                    </div>
                </div>
            </section>
        </footer>
    </div>
    <div class="snackbars" id="form-output-global"></div>
    <script src="{{ asset('front/js/core.min.js') }}"></script>
    <script src="{{ asset('front/js/script.js') }}"></script>

    @stack('scripts')
</body>

</html>
