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
        
        @yield('content')

        <!-- Login Footer -->
        <div class="text-center animated fadeIn push-20-t">
            <small class="text-muted">&copy; {{ date('Y') }} oleh JTKPK. Semua Hakcipta Terpelihara.</small>
        </div>
        <!-- END Login Footer -->

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