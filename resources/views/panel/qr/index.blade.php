@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-xl-7 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-signin" method="post"
                                action="{{ url('/panel/qr/' . $QrSetting->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Tipo</label>
                                    <select name="type" id="" class="form-control form-control-lg">
                                        <option value="">Seleccionar opción</option>
                                        <option value="square" {{ $QrSetting->type == 'square' ? 'selected' : '' }}>Cuadro
                                        </option>
                                        <option value="dot" {{ $QrSetting->type == 'dot' ? 'selected' : '' }}>Puntos</option>
                                        <option value="round" {{ $QrSetting->type == 'round' ? 'selected' : '' }}>Redondo
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="eye_styñe">Estilo</label>
                                    <select name="eye_style" id="" class="form-control form-control-lg">
                                        <option value="">Seleccionar opción</option>
                                        <option value="square" {{ $QrSetting->eye_style == 'square' ? 'selected' : '' }}>
                                            Cuadrado</option>
                                        <option value="circle" {{ $QrSetting->eye_style == 'circle' ? 'selected' : '' }}>
                                            Circular</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="float-start">Colores</label>
                                    <br>
                                    <div id="emailHelp" class="form-text mb-2">
                                        <span class="float-start">¿Quieres un estilo degradado?</span>
                                        <div class="form-check form-switch float-start mx-3">
                                            <input class="form-check-input" name="gradiant" value="1" type="checkbox"
                                                id="flexSwitchCheckDefault" {{ $QrSetting->gradiant ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="colors d-flex justify-content-evenly">
                                        <input type="color" name="color"
                                            class="form-control form-control-color float-start mr-3" id="exampleColorInput"
                                            value="{{ $QrSetting->color }}" title="Choose your color">
                                        <input type="color" name="color2"
                                            class="form-control form-control-color float-start ml-4 {{ $QrSetting->gradiant ? '' : 'd-none' }}"
                                            id="exampleColorInput" value="{{ $QrSetting->color2 }}"
                                            title="Choose your color">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="float-start">Logo</label>
                                    <br>
                                    <div id="emailHelp" class="form-text mb-2">
                                        <span class="float-start">¿Insertar tu logo en el código?</span>
                                        <div class="form-check form-switch float-start mx-3">
                                            <input class="form-check-input" name="logo" value="1" type="checkbox"
                                                id="flexSwitchCheckDefault" {{ $QrSetting->logo ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="visible-print text-center">
                                <h4 class="text-center mb-4">Vista previa</h4>
                                <?php
                                $hex = $QrSetting->color;
                                [$r, $g, $b] = sscanf($hex, '#%02x%02x%02x');
                                $hex = $QrSetting->color2;
                                [$r2, $g2, $b2] = sscanf($hex, '#%02x%02x%02x');
                                ?>
                                @if ($QrSetting->gradiant == 1)
                                    @if ($QrSetting->logo)
                                        {!! QrCode::size(200)->mergeString('https://images.vexels.com/media/users/3/136294/isolated/lists/4172fc9833fe18b5f8669b148713a189-icono-de-enlace.png', 0.3, true)->gradient($r, $g, $b, $r2, $g2, $b2, 'radial')->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu/' . Auth::user()->restaurant_id), public_path().'/images/adjfkf.svg') !!}
                                    @else
                                        {!! QrCode::size(200)->gradient($r, $g, $b, $r2, $g2, $b2, 'radial')->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu/' . Auth::user()->restaurant_id)) !!}
                                    @endif
                                @else
                                    @if ($QrSetting->logo)
                                        {!! QrCode::size(200)->merge('https://images.vexels.com/media/users/3/136294/isolated/lists/4172fc9833fe18b5f8669b148713a189-icono-de-enlace.png', 0.3, true)->color($r, $g, $b)->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu/' . Auth::user()->restaurant_id)) !!}
                                    @else
                                        {!! QrCode::size(200)->color($r, $g, $b)->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu/' . Auth::user()->restaurant_id)) !!}
                                    @endif

                                @endif
                                <p class="mt-4">Escanea el código para ver tu menu.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="#" target="_blank" class="btn btn-info w-100">Descargar código</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('change', 'input[name="gradiant"]', function() {
            if ($(this).is(':checked'))
                $('input[name="color2"]').removeClass('d-none')
            else
                $('input[name="color2"]').addClass('d-none')
        })

    </script>
@endsection
