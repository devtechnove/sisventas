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
                     <form action="{{ route('personal.update', $personal) }}" method="POST">
                        @csrf
                        @method('patch')
                      <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6 mt-1">
                                <label for="name">Nombres</label>
                                 <input type="text" class="form-control" name="name" value="{{ $personal->name }}" required>
                            </div>
                             <div class="col-sm-6 mt-1">
                                <label for="lastname">Apellidos</label>
                                  <input type="text" class="form-control" name="lastname" value="{{ $personal->lastname }}" required>
                             </div>
                              <div class="col-sm-6 mt-1">
                                <label for="cedula">Documento</label>
                                  <input type="text" class="form-control" name="cedula" value="{{ $personal->cedula }}" required>
                             </div>
                              <div class="col-sm-6 mt-1">
                                <label for="telefono">Teléfono</label>
                                  <input type="text" class="form-control" name="telefono" value="{{ $personal->telefono }}" required>
                             </div>
                             <div class="col-sm-6 mt-1">
                                 <label for="cargo">Cargo del empleado</label>
                                 <select name="cargo" id="" class="form-control">
                                     <option value="Gerente" {{($personal->cargo ==='Gerente') ? 'selected' : ''}}>Gerente</option>
                                     <option value="Encargado"{{($personal->cargo ==='Encargado') ? 'selected' : ''}}>Encargado</option>
                                     <option value="Supervisor" {{($personal->cargo ==='Supervisor') ? 'selected' : ''}}>Supervisor</option>
                                     <option value="Atención al público" {{($personal->cargo ==='Atención al público') ? 'selected' : ''}}>Atención al público</option>
                                 </select>
                             </div>
                             <div class="col-sm-6 mt-1">
                                 <label for="status">Estado del empleado</label>
                                 <select name="status" id="" class="form-control">
                                     <option value="1" {{($personal->status === 1) ? 'selected' : ''}}>Activo</option>
                                     <option value="0" {{($personal->status === 0) ? 'selected' : ''}}>Inactivo</option>

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

