<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Login | {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" crossorigin="anonymous">
    <link href="{{asset('css/mdb.lite.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/some.css')}}" rel="stylesheet">
    <link href="{{asset('css/system.css')}}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="c-app flex-row align-items-center">
 @include('sweetalert::alert', ['cdn' => "{{ url('/app-assets/') }}"])
    <!-- [ auth-signup ] start -->
<div class="auth-wrapper auth-v3">
    <div class="auth-content">
        <div class="card">
            <div class="row text-center">
                <div class="col-md-6 img-card-side">
                    <img src="{{ asset('images/auth/auth-side1.jpg') }}" alt="" class="img-fluid">
                    <div class="img-card-side-content">
                        <img src="assets/images/logo-dark.svg" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6">

                    <div class=" ">
                         <div class="{{ Route::has('register') ? 'col-md-8' : 'col-md-5' }}">
                         <!-- Brand logo-->
                        <a href="{{ url('/login') }}" class="brand-logo">
                          <img src="{{ asset('images/logo/6230af0fd25cc.png') }}" height="100" alt="">

                         </a>
                     </div><br>
                        <div class="card-body">
                        <form method="post" action="{{ url('/login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                      @if(Session::has('account_deactivated'))
                                <div class="alert alert-danger" role="alert">
                                    {{ Session::get('account_deactivated') }}
                                </div>
                                 @endif
                                </div>
                            </div>
                            <h1>Iniciar sesión</h1>
                            <p class="text-muted">Ingresa tu correo y contraseña.</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="bi bi-person"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}"
                                       placeholder="Email">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="bi bi-lock"></i>
                                    </span>
                                </div>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Password" name="password">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button class="btn btn-primary blue darken-4 px-4" type="submit">Ingresar</button>
                                </div>
                                                               
                            </div>
                        </form>
                    </div>
                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- CoreUI -->
<script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
