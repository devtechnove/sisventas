@extends('layouts.app')

@section('title', 'Customer Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
        <li class="breadcrumb-item active">Details</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nombre completo</th>
                                    <td>{{ $customer->customer_name }}</td>
                                </tr>
                                <tr>
                                    <th>Documento del cliente</th>
                                    <td>{{ $customer->customer_documento }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono</th>
                                    <td>{{ $customer->customer_phone }}</td>
                                </tr>
                                <tr>
                                    <th>Dirección</th>
                                    <td>{{ $customer->address }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Movimiento del cliente</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                        <table class="table table-sm table-condensed table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" >Fecha</th>
                                    <th class="text-center" >Hora</th>
                                    <th class="text-center" >Cant.</th>
                                    <th class="text-center">Descripción</th>
                                    <th class="text-center">Comprobante</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($venta as $detalle)

                                   @php
                                      $detalles = \DB::table('linea_productos')->where('comprobante_id',$detalle->id)->first();
                                   @endphp

                                    <tr>

                                        <td>{{ date_format( date_create($detalle->date), 'd/m/Y' ) }}</td>
                                        <td>{{ date_format( date_create($detalle->created_at), 'H:i:s' ) }}</td>
                                        <td align="center">{{ $detalles->cantidad}} UNID</td>
                                        <td title="{{$detalles->descripcion}}">
                                            @if(strlen($detalles->descripcion) > 36)
                                                {{ substr($detalles->descripcion, 0, 36) . "..."}}
                                            @else
                                                {{ $detalles->descripcion }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($detalles->comprobante_id)
                                                <a href="/sales/{{$detalles->comprobante_id}}">
                                                    {{ $detalle->status }}
                                                </a>
                                            @else
                                                -
                                            @endif
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
    </div>
@endsection

