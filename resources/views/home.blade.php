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
                                <h2 class="font-weight-bolder mb-0">{{ format_currency($profit) }}</h2>
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

        @can('show_weekly_sales_purchases|show_month_overview')
        <div class="row mb-4">
            @can('show_weekly_sales_purchases')
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
            @endcan
            @can('show_month_overview')
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header">
                        Vista general de {{ now()->format('F, Y') }}
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="chart-container" style="position: relative; height:auto; width:1000px">
                            <canvas id="currentMonthChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
        @endcan

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
@endsection

@section('third_party_scripts')
    <script src="/app-assets/vendors/js/charts/chart.min.js"></script>
@endsection

@push('page_scripts')
    <script src="{{ mix('js/chart-config.js') }}"></script>
@endpush
