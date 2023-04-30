<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Nucleuz Admin</title>
        <link rel="icon" type="image/x-icon" href="https://nucleuz.app/public/favicon.png">
        <meta name="robots" content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7COswald:300,400,500,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">

        <!-- Perfect Scrollbar -->
        <link type="text/css" href="{{ URL('public/vendor/perfect-scrollbar.css') }}" rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css" href="{{ URL('public/css/material-icons.css') }}" rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link type="text/css" href="{{ URL('public/css/fontawesome.css') }}" rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css" href="{{ URL('public/vendor/spinkit.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ URL('public/css/preloader.css') }}" rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css" href="{{ URL('public/css/app.css') }}" rel="stylesheet">

        <!-- Dark Mode CSS (optional) -->
        <link type="text/css" href="{{ URL('public/css/dark-mode.css') }}" rel="stylesheet">

    </head>

    
    <body class="layout-app layout-sticky-subnav ">

        <div class="preloader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        </div>

        <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page-content">
                @yield("content")
            </div>
            <!-- // END drawer-layout__content -->

            <!-- drawer -->
            <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
                <div class="mdk-drawer__content">
                    <div class="sidebar sidebar-dark sidebar-left" data-perfect-scrollbar>

                        <a href="{{ URL('dashboard') }}" class="sidebar-brand ">
                            <img class="sidebar-brand-icon" src="{{ URL('public/favicon.png') }}">
                        </a>
                    </div>
                </div>
            </div>
            <!-- // END drawer -->
        </div>
        <!-- // END drawer-layout -->


        <!-- jQuery -->
        <script src="{{ URL('public/vendor/jquery.min.js') }}"></script>

        <!-- Bootstrap -->
        <script src="{{ URL('public/vendor/popper.min.js') }}"></script>
        <script src="{{ URL('public/vendor/bootstrap.min.js') }}"></script>

        <!-- Perfect Scrollbar -->
        <script src="{{ URL('public/vendor/perfect-scrollbar.min.js') }}"></script>

        <!-- DOM Factory -->
        <script src="{{ URL('public/vendor/dom-factory.js') }}"></script>

        <!-- MDK -->
        <script src="{{ URL('public/vendor/material-design-kit.js') }}"></script>

        <!-- App JS -->
        <script src="{{ URL('public/js/app.js') }}"></script>

        <!-- Highlight.js -->
        <script src="{{ URL('public/js/hljs.js') }}"></script>

        <!-- List.js -->
        <script src="{{ URL('public/vendor/list.min.js') }}"></script>
        <script src="{{ URL('public/js/list.js') }}"></script>

        <!-- Tables -->
        <script src="{{ URL('public/js/toggle-check-all.js') }}"></script>
        <script src="{{ URL('public/js/check-selected-row.js') }}"></script>
        
        @yield("ExtraJS")
    </body>

</html>