@extends('layouts.app')

@section('title', 'Product Categories')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
        <li class="breadcrumb-item active">Categorias</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('utils.alerts')
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryCreateModal">
                           Nueva categoría <i class="bi bi-plus"></i>
                        </button>

                        <hr>

                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="categoryCreateModal" tabindex="-1" role="dialog" aria-labelledby="categoryCreateModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryCreateModalLabel">Nueva categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('product-categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_code">Código de categoría <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="category_code" required>
                        </div>
                        <div class="form-group">
                            <label for="category_name">Nombre de categoría <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="category_name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar <i class="bi bi-save"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
@endpush
