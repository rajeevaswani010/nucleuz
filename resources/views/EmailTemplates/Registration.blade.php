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
    <h4>You are registered successfully in Nucleuz</h4>

    <p>Here is your login details</p>

    <div><b>Email : </b> {{ $Email }}</div>
    <div><b>Password :  </b> {{ $Password }}</div>

    <a href="{{ $Link }}"><button>Login Now</button></a>
  </body>
</html>