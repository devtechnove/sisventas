@extends('layouts.admin')
@section('content')
 <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Gráfico de ventas</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a>
                        </li>
                       <li class="breadcrumb-item"><a href="{{ url('admin/panel/ventas/historial') }}">Listado de ventas</a>
                        </li>
                        <li class="breadcrumb-item active"> Gráfico de ventas
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div><br>
            <div id="ui-view"></div>
            <div>
               
                <div class="row" id="contenido" style="display:none">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <div class="card card-line-primary">
                                    <div class="card-header centrar">
                                        &nbsp;
                                        Estadisticas de ganancias mensuales al año - {{$current_year}}
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
                                   
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <div class="card card-line-primary">
                                    <div class="card-header centrar">
                                        
                                        Estadisticas de ventas y cancelaciones del año - {{$current_year}}
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
                                            <canvas id="canvas-5" width="378" height="188" class="chartjs-render-monitor" style="display: block; height: 151px; width: 303px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-line-primary">
                            <div class="card-header centrar">
                               
                                &nbsp;
                                Datos
                            </div>
                            <div class="card-body">
                                <h3 class="text-center">Venta total: {{$venta_total->sum}} {{$config->currency}}</h3>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
@push('scripts')
    <script>

window.onload = function(){
           var loader = document.getElementById('loader');
           var contenido = document.getElementById('contenido');

            contenido.style.display = 'block';
 
            $('#loader').remove();
       }


        /************************************************************/


        
var base = ["<?php echo $caja_1->sum?>","<?php echo $caja_2->sum?>","<?php echo $caja_3->sum?>","<?php echo $caja_4->sum?>","<?php echo $caja_5->sum?>","<?php echo $caja_6->sum?>","<?php echo $caja_7->sum?>","<?php echo $caja_8->sum?>","<?php echo $caja_9->sum?>","<?php echo $caja_10->sum?>","<?php echo $caja_11->sum?>","<?php echo $caja_12->sum?>"];

   


    var lineChart=new Chart(document.getElementById('canvas-1'), {
        type:'bar', data: {
            labels:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'], datasets:[ {
                label: 'Total de venta mensual', backgroundColor: '#8AB2FFba', borderColor: '#124AB7', pointBackgroundColor: '#8AB2FF', pointBorderColor: '#fff', data:  base
            }
            
            ]
        }
        , options: {
            responsive: true
        }
    }

    );

    /**************************************************************************/




var data_pie = ["<?php echo count($venta_can)?>","<?php echo count($venta_pro)?>"];

var pieChart=new Chart(document.getElementById('canvas-5'), {
    type:'pie', data: {
        labels:['Canceladas', 'Procesados'], datasets:[ {
            data: data_pie, backgroundColor: ['#FF6384', '#36A2EB'], hoverBackgroundColor: ['#FF6384', '#36A2EB']
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
@endsection