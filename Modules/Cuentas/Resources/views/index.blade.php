@extends('layouts.app')

@section('title', 'CUENTAS')
@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">CUENTAS</li>
    </ol>
@endsection

@section('content')
    <div class="c-body">
        @include('sweetalert::alert')
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
                            <div class="card-header">
                                PANEL DE CUENTAS
                                <a href="{{ route('cuentas.create') }}" class="btn btn-relief-primary">
                                    <i class="mdi mdi-plus"></i>
                                    Nueva cuenta
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 table-responsive-sm">
                                        <table class="table table-hover table-sm table-outline mb-0" id="tableExport">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-center">Banco</th>
                                                    <th class="text-center">Fecha de apertura</th>
                                                    <th class="text-center">Nro de cuenta</th>
                                                    <th class="text-center">Moneda de cuenta</th>
                                                    <th class="text-center">Monto de apertura</th>
                                                    <th class="text-center">Monto de actual</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Opciones</th>
                                                </tr>
                                            </thead>
                                            @if (count($cuentas)>0)
                                                @foreach ($cuentas as $item)
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">{{strtoupper($item->nb_nombre)}}</td>
                                                            <td class="text-center">{{$item->fe_apertura}}</td>
                                                            <td class="text-center">{{$item->nu_cuenta}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $moneda = \DB::table('currencies')->where('id',$item->moneda_id)->first();
                                                                @endphp
                                                                {{ $moneda->currency_name }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ format_currency($item->saldo_apertura) }}
                                                            </td>
                                                            <td class="text-center">
                                                                 {{ format_currency($item->saldo_actual) }}
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($item->is_active == 1)
                                                                   <span class="badge bg-success">ACTIVO</span>
                                                                   @else
                                                                   <span class="badge bg-danger">INACTIVO</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <a data-toggle="modal" data-target="#exampleModalCenter{{ $item->id }}" class="btn btn-sm  btn-relief-primary">
                                                                        <i class="mdi mdi-pencil text-white"></i>
                                                                    </a>

                                                                     <a href="cuentas/{{ $item->id }}" class="btn btn-sm  btn-relief-danger">
                                                                        <i class="mdi mdi-delete text-white"></i>
                                                                    </a>

                                                                </div>
                                                            </td>

                                                        </tr>
                                                    </tbody>
                                                    @include('layouts.modal.cuentas.editcuenta')
                                                     @include('layouts.modal.cuentas.showcuenta')
                                                @endforeach
                                            @else
                                                <tbody>
                                                    <tr>
                                                        <td colspan="8" class="text-center">No se ha registrado ninguna cuenta.</td>
                                                    </tr>
                                                </tbody>
                                            @endif
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <span><b>La cuenta estará interactuando con las ventas, los gastos y devoluciones dentro del sistema.</b></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


</div>
@endsection

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
