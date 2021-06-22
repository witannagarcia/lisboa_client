@extends('layouts.panel')
@section('content')
    <div class="row">
        <div class="col-12 pb-2 mb-2 border-bottom">
                            <a class="btn btn-primary float-right" href="{{ url('/panel/platillos/create') }}">
                                <span class="btn-inner--icon">
                                    <i class="mdi mdi-plus"></i>
                                </span>
                              <span class="btn-inner--text">Crear Platillo</span>
                            </a>
                            
        </div>
        
        @foreach($dishes as $dish)
         <div class="col-sm-3 mb-2">
            <div class="card cardDish">
                <div class="card-image">
                    @if($dish->exists('images'))
                <img alt="Card image cap" class="" src="{{ $dish->image->url }}" />
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
                    data-id="{{ $dish->id }}" data-bs-toggle="modal"
                    data-bs-target="#deleteModal">
                        Eliminar
                    </a>
                  </div>
                </div>
              </div>
         </div>
        @endforeach
        
        <!--<div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 px-4 pt-1">
                            <a class="btn btn-primary float-end" href="{{ url('/panel/platillos/create') }}">
                                <span class="btn-inner--icon">
                                    <i class="mdi mdi-plus"></i>
                                </span>
                              <span class="btn-inner--text"></span>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Categoría</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                        Precio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dishes as $dish)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    @if ($dish->images()->exists())
                                                        <img src="{{ $dish->image->url }}"
                                                            class="avatar avatar-sm rounded-circle me-2">
                                                    @else
                                                        <img src="https://ui-avatars.com/api/?name={{ $dish->name }}"
                                                            class="avatar avatar-sm rounded-circle me-2">
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $dish->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $dish->category->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">${{ number_format($dish->price, 2) }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary" href="{{ url('/panel/platillos/'.$dish->id.'/edit') }}">
                                                Modificar
                                            </a>
                                            <a class="btn btn-danger deleteBtn"
                                            data-id="{{ $dish->id }}" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">
                                                Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">There's no records to show.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $dishes->links('customs.pagination') }}
                    </div>
                </div>
            </div>
        </div>-->
    </div>
@endsection

@section('scripts')
<script>
    $(document).on('click', '.deleteBtn', function() {
        $('.deleteForm').attr('action', "{{ url('/panel/dishes') }}/" + $(this).data('id'))
    })

</script>
@endsection
