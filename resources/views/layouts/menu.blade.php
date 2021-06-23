<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu | {{ env('APP_NAME', '') }}</title>
    <link rel="stylesheet" href="{{ asset('css/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>
<body>
    <div id="loading">
        <img src="{{ $restaurant->setting->logo}}" alt="">
        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="container">
        @yield('content')
        <div id="hamburger" class="waves-effect waves-light">
            <div id="wrapper">
              <span class="icon-bar" id="one"></span>
              <span class="icon-bar" id="two"></span>
              <span class="icon-bar" id="thr"></span>
            </div>
          </div>
          @if($restaurant->setting->address)
          <div id="btnExit" class="hamburger-nav">
            <span class="floatingmenu_label">Ubicación</span>
            <a class="text-white" target="_blank" href="http://maps.google.com/?q={{$restaurant->setting->address}}">
                <span class="mdi mdi-map"></span>
            </a>
          </div>
          @endif
          @if($restaurant->setting->website)
          <div id="btnUsers" class="hamburger-nav">
            <span class="floatingmenu_label">Sitio Web</span>
            <a class="text-white" target="_blank" href="{{$restaurant->setting->website}}">
            <span class="mdi mdi-web"></span>
            </a>
             <!--<img style="width: 24px; height: 24px;" src="https://www.iconfinder.com/data/icons/small-n-flat/24/pencil-128.png">-->
          </div>
          @endif
          @if($restaurant->setting->phone)
          <div id="btnJobs" class="hamburger-nav">
            <div class="floatingmenu_label">Teléfono</div>
            <a class="text-white" target="_blank" href="{{$restaurant->setting->website}}">
            <span class="mdi mdi-phone"></span>
            </a>
             <!--<img style="width: 24px; height: 24px;" src="https://www.iconfinder.com/data/icons/small-n-flat/24/pencil-128.png">-->
          </div>
          @endif
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{ asset('js/slick.js') }}"></script>

    <script>

$(window).on('load', function() {
    $("#loading").fadeOut("slow").remove();
});

$('#hamburger').click(function() {
    $('#hamburger').toggleClass('show');
    $('.hamburger-nav').toggleClass('show');
  });

    </script>
    @yield('scripts')
</body>
</html>