@extends('layouts.app')

@section('title', 'Product Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
        <li class="breadcrumb-item active">Detalle de producto</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-3">
        <div class="row">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                         <legend>Detalle de producto</legend>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <tr>
                                    <th>Código de producto</th>
                                    <td>{{ $product->product_code }}</td>
                                </tr>
                                <tr>
                                    <th>Simbología de códiugo de barra</th>
                                    <td>{{ $product->product_barcode_symbology }}</td>
                                </tr>
                                <tr>
                                    <th>Nombre de producto</th>
                                    <td>{{ $product->product_name }}</td>
                                </tr>
                                <tr>
                                    <th>Categoría</th>
                                    <td>{{ $product->category->category_name }}</td>
                                </tr>
                                <tr>
                                    <th>Precio de compra</th>
                                    <td>{{ format_currency($product->product_cost) }}</td>
                                </tr>
                                <tr>
                                    <th>Precio de venta</th>
                                    <td>{{ format_currency($product->product_price) }}</td>
                                </tr>
                                <tr>
                                    <th>Cantidad disponible</th>
                                    <td>{{ $product->product_quantity . ' ' . $product->product_unit }}</td>
                                </tr>
                                <tr>
                                    <th>Cantidad de notificación</th>
                                    <td>{{ $product->product_stock_alert }}</td>
                                </tr>
                                <tr>
                                    <th>Impuesto (%)</th>
                                    <td>{{ $product->product_order_tax ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Clase de impuesto</th>
                                    <td>
                                        @if($product->product_tax_type == 1)
                                            Exclusivo
                                        @elseif($product->product_tax_type == 2)
                                            Inclusivo
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Imágen del producto</th>
                                    <td>
                                        <img src="{{ asset('images/products/'.$product->product_image) }}" alt="Product Image" class="img-fluid img-thumbnail mb-2">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nota del producto</th>
                                    <td>{{ $product->product_note ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
           <div class="col-md-8">
               <div class="card">
                   <div class="card-body">
                        <legend>Últimos movimientos</legend>
                <div class="col-md-12">
                    <div class="table-responsive ">
                        <table class="table table-condensed table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="70px">Fecha</th>
                                    <th class="text-center" width="70px">Hora</th>
                                    <th class="text-center" width="40px">Cant.</th>
                                    <th class="text-center">Descripción</th>
                                    <th class="text-center">Comprobante</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movimientos->sortByDesc('fecha') as $m)
                                    <tr>
                                        <td>{{ date_format( date_create($m->fecha), 'd/m/Y' ) }}</td>
                                        <td>{{ date_format( date_create($m->fecha), 'H:i:s' ) }}</td>
                                        <td align="center">{{ $m->cantidad}}</td>
                                        <td title="{{$m->descripcion}}">
                                            @if(strlen($m->descripcion) > 36)
                                                {{ substr($m->descripcion, 0, 36) . "..."}}
                                            @else
                                                {{ $m->descripcion }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($m->comprobante_id)
                                                <a href="/sales/{{$m->comprobante_id}}">
                                                    {{ $m->comprobante->status }}
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
                <div class="text-center">
                    {{ $movimientos->links() }}
                </div>
                   </div>
               </div>
             </div>
        </div>
    </div>
@endsection



