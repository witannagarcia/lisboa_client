<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu | {{ env('APP_NAME', '') }}</title>
    <link rel="stylesheet" href="{{ asset('css/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>
<body>
    <div id="loading">
        <img src="{{ $restaurant->setting->logo}}" alt="">
        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>

$(window).on('load', function() {
    $("#loading").fadeOut("slow").remove();
});
    </script>
</body>
</html>