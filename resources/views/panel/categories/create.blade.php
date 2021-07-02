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
                                    Nueva categoría
                                </h3>
                                <hr class="w-100">
                            </div>
                        </div>
                    <form action="{{ url('/panel/categorias') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="row">
                                    <div class="col-12">
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
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Categoría Padre</label>
                                            <select name="category_id" id="" class="form-control">
                                                <option value="">Seleccionar opción</option>
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <h5>Imagen banner</h5>
                                <hr>
                                <img src="https://ui-avatars.com/api/?name="
                                    style="width:240px; min-height: 240px;"
                                    class="image-thumbnail banner d-block mx-auto my-3 me-2">
                                <label for="imageBanner" class="btn btn-primary btn-block">
                                    <input type="file" class="d-none" id="imageBanner" name="image_banner">
                                    Seleccionar imagen
                                </label>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <h5>Imagen icono</h5>
                                <hr>
                                <img src="https://ui-avatars.com/api/?name="
                                    style="width:50px; height: 50px;"
                                    class="image-thumbnail icon d-block mx-auto my-3 me-2">
                                <label for="imageIcon" class="btn btn-primary btn-block">
                                    <input type="file" class="d-none" id="imageIcon" name="image_icon">
                                    Seleccionar imagen
                                </label>
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
<script>
    const imageBanner = document.getElementById("imageBanner");
    const imageIcon = document.getElementById("imageIcon");

function getImgData() {
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
getImgDataIcon()})
</script>
@endsection

