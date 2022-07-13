@extends('layouts.admin')
@section('title','Ganancias')
@section('content')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Ganancias por ventas</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a>
                        </li>
                       <li class="breadcrumb-item"><a href="{{ url('admin/panel/ventas/historial') }}">Listado de ventas</a>
                        </li>
                        <li class="breadcrumb-item active"> Ganancias por ventas
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div><br>

<div class="container-fluid">
	<div class="row" id="contenido" >
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

	 @php

	 	 $tasa = App\Models\Tasa::where('fecha_emision',$from)->first();
	 @endphp

		<div class="col-lg-12">
		    <div class="card card-line-primary">
		        <div class="card-body">
		            <div class="row">
		                
		                <div class="col-lg-3">
		                    <a class="btn btn-dark btn-lg btn-block centrar" href="{{route('admin.abrir_caja.contabilidad')}}">
		                        <img src="{{asset('images/caja/dinero.png')}}" style="width: 2.1rem !important;">
		                        &nbsp;<span style="margin-left: 5px;">Abrir caja</span></a>
		                </div>
		                <div class="col-lg-3">
		                    <a class="btn btn-danger btn-lg btn-block centrar" href="{{route('admin.registro.venta')}}">
		                        <img src="{{asset('images/caja/tienda.png')}}" style="width: 2.1rem !important;">
		                        &nbsp;<span style="margin-left: 5px;">Facturar</span></a>
		                </div>
		                <div class="col-lg-3">
		                    <a class="btn btn-primary btn-lg btn-block centrar" href="{{route('admin.grafico.venta')}}">
		                        <img src="{{asset('images/caja/grafica.png')}}" style="width: 2.1rem !important;">
		                        &nbsp;<span style="margin-left: 5px;">Rendimiento</span></a>
		                   
		                </div>
		                <div class="col-lg-3">
		                    <a class="btn btn-success btn-lg btn-block centrar" href="{{route('admin.ventas.vencimiento')}}">
		                        <img src="{{asset('images/caja/libro.png')}}" style="width: 2.1rem !important;">
		                        &nbsp;<span style="margin-left: 5px;">Facturas por cobrar</span></a>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
         <div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="text-center">
						Buscar ventas por rangos de fechas
					</h3>
				</div>
				<div class="card-body">

                    {!! Form::open(array('url'=>'/admin/panel/venta/ganancias','method'=>'POST','autocomplete'=>'off','role'=>'search'))!!}
                     <div class="row">
                        <div class="col-md-12 col-12 mb-1">
                            <label for=""><b>Nota importante: Para conocer lo que has vendido, tienes 2 campos con rango de fechas, donde debes seleccionar desde que fecha y hasta que fecha deseas consultar las ventas</b></label>
                            <div class="input-group">

                                <input type="date" class="form-control" placeholder="Button on right" aria-describedby="button-addon2" name="from" />
                                 <input type="date" class="form-control" placeholder="Button on right" aria-describedby="button-addon2" name="to" />
                                <button type="submit" class="btn btn-outline-primary" id="button-addon2" type="button">Go</button>
                            </div>
                        </div>

                    </div>
                     	
                   


                    {{Form::close()}}



				</div>
			</div>
			<div class="row">
	         	<div class="col-sm-6 mt-4">
	         		<div class="card">
	         			<div class="card-header">
	         				<h3>Punto de venta</h3>
	         			</div>
	         			<div class="card-body">
	         				<h1>{{ $punto }} BS. <i class="fas fa-coins float-right fa-2x mb-2 purple-text"></i></h1> 
	         			</div>
	         		</div>
	         	</div>
	         	<div class="col-sm-6 mt-4">
	         		<div class="card">
	         			<div class="card-header">
	         				<h3>Bolívares en efectivo</h3>
	         			</div>
	         			<div class="card-body">
	         				<h1>{{ $efectivo }} BS. <i class="fas fa-handshake float-right fa-2x mb-2 red-text"></i></h1> 
	         			</div>
	         		</div>
	         	</div>
	         	<div class="col-sm-6">
	         		<div class="card">
	         			<div class="card-header">
	         				<h3>Bolívares en transferencia</h3>
	         			</div>
	         			<div class="card-body">
	         				<h1>{{ $transf }} BS. <i class="fas fa-building float-right fa-2x mb-2 orange-text"></i></h1> 
	         			</div>
	         		</div>
	         	</div>
	         	<div class="col-sm-6">
	         		<div class="card">
	         			<div class="card-header">
	         				<h3>Bolívares en pago móvil</h3>
	         			</div>
	         			<div class="card-body">
	         				<h1>{{ $pagom }} BS. <i class="fas fa-phone-alt float-right fa-2x mb-2 green-text"></i></h1> 
	         			</div>
	         		</div>
	         	</div>
	         	<div class="col-sm-6">
	         		<div class="card">
	         			<div class="card-header">
	         				<h3>Pagos realizados en Dólares (Reflejados en Bolívares)</h3>
	         			</div>
	         			<div class="card-body">
	         				<h1>{{ number_format($dolar ,2)}} Bs. <i class="fas fa-dollar-sign float-right fa-2x mb-2 blue-text"></i></h1> 
	         			</div>
	         		</div>
	         	</div>
	         	<div class="col-sm-6">
	         		<div class="card">
	         			<div class="card-header">
	         				<h3>Su equivalente en Dólares según la tasa del día de la venta</h3>
	         			</div>
	         			<div class="card-body">
	         				<h1>{{ number_format($dolar / $tasa->amount ,2)}} USD. <i class="fas fa-dollar-sign float-right fa-2x mb-2 blue-text"></i></h1> 
	         			</div>
	         		</div>
	         	</div>
	         </div>	
		</div>
	</div>
</div>

@endsection
