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
            <li class="breadcrumb-item active">Edición de datos
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

             {!!Form::model($empresas,['method'=>'PUT','route'=>['empresa.update',$empresas->id], 'files'=>'true'])!!}
            <div class="card-body ">
               <div class="row">
                    <div class="col-sm-4 mt-1">
                     <label for="razon_social">Razón social o nombre de la empresa</label>
                     {!!Form::text('razon_social', null, array('class' => 'form-control')) !!}
                     </div>
                       <div class="col-sm-4 mt-1">
                            <label for="tx_rif">RIF / RUC de la empresa</label>
                           {!!Form::text('documento', null, array('class' => 'form-control')) !!}
                     </div>
                      <div class="col-sm-4 mt-1">
                            <label for="nu_contacto">Número de contacto de la empresa</label>
                           {!!Form::text('telefono', null, array('class' => 'form-control')) !!}
                     </div>
                      <div class="col-sm-4 mt-1">
                            <label for="email">Correo de la empresa</label>
                           {!!Form::text('email', null, array('class' => 'form-control')) !!}
                     </div>
                     <div class="col-sm-4 mt-1 ">
                            <label for="nu_contacto">Dirección de la empresa</label>
                          {!! Form::textarea('direccion', null, array('class' => 'form-control', 'cols'=>'30','rows'=>'1')) !!}
                     </div>
                       @php
                        $estados  =  [1 => 'Activo' ,0 => 'Inactivo'];
                    @endphp
                    <div class="col-sm-4 mt-1 mt-1">
                        <label for="nu_contacto">Estado de la empresa</label>
                      {!! Form::select('is_active', $estados, null, [
                         'class' => 'form-control','placeholder' =>'Seleccione']) !!}
                      </div>
                       <div class="col-sm-12 mt-2">
                           <div class="form-group">
                            <label for="product_unit">Logo de la empresa <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="Ingresa la Logo de la empresa."></i> <span class="text-danger">*</span></label>
                            <div class="file-upload-wrapper">
                                <input type="file" id="input-file-now-custom-1" name="logo_empresa" class="file-upload" data-default-file="{{asset('assets/images/logo/'.$empresas->logo_empresa)}}" />
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
