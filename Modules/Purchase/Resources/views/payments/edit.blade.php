@extends('layouts.app')

@section('title', 'Edit Payment')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Compras</a></li>
        <li class="breadcrumb-item"><a href="{{ route('purchases.show', $purchase) }}">{{ $purchase->reference }}</a></li>
        <li class="breadcrumb-item active">Modificar pagos</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="payment-form" action="{{ route('purchase-payments.update', $purchasePayment) }}" method="POST">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required readonly value="{{ $purchasePayment->reference }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="date">Fecha de registro <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="date" required value="{{ $purchasePayment->getAttributes()['date'] }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="due_amount">Cantidad debida <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="due_amount" required value="{{ format_currency($purchase->due_amount) }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="amount">Monto <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input id="amount" type="text" class="form-control" name="amount" required value="{{ old('amount') ?? $purchasePayment->amount }}">
                                            <div class="input-group-append">
                                                <button id="getTotalAmount" class="btn btn-primary" type="button">
                                                    <i class="bi bi-check-square"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label for="payment_method">Payment Method <span class="text-danger">*</span></label>
                                            <select class="form-control" name="payment_method" id="payment_method" required>
                                                <option {{ $purchasePayment->payment_method == 'Efectivo' ? 'selected' : '' }} value="Efectivo">Efectivo</option>
                                                <option {{ $purchasePayment->payment_method == 'Tarjeta de crédito' ? 'selected' : '' }} value="Tarjeta de crédito">Tarjeta de crédito</option>
                                                <option {{ $purchasePayment->payment_method == 'Transferencia Bancaria' ? 'selected' : '' }} value="Transferencia Bancaria">Transferencia Bancaria</option>
                                                <option {{ $purchasePayment->payment_method == 'Cheque' ? 'selected' : '' }} value="Cheque">Cheque</option>
                                                <option {{ $purchasePayment->payment_method == 'Otros' ? 'selected' : '' }} value="Otros">Otros</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note">Nota</label>
                                <textarea class="form-control" rows="4" name="note">{{ old('note') ?? $purchasePayment->note }}</textarea>
                            </div>

                            <input type="hidden" value="{{ $purchase->id }}" name="purchase_id">
                        </div>
                         <div class="card-footer">
                             <div class="form-group">
                                <button class="btn btn-primary">Actualizar pago
                                    <i class="bi bi-check"></i>
                                </button>
                            </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


@php
    $moneda = \Modules\Currency\Entities\Currency::where('empresa_id',\Auth::user()->empresa_id)->first();
@endphp 
@push('page_scripts')
    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#paid_amount').maskMoney({
                prefix:'{{ $moneda->symbol }}',
                    thousands:'{{ $moneda->thousand_separator }}',
                    decimal:'{{ $moneda->decimal_separator }}',
                    allowZero: true,
            });

            $('#getTotalAmount').click(function () {
                $('#amount').maskMoney('mask', {{ $purchase->due_amount }});
            });

            $('#payment-form').submit(function () {
                var amount = $('#amount').maskMoney('unmasked')[0];
                $('#amount').val(amount);
            });
        });
    </script>
@endpush

