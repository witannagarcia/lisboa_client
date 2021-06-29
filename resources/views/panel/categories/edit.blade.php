@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body p-3 pb-2">
                    <div class="row">
                        <div class="col-12 px-2 bb-2">
                            <h3 class="">
                                <a href="{{ url()->previous() }}" class="text-dark text-decoration-none">
                                    <i class="mdi mdi-arrow-left"></i>
                                </a>
                                Modificar categoría
                            </h3>
                            <hr class="w-100">
                        </div>
                    </div>
                    <form action="{{ url('/panel/categorias/' . $category->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" value="{{ $category->name }}"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <h5>Imagen banner</h5>
								<hr>
								@if($category->image_banner)
                                      <img src="{{ Storage::disk('public')->url($category->image_banner) }}"
                                                            style="width:240px;" class="d-block mx-auto my-3 me-2">
                                      @else
                                      <img src="https://ui-avatars.com/api/?name={{ $category->name }}"
                                                            style="width:240px;" class="d-block mx-auto my-3 me-2">
                                      @endif
								<label for="imageBanner" class="btn btn-primary btn-block">
									<input type="file" class="d-none" id="imageBanner" name="image_banner">
									Seleccionar imagen
								</label>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <h5>Imagen icono</h5>
								<hr>
								@if($category->image_icon)
                                      <img src="{{ Storage::disk('public')->url($category->image_icon) }}"
                                                            style="width:50px; height: 50px;" class="image-thumbnail icon d-block mx-auto my-3 me-2">
                                      @else
                                      <img src="https://ui-avatars.com/api/?name={{ $category->name }}"
                                                            style="width:50px; height: 50px;" class="image-thumbnail icon d-block mx-auto my-3 me-2">
                                      @endif
								<label for="imageIcon" class="btn btn-primary btn-block">
									<input type="file" class="d-none" id="imageIcon" name="image_icon">
									Seleccionar imagen
								</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="far fa-save"></i>
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
