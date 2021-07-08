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
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>

<body>
    <div id="loading">
        <img src="{{ Storage::disk('public')->url($branch->setting->logo) }}" alt="">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="container">
        @yield('content')
        <div id="order" class="waves-effect waves-light">
            <i class="fas fa-concierge-bell"></i>
        </div>
        <div id="hamburger" class="waves-effect waves-light">
            <div id="wrapper">
                <span class="icon-bar" id="one"></span>
                <span class="icon-bar" id="two"></span>
                <span class="icon-bar" id="thr"></span>
            </div>
        </div>
        @if ($branch->setting->address)
            <div id="btnExit" class="hamburger-nav">
                <span class="floatingmenu_label">Ubicación</span>
                <a class="text-white" target="_blank" href="http://maps.google.com/?q={{ $branch->setting->address }}">
                    <span class="mdi mdi-map"></span>
                </a>
            </div>
        @endif
        @if ($branch->setting->website)
            <div id="btnUsers" class="hamburger-nav">
                <span class="floatingmenu_label">Sitio Web</span>
                <a class="text-white" target="_blank" href="{{ $branch->setting->website }}">
                    <span class="mdi mdi-web"></span>
                </a>
                <!--<img style="width: 24px; height: 24px;" src="https://www.iconfinder.com/data/icons/small-n-flat/24/pencil-128.png">-->
            </div>
        @endif
        @if ($branch->setting->phone)
            <div id="btnJobs" class="hamburger-nav">
                <div class="floatingmenu_label">Teléfono</div>
                <a class="text-white" target="_blank" href="{{ $branch->setting->phone }}">
                    <span class="mdi mdi-phone"></span>
                </a>
                <!--<img style="width: 24px; height: 24px;" src="https://www.iconfinder.com/data/icons/small-n-flat/24/pencil-128.png">-->
            </div>
        @endif
        <div id="orderDiv" class="">
            <h3 class="text-center">Lista de Platillos</h3>
            @if (session()->exists('order'))
                <table class="table">
                    <tbody>
                        @foreach (session()->get('order') as $orderDish)
                            <tr>
                                <td>
                                  <div class="card-image">
                                    <img src="{{ $orderDish["image"] }}" class="rounded" style="max-width: 100px;" alt="">
                                  </div>
                                </td>
                                <td class="p-0">
                                  <p class="font-weight-bold mb-1">{{ $orderDish["name"]}}</p>
                                  <p class="text-muted text-wrap mt-1">{{ $orderDish["special_instructions"]}}</p>
                                </td>
                                <td class="align-middle">
                                  <p class="font-weight-bold">${{ number_format($orderDish["price"],2)}}</p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="text-center">
                  <a href="{{ url('/menu/cancelar-orden') }}" class="btn btn-secondary">Cancelar orden</a>
                  <a href="{{ url('/menu/orden?branch_id='.$branch->id.'&table='.$table) }}" class="btn btn-primary">Finalizar orden</a>
                </p>
            @else
            @endif
        </div>
        <div class="modal fade" id="specialInstructionsModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header justify-content-around">
                        <h3 class="modal-title" id="exampleModalLongTitle">Intrucciones Especiales</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ url('/menu/platillo') }}" method="post">
                        @csrf
                        <input type="hidden" name="dish_id">
                        <div class="form-group">
                          <textarea name="special_instructions" id="" cols="30" rows="5" class="form-control" placeholder="Agregar instrucciones sobre la preparación de tu platillo."></textarea>
                        </div>
                        <br>
                        <div class="form-group text-center">
                          <button class="btn btn-primary btn-block">Enviar</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/slick.js') }}"></script>

    <script>
        $(window).on('load', function() {
            $("#loading").fadeOut("slow").remove();
        });

        $(document).on('click', '#order', function() {
            $('#orderDiv').toggleClass('close');
        })

        $('#hamburger').click(function() {
            $('#hamburger').toggleClass('show');
            $('.hamburger-nav').toggleClass('show');
        });
    </script>
    @yield('scripts')
</body>

</html>
