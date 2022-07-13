@extends('layouts.app')

@section('title', 'Edit Payment')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('purchase-returns.index') }}">Retorno de compra</a></li>
        <li class="breadcrumb-item"><a href="{{ route('purchase-returns.show', $purchase_return) }}">{{ $purchase_return->reference }}</a></li>
        <li class="breadcrumb-item active">Edición de pagos</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="payment-form" action="{{ route('purchase-return-payments.update', $purchaseReturnPayment) }}" method="POST">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')

                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required readonly value="{{ $purchaseReturnPayment->reference }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="date">Fecha de registro <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="date" required value="{{ $purchaseReturnPayment->getAttributes()['date'] }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="due_amount">Deuda <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="due_amount" required value="{{ format_currency($purchase_return->due_amount) }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="amount">Monto <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input id="amount" type="text" class="form-control" name="amount" required value="{{ old('amount') ?? $purchaseReturnPayment->amount }}">
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
                                            <label for="payment_method">Método de pago <span class="text-danger">*</span></label>
                                            <select class="form-control" name="payment_method" id="payment_method" required>
                                                <option {{ $purchaseReturnPayment->payment_method == 'Efectivo' ? 'selected' : '' }} value="Efectivo">Efectivo</option>
                                                <option {{ $purchaseReturnPayment->payment_method == 'Tarjeta de crédito' ? 'selected' : '' }} value="Tarjeta de crédito">Tarjeta de crédito</option>
                                                <option {{ $purchaseReturnPayment->payment_method == 'Transferencia Bancaria' ? 'selected' : '' }} value="Transferencia Bancaria">Transferencia Bancaria</option>
                                                <option {{ $purchaseReturnPayment->payment_method == 'Cheque' ? 'selected' : '' }} value="Cheque">Cheque</option>
                                                <option {{ $purchaseReturnPayment->payment_method == 'Otros' ? 'selected' : '' }} value="Otros">Otros</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note">Nota</label>
                                <textarea class="form-control" rows="4" name="note">{{ old('note') ?? $purchaseReturnPayment->note }}</textarea>
                            </div>

                            <input type="hidden" value="{{ $purchase_return->id }}" name="purchase_return_id">
                        </div>
                        <div class="card-footer">
                              <div class="form-group">
                                <button class="btn btn-primary">Actualizar pago <i class="bi bi-save"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('page_scripts')
    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#amount').maskMoney({
                prefix:'{{ settings()->currency->symbol }}',
                thousands:'{{ settings()->currency->thousand_separator }}',
                decimal:'{{ settings()->currency->decimal_separator }}',
            });

            $('#amount').maskMoney('mask');

            $('#getTotalAmount').click(function () {
                $('#amount').maskMoney('mask', {{ $purchase_return->due_amount }});
            });

            $('#payment-form').submit(function () {
                var amount = $('#amount').maskMoney('unmasked')[0];
                $('#amount').val(amount);
            });
        });
    </script>
@endpush

