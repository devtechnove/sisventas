@extends('layouts.app')

@section('title', 'TAREAS')
@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tarea.index') }}">Listado general</a></li>
        <li class="breadcrumb-item active">Modificar registro</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form 
                        action="{{ route('tarea.update', $tarea) }}" 
                        method="POST">
                        @csrf
                        @method('patch')
                     @csrf
                      <div class="card-body">

                        <div class="row">
                            <div class="col-sm-12 mt-1">
                                <label for="name">Título</label>
                                 <input type="text" 
                                        class="form-control" 
                                        name="titulo" 
                                        value="{{$tarea->titulo}}" 
                                        required
                                        >
                            </div>
                             <div class="col-sm-12 mt-1">
                                <label for="lastname">Descripción</label>
                                  <textarea 
                                   name="descripcion" 
                                   id="" 
                                   cols="30" 
                                   rows="5" 
                                   class="form-control" 
                                   required
                                   >
                                    {{$tarea->descripcion}}
                                  </textarea>
                             </div>
                             <div class="col-sm-6 mt-1">
                                <label for="cedula">Porcentaje de tarea</label>
                                  <input 
                                  type="text" 
                                  value=" {{$tarea->porcentaje}} "
                                  class="form-control" 
                                  name="porcentaje" 
                                  required>
                             </div> 
                             <div class="col-sm-6 mt-1">
                                 <label for="estado_tarea">Estado de la tarea</label>
                                 <select name="estado_tarea" id="" class="form-control">
                                     <option value="6" {{($tarea->estado_tarea === 6) ? 'selected' : ''}}>A la espera por aprobación</option>
                                     <option value="5" {{($tarea->estado_tarea === 5) ? 'selected' : ''}}>Diseñado</option>
                                     <option value="4" {{($tarea->estado_tarea === 4) ? 'selected' : ''}}>Por asignar</option>
                                     <option value="3" {{($tarea->estado_tarea === 3) ? 'selected' : ''}}>Asignado</option>
                                     <option value="2" {{($tarea->estado_tarea === 2) ? 'selected' : ''}}>Por realizar</option>
                                     <option value="1" {{($tarea->estado_tarea === 1) ? 'selected' : ''}}>Realizado</option>
                                 </select>
                             </div>
                            
                            <div class="col-sm-12 mt-1">
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
                                 value="{{ $tarea->fecha_inicio }}">
                             </div>
                             <div class="col-sm-6 mt-1">
                                <label for="status">Fecha fin de la tarea</label>
                               <input type="date" name="fecha_fin" class="form-control"
                                value="{{ $tarea->fecha_fin }}">
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

