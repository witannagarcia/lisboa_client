@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-12 pb-2 mb-2 border-bottom d-flex justify-content-between">
            <h3>Usuarios</h3>
            <a class="btn btn-primary float-right" href="{{ url('/panel/usuarios/create') }}">
                <span class="btn-inner--icon">
                    <i class="mdi mdi-plus"></i>
                </span>
                <span class="btn-inner--text">Crear usuario</span>
            </a>

        </div>

        <div class="table-responsive p-0">
            <table class="table align-items-center justify-content-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rol
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sucursal
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->branch_id == null ? 'No asignada' : $user->branch->name }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ url('/panel/usuarios/' . $user->id . '/edit') }}">
                                    Modificar
                                </a>
                                <a class="btn btn-danger deleteBtn" data-id="{{ $user->id }}" data-toggle="modal"
                                    data-target="#deleteModal">
                                    Eliminar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3"> No hay usuarios registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).on('click', '.deleteBtn', function() {
        $('.deleteForm').attr('action', "{{ url('/panel/usuarios') }}/" + $(this).data('id'))
    })
</script>
@endsection
