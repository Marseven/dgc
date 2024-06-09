@php
    $user = App\Models\User::with('roles')->find(Auth::user()->id);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="#">
    <meta name="keywords" content="#">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('front/images/dgc.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('front/images/dgc.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Direction Général du Commerce | Gabon</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/vendors/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/vendors/animate.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('admin/css/color-1.css" media="screen') }}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/responsive.css') }}">

    @stack('styles')
</head>

<body onload="startTime()">
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"> <span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <form class="form-inline search-full col" action="#" method="get">
                    <div class="form-group w-100">
                        <div class="Typeahead Typeahead--twitterUsers">
                            <div class="u-posRelative">
                                <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                                    placeholder="Recherche .." name="q" title="" autofocus>
                                <div class="spinner-border Typeahead-spinner" role="status"><span
                                        class="sr-only">Chargement...</span></div><i class="close-search"
                                    data-feather="x"></i>
                            </div>
                            <div class="Typeahead-menu"></div>
                        </div>
                    </div>
                </form>
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="logo-wrapper"><a href="{{ route('dashboard') }}"><img class="img-fluid"
                                src="{{ asset('front/images/dgc_wb.png') }}" width="75" alt=""></a>
                    </div>
                    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle"
                            data-feather="align-center"></i></div>
                </div>
                <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">

                </div>
                <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
                    <ul class="nav-menus">

                        <li> <span class="header-search">
                                <svg>
                                    <use href="{{ asset('admin/svg/icon-sprite.svg#search') }}"></use>
                                </svg></span></li>

                        <li>
                            <div class="mode">
                                <svg>
                                    <use href="{{ asset('admin/svg/icon-sprite.svg#moon') }}"></use>
                                </svg>
                            </div>
                        </li>


                        <li class="profile-nav onhover-dropdown pe-0 py-0">
                            <div class="media profile-media"><img class="b-r-10"
                                    src="{{ asset('admin/images/dashboard/profile.png') }}" alt="">
                                <div class="media-body"><span>{{ $user['last_name'] }}</span>
                                    <p class="mb-0">
                                        {{ $user->roles->count() != 0 ? $user->roles->first()['name'] : 'Admin' }} <i
                                            class="middle fa fa-angle-down"></i>
                                    </p>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href="{{ route('admin.profil.user') }}"><i
                                            data-feather="user"></i><span>Profil
                                        </span></a>
                                </li>
                                <li><a href="{{ url('log-out') }}"><span>Déconnexion</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper" sidebar-layout="stroke-svg">
                <div>
                    <div class="logo-wrapper"><a href="{{ route('dashboard') }}"><img class="img-fluid for-light"
                                src="{{ asset('front/images/dgc_wb.png') }}" width="75" alt=""><img
                                class="img-fluid for-dark" src="{{ asset('front/images/dgc_wb.png') }}"
                                width="75" alt=""></a>
                        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle"
                                data-feather="grid"> </i></div>
                    </div>
                    <div class="logo-icon-wrapper"><a href="{{ route('dashboard') }}"><img class="img-fluid"
                                src="{{ asset('front/images/dgc_wb.png') }}" width="45" alt=""></a>
                    </div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn"><a href="{{ route('dashboard') }}"><img class="img-fluid"
                                            src="{{ asset('front/images/dgc_wb.png') }}" width="75"
                                            alt=""></a>
                                    <div class="mobile-back text-end"><span>Retour</span><i
                                            class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                                </li>
                                <li class="pin-title sidebar-main-title">
                                    <div>
                                        <h6>Epinglé</h6>
                                    </div>
                                </li>
                                <li class="sidebar-main-title">
                                    <div>
                                        <h6 class="">Générale</h6>
                                    </div>
                                </li>
                                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                                    <a class="sidebar-link sidebar-title" href="{{ route('dashboard') }}">
                                        <svg class="stroke-icon">
                                            <use href="{{ asset('admin/svg/icon-sprite.svg#stroke-home') }}"></use>
                                        </svg>
                                        <svg class="fill-icon">
                                            <use href="{{ asset('admin/svg/icon-sprite.svg#fill-home') }}"></use>
                                        </svg><span class="">Tableau de Bord </span></a>

                                </li>
                                <li class="sidebar-main-title">

                                    <h6 class="">Déclarations</h6>

                                </li>
                                @hasPrivilige('VOIR_IMPORTATION')
                                    <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i>
                                        <a class="sidebar-link sidebar-title" href="{{ route('admin.importation') }}">
                                            <i data-feather="package" class="mx-1"></i><span>Import / Export
                                            </span></a>
                                    </li>
                                @endHasPrivilige

                                @hasPrivilige('VOIR_STOCK')
                                    <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i>
                                        <a class="sidebar-link sidebar-title" href="{{ route('admin.stock') }}">
                                            <i data-feather="database" class="mx-1"></i><span>Stocks </span></a>
                                    </li>
                                @endHasPrivilige

                                @hasPrivilige('VOIR_ENTREPRISE')
                                    <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i>
                                        <a class="sidebar-link sidebar-title" href="{{ route('admin.entreprise') }}">
                                            <i data-feather="home" class="mx-1"></i><span>Entreprises </span></a>
                                    </li>
                                @endHasPrivilige

                                @hasPrivilige('VOIR_UTILISATEUR')
                                    <li class="sidebar-main-title">

                                        <h6 class="">Utilisateurs</h6>

                                    </li>
                                    @hasPrivilige('VOIR_UTILISATEUR')
                                        <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i>
                                            <a class="sidebar-link sidebar-title" href="{{ route('admin.list.user') }}">
                                                <i data-feather="users" class="mx-1"></i><span>Liste des utilisateurs
                                                </span></a>
                                        </li>
                                    @endHasPrivilige

                                    @hasPrivilige('VOIR_ROLE')
                                        <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i>
                                            <a class="sidebar-link sidebar-title" href="{{ route('admin.list.role') }}">
                                                <i data-feather="user-check" class="mx-1"></i><span>Rôles </span></a>
                                        </li>
                                    @endHasPrivilige

                                    @hasPrivilige('VOIR_PERMISSION')
                                        <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i>
                                            <a class="sidebar-link sidebar-title" href="{{ route('admin.list.privilege') }}">
                                                <i data-feather="user-plus" class="mx-1"></i><span>Privilèges </span></a>
                                        </li>
                                    @endHasPrivilige

                                    @hasPrivilige('VOIR_UTILISATEUR_TYPE')
                                        <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i>
                                            <a class="sidebar-link sidebar-title" href="{{ route('admin.list.user-type') }}">
                                                <i data-feather="user" class="mx-1"></i><span>Types d'utilisateur
                                                </span></a>
                                        </li>
                                    @endHasPrivilige
                                @endHasPrivilige

                                @hasPrivilige('VOIR_PARAMETRE')
                                    <li class="sidebar-main-title">

                                        <h6 class="">Paramètres</h6>

                                    </li>
                                    <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i>
                                        <a class="sidebar-link sidebar-title" href="{{ route('admin.activite') }}">
                                            <i data-feather="briefcase" class="mx-1"></i><span>Activités </span></a>
                                    </li>
                                    <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i>
                                        <a class="sidebar-link sidebar-title" href="{{ route('admin.declaration') }}">
                                            <i data-feather="archive" class="mx-1"></i><span>Type de déclaration
                                            </span></a>
                                    </li>
                                    <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i>
                                        <a class="sidebar-link sidebar-title" href="{{ route('admin.product') }}">
                                            <i data-feather="box" class="mx-1"></i><span>Type de produit
                                            </span></a>
                                    </li>

                                    <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i>
                                        <a class="sidebar-link sidebar-title" href="{{ route('admin.logistic') }}">
                                            <i data-feather="anchor" class="mx-1"></i><span>Moyen logistique
                                            </span></a>
                                    </li>
                                @endHasPrivilige

                                @hasPrivilige('VOIR_LOG')
                                    <!--begin:Menu item-->
                                    <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i>
                                        <a class="sidebar-link sidebar-title" href="{{ url('log-viewer') }}">
                                            <i data-feather="list" class="mx-1"></i><span>Log
                                            </span></a>
                                    </li>
                                @endHasPrivilige
                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                @yield('content')
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">Copyright {{ date('Y') }} © Direction Générale du Commerce</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('admin/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('admin/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('admin/js/icons/feather-icon/feather-icon.js') }}"></script>

    <!-- scrollbar js-->
    <script src="{{ asset('admin/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('admin/js/scrollbar/custom.js') }}"></script>

    <!-- Sidebar jquery-->
    <script src="{{ asset('admin/js/config.js') }}"></script>

    <!-- Plugins JS start-->
    <script src="{{ asset('admin/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('admin/js/sidebar-pin.js') }}"></script>
    <script src="{{ asset('admin/js/clock.js') }}"></script>
    <script src="{{ asset('admin/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin/js/slick/slick.js') }}"></script>
    <script src="{{ asset('admin/js/header-slick.js') }}"></script>
    <script src="{{ asset('admin/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('admin/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('admin/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('admin/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('admin/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('admin/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('admin/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('admin/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('admin/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ asset('admin/js/height-equal.js') }}"></script>
    <script src="{{ asset('admin/js/animation/wow/wow.min.js') }}"></script>
    <!-- Plugins JS Ends-->

    <!-- Theme js-->
    <script src="{{ asset('admin/js/script.js') }}"></script>

    @stack('scripts')

</body>

</html>
