@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="row">
                        <div class="col-12 px-4 pt-3 d-flex justify-content-between">
                            <h3>Sucursales</h3>
                            <a class="btn btn-primary float-right" href="{{ url('/panel/sucursales/create') }}">
                                <span class="btn-inner--icon">
                                    <i class="mdi mdi-plus"></i>
                                </span>
                                <span class="btn-inner--text">Crear sucursal</span>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dirección
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($branches as $branch)
                                    <tr>
                                        <td>{{ $branch->name }}</td>
                                        <td>{{ $branch->address }}</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ url('/panel/sucursales/' . $branch->id . '/edit') }}">
                                                Modificar
                                            </a>
                                            <a class="btn btn-danger deleteBtn"
                                            data-id="{{ $branch->id }}" data-toggle="modal" data-target="#deleteModal">
                                                Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-3"> No hay sucursales registradas</td>
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
            $('.deleteForm').attr('action', "{{ url('/panel/sucursales') }}/" + $(this).data(
                'id'))
        })
</script>
@endsection