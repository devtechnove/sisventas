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
              <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">{{ format_currency($revenue) }}</h2>
                                <p class="card-text">Ventas</p>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                   <span class="iconify fa-3x" data-icon="mdi:sale"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">{{ format_currency($sale_returns) }}</h2>
                                <small class="card-text">Devolución de ventas</small>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                   <span class="iconify fa-3x" data-icon="akar-icons:shipping-box-v2"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">{{ format_currency($purchase_returns) }}</h2>
                                <small class="card-text">Devolución de compras</small>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                     <span class="iconify fa-3x" data-icon="fa-regular:handshake"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
               <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">{{ format_currency($revenue) }}</h2>
                                <small class="card-text">Ganancias</small>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <span class="iconify fa-3x" data-icon="fa6-solid:sack-dollar"></span>
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
                        <canvas id="salesPurchasesChart"></canvas>
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

        @can('show_monthly_cashflow')
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
        @endcan
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
