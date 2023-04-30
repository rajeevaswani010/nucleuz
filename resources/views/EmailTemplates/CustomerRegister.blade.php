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

    <p>{{ $Customer }} register via invite link. Please check</p>
  </body>
</html>