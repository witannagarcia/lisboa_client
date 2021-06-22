@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body p-4 pb-2">
                    <form action="{{ url('/panel/categorias') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    @error('name')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    @error('name')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-icon-text">
                                    <i class="mdi mdi-arrow-left"></i>
                                    Regresar
                                </a>
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
