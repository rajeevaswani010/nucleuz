
<script src="{{ URL('public/newasserts/js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#form_data").submit(function (e) {
            $("#login_button").attr("disabled", true);
            return true;
        });
    });
</script>


<!DOCTYPE html>




<html lang="en" dir="">

<head>
    <title>Login</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content="Dashboard Template Description"/>
    <meta name="keywords" content="Dashboard Template"/>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL('public/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL('public/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL('public/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ URL('public/site.webmanifest') }}">

    <!-- font css -->
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/fonts/material.css') }}">

    <!-- vendor css -->

            <link rel="stylesheet" href="{{ URL('public/newasserts/assets/css/style.css') }}" id="main-style-link">

    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/css/customizer.css') }}">

</head>

<body class="theme-4">
<div class="auth-wrapper auth-v3">
    <div class="bg-auth-side bg-primary"></div>
    <div class="auth-content">
        <nav class="navbar navbar-expand-md navbar-light default" style="background:none!important;box-shadow: none!important;">
            <div class="container-fluid pe-2">
                <a class="navbar-brand" href="{{ URL('/') }}">

            <img src="{{ URL('public/logo.png') }}" alt="projecterp" class="logo w-50" style="width: 20% !important;">
                                    </a>
              
            </div>
        </nav>

        <div class="card">
            <div class="row align-items-center text-start">
                <div class="col-xl-6">
                    <div class="card-body">
                            <div class="">
        <h2 class="mb-3 f-w-600">Change your password</h2>
    </div>
   

    {!! Form::open(['url' => 'DoReset', 'id' => 'loginForm', 'enctype' => 'multipart/form-data', 'method' => 'post']) !!}

    <div class="">
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input class="form-control " id="email" type="email" name="Username"  required />
            </div>
       

            <div class="form-group mb-4">
            <a href="{{ URL('login') }}" class="text-xs">Back To Login</a>
                
        </div>
        <div class="d-grid">
            <button type="submit" class="btn-login btn btn-primary btn-block mt-2" id="login_button">Reset</button>
        </div>
        <br />

        @if(Session::has('Danger'))
        <div class="alert alert-danger" role="alert">
            <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
            <div class="alert-text">{!!Session::get('Danger')!!}</div>
        </div>
        @endif

        @if(Session::has('Success'))
        <div class="alert alert-success" role="alert">
            <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
            <div class="alert-text">{!!Session::get('Success')!!}</div>
        </div>
        @endif
        
    </div>
    {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-xl-6 img-card-side">
                    <div class="auth-img-content">
                        <img
                            src="{{ URL('public/newasserts/assets/images/auth/img-auth-3.svg') }}"
                            alt=""
                            class="img-fluid"
                        />
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="auth-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <p class="">
                            Copyright ERPGO 2023
                        </p>
                    </div>

                </div>
            </div>
        </div>--}}
    </div>
</div>
<!-- [ auth-signup ] end -->

    </body>
</html>
