@extends('layouts.app')

@section('title', 'Quotation Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('quotations.index') }}">Cotizaciones</a></li>
        <li class="breadcrumb-item active">Details</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center">
                        <div>
                            Referencia: <strong>{{ $quotation->reference }}</strong>
                        </div>
                        <a target="_blank" class="btn btn-sm btn-secondary mfs-auto mfe-1 d-print-none" href="{{ route('quotations.pdf', $quotation->id) }}">
                            <i class="bi bi-printer"></i> Imprimir
                        </a>
                        <a target="_blank" class="btn btn-sm btn-info mfe-1 d-print-none" href="{{ route('quotations.pdf', $quotation->id) }}">
                            <i class="bi bi-save"></i> Guardar
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Información de la compañía:</h5>
                                <div><strong>{{ settings()->company_name }}</strong></div>
                                <div>{{ settings()->company_address }}</div>
                                <div>Correo: {{ settings()->company_email }}</div>
                                <div>Teléfono: {{ settings()->company_phone }}</div>
                            </div>

                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Información del cliente:</h5>
                                <div><strong>{{ $customer->customer_name }}</strong></div>
                                <div>{{ $customer->address }}</div>
                                <div>Correo: {{ $customer->customer_email }}</div>
                                <div>Teléfono: {{ $customer->customer_phone }}</div>
                            </div>

                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Información de factura:</h5>
                                <div>Factura: <strong>INV/{{ $quotation->reference }}</strong></div>
                                <div>Fecha: {{ \Carbon\Carbon::parse($quotation->date)->format('d M, Y') }}</div>
                                <div>
                                    Estado de la factura: <strong>{{ $quotation->status }}</strong>
                                </div>
                                <div>
                                    Pago de la factura: <strong>{{ $quotation->payment_status }}</strong>
                                </div>
                            </div>

                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="align-middle">Producto</th>
                                    <th class="align-middle">Precio</th>
                                    <th class="align-middle">Cantidad</th>
                                    <th class="align-middle">Descuento</th>
                                    <th class="align-middle">Impuesto</th>
                                    <th class="align-middle">Sub Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($quotation->quotationDetails as $item)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $item->product_name }} <br>
                                            <span class="badge badge-success">
                                                {{ $item->product_code }}
                                            </span>
                                        </td>

                                        <td class="align-middle">{{ format_currency($item->unit_price) }}</td>

                                        <td class="align-middle">
                                            {{ $item->quantity }}
                                        </td>

                                        <td class="align-middle">
                                            {{ format_currency($item->product_discount_amount) }}
                                        </td>

                                        <td class="align-middle">
                                            {{ format_currency($item->product_tax_amount) }}
                                        </td>

                                        <td class="align-middle">
                                            {{ format_currency($item->sub_total) }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5 ml-md-auto">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="left"><strong>Descuento ({{ $quotation->discount_percentage }}%)</strong></td>
                                        <td class="right">{{ format_currency($quotation->discount_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Impuesto ({{ $quotation->tax_percentage }}%)</strong></td>
                                        <td class="right">{{ format_currency($quotation->tax_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Envío de producto</strong></td>
                                        <td class="right">{{ format_currency($quotation->shipping_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Total a cancelar</strong></td>
                                        <td class="right"><strong>{{ format_currency($quotation->total_amount) }}</strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

