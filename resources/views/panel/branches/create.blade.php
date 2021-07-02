@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body p-3 pb-2">
                    <div class="row">
                        <div class="col-12 px-4 pt-3 bb-2">
                            <h3 class="">
                                <a href="{{ url()->previous() }}" class="text-dark text-decoration-none">
                                    <i class="mdi mdi-arrow-left"></i>
                                </a>
                                Nueva sucursal
                            </h3>
                            <hr class="w-100">
                        </div>
                    </div>
                    <form action="{{ url('/panel/sucursales') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-sm-12 col-md-8">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre</label>
                                            <input type="text" name="name"
                                                class="form-control form-control-lg @error('name') is-invalid @enderror">
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Calle</label>
                                            <input type="text" name="address"
                                                class="form-control form-control-lg @error('address') is-invalid @enderror">
                                            @error('address')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Número Exterior</label>
                                            <input type="text" name="ext_num"
                                                class="form-control form-control-lg @error('ext_num') is-invalid @enderror">
                                            @error('ext_num')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Colonia</label>
                                            <input type="text" name="suburb"
                                                class="form-control form-control-lg @error('suburb') is-invalid @enderror">
                                            @error('suburb')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Ciudad</label>
                                            <input type="text" name="city"
                                                class="form-control form-control-lg @error('city') is-invalid @enderror">
                                            @error('city')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Estado</label>
                                            <input type="text" name="state"
                                                class="form-control form-control-lg @error('state') is-invalid @enderror">
                                            @error('state')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 h-auto">
                                <h4 class="text-center">Ubicación en mapa</h4>
                                <p class="text-muted text-center">Arrastra el icono para colocar la ubicación exacta.</p>
                                <div id="map" class="w-100 h-100"></div>
                                <input type="hidden" name="coordinates" value="">
                                @error('coordinates')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-icon-text btn-primary">
                                    <i class="mdi mdi-content-save"></i>
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=&v=weekly">
    </script>
    <script>
        //const imageBanner = document.getElementById("imageBanner");
        //const imageIcon = document.getElementById("imageIcon");

        let map;
        let marker = null;
        const geocoder = new google.maps.Geocoder();

        $(document).on('keyup', 'input[type="text"]', delay(function() {
            var a = '';
            $('input[type="text"]').not('input[name="name"]').each(function() {
                a += `${this.value}, `;
            });
            if (a.length > 30) {
                geocodeAddress(a, map);
            }
        }, 1000))

        function geocodeAddress(address, resultsMap) {
            geocoder
                .geocode({
                    address: address
                })
                .then(({
                    results
                }) => {
                    results[0].address_components.map((item) => {
                        if (item.types.includes("sublocality"))
                            $('input[name="suburb"]').val(item.long_name);

                        if (item.types.includes("locality"))
                            $('input[name="city"]').val(item.long_name);

                        if (item.types.includes("administrative_area_level_1"))
                            $('input[name="state"]').val(item.long_name);

                    });

                    resultsMap.setCenter(results[0].geometry.location);
                    resultsMap.setZoom(17)
                    $('input[name="coordinates"]').val(
                        `${results[0].geometry.location.lat()},${results[0].geometry.location.lng()}`)
                    if (marker == null) {
                        marker = new google.maps.Marker({
                            map: resultsMap,
                            draggable: true,
                            position: results[0].geometry.location,
                        });

                        google.maps.event.addListener(marker, 'dragend', function() {
                            $('input[name="coordinates"]').val(`${this.position.lat()},${this.position.lng()}`)
                        });
                    } else {
                        marker.setCenter(results[0].geometry.location)
                    }
                })
                .catch((e) => {});
        }

        function delay(callback, ms) {
            var timer = 0;
            return function() {
                var context = this,
                    args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function() {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 19.24787752940656,
                    lng: -103.70771996270322
                },
                mapTypeControl: false,
                streetViewControl: false,
                zoom: 10,
            });
        }

        $(document).ready(function() {
            initMap();
        })

        /*function getImgData() {
        const files = imageBanner.files[0];
        if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function () {
          $('.banner').attr('src', this.result)
        });    
        }
        }

        function getImgDataIcon() {
        const files = imageIcon.files[0];
        if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function () {
          $('.icon').attr('src', this.result)
        });    
        }
        }

        imageBanner.addEventListener("change", function () {
        getImgData()})
        imageIcon.addEventListener("change", function () {
        getImgDataIcon()})*/
    </script>
@endsection
