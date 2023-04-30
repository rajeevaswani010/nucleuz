<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div><img src="{{ URL('public/logo.png') }}" style="width: 20%;"></div>

    <h1>Hi {{ $Name }}!</h1>
    <h4>We have received your forgot password request. Click below link to reset your password</h4>

    <a href="{{ $Link }}"><button>Reset Now</button></a>
  </body>
</html>