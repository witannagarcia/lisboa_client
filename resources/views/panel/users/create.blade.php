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
                                Crear usuario
                            </h3>
                            <hr class="w-100">
                        </div>
                    </div>
                    <form action="{{ url('/panel/usuarios') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" value=""
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" value="" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="">Rol</label>
                                    <select name="role" id="" class="form-control @error('role') is-invalid @enderror">
                                        <option value="">Selecciona opción</option>
                                        <option value="sucursal">Administrador de sucursal</option>
                                        <option value="cocinero">Cocina</option>
                                        <option value="mesero">Mesero</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="">Sucursal</label>
                                    <select name="branch_id" id="" class="form-control @error('branch_id') is-invalid @enderror">
                                        <option value="">Selecciona opción</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}">
                                                {{ $branch->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('branch_id')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="">Contraseña</label>
                                    <input type="text" name="password" value="" class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
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

        $(document).on('click', '.generatePassword', function() {
            $('input[name="password"]').val(generateP())
        })
    </script>
@endsection
