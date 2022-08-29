@extends('layouts/app')

@section('title', 'PLANES')

@section('breadcrumb')
<h2 class="content-header-title float-left mb-0">PLANES</h2>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Datos principales de los planes disponibles.</li>
    </ol>
@endsection
@section('styles')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset('/app-assets/vendors/css/animate/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/app-assets/css/config-page.css') }}">

@endsection
@section('content')
 @include('sweetalert::alert', ['url' => "/vendors/extensions/sweetalert2.all.min.js"])
 <div class="row mt-2 animate__animated_fadeIn animate__fadeIn animate__delay-1s">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Datos de los planes
                  <a href="{{ route('planes.create') }}" class="btn btn-relief-primary float-right"><i class="mdi mdi-plus fa-1x"></i> Nuevo plan</a>
            </div>

            <div class="card-body">
                 <div class="table-responsive">
                     <table  class="table table-hover  " id="tablaModulos">
                    <thead>
                      <tr class="text-center">

                      <th>Nombre completo</th>
                      <th>Tipo de plan</th>
                      <th>Costo</th>
                      <th>Opciones</th>
                      </tr>
                    </thead>
                        <tbody>
                          @foreach ($planes as $element)

                            <tr class="text-center">

                             <td>{{ $element->name }}</td>
                             <td>{{ $element->tipo_plan }}</td>
                             <td>
                                 {{ number_format($element->amount,2) }}
                             </td>
                            <td>
                                <a href="{{ route('planes.edit',$element->id) }}" class="btn btn-relief-primary round btn-sm"><i class="far fa-edit"></i> Editar</a>
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
