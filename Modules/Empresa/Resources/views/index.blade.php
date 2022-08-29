@extends('layouts/app')

@section('title', 'EMPRESA')

@section('breadcrumb')
<h2 class="content-header-title float-left mb-0">Empresa</h2>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Datos principales de la empresa.</li>
    </ol>
@endsection
@section('styles')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/animate/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('app-assets/css/config-page.css') }}">

@endsection
@section('content')
 @include('sweetalert::alert', ['url' => "/vendors/extensions/sweetalert2.all.min.js"])
<div class="row mt-2 animate__animated_fadeIn animate__fadeIn animate__delay-1s">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Datos de la empresa
                @can('Registrar Empresa')
                 <a href="{{ route('empresa.create') }}" class="btn btn-relief-primary float-right"><i class="mdi mdi-plus fa-1x"></i> Nueva empresa</a>
                 @endcan
            </div>
            <div class="card-body">

                 <div class="table-responsive">
                     <table  class="table table-hover  " id="tablaModulos">
                    <thead>
                      <tr class="text-center">

                      <th>Logo</th>
                      <th>Razón social</th>
                      <th>Documento</th>
                      <th>Teléfono</th>
                      <th>Estado de la empresa</th>
                      <th>Plan de la empresa</th>
                      <th>Opciones</th>
                      </tr>
                    </thead>
                        <tbody>
                          @foreach ($empresa as $element)

                            <tr class="text-center">

                             <td><img src="{{ asset('assets/images/logo/'.$element->logo_empresa) }}" alt="Logo de la empresa" height="30"></td>
                             <td>{{ $element->razon_social }}</td>
                             <td>{{ $element->documento }}</td>
                             <td>{{ $element->telefono }}</td>
                             <td>
                                @if ($element->is_active == 1)
                                  <span class="badge bg-success" >ACTIVO</span>
                                  @else
                                  <span class="badge bg-danger" >INACTIVO</span>
                                 @endif
                            </td>
                            <td>
                               @if (\Auth::user()->hasRole('Administrador'))
                                  <span class="badge bg-info" >{{ $element->plan->name }}</span>
                                 @else
                                  <span class="badge bg-info" >{{ $element->plan->name }}</span>
                               @endif
                            </td>
                            <td>
                                @can('Editar Empresa')
                                <a href="{{ route('empresa.edit',$element->id) }}" class="btn btn-relief-primary round btn-sm"><i class="far fa-edit"></i> Editar</a>
                                @endcan
                            </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>
</div>

@endsection
