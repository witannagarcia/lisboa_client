<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', '') }}</title>
    <link rel="stylesheet" href={{ asset('css/auth.css') }}>
</head>
<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

<body>
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          @yield("content")
        </div>
      </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
  
</html>