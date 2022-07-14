@extends('layouts.app')

@section('title', 'Clientes')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Clientes</a></li>
        <li class="breadcrumb-item active">Modificación de clientes</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('customers.update', $customer) }}" method="POST">
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
                                        <label for="customer_name">Nombre completo<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="customer_name" required value="{{ $customer->customer_name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="customer_documento">Documento del cliente <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="customer_documento" required value="{{ $customer->customer_documento }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="customer_phone">Teléfono <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="customer_phone" required value="{{ $customer->customer_phone }}">
                                    </div>
                                </div>

                            </div>

                             <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="address">Dirección <span class="text-danger">*</span></label>
                                        <textarea name="address" id="" cols="30" rows="5" class="form-control">
                                            {{ $customer->address }}
                                        </textarea>

                                    </div>
                                </div>
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

