@extends('layouts.app')

@section('title', 'Home')

@section('breadcrumb')
 <h2 class="content-header-title float-left mb-0">Página de inicio</h2>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Datos generales</li>
    </ol>
@endsection

@section('content')
    <div>
        @can('show_total_stats')
        <div class="row">
              <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">{{ format_currency($revenue) }}</h2>
                                <p class="card-text">Ventas</p>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                   <iconify-icon icon="mdi:sale" class="fa-2x"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">{{ format_currency($sale_returns) }}</h2>
                                <small class="card-text">Devolución de ventas</small>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                  <iconify-icon icon="akar-icons:shipping-box-v2" class="fa-2x"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">{{ format_currency($purchase_returns) }}</h2>
                                <small class="card-text">Devolución de compras</small>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                      <iconify-icon icon="mdi:refresh" class="fa-2x"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                  <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">{{ format_currency($purchase) }}</h2>
                                <small class="card-text">Compras</small>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <iconify-icon icon="fa-regular:handshake" class="fa-2x"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">{{ format_currency($expense) }}</h2>
                                <small class="card-text">Gastos</small>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <iconify-icon icon="ic:baseline-point-of-sale" class="fa-2x"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
               <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                @php
                                  $totales =   $revenue - $currentMonthExpenses - $purchase
                                @endphp
                                <h2 class="font-weight-bolder mb-0">
                                    @if ($totales < 0)
                                        {{ format_currency('0.00') }}
                                    @else
                                        {{ format_currency($totales) }}
                                    @endif
                                </h2>
                                <small class="card-text">Ganancias</small>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                     <iconify-icon icon="fa6-solid:sack-dollar" class="fa-2x"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>

             </div>
        @endcan

       @if (\Auth::user()->hasRole('Super Administrador') || \Auth::user()->hasRole('Administrador') || \Auth::user()->hasRole('Supervisor'))
        <div class="row mb-4">

            <div class="col-lg-7">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header">
                       Ventas y compras en los útimos 7 días
                    </div>
                    <div class="card-body">
                        <div id="chart-container">
                            <canvas id="employee"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header">
                        Vista general de {{ now()->format('F, Y') }}
                    </div>
                    <div class="card-body">

                            <canvas id="currentMonthChart" height="250"></canvas>

                    </div>
                </div>
            </div>

        </div>

    @endif
    <div class="row">
        <div class="col-md-7">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4>Transacciones recientes</h4>
                  <div class="right-column">
                    <div class="badge badge-primary">Últimos 5 registros</div>
                  </div>
                </div>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" href="#sale-latest" role="tab" data-toggle="tab">Ventas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#purchase-latest" role="tab" data-toggle="tab">Compras</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="#products-latest" role="tab" data-toggle="tab">Productos</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="#expeses-latest" role="tab" data-toggle="tab">Gastos</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="#tasa-latest" role="tab" data-toggle="tab">Tasa del día</a>
                  </li>
                </ul>

                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade show active" id="sale-latest">
                      <div class="table-responsive">
                        <table class="table table-hover table-bordered table-sm text-center">
                          <thead>
                            <tr>
                              <th>Fecha</th>
                              <th>Estado de la venta</th>
                               <th>Método de pago</th>
                              <th>Total cancelado</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($recent_sale as $sale)

                            <tr>
                              <td>{{ $sale->date }}</td>
                              <td>{{ $sale->payment_method }}</td>
                              @if($sale->status == 'Completado')
                              <td><div class="badge badge-success">Procesado</div></td>

                              @else
                              <td><div class="badge badge-danger">Cancelado</div></td>

                              @endif

                              <td>{{ format_currency($sale->paid_amount / 100) }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="quotation-latest">
                      <div class="table-responsive">
                       <table class="table table-hover table-bordered table-sm text-center">
                          <thead>
                            <tr>
                              <th>{{trans('file.date')}}</th>
                              <th>{{trans('file.status')}}</th>
                              <th>{{trans('file.grand total')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="purchase-latest">
                      <div class="table-responsive">
                       <table class="table table-hover table-bordered table-sm text-center">
                          <thead>
                            <tr>
                              <th>Fecha</th>
                              <th>Código</th>
                              <th>Proveedor</th>
                              <th>Estado</th>

                            </tr>
                          </thead>
                          <tbody>
                            @foreach($recent_purchase as $purchase)
                            <?php $supplier = DB::table('suppliers')->where('empresa_id',\Auth::user()->empresa_id)->find($purchase->supplier_id); ?>
                            <tr>
                              <td>{{ $purchase->date }}</td>
                              <td>{{$purchase->reference}}</td>
                              @if($supplier)
                                <td>{{$supplier->supplier_name}}</td>
                              @else
                                <td>N/A</td>
                              @endif
                              @if($purchase->status == 'Completado')
                              <td><div class="badge badge-success">Completado</div></td>
                              @elseif($purchase->status == 'Ordenado')
                              <td><div class="badge badge-info">Parcial</div></td>
                              @else
                              <td><div class="badge badge-danger">Pendiente</div></td>

                              @endif

                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="products-latest">

                      <div class="table-responsive">
                       <table class="table table-hover table-bordered table-sm text-center">
                          <thead>
                            <tr>
                              <th>Código</th>
                              <th>Producto</th>

                              <th>Cantidad</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($products as $producto)

                            <tr>
                              <td>{{$producto->product_code}}</td>
                              <td>{{ $producto->product_name }}</td>
                              <td>{{$producto->product_quantity}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="expeses-latest">

                      <div class="table-responsive">
                       <table class="table table-hover table-bordered table-sm text-center">
                          <thead>
                            <tr>
                              <th>Fecha</th>
                              <th>Referencia</th>
                              <th>Descripción</th>
                              <th>Estado</th>
                              <th>Cantidad</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($recent_expense as $producto)

                            <tr>
                              <td>{{ $producto->fecha }} {{ $producto->hora }}</td>
                              <td>{{ $producto->reference }}</td>
                              <td>{{ $producto->details }}</td>
                              <td><div class="badge badge-success">Realizado</div></td>
                              <td>{{ format_currency($producto->amount) }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tasa-latest">
                    @php
                        $tasas = App\Models\Tasa::take(5)->orderBy('id','DESC')->where('empresa_id',\Auth::user()->empresa_id)->get()
                    @endphp
                      <div class="table-responsive">
                       <table class="table table-hover table-bordered table-sm text-center">
                          <thead>
                            <tr>
                              <th>Fecha</th>
                              <th>Tasa (Bs)</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($tasas as $tasa)

                            <tr>
                              <td>{{ $tasa->fecha_emision }}</td>
                              <td>{{ $tasa->amount }}Bs.</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>
            </div>
             <div class="col-md-5">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4>Lo mejor vendido en el mes {{$mes_actual}}</h4>
                  <div class="right-column">
                    <div class="badge badge-primary">Las últimas 5</div>
                  </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-sm text-center">
                      <thead>
                        <tr>
                          <th>SL No</th>
                          <th>Detalle del producto</th>
                          <th>Cantidad</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($best_selling_qty as $key=>$sale)
                        <?php $product = DB::table('products')->where('empresa_id',\Auth::user()->empresa_id)->find($sale->product_id); ?>
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>{{$product->product_name}}</td>
                          <td>{{$sale->sold_qty}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
            <div class="col-md-7">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4>Lo mejor vendido {{ $mes_actual }} (Cantidad)</h4>
                  <div class="right-column">
                    <div class="badge badge-primary">Las últimas 5</div>
                  </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-sm text-center">
                      <thead>
                        <tr>
                          <th>SL No</th>
                          <th>Detalle del producto</th>
                          <th>Cantidad</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($yearly_best_selling_qty as $key => $sale)
                       <?php $product = DB::table('products')->where('empresa_id',\Auth::user()->empresa_id)->find($sale->product_id); ?>
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>{{$product->product_name}}</td>
                          <td>{{$sale->sold_qty}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4>Lo mejor vendido {{ $mes_actual }} (Precio)</h4>
                  <div class="right-column">
                    <div class="badge badge-primary">Las últimas 5</div>
                  </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-sm text-center">
                      <thead>
                        <tr>
                          <th>SL No</th>
                          <th>Detalle del producto</th>
                          @if(\Auth::user()->hasRole('Administrador'))
                          <th>Total ($)</th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($yearly_best_selling_price as $key => $sale)
                        <?php $product = DB::table('products')->where('empresa_id',\Auth::user()->empresa_id)->find($sale->product_id); ?>
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>{{$product->product_name}}</td>
                          @if(\Auth::user()->hasRole('Administrador'))
                               <td>{{number_format((float)$sale->total_price, 2, '.', '')}}</td>
                          @endif
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
    </div>

       {{--  @can('show_monthly_cashflow')
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header">
                       Flujo de caja mensual (pago enviado y recibido)
                    </div>
                    <div class="card-body">
                        <canvas id="paymentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endcan --}}
    </div>
    <div class="modal fade" id="createModalTasa" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Ingresar tasa del día</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {!! Form::open(['route' => ['tasa.store'],'method' => 'POST','id'=>'formodelo','autocomplete' =>'off']) !!}
                 <div class="col-sm-12">
                    <label>Tasa del día</label>
                    <div class="input-group">

                      <input type="text" class="form-control" id="nombremarca" placeholder="Precio de la tasa del día"
                       name="amount">

                      <input type="hidden" id="idmarca" value="" name="idmarca">
                    </div>
                  </div><br>




                  <div class="row">
                    <div class="col-sm-12">
                      <button type="submit" class="btn blue darken-4 form-control"
                       id="boton">
                          <i class="fas fa-save text-white" id="ajax-icon"></i>
                           <span class="text-white ml-3">{{ __('Guardar') }}</span>
                      </button>
                    </div>
                  </div>
                  {!! Form::close()!!}
              </div>
            </div>
          </div>
        </div>
    <input type="hidden" id="tasa" value="{{ $tasa }}">
@endsection

@section('third_party_scripts')
    <script src="/app-assets/vendors/js/charts/chart.min.js"></script>
@endsection

@push('page_scripts')
    <script src="{{ asset('js/chart-config.js') }}"></script>
     <script>
        // Get Canvas element by its id
        employee_chart = document.getElementById('employee').getContext('2d');
        chart = new Chart(employee_chart,{
          type: 'bar',
            data:{
                labels:[
                    /*
                        this is blade templating.
                        we are getting the date by specifying the submonth
                     */

                    '{{Carbon\Carbon::now()->subDays(6)->toFormattedDateString()}}',
                    '{{Carbon\Carbon::now()->subDays(5)->toFormattedDateString()}}',
                    '{{Carbon\Carbon::now()->subDays(4)->toFormattedDateString()}}',
                    '{{Carbon\Carbon::now()->subDays(3)->toFormattedDateString()}}',
                    '{{Carbon\Carbon::now()->subDays(2)->toFormattedDateString()}}',
                    '{{Carbon\Carbon::now()->subDays(1)->toFormattedDateString()}}',
                    '{{Carbon\Carbon::now()->subDays(0)->toFormattedDateString()}}',
                    ],
                datasets:[{
                    label:'Ventas',
                    data:[
                        '{{$emp_count_7}}',
                        '{{$emp_count_6}}',
                        '{{$emp_count_5}}',
                        '{{$emp_count_4}}',
                        '{{$emp_count_3}}',
                        '{{$emp_count_2}}',
                        '{{$emp_count_1}}',
                        '{{$emp_count_0 }}'
                    ],
                     backgroundColor: '#00A404',
                      borderColor: '#00A404',
                      borderWidth: 1
                },
                {
                      label: 'Compras',
                      data: [
                        '{{$purch_count_7}}',
                        '{{$purch_count_6}}',
                        '{{$purch_count_5}}',
                        '{{$purch_count_4}}',
                        '{{$purch_count_3}}',
                        '{{$purch_count_2}}',
                        '{{$purch_count_1}}',
                        '{{$purch_count_0 }}'

                      ],
                      backgroundColor: '#FF0000',
                      borderColor: '#FF0000',
                      borderWidth: 1
                }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
     <script>
        var tasa = $('#tasa').val();
        console.log(tasa);
    if(tasa == 0)
    {
         $('#createModalTasa').modal('show');
    }
    else
    {
        $('#createModalTas').modal('hide');
    }
    </script>

@endpush
