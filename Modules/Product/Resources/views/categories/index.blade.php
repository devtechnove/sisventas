@extends('layouts.app')

@section('title', 'CATEGORIAS')

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
                    <div class="card-header">
                         <!-- Button trigger modal -->
                        <button type="button" class="btn btn-relief-primary float-right" data-toggle="modal" data-target="#categoryCreateModal">
                           Nueva categoría <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered"  id="tableExport">
                                <thead>
                                    <tr class="text-center">
                                        <th>Código</th>
                                        <th>Descripción</th>
                                        <th>Cantidad de productos</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $element)
                                        <tr class="text-center">
                                         <td>{{ $element->category_code }}</td>
                                         <td>{{ $element->category_name }}</td>
                                         <td>{{ $element->products->sum('category_id') /2 }}</td>
                                         <td>
                                             <div class="btn-group">
                                                 <a href="{{ route('product-categories.edit', $element->id) }}" class="btn btn-relief-info">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button id="delete" class="btn btn-relief-danger" onclick="
                                                event.preventDefault();
                                                if (confirm('¿Estás seguro(a)? ¡Se eliminará definitivamente!')) {
                                                    document.getElementById('destroy{{ $element->id }}').submit();
                                                }
                                                ">
                                                <i class="bi bi-trash"></i>
                                                <form id="destroy{{ $element->id }}" class="d-none" action="{{ route('product-categories.destroy', $element->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </button>
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

@endpush
