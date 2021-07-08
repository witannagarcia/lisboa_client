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
                                Modificar usuario
                            </h3>
                            <hr class="w-100">
                        </div>
                    </div>
                    <form action="{{ url('/panel/usuarios/' . $user->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="">Rol</label>
                                    <select name="role" id="" class="form-control">
                                        <option value="">Selecciona opción</option>
                                        <option value="sucursal" {{$user->role == "sucursal" ? 'selected':''}}>Administrador de sucursal</option>
                                        <option value="cocinero" {{$user->role == "cocinero" ? 'selected':''}}>Cocina</option>
                                        <option value="mesero" {{$user->role == "mesero" ? 'selected':''}}>Mesero</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="">Sucursal</label>
                                    <select name="branch_id" id="" class="form-control">
                                        <option value="">Selecciona opción</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}"
                                                {{ $branch->id == $user->branch_id ? 'selected' : '' }}>
                                                {{ $branch->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="">Contraseña</label>
                                    <input type="text" name="password" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <a class="btn btn-primary btn-block mt-4 generatePassword">Generar contraseña</a>
                                </div>
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
        function generateP() {
            var pass = '';
            var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' +
                'abcdefghijklmnopqrstuvwxyz0123456789@#$';

            for (i = 1; i <= 10; i++) {
                var char = Math.floor(Math.random() *
                    str.length + 1);

                pass += str.charAt(char)
            }

            return pass;
        }

        $(document).on('click', '.generatePassword', function(){
            $('input[name="password"]').val(generateP())
        })
    </script>
@endsection
