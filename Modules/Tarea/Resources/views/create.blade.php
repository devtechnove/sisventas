@extends('layouts.app')

@section('title', 'TAREAS')
@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tarea.index') }}">Listado general</a></li>
        <li class="breadcrumb-item active">Nuevo registro</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('tarea.store') }}" method="POST" autocomplete="off">
                     @csrf
                      <div class="card-body">

                        <div class="row">
                            <div class="col-sm-12 mt-1">
                                <label for="name">Título</label>
                                 <input type="text" class="form-control" name="name" required>
                            </div>
                             <div class="col-sm-12 mt-1">
                                <label for="lastname">Descripción</label>
                                  <textarea name="descripcion" id="" cols="30" rows="5" class="form-control" required></textarea>
                             </div>
                              <div class="col-sm-6 mt-1">
                                <label for="cedula">Porcentaje de tarea</label>
                                  <input type="text" class="form-control" name="porcentaje" required>
                             </div>
                             <div class="col-sm-6 mt-1">
                                 <label for="estado_tarea">Estado de la tarea</label>
                                 <select name="estado_tarea" id="" class="form-control">
                                     <option value="4">Sin asignar</option>
                                     <option value="3">Asignado</option>
                                     <option value="2">Sin realizar</option>
                                     <option value="1">Realizado</option>
                                 </select>
                             </div>
                             <div class="col-sm-6 mt-1">
                                <label for="prioridad_tarea">Prioridad de la tarea</label>
                                <select name="prioridad_tarea" id="" class="form-control">
                                    <option value="3">Alta</option>
                                    <option value="2">Media</option>
                                    <option value="1">Baja</option>
                                </select>
                            </div>
                            <div class="col-sm-6 mt-1">
                                <label for="personal_id">Empleado asignado</label>
                                <select name="personal_id" id="" class="form-control">
                                    @php
                                        $empleados = Modules\Personal\Entities\Personal::get();
                                    @endphp
                                    <option value="">Seleccione</option>
                                    @foreach ($empleados as $item)
                                       <option value="{{ $item->id }}">{{ $item->name .' '. $item->lastname }}</option>
                                    @endforeach
                                </select>
                            </div>

                             <div class="col-sm-6 mt-1">
                                 <label for="status">Fecha de inicio</label>
                                <input type="date" name="fecha_inicio" class="form-control"
                                 value="{{ date('Y-m-d') }}">
                             </div>
                             <div class="col-sm-6 mt-1">
                                <label for="status">Fecha fin de la tarea</label>
                               <input type="date" name="fecha_fin" class="form-control"
                                value="{{ date('Y-m-d') }}">
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

