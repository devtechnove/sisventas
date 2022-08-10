<div>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            <span>{{ session('message') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                @endif
                  <div class="form-group">
                        <label for="customer_id">Clientes <span class="text-danger">*</span></label>
                       <div class="input-group">
                        <select class="form-control" wire:model="customer_id" id="customer_id" required>
                            <option value="">Seleccione un cliente</option>
                            @foreach(\Modules\People\Entities\Customer::all() as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#proveedorCreateModal">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                 </div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                        <tr class="text-center">
                            <th class="align-middle">Producto</th>
                            <th class="align-middle">Precio</th>
                            <th class="align-middle">Cantidad</th>
                            <th class="align-middle">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($cart_items->isNotEmpty())
                            @foreach($cart_items as $cart_item)
                                <tr>
                                    <td class="align-middle">
                                        {{ $cart_item->name }} <br>
                                        <span class="badge badge-success">
                                        {{ $cart_item->options->code }}
                                    </span>
                                        @include('livewire.includes.product-cart-modal')
                                    </td>

                                    <td class="align-middle">
                                        {{ format_currency($cart_item->price) }}
                                    </td>

                                    <td class="align-middle">
                                        @include('livewire.includes.product-cart-quantity')
                                    </td>

                                    <td class="align-middle text-center">
                                        <a href="#" wire:click.prevent="removeItem('{{ $cart_item->rowId }}')">
                                            <i class="bi bi-x-circle font-2xl text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">
                        <span class="text-danger">
                           Por favor busca y selecciona el producto
                        </span>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <tr>
                                <th>Impuesto ({{ $global_tax }}%)</th>
                                <td>(+) {{ format_currency(Cart::instance($cart_instance)->tax()) }}</td>
                            </tr>
                            <tr>
                                <th>Descuento ({{ $global_discount }}%)</th>
                                <td>(-) {{ format_currency(Cart::instance($cart_instance)->discount()) }}</td>
                            </tr>
                            <tr>
                                <th>Costo de envío</th>
                                <input type="hidden" value="{{ $shipping }}" name="shipping_amount">
                                <td>(+) {{ format_currency($shipping) }}</td>
                            </tr>
                            <tr class="text-primary">
                                <th>Total a pagar</th>
                                @php
                                    $total_with_shipping = Cart::instance($cart_instance)->total() + (float) $shipping
                                @endphp
                                <th>
                                    (=) {{ format_currency($total_with_shipping) }}
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="tax_percentage">Impuesto (%)</label>
                        <input wire:model.lazy="global_tax" type="number" class="form-control" min="0" max="100" value="{{ $global_tax }}" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="discount_percentage">Descuento (%)</label>
                        <input wire:model.lazy="global_discount" type="number" class="form-control" min="0" max="100" value="{{ $global_discount }}" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="shipping_amount">Costo de envío</label>
                        <input wire:model.lazy="shipping" type="number" class="form-control" min="0" value="0" required step="0.01">
                    </div>
                </div>
            </div>

            <div class="form-group d-flex justify-content-center flex-wrap mb-0">
                <button wire:click="resetCart" type="button" class="btn btn-pill btn-danger mr-3"><i class="bi bi-x"></i> Reiniciar</button>
                <button wire:loading.attr="disabled" wire:click="proceed" type="button" class="btn btn-pill btn-primary" {{  $total_amount == 0 ? 'disabled' : '' }}><i class="bi bi-check"></i> Proceder</button>
            </div>
        </div>
    </div>

           <!-- Create Modal -->
    <div class="modal fade" id="proveedorCreateModal" tabindex="-1" role="dialog" aria-labelledby="proveedorCreateModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="proveedorCreateModalLabel">Nuevo cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf
                     <div class="modal-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="customer_name">Nombre <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('customer_name') }}" class="form-control" name="customer_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="customer_email">Documento <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('customer_documento') }}" class="form-control" name="customer_documento" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="customer_phone">Teléfono <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('customer_phone') }}" class="form-control" name="customer_phone" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="address">Dirección <span class="text-danger">*</span></label>
                                        <textarea name="address" id="" cols="30" rows="5" class="form-control">
                                            {{ old('address') }}
                                        </textarea>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar <i class="bi bi-save"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--Checkout Modal--}}
    @include('livewire.pos.includes.checkout-modal')

</div>

