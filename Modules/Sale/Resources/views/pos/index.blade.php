@extends('layouts.pos')

@section('title', 'VENTAS | POS')

@section('third_party_stylesheets')

@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Punto de venta</li>
    </ol>
@endsection

@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                @include('utils.alerts')
            </div>
            <div class="col-lg-7">
                <livewire:search-product/>
                <livewire:pos.product-list :categories="$product_categories"/>
            </div>
            <div class="col-lg-5">
                <livewire:pos.checkout :cart-instance="'sale'" :customers="$customers"/>
            </div>
        </div>
    </div>
@endsection
@php
    $moneda = \Modules\Currency\Entities\Currency::where('empresa_id',\Auth::user()->empresa_id)->first();
@endphp 
@push('page_scripts')
    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
    <script>
        $(document).ready(function () {
            window.addEventListener('showCheckoutModal', event => {
                $('#checkoutModal').modal('show');

                $('#paid_amount').maskMoney({
                    prefix:'{{ $moneda->symbol }}',
                    thousands:'{{ $moneda->thousand_separator }}',
                    decimal:'{{ $moneda->decimal_separator }}',
                    allowZero: true,
                });

                $('#total_amount').maskMoney({
                    prefix:'{{ $moneda->symbol }}',
                thousands:'{{ $moneda->thousand_separator }}',
                decimal:'{{ $moneda->decimal_separator }}',
                allowZero: true,
                });

                $('#paid_amount').maskMoney('mask');
                $('#total_amount').maskMoney('mask');

                $('#checkout-form').submit(function () {
                    var paid_amount = $('#paid_amount').maskMoney('unmasked')[0];
                    $('#paid_amount').val(paid_amount);
                    var total_amount = $('#total_amount').maskMoney('unmasked')[0];
                    $('#total_amount').val(total_amount);
                });
            });
        });
    </script>

@endpush
