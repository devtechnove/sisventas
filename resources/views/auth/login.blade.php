@extends('layouts.auth')
@section('title','LOGIN')
@section('content')

 @include('sweetalert::alert')

<div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
    <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
        <h3 class="card-title fw-bold mb-1 mt-1">¡Bienvenidos a DEVPOS! 👋</h3>
        <p class="card-text mb-2 small">la mejor opción para llevar el control de tus ventas.</p>
        <form method="POST" class="auth-login-form mt-2" action="{{ route('login') }}">
            @csrf
            <div class="mb-1">
                <label class="form-label" for="login-email">Correo electrónico</label>
                 <input id="email"
                        type="email"
                        class="form-control
                        @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="example@mail.com"
                        autocomplete="off"
                        autofocus>

                     @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                @enderror
             </div>
            <div class="mb-1">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Contraseña</label>
                    @if (Route::has('password.request'))
                      <a href="{{ route('password.request') }}">
                        <small>
                            ¿Has olvidado tu contraseña?
                     </small>
                    </a>
                    @endif
                </div>
                <div class="input-group input-group-merge form-password-toggle">
                    <input class="form-control form-control-merge"
                           id="password"
                           type="password"
                           name="password"
                           placeholder="············"
                           aria-describedby="password"
                           tabindex="2"/>
                           <span class="input-group-text cursor-pointer">
                              <i data-feather="eye"></i>
                           </span>
                   </div>
               </div>
              <div class="mb-1">
                <div class="form-check">
                    <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" />
                    <label class="form-check-label" for="remember-me"> Recuérdame</label>
                </div>
            </div>
            <button class="btn btn-primary w-100" tabindex="4">Ingresar</button>
        </form>
        <p class="text-center mt-2"><span>¿Nuevo en nuestra plataforma?</span>
            @if (Route::has('register'))
              <a href="{{ route('register') }}">
                <small>
                    Crea tu cuenta
             </small>
            </a>
         @endif
        </p>

    </div>
</div>
@endsection
