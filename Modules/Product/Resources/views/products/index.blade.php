@extends('layouts.app')

@section('title', 'Products')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Products</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                          <a href="{{ route('products.create') }}" class="btn btn-relief-primary float-right">
                           Nuevo proucto<i class="bi bi-plus"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table bordered" id="tableExport" >
                                <thead>
                                    <tr>
                                        <th>Imágen</th>
                                        <th>Producto</th>
                                        <th>Código</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Categoría</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $element)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('/images/products/'.$element->product_image) }}" border="0" width="50" class="img-thumbnail" align="center">
                                            </td>
                                            <td>{{ $element->product_name }}</td>
                                            <td>{{ $element->product_code }}</td>
                                            <td>{{ format_currency($element->product_price) }}</td>
                                            <td>{{ $element->product_quantity .' '.$element->product_unit }}</td>
                                            <td>{{ $element->category->category_name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    @can('edit_products')
                                                        <a href="{{ route('products.edit', $element->id) }}" class="btn btn-info">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        @endcan
                                                        @can('show_products')
                                                        <a href="{{ route('products.show', $element->id) }}" class="btn btn-primary">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        @endcan
                                                        @can('delete_products')
                                                        <button id="delete" class="btn btn-danger" onclick="
                                                            event.preventDefault();
                                                            if (confirm('Are you sure? It will delete the data permanently!')) {
                                                                document.getElementById('destroy{{ $element->id }}').submit()
                                                            }
                                                            ">
                                                            <i class="bi bi-trash"></i>
                                                            <form id="destroy{{ $element->id }}" class="d-none" action="{{ route('products.destroy', $element->id) }}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        </button>
                                                        @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')

@endpush
