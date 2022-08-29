@extends('layouts/app')

@section('title', 'PLANES')

@section('breadcrumb')
<h2 class="content-header-title float-left mb-0">PLANES</h2>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/planes') }}">Listado general</a></li>
        <li class="breadcrumb-item active">Registro de nuevo plan</li>
    </ol>
@endsection
@section('styles')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset('/app-assets/vendors/css/animate/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/app-assets/css/config-page.css') }}">

@endsection
@section('content')
<div class="row mt-2 animate__animated_fadeIn animate__fadeIn animate__delay-1s">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                @if ($errors->any())
                <div class="demo-spacing-0 mb-2">
                    <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                        <div class="alert-body">
                            <i data-feather="info" class="mr-50 align-middle"></i>
                            <span>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="card">
            {!! Form::open(['route'=>'planes.store','autocomplete'=>'off']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('name', 'Nombre del plan') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del plan']) !!}
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                        </span>
                    @enderror
                    <div class="col-sm-6 mt-1">
                        {!! Form::label('tipo_plan', 'Tipo de plan') !!}
                        <select name="tipo_plan" id="tipo_plan" class="form-control">
                            <option value="">Selecciona</option>
                            <option value="Indeterminado">Indeterminado</option>
                            <option value="Mensual">Mensual</option>
                            <option value="Anual">Anual</option>
                        </select>
                    </div>
                    @error('tipo_plan')
                        <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                        </span>
                    @enderror
                    <div class="col-sm-6 mt-1">
                        {!! Form::label('plan', 'Costo del plan') !!}
                        {!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'Costo $']) !!}
                    </div>
                    @error('amount')
                        <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-relief-primary">Guardar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

