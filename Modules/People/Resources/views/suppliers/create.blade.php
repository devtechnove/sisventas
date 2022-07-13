@extends('layouts.app')

@section('title', 'Create Supplier')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Proveedores</a></li>
        <li class="breadcrumb-item active">Nuevo proveedor</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="row">
                 @include('utils.alerts')
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="supplier_name">Razón social <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="supplier_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="supplier_email">Correo electrónico <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="supplier_email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="supplier_phone">Teléfono <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="supplier_phone" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="supplier_rif">Rif <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="supplier_rif" required>
                                    </div>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="address">Dirección del proveedor <span class="text-danger">*</span></label>
                                        <textarea type="text" class="form-control" name="address" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                           <div class="col-lg-12">
                                <div class="form-group">
                                    <button class="btn btn-primary">Nuevo proveedor <i class="bi bi-add"></i></button>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

