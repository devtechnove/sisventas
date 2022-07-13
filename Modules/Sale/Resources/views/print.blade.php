<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sale Details</title>
    <link rel="stylesheet" href="{{ public_path('b3/bootstrap.min.css') }}">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div style="text-align: center;margin-bottom: 35px;">
                <img width="200" src="{{ public_path('images/6230af0fd25cc.png') }}" alt="Logo">
                <div class="row">
                     <div class="col-xs-12 mb-3 mt-3 mb-md-0 text-center" >
                            <div style="margin-right: 5em;">{{ settings()->company_address }}</div>
                            <div style="margin-right: 5em;">Email: {{ settings()->company_email }}</div>
                            <div style="margin-right: 5em;">Phone: {{ settings()->company_phone }}</div>
                        </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                        <div class="row">
                         <div class="col-xs-12">
                            <h4 class="mb-2" style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">Información del cliente:</h4>
                            <div><strong>{{ $customer->customer_name }}</strong></div>
                            <div>{{ $customer->address }}</div>
                            <div>Correo electrónico: {{ $customer->customer_email }}</div>
                            <div>Teléfono: {{ $customer->customer_phone }}</div>
                        </div>
                        </div><br><br><br><br><br>




                    <div class="table-responsive-sm" style="margin-top: 30px;">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="align-middle">Producto</th>
                                <th class="align-middle">Precio del producto</th>
                                <th class="align-middle">Cantidad</th>
                                <th class="align-middle">Descuento</th>
                                <th class="align-middle">Impuesto</th>
                                <th class="align-middle">Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sale->saleDetails as $item)
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
                        <div class="col-xs-4 col-xs-offset-8">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="left"><strong>Descuento ({{ $sale->discount_percentage }}%)</strong></td>
                                    <td class="right">{{ format_currency($sale->discount_amount) }}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Impuesto ({{ $sale->tax_percentage }}%)</strong></td>
                                    <td class="right">{{ format_currency($sale->tax_amount) }}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Transporte por envío)</strong></td>
                                    <td class="right">{{ format_currency($sale->shipping_amount) }}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Total a pagar</strong></td>
                                    <td class="right"><strong>{{ format_currency($sale->total_amount) }}</strong></td>
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
</body>
</html>
