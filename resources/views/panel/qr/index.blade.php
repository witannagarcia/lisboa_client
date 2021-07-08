@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-7">
                            <div id="accordion" role="tablist">
                                <div class="card mb-2">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Código QR
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <form class="form-signin" method="post"
                                                action="{{ url('/panel/qr/' . $QrSetting->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="">Tipo</label>
                                                    <select name="type" id="" class="form-control form-control-lg">
                                                        <option value="">Seleccionar opción</option>
                                                        <option value="square"
                                                            {{ $QrSetting->type == 'square' ? 'selected' : '' }}>
                                                            Cuadro
                                                        </option>
                                                        <option value="dot"
                                                            {{ $QrSetting->type == 'dot' ? 'selected' : '' }}>
                                                            Puntos</option>
                                                        <option value="round"
                                                            {{ $QrSetting->type == 'round' ? 'selected' : '' }}>
                                                            Redondo
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="eye_styñe">Estilo</label>
                                                    <select name="eye_style" id="" class="form-control form-control-lg">
                                                        <option value="">Seleccionar opción</option>
                                                        <option value="square"
                                                            {{ $QrSetting->eye_style == 'square' ? 'selected' : '' }}>
                                                            Cuadrado</option>
                                                        <option value="circle"
                                                            {{ $QrSetting->eye_style == 'circle' ? 'selected' : '' }}>
                                                            Circular</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="float-start">Colores</label>
                                                    <br>
                                                    <div id="emailHelp" class="form-text mb-2">
                                                        <span class="float-start">¿Quieres un estilo
                                                            degradado?</span>
                                                        <div class="form-check form-switch float-start mx-3">
                                                            <input class="form-check-input" name="gradiant" value="1"
                                                                type="checkbox" id="flexSwitchCheckDefault"
                                                                {{ $QrSetting->gradiant ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="colors d-flex justify-content-evenly">
                                                        <input type="color" name="color"
                                                            class="form-control form-control-color float-start mr-3"
                                                            id="exampleColorInput" value="{{ $QrSetting->color }}"
                                                            title="Choose your color">
                                                        <input type="color" name="color2"
                                                            class="form-control form-control-color float-start ml-4 {{ $QrSetting->gradiant ? '' : 'd-none' }}"
                                                            id="exampleColorInput" value="{{ $QrSetting->color2 }}"
                                                            title="Choose your color">
                                                    </div>
                                                </div>
                                                <!--<div class="form-group">
                                                    <label for="" class="float-start">Logo</label>
                                                    <br>
                                                    <div id="emailHelp" class="form-text mb-2">
                                                        <span class="float-start">¿Insertar tu logo en el
                                                            código?</span>
                                                        <div class="form-check form-switch float-start mx-3">
                                                            <input class="form-check-input" name="logo" value="1"
                                                                type="checkbox" id="flexSwitchCheckDefault"
                                                                {{ $QrSetting->logo ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                <br>
                                                <div class="form-group text-center">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-2">
                                    <div class="card-header" role="tab" id="headingTwo">
                                        <h5 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Orden de categorías
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <p class="text-muted text-center">Arrastra los elementos de la lista en el orden
                                                requerido.</p>
                                            <ul class="list-group drag-sort-enable">
                                                @foreach ($categories as $category)
                                                    <li data-id="{{ $category->id }}" class="list-group-item">
                                                        {{ $category->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-2">
                                    <div class="card-header" role="tab" id="headingThree">
                                        <h5 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                Estilos y colores
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            ...............................................................................#3
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5 d-flex flex-column justify-content-center">
                            <div class="visible-print text-center menu-toggle d-none">
                                <h4 class="text-center mb-4">Vista previa</h4>
                                <?php
                                $hex = $QrSetting->color;
                                [$r, $g, $b] = sscanf($hex, '#%02x%02x%02x');
                                $hex = $QrSetting->color2;
                                [$r2, $g2, $b2] = sscanf($hex, '#%02x%02x%02x');
                                ?>
                                @if ($QrSetting->gradiant == 1)
                                    @if ($QrSetting->logo == 1)
                                        {!! QrCode::size(200)->merge('https://images.vexels.com/media/users/3/136294/isolated/lists/4172fc9833fe18b5f8669b148713a189-icono-de-enlace.png', 0.3, true)->gradient($r, $g, $b, $r2, $g2, $b2, 'radial')->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu?branch_id='.session()->get('branch')->id), public_path() . '/images/adjfkf.svg') !!}
                                    @else
                                        {!! QrCode::size(200)->gradient($r, $g, $b, $r2, $g2, $b2, 'radial')->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu?branch_id='.session()->get('branch')->id)) !!}
                                    @endif
                                @else
                                    @if ($QrSetting->logo == 1)
                                        {!! QrCode::size(200)->merge('https://images.vexels.com/media/users/3/136294/isolated/lists/4172fc9833fe18b5f8669b148713a189-icono-de-enlace.png', 0.3, true)->color($r, $g, $b)->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu?branch_id='.session()->get('branch')->id)) !!}
                                    @else
                                        {!! QrCode::size(200)->color($r, $g, $b)->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu?branch_id='.session()->get('branch')->id)) !!}
                                    @endif

                                @endif
                                <p class="mt-4">Escanea el código para ver tu menu.</p>
                            </div>
                            <div class="smartphone">
                                <div class="content">
                                    <iframe id="preview" class="w-100 h-100"
                                        src="{{ url('/menu?branch_id=' . session()->get('branch')->id) }}">Your browser
                                        isn't
                                        compatible</iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                        role="tab" aria-controls="nav-home" aria-selected="true">Código Qr</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                        role="tab" aria-controls="nav-profile" aria-selected="false">Orden de categorías</a>
                                    <a class="nav-item nav-link" id="nav-style-tab" data-toggle="tab" href="#nav-style" role="tab"
                                        aria-controls="nav-style" aria-selected="false">Estilos</a>
                                </div>
                            </nav>
                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
                                                                        <option value="square"
                                                                            {{ $QrSetting->type == 'square' ? 'selected' : '' }}>
                                                                            Cuadro
                                                                        </option>
                                                                        <option value="dot"
                                                                            {{ $QrSetting->type == 'dot' ? 'selected' : '' }}>
                                                                            Puntos</option>
                                                                        <option value="round"
                                                                            {{ $QrSetting->type == 'round' ? 'selected' : '' }}>
                                                                            Redondo
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="eye_styñe">Estilo</label>
                                                                    <select name="eye_style" id=""
                                                                        class="form-control form-control-lg">
                                                                        <option value="">Seleccionar opción</option>
                                                                        <option value="square"
                                                                            {{ $QrSetting->eye_style == 'square' ? 'selected' : '' }}>
                                                                            Cuadrado</option>
                                                                        <option value="circle"
                                                                            {{ $QrSetting->eye_style == 'circle' ? 'selected' : '' }}>
                                                                            Circular</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="float-start">Colores</label>
                                                                    <br>
                                                                    <div id="emailHelp" class="form-text mb-2">
                                                                        <span class="float-start">¿Quieres un estilo
                                                                            degradado?</span>
                                                                        <div class="form-check form-switch float-start mx-3">
                                                                            <input class="form-check-input" name="gradiant"
                                                                                value="1" type="checkbox"
                                                                                id="flexSwitchCheckDefault"
                                                                                {{ $QrSetting->gradiant ? 'checked' : '' }}>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="colors d-flex justify-content-evenly">
                                                                        <input type="color" name="color"
                                                                            class="form-control form-control-color float-start mr-3"
                                                                            id="exampleColorInput" value="{{ $QrSetting->color }}"
                                                                            title="Choose your color">
                                                                        <input type="color" name="color2"
                                                                            class="form-control form-control-color float-start ml-4 {{ $QrSetting->gradiant ? '' : 'd-none' }}"
                                                                            id="exampleColorInput"
                                                                            value="{{ $QrSetting->color2 }}"
                                                                            title="Choose your color">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="float-start">Logo</label>
                                                                    <br>
                                                                    <div id="emailHelp" class="form-text mb-2">
                                                                        <span class="float-start">¿Insertar tu logo en el
                                                                            código?</span>
                                                                        <div class="form-check form-switch float-start mx-3">
                                                                            <input class="form-check-input" name="logo" value="1"
                                                                                type="checkbox" id="flexSwitchCheckDefault"
                                                                                {{ $QrSetting->logo ? 'checked' : '' }}>
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
                                                                        {!! QrCode::size(200)->mergeString('https://images.vexels.com/media/users/3/136294/isolated/lists/4172fc9833fe18b5f8669b148713a189-icono-de-enlace.png', 0.3, true)->gradient($r, $g, $b, $r2, $g2, $b2, 'radial')->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu'), public_path() . '/images/adjfkf.svg') !!}
                                                            @else
                                                                        {!! QrCode::size(200)->gradient($r, $g, $b, $r2, $g2, $b2, 'radial')->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu')) !!}
                                                                    @endif
                                                        @else
                                                                    @if ($QrSetting->logo)
                                                                        {!! QrCode::size(200)->merge('https://images.vexels.com/media/users/3/136294/isolated/lists/4172fc9833fe18b5f8669b148713a189-icono-de-enlace.png', 0.3, true)->color($r, $g, $b)->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu')) !!}
                                                            @else
                                                                        {!! QrCode::size(200)->color($r, $g, $b)->style($QrSetting->type ? $QrSetting->type : 'square')->eye($QrSetting->eye_style ? $QrSetting->eye_style : 'square')->generate(url('/menu')) !!}
                                                                    @endif

                                                                @endif
                                                                <p class="mt-4">Escanea el código para ver tu menu.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <a href="{{ url('panel/qr/1') }}"
                                                                class="btn btn-info w-100">Descargar código</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <ul class="list-group drag-sort-enable">
                                        @foreach ($categories as $category)
                                            <li data-id="{{ $category->id }}" class="list-group-item">
                                                {{ $category->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="nav-style" role="tabpanel" aria-labelledby="nav-style-tab">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function enableDragSort(listClass) {
            const sortableLists = document.getElementsByClassName(listClass);
            Array.prototype.map.call(sortableLists, (list) => {
                enableDragList(list)
            });
        }

        function enableDragList(list) {
            Array.prototype.map.call(list.children, (item) => {
                enableDragItem(item)
            });
        }

        function enableDragItem(item) {
            item.setAttribute('draggable', true)
            item.ondrag = handleDrag;
            item.ondragend = handleDrop;
        }

        function handleDrag(item) {
            const selectedItem = item.target,
                list = selectedItem.parentNode,
                x = event.clientX,
                y = event.clientY;

            selectedItem.classList.add('drag-sort-active');
            let swapItem = document.elementFromPoint(x, y) === null ? selectedItem : document.elementFromPoint(x, y);

            if (list === swapItem.parentNode) {
                swapItem = swapItem !== selectedItem.nextSibling ? swapItem : swapItem.nextSibling;
                list.insertBefore(selectedItem, swapItem);
            }
        }

        function handleDrop(item) {
            item.target.classList.remove('drag-sort-active');
            let categories = [];
            $('.list-group li').each(function(item) {
                categories.push({
                    categoryId: $('.list-group li').eq(item).data('id'),
                    order: item + 1
                })
            })
            $.ajax({
                url: "{{ url('/panel/qr/' . $QrSetting->id) }}",
                type: "post",
                dataType: "json",
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "PUT",
                    categories: categories
                },
                success: function(data) {
                    tata.success('Éxito', data.msg)
                    document.getElementById('preview').contentDocument.location.reload(true);
                },
                error: function(err) {
                    console.error(err)
                }
            })
        }

        (() => {
            enableDragSort('drag-sort-enable')
        })();

        $(document).on('change', 'input[name="gradiant"]', function() {
            if ($(this).is(':checked'))
                $('input[name="color2"]').removeClass('d-none')
            else
                $('input[name="color2"]').addClass('d-none')
        })

        $(document).on('click', '#accordion a', function() {
            if ($(this).closest('.card').index() == 0) {
                $('.menu-toggle').removeClass('d-none')
                $('.smartphone').addClass('d-none')
            } else {
                $('.menu-toggle').addClass('d-none')
                $('.smartphone').removeClass('d-none')
            }
        })
    </script>
@endsection
