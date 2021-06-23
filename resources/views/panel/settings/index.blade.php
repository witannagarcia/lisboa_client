@extends('layouts.panel')

@section('content')
<div class="row">
    <div class="col-12 pb-2 mb-2">
        <div class="card">
            <div class="card-body">
                <nav>
					<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Restaurante</a>
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Horarios</a>
					</div>
				</nav>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						<form class="row" action="{{ url('/panel/configuracion/'.$settings->id) }}" method="post" enctype="multipart/form-data">
							@csrf
							@method('put')
							<div class="col-sm-6">
								<div class="form-group">
									<label for="">Nombre</label>
									<input type="text" name="name" value="{{ $settings->name }}" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Télefono</label>
									<input type="text" name="phone" value="{{ $settings->phone }}" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Sitio Web</label>
									<input type="text" name="website" value="{{ $settings->website }}" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Dirección</label>
									<input type="text" name="address" value="{{ $settings->address }}" class="form-control">
								</div>
							</div>
							<div class="col-sm-6">
								<h5>Logo</h5>
								<hr>
								@if($settings->logo)
                                      <img src="{{ asset($settings->logo) }}"
                                                            style="width:240px; height: 240px;" class="image-thumbnail d-block mx-auto my-3 me-2">
                                      @else
                                      <img src="https://ui-avatars.com/api/?name={{ $settings->name }}"
                                                            style="width:240px; height: 240px;" class="image-thumbnail d-block mx-auto my-3 me-2">
                                      @endif
								<label for="logoRestaurant" class="btn btn-primary btn-block">
									<input type="file"  name="logo_setting" class="d-none" id="logoRestaurant">
									Seleccionar imagen
								</label>
							</div>
							<div class="col-sm-12 text-center">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						
					</div>
				</div>
            </div>
        </div>                                 
    </div>
</div>
@endsection

@section('scripts')
<script>
	const chooseFile = document.getElementById("logoRestaurant");

	function getImgData() {
  const files = chooseFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      $('.image-thumbnail').attr('src', this.result)
    });    
  }
}

	chooseFile.addEventListener("change", function () {
  getImgData();
});
</script>
@endsection

