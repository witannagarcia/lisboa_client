@extends('layouts.panel')
@section('content')
    <div class="row">
        <div class="col-12 pb-2 mb-2 border-bottom d-flex justify-content-between">
            <h3>Platillos</h3>
                            <a class="btn btn-primary float-right" href="{{ url('/panel/platillos/create') }}">
                                <span class="btn-inner--icon">
                                    <i class="mdi mdi-plus"></i>
                                </span>
                              <span class="btn-inner--text">Crear Platillo</span>
                            </a>
                            
        </div>
        
        @forelse($dishes as $dish)
         <div class="col-sm-4 col-md-4 col-lg-3 mb-2">
            <div class="card cardDish">
                <div class="card-image">
                    @if($dish->images()->exists())
                <img alt="Card image cap" class="" src="{{ Storage::disk('public')->url($dish->image->url) }}" />
                @else
                @endif 
                </div>                                  
                <div class="card-block py-2">
                  <h4 class="card-title text-center">{{ $dish->name }}</h4>          
                  <p class="card-text text-center">${{ $dish->price}}</p>
                  <div class="w-100 d-flex justify-content-around">
                    <a class="btn btn-primary" href="{{ url('/panel/platillos/'.$dish->id.'/edit') }}">
                        Modificar
                    </a>
                    <a class="btn btn-danger deleteBtn"
                    data-id="{{ $dish->id }}" data-toggle="modal"
                    data-target="#deleteModal">
                        Eliminar
                    </a>
                  </div>
                </div>
              </div>
         </div>
         @empty
             <div class="col-12">
                <h5 class="text-center py-3"> No hay platillos registrados</h5>  
            </div>                             
         @endforelse
    </div>
@endsection

@section('scripts')
<script>
    $(document).on('click', '.deleteBtn', function() {
        $('.deleteForm').attr('action', "{{ url('/panel/dishes') }}/" + $(this).data('id'))
    })

</script>
@endsection
