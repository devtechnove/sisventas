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
     <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-auth.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->
    <link href="{{asset('css/mdb.lite.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/some.css')}}" rel="stylesheet">
    <link href="{{asset('css/system.css')}}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="{{asset('css/bootstrap-icons.css')}}" rel="stylesheet">
</head>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">

<div class="auth-wrapper auth-v3">

        @include('sweetalert::alert')
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
                        <a href="{{ url('/login') }}" class="brand-logo text-center ml-5">
                          <img src="{{ asset('images/logo/6230af0fd25cc.png') }}" height="100" alt="">
                         </a>
                             </div>
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
                                    <div class="input-group mb-1">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- CoreUI -->
<!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/page-auth-login.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

</body>
</html>
