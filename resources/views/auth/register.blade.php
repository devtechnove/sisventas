<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Registro a nuestra app de punto de venta">
    <meta name="keywords" content="Nuestro producto está para ayudarte en todo lo que necesites implementar en tu negocio.">
    <meta name="author" content="DEVTECH">
    <title>DEVPOS | REGISTRO</title>
    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/images/logo/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/page-auth.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo--><a class="brand-logo" href="javascript:void(0);">
                             <a class="brand-logo" href="javascript:void(0);">
                            <img src="{{ asset('assets/images/logo/logo_negro.png') }}" alt="" height="100">
                        </a>
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-7 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="/app-assets/images/pages/register-v2.svg" alt="Register V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Register-->
                        <div class="d-flex col-lg-5 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h1 class="card-title font-weight-bold mb-1">Crea tu cuenta 🚀</h1>
                                <p class="card-text mb-2" style="font-size: 15px;">¡Haga que la administración de su dinero sea fácil y práctica!</p>
                                 <form class="auth-register-form mt-2"
                                       method="POST"
                                       action="{{ route('register') }}"
                                       autocomplete="off">
                                  @csrf
                                   <div class="row">
                                      <div class="col-sm-12">
                                         <div class="form-group">
                                          <label class="form-label" for="register-razon_social">Razón social</label>
                                         <input id="razon_social" type="text" class="form-control @error('razon_social') is-invalid @enderror" name="razon_social" value="{{ old('razon_social') }}" placeholder="Razón social de la empresa" required autocomplete="off" autofocus>

                                         @error('razon_social')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                     </div>
                                    </div>
                                     <div class="col-sm-12">
                                         <div class="form-group">
                                          <label class="form-label" for="register-documento">Documento de tu empresa</label>
                                         <input id="documento" type="text" class="form-control @error('documento') is-invalid @enderror" placeholder="Identificación de tu empresa" name="documento" value="{{ old('documento') }}" required autocomplete="off" autofocus>

                                         @error('documento')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>
                                       <div class="col-sm-6">
                                         <div class="form-group">
                                          <label class="form-label" for="register-username">Tu Nombre completo</label>
                                         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Ingresa tu nombre" value="{{ old('name') }}" required autocomplete="off" autofocus>
                                         @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>
                                   <div class="col-sm-6">
                                     <div class="form-group">
                                        <label class="form-label" for="register-email">Tu Correo electrónico</label>
                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Ingresa tu correo electrónico" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="register-password">Contraseña</label>
                                        <input id="password" type="password" placeholder="Ingresa tu contraseña" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('name') }}" required autocomplete="off" autofocus>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                     <div class="form-group">
                                        <label class="form-label" for="register-password">Confirmación de Contraseña</label>
                                        <input id="password-confirm" type="password" placeholder="Confirma tu contraseña" class="form-control" name="password_confirmation" required autocomplete="off">


                                    </div>
                                       </div>
                                   </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="register-privacy-policy" type="checkbox" tabindex="4" />
                                            <label class="custom-control-label" for="register-privacy-policy">Estoy de acuerdo con la<a href="javascript:void(0);">&nbsp;política de privacidad y términos</a></label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" tabindex="5">Registrar</button>
                                </form>
                                <p class="text-center mt-2"><span>¿Ya tienes cuenta?</span><a href=" {{ route('login') }} "><span>&nbsp;Inicia sesión</span></a></p>
                            </div>
                        </div>
                        <!-- /Register-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="/app-assets/js/scripts/pages/page-auth-register.js"></script>
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
<!-- END: Body-->

</html>
