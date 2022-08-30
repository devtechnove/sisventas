<div>
    @php
        $totalCredito = 0;
        $totalDebito = 0;
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form wire:submit.prevent="generateReport">
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Fecha de inicio <span class="text-danger">*</span></label>
                                    <input wire:model.defer="start_date" type="date" class="form-control" name="start_date">
                                    @error('start_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Fecha fin<span class="text-danger">*</span></label>
                                    <input wire:model.defer="end_date" type="date" class="form-control" name="end_date">
                                    @error('end_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Cuentas bancarias asociadas</label>
                                    <select wire:model.defer="cuenta_id" class="form-control" name="cuenta_id">
                                        <option value="">Selecciona la cuenta bancaria</option>
                                        @foreach($cuentas as $cuenta)
                                            <option value="{{ $cuenta->id }}">{{ $cuenta->nb_nombre }}</option>
                                        @endforeach
                                    </select>
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
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-striped text-center mb-0" id="tableExport">
                        <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center" style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Cargando...</span>
                            </div>
                        </div>
                        <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Detalle</th>
                            <th>Estado</th>
                            <th>Crédito</th>
                            <th>Débito</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($estados as $sale)
                            <tr>
                                <td> {{ \Carbon\Carbon::parse($sale->fecha_emision)->format('d M, Y') }}</td>
                                <td> {{ $sale->descripcion }}</td>
                                <td> {{ $sale->tipo_movimiento }}</td>
                                <td>{{ format_currency($sale->credito) }}</td>
                                <td>{{ format_currency($sale->debito) }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                         @foreach ($estados as $vent)
                            @php
                                $totalCredito+=$vent->credito;//sumanos los valores, ahora solo fata mostrar dicho valor
                                $totalDebito+=$vent->debito
                            @endphp
                         @endforeach
                        <tfoot class="table-border-bottom-0">
                        <tr>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th>{{ format_currency ($totalCredito )  }} </th>
                          <th>{{ format_currency ($totalDebito )  }}</th>
                        </tr>
                      </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
