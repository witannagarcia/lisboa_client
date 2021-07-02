@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body pb-2">
                    <div class="row">
                        <div class="col-12 px-3 bb-2">
                            <h3 class="">
                                <a href="{{ url()->previous() }}" class="text-dark text-decoration-none">
                                    <i class="mdi mdi-arrow-left"></i>
                                </a>
                                Modificar platillo
                            </h3>
                            <hr class="w-100">
                        </div>
                    </div>
                    <form method="post" action="{{ url('/panel/platillos/' . $dish->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>Información</h5>
                                <hr>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" value="{{ $dish->name }}"
                                        class="form-control form-control-lg">
                                    @error('name')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Categoría</label>
                                    <select name="category_id" class="form-control form-control-lg">
                                        <option value="">Seleccionar opción</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $dish->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Subcategoría</label>
                                    <select name="subcategory_id" class="form-control form-control-lg">
                                        <option value="">Seleccionar opción</option>
                                        @if ($dish->category->nodes()->exists())
                                            @foreach ($dish->category->nodes as $node)
                                                <option value="{{ $node->id }}">{{ $node->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="spinner-border position-absolute invisible" style="top: 30px; left: 40%;"
                                        role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Tiempo de preparación (minutos)</label>
                                    <input type="text" name="preparation_time" value="{{ $dish->preparation_time }}"
                                        class="form-control form-control-lg number">
                                    @error('preparation_time')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="">Descripción corta</label>
                                    <input type="text" name="preview" value="{{ $dish->preview }}"
                                        class="form-control form-control-lg number">
                                    @error('preview')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Descripción</label>
                                    <textarea name="description" id="" cols="30" rows="4"
                                        class="form-control">{{ $dish->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>Precios</h5>
                                <hr>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Precio normal</label>
                                    <input type="text" name="price" value="{{ $dish->price }}" class="form-control">
                                    @error('price')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Precio media orden</label>
                                    <input type="text" name="price_half" value="{{ $dish->price_half }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>Galeria</h5>
                                <hr>
                                <div class="input-file-container">
                                    <label tabindex="0" for="my-file" class="btn btn-primary">
                                        <input type="file" name="files[]" class="input-file d-none" id="my-file"
                                            multiple />Seleccionar imagenes</label>
                                </div>
                                <div id="preview"></div>
                                <div id="gallery" class="mt-2">
                                    <h5>Imagenes actuales</h5>
                                    <hr>
                                    <div class="w-100">
                                        @foreach ($dish->images as $image)
                                            <div class="image float-left mb-3 mr-3">
                                                <a class="btn btn-icons deleteBtn btn-danger btn-rounded"
                                                    data-toggle="modal" data-target="#deleteAjaxModal"
                                                    data-id="{{ $image->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <img src="{{ Storage::disk('public')->url($image->url) }}" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-icon-text">
                                    <i class="mdi mdi-arrow-left"></i>
                                    Regresar
                                </a>
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
    <script>
        let imageToDelete = null;
        function previewImages() {

            var preview = document.querySelector('#preview');

            if (this.files) {
                [].forEach.call(this.files, readAndPreview);
            }

            function readAndPreview(file) {

                // Make sure `file.name` matches our extensions criteria
                if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                    return alert(file.name + " is not an image");
                } // else...

                var reader = new FileReader();

                reader.addEventListener("load", function() {
                    var image = new Image();
                    image.height = 150;
                    image.title = file.name;
                    image.src = this.result;
                    preview.appendChild(image);
                });

                reader.readAsDataURL(file);

            }

        }

        document.querySelector('#my-file').addEventListener("change", previewImages);

        $(document).on('change', 'select[name="category_id"]', function() {
            let catId = $('select[name="category_id"] option:selected').val();

            if (catId == "") {
                $('select[name="subcategory_id"]').find('option').not(':first').remove();
                return false;
            }

            $('select[name="subcategory_id"]').closest('div').find('.spinner-border').toggleClass('invisible');

            $.ajax({
                url: "{{ url('/panel/categorias') }}/" + catId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="subcategory_id"]').closest('div').find('.spinner-border')
                        .toggleClass('invisible');
                    $('select[name="subcategory_id"]').find('option').not(':first').remove();
                    data.data.map((item) => {
                        $('select[name="subcategory_id"]').append(
                            `<option value="${item.id}">${item.name}</option>`);
                    })
                },
                error: function(err) {
                    console.log(err)
                }
            })
        })

        $(document).on('click', '.deleteBtn', function() {
            imageToDelete = $(this).closest('.image');
            let url = `panel/platillos/{{ $dish->id}}/imagenes/${$(this).data('id')}`
            urlDelete = `{{ url('${url}') }}`;
        })

        $(document).on('click', '.acceptAjaxDelete', function(){
            $('.acceptAjaxDelete span').toggleClass('d-none')

            

            $.ajax({
                url: urlDelete,
                type: "POST",
                dataType: "json",
                data:{
                    _token: "{{ csrf_token() }}",
                    _method: "DELETE",
                },
                success:function(data){
                    console.log(imageToDelete)
                    $('.acceptAjaxDelete span').toggleClass('d-none')
                    imageToDelete.remove();
                    $('#deleteAjaxModal').modal('hide')
                    $(".modal-backdrop").remove();
                    tata.success('Éxito', data.msg)
                },
                error:function(err){
                    console.log(err)
                }

            })
        })
    </script>
@endsection
