@extends('layouts.admin')
@section('content')


      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Detalle de caja</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a>
                        </li>
                       <li class="breadcrumb-item"><a href="{{ url('admin/panel/ventas/historial') }}">Listado de ventas</a>
                        </li>
                        <li class="breadcrumb-item active"> Detalle de la caja
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div><br> 
    <div id="ui-view"></div>   
    <div class="row" style="display:none" id="contenido">
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
        
        <div class="card card-line-primary">
            <div class="card-header">
                 Hisitorial de cajas
            </div>
            <div class="card-body">
                
                   
                               
                    <div class="col-lg-12 cajas">
                        <table class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
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
                                        <td class="text-center">{{$config->prefijo_moneda}}{{$item->monto}} {{$config->currency}}</td>
                                        <td class="text-center">
                                            @if ($item->monto_cierre == '0.00' || !$item->monto_cierre)
                                                <span class="badge badge-dark">Aun no cerrada</span>
                                            @else
                                            {{$config->prefijo_moneda}}{{$item->monto_cierre}} {{$config->currency}}
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
                                                    <a class="dropdown-item" href="{{route('admin.data_caja.detalle',$item->codigo)}}">
                                                         &nbsp;Ventas</a>
                                                    @if ($item->user_id == auth()->user()->id && $item->estado == 'Abierta')
                                                        <a class="dropdown-item" href="{{route('admin.cerrar_caja.contabilidad',$item->id)}}">
                                                       
                                                        &nbsp;Cerrar caja</a>
                                                    @else
                                                    <button class="dropdown-item" disabled title="Solo">
                                                        
                                                         &nbsp;Cerrar caja</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                           
                        </table>
                        <div class="row mt-4">
                            {{$cajas->render()}}
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

@endsection
@push('scripts')
    <script>
        window.onload = function(){
           var loader = document.getElementById('loader');
           var contenido = document.getElementById('contenido');

            contenido.style.display = 'block';
 
            $('#loader').remove();
       }
        /*PAGINACION*/
        $(document).on("click", ".pagination a", function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var route = "{{route('admin.historial.contabilidad')}}";
            
            $.ajax({
                route: route,
                data: {page: page},
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('.cajas').html(data);
                    
                }

            })
        });
    </script>
@endpush