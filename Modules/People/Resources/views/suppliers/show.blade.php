@extends('layouts.app')

@section('title', 'Supplier Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
        <li class="breadcrumb-item active">Details</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Razón social del proveedor</th>
                                    <td>{{ $supplier->supplier_name }}</td>
                                </tr>
                                <tr>
                                    <th>Correo electrónico del proveedor</th>
                                    <td>{{ $supplier->supplier_email }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono del proveedor</th>
                                    <td>{{ $supplier->supplier_phone }}</td>
                                </tr>
                                <tr>
                                    <th>Rif del proveedor</th>
                                    <td>{{ $supplier->supplier_rif }}</td>
                                </tr>
                                <tr>
                                    <th>Dirección del proveedor</th>
                                    <td>{{ $supplier->address }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-sm-6">
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
                                    <th class="text-center">Compra</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $compras = \DB::table('purchases')->where('supplier_id',$supplier->id)->get();
                                @endphp
                                @foreach ($compras as $detalle)
                                    <td>{{ date_format( date_create($detalle->date), 'd/m/Y' ) }}</td>
                                    <td>{{ date_format( date_create($detalle->created_at), 'H:i:s' ) }}</td>
                                      <td class="text-center">
                                            @if($detalle->id)
                                                <a href="/purchases/{{$detalle->id}}">
                                                    {{ $detalle->status }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
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

