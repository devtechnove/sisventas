@extends('layouts.app')

@section('title', 'Edit Product')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form id="product-form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
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
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="product_name">Descripción <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_name" required value="{{ $product->product_name }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="product_code">Código del producto <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_code" required value="{{ $product->product_code }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Categoría <span class="text-danger">*</span></label>
                                        <select class="form-control" name="category_id" id="category_id" required>
                                            @foreach(\Modules\Product\Entities\Category::all() as $category)
                                                <option {{ $category->id == $product->category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="barcode_symbology">Simbología de codigo de barras <span class="text-danger">*</span></label>
                                        <select class="form-control" name="product_barcode_symbology" id="barcode_symbology" required>
                                            <option {{ $product->product_barcode_symbology == 'C128' ? 'selected' : '' }} value="C128">Code 128</option>
                                            <option {{ $product->product_barcode_symbology == 'C39' ? 'selected' : '' }} value="C39">Code 39</option>
                                            <option {{ $product->product_barcode_symbology == 'UPCA' ? 'selected' : '' }} value="UPCA">UPC-A</option>
                                            <option {{ $product->product_barcode_symbology == 'UPCE' ? 'selected' : '' }} value="UPCE">UPC-E</option>
                                            <option {{ $product->product_barcode_symbology == 'EAN13' ? 'selected' : '' }} value="EAN13">EAN-13</option>
                                            <option {{ $product->product_barcode_symbology == 'EAN8' ? 'selected' : '' }} value="EAN8">EAN-8</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_cost">Costo <span class="text-danger">*</span></label>
                                        <input id="product_cost" type="text" class="form-control" min="0" name="product_cost" required value="{{ $product->product_cost }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_price">Precio de venta <span class="text-danger">*</span></label>
                                        <input id="product_price" type="text" class="form-control" min="0" name="product_price" required value="{{ $product->product_price }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_quantity">Cantidad disponible <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_quantity" required value="{{ $product->product_quantity }}" min="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_stock_alert">Alerta de cantidad<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_stock_alert" required value="{{ $product->product_stock_alert }}" min="0">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_order_tax">Impuesto (%)</label>
                                        <input type="text" class="form-control" name="product_order_tax" value="{{ $product->product_order_tax }}" min="0" max="100">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_tax_type">Tipo de impuesto</label>
                                        <select class="form-control" name="product_tax_type" id="product_tax_type">
                                            <option value="" selected>None</option>
                                            <option {{ $product->product_tax_type == 1 ? 'selected' : '' }}  value="1">Exclusivo</option>
                                            <option {{ $product->product_tax_type == 2 ? 'selected' : '' }} value="2">Inclusivo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_unit">Presentación <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="This text will be placed after Product Quantity."></i> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_unit" value="{{ old('product_unit') ?? $product->product_unit }}" required>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="product_unit">Imágen del producto <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="Ingresa la imágen del producto."></i> <span class="text-danger">*</span></label>
                                <div class="file-upload-wrapper">
                                    <input type="file" id="input-file-now-custom-1" name="document" class="file-upload" data-default-file="{{asset('images/products/'.$product->product_image)}}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_note">Nota</label>
                                <textarea name="product_note" id="product_note" rows="4 " class="form-control">{{ $product->product_note }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                             <div class="form-group">
                              <button class="btn btn-primary">Actualizar <i class="bi bi-save"></i></button>
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

            $('#product_cost').maskMoney('mask');
            $('#product_price').maskMoney('mask');

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

