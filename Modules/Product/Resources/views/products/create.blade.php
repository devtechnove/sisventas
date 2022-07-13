@extends('layouts.app')

@section('title', 'Create Product')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
        <li class="breadcrumb-item active">Nuevo producto</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="product-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_name">Nombre <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_name" required value="{{ old('product_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_code">Código del producto <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_code" required value="{{ old('product_code') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Categoría <span class="text-danger">*</span></label>
                                        <select class="form-control" name="category_id" id="category_id" required>
                                            <option value="" selected disabled>Selecciona la Categoría</option>
                                            @foreach(\Modules\Product\Entities\Category::all() as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="barcode_symbology">Simbología para código de barra <span class="text-danger">*</span></label>
                                        <select class="form-control" name="product_barcode_symbology" id="barcode_symbology" required>
                                            <option value="" selected disabled>Seleccione</option>
                                            <option value="C128">Code 128</option>
                                            <option value="C39">Code 39</option>
                                            <option value="UPCA">UPC-A</option>
                                            <option value="UPCE">UPC-E</option>
                                            <option value="EAN13">EAN-13</option><option value="EAN8">EAN-8</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_cost">Costo del producto <span class="text-danger">*</span></label>
                                        <input id="product_cost" type="text" class="form-control" name="product_cost" required value="{{ old('product_cost') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_price">Precio de venta <span class="text-danger">*</span></label>
                                        <input id="product_price" type="text" class="form-control" name="product_price" required value="{{ old('product_price') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_quantity">Cantidad inicial <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="product_quantity" required value="{{ old('product_quantity') }}" min="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_stock_alert">Cantidad de alerta<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="product_stock_alert" required value="{{ old('product_stock_alert') }}" min="0" max="100">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_order_tax">Impuesto (%)</label>
                                        <input type="text" class="form-control" name="product_order_tax" value="{{ old('product_order_tax') }}" min="1">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_tax_type">Clase de impuesto <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="Exclusivo: precio del producto = precio real del producto + impuestos. Inclusivo: Precio real del producto = Precio del producto - Impuestos."></i></label>
                                        <select class="form-control" name="product_tax_type" id="product_tax_type">
                                            <option value="" selected disabled>Seleccione</option>
                                            <option value="1">Exclusivo</option>
                                            <option value="2">Inclusivo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_unit">Presentación del producto <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="Este texto se colocará después de Este texto se colocará después de la cantidad del producto."></i> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_unit" value="{{ old('product_unit') }}" required>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="product_unit">Imágen del producto <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="Ingresa la imágen del producto."></i> <span class="text-danger">*</span></label>
                                <div class="file-upload-wrapper">
                                    <input type="file" id="input-file-now-custom-1" name="document" class="file-upload" data-default-file="{{asset('images/fallback_product_image.png')}}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_note">Nota</label>
                                <textarea name="product_note" id="product_note" rows="4 " class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-lg-12">
                             @include('utils.alerts')
                             <div class="form-group">
                              <button class="btn btn-primary">
                                Crear producto
                                <i class="bi bi-save"></i>
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

@section('third_party_scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection

@push('page_scripts')
    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#product_cost').maskMoney({
                prefix:'{{ settings()->currency->symbol }}',
                thousands:'{{ settings()->currency->thousand_separator }}',
                decimal:'{{ settings()->currency->decimal_separator }}',
            });
            $('#product_price').maskMoney({
                prefix:'{{ settings()->currency->symbol }}',
                thousands:'{{ settings()->currency->thousand_separator }}',
                decimal:'{{ settings()->currency->decimal_separator }}',
            });

            $('#product-form').submit(function () {
                var product_cost = $('#product_cost').maskMoney('unmasked')[0];
                var product_price = $('#product_price').maskMoney('unmasked')[0];
                $('#product_cost').val(product_cost);
                $('#product_price').val(product_price);
            });
        });




    </script>
    <script>
        $('.file-upload').file_upload();
    </script>
@endpush

