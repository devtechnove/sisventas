@extends('layouts.app')

@section('title', 'EMPLEADOS')
@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('personal.index') }}">Listado general</a></li>
        <li class="breadcrumb-item active">Nuevo registro</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('personal.store') }}" method="POST" autocomplete="off">
                     @csrf
                      <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6 mt-1">
                                <label for="name">Nombres</label>
                                 <input type="text" class="form-control" name="name" required>
                            </div>
                             <div class="col-sm-6 mt-1">
                                <label for="lastname">Apellidos</label>
                                  <input type="text" class="form-control" name="lastname" required>
                             </div>
                              <div class="col-sm-6 mt-1">
                                <label for="cedula">Documento</label>
                                  <input type="text" class="form-control" name="cedula" required>
                             </div>
                              <div class="col-sm-6 mt-1">
                                <label for="telefono">Teléfono</label>
                                  <input type="text" class="form-control" name="telefono" required>
                             </div>
                             <div class="col-sm-6 mt-1">
                                 <label for="cargo">Cargo del empleado</label>
                                 <select name="cargo" id="" class="form-control">
                                     <option value="Gerente">Gerente</option>
                                     <option value="Encargado">Encargado</option>
                                     <option value="Supervisor">Supervisor</option>
                                     <option value="Atención al público">Atención al público</option>
                                 </select>
                             </div>
                             <div class="col-sm-6 mt-1">
                                 <label for="status">Estado del empleado</label>
                                 <select name="status" id="" class="form-control">
                                     <option value="1">Activo</option>
                                     <option value="0">Inactivo</option>

                                 </select>
                             </div>
                           </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

