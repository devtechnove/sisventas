@extends('layouts.app')
@section('content')
<div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Ventas mensuales</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url('panel/contabilidad') }}">Listado de cajas</a>
                        <li class="breadcrumb-item active"> Ventas globales por mes
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div><br>
            <div id="ui-view"></div>
            <div class="container-fluid">
               
                <div class="row" id="contenido" style="display:none">
                    <div class="row">
                        <div class="col-lg-8">
                            
                            <div class="card card-line-primary  ">
                                <div class="card-header centrar">
                                    <i class="fas fa-calendar-alt"> </i> &nbsp;
                                    Estadisticas de caja mensual al año - {{$current_year}}
                                    <div class="card-header-actions"></div>
                                </div>
                                <div class="card-body">
                                    <div class="c-chart-wrapper">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class=""></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class=""></div>
                                            </div>
                                        </div>
                                        <canvas id="canvas-1" width="387" height="192" class="chartjs-render-monitor" style="display: block; height: 154px; width: 310px;"></canvas>
                                    </div>
                                </div>
                                <div class="card-footer">
                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-line-primary  ">
                                <div class="card-header centrar">
                                    <i class="fas fa-list"> </i>
                                    &nbsp;
                                    Datos
                                </div>
                                <div class="card-body">
                                    <table class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
                                        <thead class="thead-dark">
                                            <th class="text-center">Dato</th>
                                            <th class="text-center">Valor</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Monto base total mes anterior</td>
                                                <td class="text-center">${{$caja_mes_anterior->sum}}</td>
                                            </tr>
                                            <tr>
                                                <td>Monto de cierre total mes anterior</td>
                                                <td class="text-center">${{$caja_mes_anterior->sum}}</td>
                                            </tr>
                                            <tr>
                                                <td>Monto base actual</td>
                                                <td class="centrar">
                                                    @if ($caja_mes_actual->sum <= $caja_mes_anterior->sum)
                                                    <img src="{{asset('images/ventas/down.png')}}" style="width:15px">
                                                    @else
                                                    <img src="{{asset('images/ventas/up.png')}}" style="width:15px">
                                                    @endif
                                                    &nbsp;
                                                    ${{$caja_mes_actual->sum}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Monto cierre actual</td>
                                                <td class="centrar">
                                                    @if ($caja_mes_actual->sum <= $caja_mes_anterior->sum)
                                                    <img src="{{asset('images/ventas/down.png')}}" style="width:15px">
                                                    @else
                                                    <img src="{{asset('images/ventas/up.png')}}" style="width:15px">
                                                    @endif
                                                    &nbsp;
                                                    ${{$caja_mes_actual->sum}}
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10">
                                      {!! Form::open(array('url'=>'/panel/ganancias/mensual','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                        <div class="row">
                                            <div class="col-lg-10">
                                                Filtrar año
                                               <input type="text" name="year" class="form-control">
                                                
                                            </div><br>
                                            <div class="col-lg-2">
                                                <button class="btn btn-primary mt-1">Filtrar</button>
                                            </div>
                                        </div>
                                    {{Form::close()}}<br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
@section('third_party_scripts')
    <script src="/app-assets/vendors/js/charts/chart.min.js"></script>
@endsection
@push('page_scripts')
    <script>

window.onload = function(){
           var loader = document.getElementById('loader');
           var contenido = document.getElementById('contenido');

            contenido.style.display = 'block';
 
            $('#loader').remove();
       }
        
    var base = ["<?php echo $caja_1->sum?>","<?php echo $caja_2->sum?>","<?php echo $caja_3->sum?>","<?php echo $caja_4->sum?>","<?php echo $caja_5->sum?>","<?php echo $caja_6->sum?>","<?php echo $caja_7->sum?>","<?php echo $caja_8->sum?>","<?php echo $caja_9->sum?>","<?php echo $caja_10->sum?>","<?php echo $caja_11->sum?>","<?php echo $caja_12->sum?>"];

    var cierre = ["<?php echo $caja_1->sum?>","<?php echo $caja_2->sum?>","<?php echo $caja_3->sum?>","<?php echo $caja_4->sum?>","<?php echo $caja_5->sum?>","<?php echo $caja_6->sum?>","<?php echo $caja_7->sum?>","<?php echo $caja_8->sum?>","<?php echo $caja_9->sum?>","<?php echo $caja_10->sum?>","<?php echo $caja_11->sum?>","<?php echo $caja_12->sum?>"];


    var lineChart=new Chart(document.getElementById('canvas-1'), {
        type:'line', data: {
            labels:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'], datasets:[ {
                label: 'Monto base', backgroundColor: '#8AB2FFba', borderColor: '#124AB7', pointBackgroundColor: '#8AB2FF', pointBorderColor: '#fff', data:  base
            }
            , {
                label: 'Monto de cierre', backgroundColor: '#E0FFE6ba', borderColor: '#1CC63F', pointBackgroundColor: '#E0FFE6', pointBorderColor: '#fff', data: cierre
            }
            ]
        }
        , options: {
            responsive: true
        }
    }

    );

    </script>
@endpush
