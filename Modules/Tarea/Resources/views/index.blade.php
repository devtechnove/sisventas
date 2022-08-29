@extends('layouts.app')

@section('title', 'TAREAS')
@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Listado general</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h4>Listado general de tareas</h4>
                   @can('create_tarea')
                    <a href="{{ route('tarea.create') }}" 
                      class="btn btn-relief-primary">Nueva tarea
                    </a>
                   @endcan
                </div>
                <div class="table-responsive">
                  <table class="table table-hover table-outline mb-0" id="tableExport">
                    <thead class="thead-light">
                        <tr> 
                            <th class="text-center">Título</th>
                            <th class="text-center">Descripción</th>
                            <th class="text-center">Asignado a:</th>
                            <th class="text-center">Porcentaje de asignación</th>
                            <th class="text-center">Estado de la tarea</th>
                            <th class="text-center">Días restantes</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    @foreach ($tareas as $item)
                    <tbody>
                       <tr class="text-center">
                         <td>{{ $item->titulo }} </td>
                         <td>
                           <a href="#" 
                             data-toggle="modal" 
                             data-target="#exampleModalCenter{{ $item->id }}">
                            @if(strlen($item->descripcion) > 28)
                            {{ substr($item->descripcion, 0, 28) . "..."}}
                            @else
                                {{ $item->descripcion }}
                            @endif
                           </a>
                         </td>
                         <td>
                            {{  $item->personal->name .' '. $item->personal->lastname }}
                         </td>
                         <td>
                            @if ($item->porcentaje == '100')
                            <div class="progress progress-bar-success">
                                <div class="progress-bar" 
                                     role="progressbar" 
                                     aria-valuenow="{{ $item->porcentaje }}" 
                                     aria-valuemin="{{ $item->porcentaje }}" 
                                     aria-valuemax="100" 
                                     style="width: {{ $item->porcentaje }}%">
                                     {{ $item->porcentaje }}%
                                </div>
                            </div>
                            @else
                            <div class="progress progress-bar-primary">
                                <div class="progress-bar" 
                                     role="progressbar" 
                                     aria-valuenow="{{ $item->porcentaje }}" 
                                     aria-valuemin="{{ $item->porcentaje }}" 
                                     aria-valuemax="100" 
                                     style="width: {{ $item->porcentaje }}%">
                                     {{ $item->porcentaje }}%
                                </div>
                            </div>
                            @endif
                         </td>
                         <td>
                            @if ($item->estado_tarea == 1)
                                <span class="badge bg-success">Realizado</span>
                            @elseif($item->estado_tarea == 2)
                                <span class="badge bg-warning">Sin realizar</span>
                            @elseif($item->estado_tarea == 3)
                                <span class="badge bg-info">Asignado</span>
                            @elseif($item->estado_tarea == 4)
                                <span class="badge bg-danger">Por asignar</span>
                            @elseif($item->estado_tarea == 5)
                                <span class="badge bg-danger">Diseñado</span>
                            @else
                                 <span class="badge bg-danger">Por aprobación de diseño</span>
                            @endif
                         </td>
                         <td>
                         <?php
                            $hoy = time();
                            $fecha_vencimiento = strtotime($item->fecha_fin);
                            $date_diff = $fecha_vencimiento - $hoy;
                            $dias_de_atraso = round($date_diff / (60 * 60 * 24))*-1;
                           ?>
                           @if($dias_de_atraso == 0 && $item->estado_tarea == 100)
                           <span class="badge bg-success">Tarea finalizada</span>
                           @elseif($dias_de_atraso > 0)
                           <span class="badge bg-warning"> {{ $dias_de_atraso }}</span>
                           
                           @elseif($dias_de_atraso > -7)
                           <span class="badge bg-danger"> {{ $dias_de_atraso }}</span>
                          
                           @endif
                         </td>
                         <td>
                            <div class="btn-group">
                                @can('edit_tarea')
                                    <a href="{{ route('tarea.edit',$item->id) }}"
                                    class="btn btn-relief-primary">
                                     <i class="mdi mdi-pencil"></i>
                                 </a> 
                                @endcan
                               
                                 @can('delete_tarea')
                                    <button id="delete" class="btn btn-relief-danger btn-sm" onclick="
                                        event.preventDefault();
                                        if (confirm('¿Estás seguro (a)? Los datos se eliminarán permanentemente!')) {
                                        document.getElementById('destroy{{ $item->id }}').submit()
                                        }
                                        ">
                                        <i class="bi bi-trash"></i>
                                        <form id="destroy{{ $item->id }}" 
                                            class="d-none" 
                                            action="{{ route('tarea.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </button>
                                @endcan
                            </div>
                         </td>
                      </tr>
                    </tbody>
                    <div class="modal fade" id="exampleModalCenter{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Detalle de la tarea asignada.</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        {{ $item->descripcion }}
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" 
                                            class="btn btn-primary" 
                                            data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
