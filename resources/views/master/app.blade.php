<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>{{ config('app.name', 'JTKPK') }} - @yield('title')</title>

        <meta name="description" content="@yield('site.description')">
        <meta name="Developer" content="Zulkifli Mohamed (putera)">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Icons -->
        <link rel="shortcut icon" href="/assets/img/favicons/favicon.png">

        <link rel="icon" type="image/png" href="/assets/img/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="/assets/img/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/assets/img/favicons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/assets/img/favicons/favicon-160x160.png" sizes="160x160">
        <link rel="icon" type="image/png" href="/assets/img/favicons/favicon-192x192.png" sizes="192x192">

        <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/favicons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/assets/img/favicons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/favicons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/favicons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/favicons/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/favicons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/favicons/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/favicons/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Web fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="/assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" href="/assets/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="/assets/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
        <link rel="stylesheet" href="/assets/js/plugins/select2/select2.min.css">
        <link rel="stylesheet" href="/assets/js/plugins/select2/select2-bootstrap.min.css">
        <link rel="stylesheet" href="/assets/js/plugins/jquery-auto-complete/jquery.auto-complete.min.css">
        <link rel="stylesheet" href="/assets/js/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
        <link rel="stylesheet" href="/assets/js/plugins/ion-rangeslider/css/ion.rangeSlider.skinHTML5.min.css">
        <link rel="stylesheet" href="/assets/js/plugins/dropzonejs/dropzone.min.css">
        <link rel="stylesheet" href="/assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.css">
        <link rel="stylesheet" href="/assets/js/plugins/datatables/jquery.dataTables.min.css">
        <link rel="stylesheet" href="/assets/js/plugins/fullcalendar/fullcalendar.min.css">
        <link rel="stylesheet" href="/assets/js/plugins/sweetalert/sweetalert.min.css">
        <link rel="stylesheet" href="/assets/js/plugins/magnific-popup/magnific-popup.min.css">
        <link rel="stylesheet" href="/assets/js/plugins/summernote/summernote.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/emojione/2.2.6/assets/css/emojione.min.css"/>
        @yield('css')

        <!-- Bootstrap and OneUI CSS framework -->
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" id="css-main" href="/assets/css/oneui.css">
        <link rel="stylesheet" href="/assets/css/custom.css">
        <!-- END Stylesheets -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
        <div id="page-container" class="sidebar-l sidebar-mini sidebar-o side-scroll header-navbar-fixed enable-cookies">
            @yield('side.overlay')

            <!-- Sidebar -->
            <nav id="sidebar">
                <!-- Sidebar Scroll Container -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Side Header -->
                        <div class="side-header side-content bg-white-op">
                            <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times"></i>
                            </button>
                            <div class="btn-group pull-right">
                                <button class="btn btn-link text-gray dropdown-toggle" data-toggle="dropdown" type="button">
                                    <i class="si si-drop"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right font-s13 sidebar-mini-hide">
                                    <li>
                                        <a data-toggle="theme" data-theme="default" tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-circle text-default pull-right"></i> <span class="font-w600">Default</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-toggle="theme" data-theme="/assets/css/themes/amethyst.min.css" tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-circle text-amethyst pull-right"></i> <span class="font-w600">Amethyst</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-toggle="theme" data-theme="/assets/css/themes/city.min.css" tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-circle text-city pull-right"></i> <span class="font-w600">City</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-toggle="theme" data-theme="/assets/css/themes/flat.min.css" tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-circle text-flat pull-right"></i> <span class="font-w600">Flat</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-toggle="theme" data-theme="/assets/css/themes/modern.min.css" tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-circle text-modern pull-right"></i> <span class="font-w600">Modern</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-toggle="theme" data-theme="/assets/css/themes/smooth.min.css" tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-circle text-smooth pull-right"></i> <span class="font-w600">Smooth</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- END Side Header -->

                        <!-- Side Content -->
                        <div class="side-content">
                            <ul class="nav-main">
                                <li>
                                    <a class="{{ (Request::path()=='/' || Request::path()=='home') ? 'active':'' }}" href="{{ url('/') }}">
                                        <i class="si si-speedometer"></i><span class="sidebar-mini-hide">Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ (Request::path()=='profil') ? 'active':'' }}" href="{{ url('/profil') }}">
                                        <i class="fa fa-user"></i><span class="sidebar-mini-hide">Profil</span>
                                    </a>
                                </li>

                                @if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin'))
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                        <i class="si si-support"></i><span class="sidebar-mini-hide">Pentadbiran</span>
                                    </a>
                                    <ul>
                                        @if (Auth::user()->hasRole('super-admin'))
                                            <li>
                                                <a class="{{ (Request::path()=='admin/packages') ? 'active':'' }}" href="{{ url('/admin/packages') }}">Pakej Sistem</a>
                                            </li>
                                        @endif
                                        <li>
                                            <a class="{{ (Request::path()=='admin/users') ? 'active':'' }}" href="{{ url('/admin/users') }}">Pengguna</a>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                                
                                <!--
                                    MODULE TERSEDIA
                                -->
                                @if (!Auth::user()->hasRole('jpn'))
                                <li>
                                    <a class="{{ (Request::path()=='tugasan-harian') ? 'active':'' }}" href="{{ url('/tugasan-harian') }}">
                                        <i class="fa fa-book"></i><span class="sidebar-mini-hide">Tugasan Harian</span>
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <a class="{{ (Request::path()=='aduan-kerosakan') ? 'active':'' }}" href="{{ url('/aduan-kerosakan') }}">
                                        <i class="fa fa-wrench"></i><span class="sidebar-mini-hide">Aduan Kerosakan</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ (Request::path()=='dev-team') ? 'active':'' }}" href="{{ url('/dev-team') }}">
                                        <i class="fa fa-users"></i><span class="sidebar-mini-hide">Development Team</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ (Request::path()=='smart-team') ? 'active':'' }}" href="{{ url('/smart-team') }}">
                                        <i class="fa fa-ambulance"></i><span class="sidebar-mini-hide">SMART Team</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ (Request::path()=='forums') ? 'active':'' }}" href="{{ url('/forums') }}">
                                        <i class="fa fa-comments"></i><span class="sidebar-mini-hide">FORUM</span>
                                    </a>
                                </li>

                                <!-- PAKEJ MENU -->
                                @foreach (App\Packages::all() as $package)
                                    @if ($package->package_status == 1)
                                        <li>
                                            <a class="{{ (Request::path() == substr($package->package_url,1)) ? 'active':'' }}" href="{{ url(''.$package->package_url.'') }}">
                                                <i class="fa {{ $package->package_icon_text }}"></i><span class="sidebar-mini-hide">{{ $package->package_title }}</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach

                                <li>
                                    <a class="" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i><span class="sidebar-mini-hide">Log Keluar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END Side Content -->
                    </div>
                    <!-- Sidebar Content -->
                </div>
                <!-- END Sidebar Scroll Container -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="header-navbar" class="content-mini content-mini-full">
                <!-- Header Navigation Right -->
                <ul class="nav-header pull-right">
                    <li>
                        @if (Auth::guest())
                            <a href="{{ url('/login') }}" class="btn btn-success">
                                <i class="fa fa-sign-in push-5-r"></i>Log Masuk
                            </a>
                        @else
                            <div class="btn-group">
                                <button class="btn btn-default btn-image dropdown-toggle" data-toggle="dropdown" type="button">
                                    <img src="/avatar" class="img-avatar" title="{{ Auth::user()->name }}">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a tabindex="-1" href="{{ url('/profil') }}">
                                            <i class="si si-user pull-right"></i> Profil
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="si si-logout pull-right"></i>Log Keluar
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        @endif
                    </li>
                </ul>
                <!-- END Header Navigation Right -->

                <!-- Header Navigation Left -->
                <ul class="nav-header pull-left">
                    <li class="hidden-md hidden-lg">
                        <button class="btn btn-default" data-toggle="layout" data-action="sidebar_toggle" type="button">
                            <i class="fa fa-navicon"></i>
                        </button>
                    </li>
                    <li class="hidden-xs hidden-sm">
                        <button class="btn btn-default" data-toggle="layout" data-action="sidebar_mini_toggle" type="button">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                    </li>
                    <li class="h6 hidden-xs hidden-sm">
                        <img src="/avatar" class="img-avatar img-avatar32 push-5-r" title="{{ Auth::user()->name }}"> {{ Auth::user()->name }}
                    </li>
                </ul>
                <!-- END Header Navigation Left -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                @yield('content')
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix">
                <div class="pull-left font-w300">
                    Dibangunkan dengan <i class="fa fa-heart text-city"></i> oleh <a class="font-w600" href="https://github.com/putera" target="_blank">JTKPK</a>
                </div>
                <div class="pull-right font-w300">
                    &copy; {{ date('Y') }} oleh <span class="font-w400">Juruteknik Komputer Negeri Perak (JTKPK)</span>. Semua Hakcipta Terpelihara.
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Core Javascript -->
        <script src="/assets/js/core/jquery.min.js"></script>
        <script src="/assets/js/core/bootstrap.min.js"></script>
        <script src="/assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="/assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="/assets/js/core/jquery.appear.min.js"></script>
        <script src="/assets/js/core/jquery.countTo.min.js"></script>
        <script src="/assets/js/core/jquery.placeholder.min.js"></script>
        <script src="/assets/js/core/js.cookie.min.js"></script>
        <script src="/assets/js/app.js.php"></script>
        <script src="/js/ajax.js"></script>
        <script src="/js/custom.js"></script>

        <!-- Page JS Plugins -->
        <script src="/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="/assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="/assets/js/plugins/bootstrap-datetimepicker/moment.min.js"></script>
        <script src="/assets/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script src="/assets/js/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="/assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
        <script src="/assets/js/plugins/select2/select2.full.min.js"></script>
        <script type="text/javascript">
            $.fn.modal.Constructor.prototype.enforceFocus = function () {};
        </script>
        <script src="/assets/js/plugins/masked-inputs/jquery.maskedinput.min.js"></script>
        <script src="/assets/js/plugins/jquery-auto-complete/jquery.auto-complete.min.js"></script>
        <script src="/assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
        <script src="/assets/js/plugins/dropzonejs/dropzone.min.js"></script>
        <script src="/assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
        <script src="/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/assets/js/pages/base_tables_datatables.js"></script>        
        <script src="/assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>
        <script src="/assets/js/plugins/fullcalendar/gcal.min.js"></script>
        <!--<script src="/assets/js/pages/calendar.js.php"></script>-->
        <script src="/assets/js/plugins/sweetalert/sweetalert.min.js"></script>
        <script src="/assets/js/plugins/summernote/summernote.min.js"></script>
        <script src="/assets/js/plugins/ckeditor/ckeditor.js"></script>
        <script src="/assets/js/plugins/jquery-textcomplete/jquery.textcomplete.min.js"></script>
        <script src="/assets/js/plugins/magnific-popup/magnific-popup.min.js"></script>
        <script src="https://cdn.jsdelivr.net/emojione/2.2.6/lib/js/emojione.min.js"></script>
        @yield('js')

        <script>
            jQuery(function () {
                App.initHelpers(['datepicker', 'datetimepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider', 'magnific-popup', 'tags-inputs' @yield('app.helper')]);
                @yield('jquery')
            });
        </script>
    </body>
</html>