@extends('layouts.app')

@section('title', 'Nuevo usuario')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
        <li class="breadcrumb-item active">Nuevo usuario</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')

                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nombre completo <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Correo electrónico <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password">Contraseña <span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" name="password" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirmación de contraseña <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="password" name="password_confirmation"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="role">Role <span class="text-danger">*</span></label>
                                <select class="form-control" name="role" id="role" required>
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach(\Spatie\Permission\Models\Role::where('id', '>', 1)->get() as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                               <div class="form-group">
                                <label for="role">Empresa <span class="text-danger">*</span></label>
                                <select class="form-control" name="empresa_id" id="empresa_id" required>
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach(\Modules\Empresa\Entities\Empresa::where('id', '=',\Auth::user()->empresa_id)->get() as $empresa)
                                        <option value="{{ $empresa->id }}">{{ $empresa->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>

                          <div class="form-group">
                                <label for="role">Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="status"  required>
                                    <option value="" selected disabled>Seleccione</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                              <div class="form-group">
                                <button class="btn btn-primary">Guardar usuario <i class="bi bi-save"></i></button>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('page_scripts')

@endpush


