@extends('layouts.auth')

@section('content')
    <div class="card card-signin flex-row my-5">
        <div class="card-img-left d-none d-md-flex">
            <img src="https://www.rewardsnetwork.com/wp-content/uploads/2017/09/Management2.jpg" alt="">
            <!-- Background image for card set in CSS! -->
        </div>
        <div class="card-body d-flex justify-content-around flex-column">
            <img src="{{ asset('images/logo.jpeg') }}" class="logo" alt="">
            <h5 class="card-title text-center">Iniciar Sesión</h5>
            @if ($message = Session::get('success'))
            <div class="alert alert-success rounded-pill alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <form class="form-signin" method="post" action="{{ url('/login') }}">
                @csrf
                <div class="form-label-group">
                    <input type="email" id="inputEmail" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Usuario">
                    <label for="inputEmail">Usuario</label>
                    @error('email')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-label-group">
                    <input type="password" id="inputPassword" name="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña">
                    <label for="inputPassword">Contraseña</label>
                    @error('password')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="remember_me" type="checkbox" value="">
                    <label class="form-check-label" for="invalidCheck2">
                        Recordarme
                    </label>
                </div>

                <p class="text-center">
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Iniciar Sesión</button>
                </p>
                <p class="text-center">
                    <!--<span class="text-muted">Not registred yet?</span>
                    <a class="" href="{{ url('/register') }}">Sign Up</a>-->
                </p>
                <p class="text-center">
                    <a class="" href="{{ url('/forgot-password') }}">¿Olvido su contraseña?</a>
                </p>
                <hr class="my-4">
                <!--<button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i
                        class="fab fa-google mr-2"></i> Sign up with Google</button>
                <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i
                        class="fab fa-facebook-f mr-2"></i> Sign up with Facebook</button>-->
            </form>
        </div>
    </div>
@endsection
