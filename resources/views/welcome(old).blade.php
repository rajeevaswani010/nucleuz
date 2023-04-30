<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login</title>
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

        <link rel="apple-touch-icon" sizes="180x180" href="{{ URL('public/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ URL('public/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ URL('public/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ URL('public/site.webmanifest') }}">

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
                <div class=" pt-32pt pt-sm-64pt pb-32pt">
                    <div class="container-fluid page__container">
                        @if(Session::has('Danger'))
                          <div class="alert alert-danger" role="alert">
                              <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                              <div class="alert-text">{!!Session::get('Danger')!!}</div>
                          </div>
                          @endif
                          <div class="text-center"><img src="{{ URL('public/logo.png') }}" style="width: 40%"></div>
                        {!! Form::open(['url' => 'login', 'class' => 'col-md-5 p-0 mx-auto', 'enctype' => 'multipart/form-data', 'method' => 'post']) !!}
                            <div class="form-group">
                                <label class="form-label" for="email">{{ __('Username:') }}</label>
                                <input id="email" type="text" name="Username" class="form-control" placeholder="Your email address ...">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password">{{ __('Password:') }}</label>
                                <input id="password" type="password" name="Password" class="form-control" placeholder="Password">
                                <p class="text-right"><a href="{{ URL('reset-password') }}" class="small">{{ __('Forgot your password?') }}</a></p>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-accent">{{ __('Login') }}</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
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

        <!-- App Settings (safe to remove) -->
        <script src="{{ URL('public/js/app-settings.js') }}"></script>
    </body>

</html>