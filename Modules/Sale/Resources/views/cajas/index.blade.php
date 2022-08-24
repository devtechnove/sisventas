@extends('layouts.app')
@section('title','Caja')

@section('content')
@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/panel/contabilidad') }}">Cajas</a></li>
        <li class="breadcrumb-item active">Listado general</li>
    </ol>
@endsection

<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div id="ui-view"></div>
            <div>
                <div class="row" id="contenido" style="display:none">
                    @if(Session::has('success'))
                        <div class="col-lg-12">
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="background: #69e781 !important">
                                {{Session::get('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif 
                    
                    @if(Session::has('danger'))
                        <div class="col-lg-12">
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="color: #ffffff;background-color: #ed2b2b;">
                                {{Session::get('danger')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif 

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row" >
                                   
                                    <div class="col-lg-3">
                                        <a class="btn btn-dark btn-lg btn-block centrar" href="{{route('abrir_caja.contabilidad')}}">
                                            <img src="{{asset('images/caja/dinero.png')}}" style="width: 2.1rem !important;">
                                            &nbsp;<span style="margin-left: 5px;">Abrir caja</span></a>
                                    </div>
                                    <div class="col-lg-3">
                                        <a class="btn btn-danger btn-lg btn-block centrar" href="{{route('sales.create')}}">
                                            <img src="{{asset('images/caja/tienda.png')}}" style="width: 2.1rem !important;">
                                            &nbsp;<span style="margin-left: 5px;">Facturar</span></a>
                                    </div>

                                    <div class="col-lg-3">
                                        <a class="btn btn-primary btn-lg btn-block centrar" href="{{route('semanal.contabilidad')}}">
                                            <img src="{{asset('images/caja/grafica.png')}}" style="width: 2.1rem !important;">
                                            &nbsp;<span style="margin-left: 5px;">Grafica</span></a>
                                       
                                    </div>
                                    <div class="col-lg-3">
                                        <a class="btn btn-success btn-lg btn-block centrar" href="{{route('historial.contabilidad')}}">
                                            <img src="{{asset('images/caja/libro.png')}}" style="width: 2.1rem !important;">
                                            &nbsp;<span style="margin-left: 5px;">Historial</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        
                        <div class="card">
                            <div class="card-header">
                                PANEL DE CONTABILIDAD
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {!! Form::open(array('url'=>'panel/contabilidad','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                                <div class="input-group">
                                                    <input class="form-control" type="date" name="buscar" value="{{$buscar}}" placeholder="Nombres o DNI del usuario" >
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" >
                                                            <i class="zmdi zmdi-search"></i>
                                                        </button>
                                                        
                                                    </span>
                                                </div>
                                                {{Form::close()}}
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-12 table-responsive-sm">
                                        <table class="table table-hover table-outline mb-0 table-sm">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-center">Identificador</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Hora de apertura</th>
                                                    <th class="text-center">Hora de cierre</th>
                                                    <th class="text-center">Monto de apertura</th>
                                                    <th class="text-center">Monto de cierre</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Caja</th>
                                                    <th class="text-center">Opciones</th>
                                                </tr>
                                            </thead>
                                            @if (count($cajas)>0)
                                                @foreach ($cajas as $item)
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">{{strtoupper($item->codigo)}}</td>
                                                            <td class="text-center">{{$item->fecha}}</td>
                                                            <td class="text-center">{{$item->hora}}</td>
                                                            <td class="text-center">
                                                                @if (!$item->hora_cierre)
                                                                <span class="badge badge-dark">Aun no cerrada</span>
                                                                @else
                                                                    {{$item->hora_cierre}}
                                                                @endif        
                                                            </td>
                                                            <td class="text-center">{{format_currency($item->monto)}}</td>
                                                            <td class="text-center">
                                                                @if ($item->monto_cierre == '0.00' || !$item->monto_cierre)
                                                                    <span class="badge badge-dark">Aun no cerrada</span>
                                                                @else
                                                                {{format_currency($item->monto_cierre)}}
                                                                @endif
                                                            </td>
                                                            <td class="text-center">{{$item->estado}}</td>
                                                            <td class="text-center">{{$item->caja}}</td>
                                                            <td class="text-center">
                                                                <div class="btn-group">
                                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fas fa-cog"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" x-placement="bottom-start" style="will-change: transform; margin: 0px;">
                                                                        <a class="dropdown-item" href="{{route('data_caja.detalle',$item->codigo)}}">
                                                                            &nbsp;Ventas</a>
                                                                        @if ( auth()->user()->id && $item->estado == 'Abierta')
                                                                            <a class="dropdown-item" href="{{route('cerrar_caja.contabilidad',$item->id)}}">

                                                                            </svg> &nbsp;Cerrar caja</a>
                                                                        @else
                                                                        <button class="dropdown-item" disabled title="Solo">

                                                                            </svg> &nbsp;Cerrar caja</button>
                                                                        @endif
                                                                        
                                                                    
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                @endforeach
                                            @else
                                                <tbody>
                                                    <tr>
                                                        <td colspan="8" class="text-center">No se aperturó alguna caja este día.</td>
                                                    </tr>
                                                </tbody>
                                            @endif
                                        </table>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <span>Solos nos usuarios que abrieron caja la pueden cerrar.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
 
</div>
@push('page_scripts')
    <script>
 
        window.onload = function(){
           var loader = document.getElementById('loader');
           var contenido = document.getElementById('contenido');

            contenido.style.display = 'block';
 
            $('#loader').remove();
       }
    </script>
@endpush
@endsection
