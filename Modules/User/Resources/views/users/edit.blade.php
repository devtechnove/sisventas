@extends('layouts.app')

@section('title', 'Modificación de usuarios')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
        <li class="breadcrumb-item active">Modificación de usuarios</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')

                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nombre completo <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" required value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Correo electrónico <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email" required value="{{ $user->email }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="role">Role <span class="text-danger">*</span></label>
                                <select class="form-control" name="role" id="role" required>
                                    @foreach(\Spatie\Permission\Models\Role::where('name', '!=', 'Super Admin')->get() as $role)
                                        <option {{ $user->hasRole($role->name) ? 'selected' : '' }} value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="is_active">Estado del usuario <span class="text-danger">*</span></label>
                                <select class="form-control" name="is_active" id="is_active" required>
                                    <option value="true" {{ $user->is_active == true ? 'selected' : ''}}>Activo</option>
                                    <option value="false" {{ $user->is_active == false ? 'selected' : ''}}>Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                              <div class="form-group">
                                <button class="btn btn-primary">Actualizar datos <i class="bi bi-save"></i></button>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="product_unit">Imágen del producto <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="Ingresa la imágen del producto."></i> <span class="text-danger">*</span></label>
                                <div class="file-upload-wrapper">
                                    <input type="file" id="input-file-now-custom-1" name="document" class="file-upload" data-default-file="{{asset('images/perfiles/'.$user->image)}}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection



@push('page_scripts')
     <script>
        $('.file-upload').file_upload();
    </script>
@endpush


