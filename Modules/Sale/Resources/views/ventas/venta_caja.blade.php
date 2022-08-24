@extends('layouts.app')
@section('title','VENTAS')
@section('content')
@php
    $suma=0;
@endphp
<div class="row container-fluid" id="contenido" style="display:none">
    <div class="row">
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
    </div>

   <div class="row">
       <div class="col-lg-8">
           <div class="card card-line-primary">
               <div class="card-header">
                   Ventas de caja
               </div>

    <div class="row">
        <div class="col-lg-12 table-responsive-sm">
            <table class="table  table-hover table-outline mb-0 table-sm" id="" >
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Número de serie</th>
                        <th class="text-center">Total pagado</th>
                        <th class="text-center">Estado</th>

                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                @if (count($venta) == '0')
                    <tbody>
                        <tr>
                            <td colspan="7" class="text-center"><i class="fas fa-exclamation-triangle"></i> No se registraron ventas en esta caja</td>
                        </tr>
                    </tbody>
                @else

                        <tbody>
                               @foreach ($venta as $item)
                            <tr>
                                <td class="text-center">{{$item->date}}</td>
                                <td class="text-center">{{ $item->customer_name }}</td>
                                <td class="text-center">{{$item->reference}}</td>
                                <td class="text-center">{{format_currency($item->total_amount)}}</td>
                                <td class="text-center">
                                    @if ($item->status == 'Completado')
                                        <span class="badge badge-primary">Procesado</span>
                                    @else
                                        <span class="badge badge-danger">Cancelado</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-ghost-primary dropdown rounded" data-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a target="_blank" href="{{ route('sales.pos.pdf', $item->id) }}" class="dropdown-item">
                                            <i class="bi bi-file-earmark-pdf mr-2 text-success" style="line-height: 1;"></i> Factura
                                        </a>
                                        @can('access_sale_payments')
                                            <a href="{{ route('sale-payments.index', $item->id) }}" class="dropdown-item">
                                                <i class="bi bi-cash-coin mr-2 text-warning" style="line-height: 1;"></i> Ver pagos
                                            </a>
                                        @endcan
                                        @can('access_sale_payments')
                                            @if($item->due_amount > 0)
                                            <a href="{{ route('sale-payments.create', $item->id) }}" class="dropdown-item">
                                                <i class="bi bi-plus-circle-dotted mr-2 text-success" style="line-height: 1;"></i> Agregar pago
                                            </a>
                                            @endif
                                        @endcan
                                        @can('edit_sales')
                                            <a href="{{ route('sales.edit', $item->id) }}" class="dropdown-item">
                                                <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar
                                            </a>
                                        @endcan
                                        @can('show_sales')
                                            <a href="{{ route('sales.show', $item->id) }}" class="dropdown-item">
                                                <i class="bi bi-eye mr-2 text-info" style="line-height: 1;"></i> Detalle de venta
                                            </a>
                                        @endcan
                                        @can('delete_sales')
                                            <button id="delete" class="dropdown-item" onclick="
                                                event.preventDefault();
                                                if (confirm('Are you sure? It will delete the data permanently!')) {
                                                document.getElementById('destroy{{ $item->id }}').submit()
                                                }">
                                                <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Delete
                                                <form id="destroy{{ $item->id }}" class="d-none" action="{{ route('sales.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </button>
                                        @endcan
                                    </div>
                                </div>

                            </td>
                          </tr>
                    @endforeach
                </tbody>
            @endif
           </table>
    </div>
    <div class="col-lg-12">

    </div>

</div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card card-line-primary">
        <div class="card-header">
            Datos de caja
        </div>
        <table class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
            <thead class="thead-light">
                <tr>
                    <th>Código</th>
                    <td class="text-center">{{strtoupper($caja->codigo)}}</td>
                </tr>
                <tr>
                    <th>Hora de apertura</th>
                    <td class="text-center">{{strtoupper($caja->hora)}}</td>
                </tr>
                <tr>
                    <th>Hora de cierre</th>
                    <td class="text-center">
                        @if ($caja->hora_cierre == '')
                            <span>Caja abierta</span>
                        @else
                            {{$caja->hora_cierre}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Caja</th>
                    <td class="text-center">{{$caja->caja}}</td>
                </tr>
                <tr>
                    <th>Monto apertura</th>
                    <td class="text-center">{{format_currency($caja->monto)}}</td>
                </tr>
                <tr>
                    <th>Monto cierre</th>
                    <td class="text-center">
                        @if ($caja->monto_cierre == '0.00')
                            <span>Caja abierta</span>
                        @else
                            ${{$caja->monto_cierre}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Total en caja</th>
                    <td class="text-center">
                            @foreach ($venta as $vent)
                            @php
                                $suma+=$vent->total_amount;//sumanos los valores, ahora solo fata mostrar dicho valor
                            @endphp
                            @endforeach
                            {{ format_currency ($suma )  }}
                    </td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td class="text-center">
                        @if ($caja->estado == 'Cerrada')
                            <span class="badge badge-danger">
                                {{$caja->estado}}
                            </span>
                        @else
                            <span class="badge badge-success">
                                {{$caja->estado}}
                            </span>
                        @endif
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>
</div>
</div>

@push('page_scripts')
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
            var route = "{{route('data_caja.detalle',$caja->codigo)}}";

            $.ajax({
                route: route,
                data: {page: page},
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('.ventas_caja').html(data);

                }

            })
        });
    </script>
@endpush
@endsection
