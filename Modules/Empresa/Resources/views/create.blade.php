@extends('layouts/app')

@section('title', 'EMPRESA')

@section('breadcrumb')
  <h2 class="content-header-title float-left mb-0">Empresa</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/empresa') }}">Listado general</a>
            </li>
            <li class="breadcrumb-item active">Registro de empresa.
            </li>
        </ol>
    </div>
@endsection
@section('styles')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/animate/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('app-assets/css/config-page.css') }}">

@endsection
@section('content')
<div class="row mt-2 animate__animated_fadeIn animate__fadeIn animate__delay-1s">
    <div class="col-sm-12">
        <div class="card">

             {!!Form::open(['method'=>'POST','route'=>['empresa.store'], 'files'=>'true'])!!}
            <div class="card-body ">
               <div class="row">
                      <div class="col-sm-4 mt-1">
                            <div class="form-group">
                                <label for="register-email" class="form-label">Razón social o Nombre de la empresa</label>
                                <input type="text" class="form-control @error('razon_social') is-invalid @enderror" id="register-razon_social" name="razon_social" placeholder="Nombre de la empresa" aria-describedby="register-razon_social" tabindex="2" value="{{ old('razon_social') }}" />
                                @error('razon_social')
                                  <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                  </span>
                                @enderror
                             </div>
                         </div>
                           <div class="col-sm-4 mt-1">
                            <div class="form-group">
                                <label for="register-email" class="form-label">RIF / RUC de la empresa</label>
                                <input type="text" class="form-control @error('tx_rif') is-invalid @enderror" id="register-tx_rif" name="tx_rif" placeholder="Documento de la empresa" aria-describedby="register-tx_rif" tabindex="2" value="{{ old('tx_rif') }}" />
                                @error('tx_rif')
                                  <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                  </span>
                                @enderror
                             </div>
                         </div>
                         <div class="col-sm-4 mt-1">
                            <div class="form-group">
                                <label for="register-email" class="form-label">Teléfono de contacto de la empresa</label>
                                <input type="text" class="form-control @error('nu_contacto') is-invalid @enderror" id="register-nu_contacto" name="nu_contacto" placeholder="Contacto de la empresa" aria-describedby="register-nu_contacto" tabindex="2" value="{{ old('nu_contacto') }}" />
                                @error('nu_contacto')
                                  <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                  </span>
                                @enderror
                             </div>
                         </div>
                         <div class="col-sm-4 mt-1">
                            <div class="form-group">
                                <label for="register-email" class="form-label">Correo de la empresa</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="register-email" name="email" placeholder="Correo de la empresa" aria-describedby="register-email" tabindex="2" value="{{ old('email') }}" />
                                @error('email')
                                  <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                  </span>
                                @enderror
                             </div>
                         </div>
                           <div class="col-sm-4 mt-1">
                            <div class="form-group">
                                <label for="register-email" class="form-label">Dirección de la empresa</label>
                                <textarea type="text" class="form-control @error('tx_direccion') is-invalid @enderror" id="register-tx_direccion" name="tx_direccion" placeholder="Contacto de la empresa" aria-describedby="register-tx_direccion" tabindex="2" value="{{ old('tx_direccion') }}" cols="30" rows="1">
                                </textarea>
                                @error('tx_direccion')
                                  <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                  </span>
                                @enderror
                             </div>
                         </div>
                          @php
                        $estados  =  [1 => 'Activo' ,0 => 'Inactivo'];
                    @endphp
                    <div class="col-sm-4 mt-1">
                        <label for="nu_contacto">Estado de la empresa</label>
                      {!! Form::select('is_active', $estados, null, [
                         'class' => 'form-control','placeholder' =>'Seleccione']) !!}
                      </div>
                       <div class="col-sm-12 mt-2">
                           <div class="form-group">
                            <label for="product_unit">Logo de la empresa <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="Ingresa la Logo de la empresa."></i> <span class="text-danger">*</span></label>
                            <div class="file-upload-wrapper">
                                <input type="file" id="input-file-now-custom-1" name="logo_empresa" class="file-upload" data-default-file="{{asset('images/fallback_product_image.png')}}" />
                            </div>
                         </div>
                    </div>

                  </div>
                </div>
                <div class="card-footer">
                  <button class="btn btn-primary">Guardar</button>
               </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
     $('.file-upload').file_upload();
</script>
@endsection
