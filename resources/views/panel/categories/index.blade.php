@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row">
                        <div class="col-12 px-4 pt-3 d-flex justify-content-between">
                            <h3>Categorías</h3>
                            <a class="btn btn-primary float-right" href="{{ url('/panel/categorias/create') }}">
                                <span class="btn-inner--icon">
                                    <i class="mdi mdi-plus"></i>
                                </span>
                                <span class="btn-inner--text">Crear categoría</span>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Icono
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Categoría
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#
                                        Productos</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <th>
                                            @if ($category->image_icon)
                                                @if (Storage::disk('public')->exists($category->image_icon))
                                                    <img src="{{ Storage::disk('public')->url($category->image_icon) }}"
                                                        class="rounded-0" style="width: 60px; height:60px;">
                                                @endif
                                            @else
                                            
                                                <img src="https://ui-avatars.com/api/?name={{ $category->name }}"
                                                    class="avatar avatar-sm rounded-circle me-2">
                                            @endif
                                        </th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->parent()->exists() ? $category->parent->name:' - ' }}</td>
                                        <td>{{ $category->dishes()->count() }}</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ url('/panel/categorias/' . $category->id . '/edit') }}">
                                                Modificar
                                            </a>
                                            <a class="btn btn-danger deleteBtn"
                                            data-id="{{ $category->id }}" data-toggle="modal" data-target="#deleteModal">
                                                Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-3"> No hay categrías registradas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
<script>
     $(document).on('click', '.deleteBtn', function() {
            $('.deleteForm').attr('action', "{{ url('/panel/categorias') }}/" + $(this).data(
                'id'))
        })
</script>
@endsection