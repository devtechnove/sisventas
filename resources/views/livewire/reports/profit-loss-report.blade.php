<div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form wire:submit.prevent="generateReport">
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Fecha de inicio <span class="text-danger">*</span></label>
                                    <input wire:model.defer="start_date" type="date" class="form-control" name="start_date">
                                    @error('start_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Fecha fin <span class="text-danger">*</span></label>
                                    <input wire:model.defer="end_date" type="date" class="form-control" name="end_date">
                                    @error('end_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <span wire:target="generateReport" wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <i wire:target="generateReport" wire:loading.remove class="bi bi-shuffle"></i>
                                Filtrar datos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Sales --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 d-flex align-items-center">
                    <div>
                        <div class="text-value text-primary">{{ format_currency($sales_amount) }}</div>
                        <div class="text-uppercase font-weight-bold small ">{{ $total_sales }} Ventas</div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Sale Returns --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 d-flex align-items-center">

                    <div>
                        <div class="text-value text-primary">{{ format_currency($sale_returns_amount) }}</div>
                        <div class="text-uppercase font-weight-bold small">{{ $total_sale_returns }}
                          Devoluciones
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Profit --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 d-flex align-items-center">
                    <div>
                        <div class="text-value text-primary">{{ format_currency($profit_amount) }}</div>
                        <div class="text-uppercase font-weight-bold small">LUCRO</div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Purchases --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 d-flex align-items-center">
                    <div>
                        <div class="text-value text-primary">{{ format_currency($purchases_amount) }}</div>
                        <div class="text-uppercase font-weight-bold small">{{ $total_purchases }} Compras</div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Purchase Returns --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 d-flex align-items-center">
                    <div>
                        <div class="text-value text-primary">{{ format_currency($purchase_returns_amount) }}</div>
                        <div class="text-uppercase font-weight-bold small">{{ $total_purchase_returns }} Devolución de compras</div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Expenses --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 d-flex align-items-center">
                    <div>
                        <div class="text-value text-primary">{{ format_currency($expenses_amount) }}</div>
                        <div class="text-uppercase font-weight-bold small">Gastos</div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Payments Received --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 d-flex align-items-center">
                    <div>
                        <div class="text-value text-primary">{{ format_currency($payments_received_amount) }}</div>
                        <div class="text-uppercase font-weight-bold small">Pagos recibidos</div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Payments Sent --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 d-flex align-items-center">
                    <div>
                        <div class="text-value text-primary">{{ format_currency($payments_sent_amount) }}</div>
                        <div class="text-uppercase font-weight-bold small">Pagos enviados</div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Payments Net --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 d-flex align-items-center">
                    <div>
                        <div class="text-value text-primary">{{ format_currency($payments_net_amount) }}</div>
                        <div class="text-uppercase font-weight-bold small">Total de pagos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
