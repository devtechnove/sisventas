@extends('layouts.app')

@section('title', 'Nuevo Cliente')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Clientes</a></li>
        <li class="breadcrumb-item active">Registro de clientes</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
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
                        <div class="card-footer">
                             <div class="form-group">
                              <button class="btn btn-primary">Guardar <i class="bi bi-save"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

