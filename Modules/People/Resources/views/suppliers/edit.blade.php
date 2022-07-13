@extends('layouts.app')

@section('title', 'Update Supplier')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Proveedores</a></li>
        <li class="breadcrumb-item active">Editar datos del proveedor</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
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
                                        <label for="supplier_name">Razón social <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="supplier_name" required value="{{ $supplier->supplier_name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="supplier_email">Correo electrónico <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="supplier_email" required value="{{ $supplier->supplier_email }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="supplier_phone">Teléfono <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="supplier_phone" required value="{{ $supplier->supplier_phone }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="supplier_rif">Rif <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="supplier_rif" required value="{{ $supplier->supplier_rif }}">
                                    </div>
                                </div>

                            </div>

                            <div class="form-row">
                               <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="address">Dirección del proveedor <span class="text-danger">*</span></label>
                                        <textarea type="text" class="form-control" name="address" required>
                                            {{ $supplier->address }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                             <div class="col-lg-12">
                                @include('utils.alerts')
                                <div class="form-group">
                                    <button class="btn btn-primary">Actualizar <i class="bi bi-save"></i></button>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

