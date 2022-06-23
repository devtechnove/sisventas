@extends('layouts.app')
@section('title', 'ROLES')
@section('content')
<!-- start page title -->
 <div class="page-content">
  <nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-style1">
    <li class="breadcrumb-item">
      <a href="/"><i class="fas fa-home"></i> Inicio</a>
    </li>
    <li class="breadcrumb-item">
      <a href="javascript:void(0);"> <i class="fas fa-shield"></i> Seguridad</a>
    </li>
     <li class="breadcrumb-item">
      <a href="javascript:void(0);"> <i class="fas fa-lock"></i> Roles</a>
    </li>
    <li class="breadcrumb-item active">Listado general</li>
  </ol>
 </nav>
   <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                  <span>Roles registrados</span>
                  <div class="d-flex align-items-end mt-2">
                    <h4 class="mb-0 me-2">{{ Spatie\Permission\Models\Role::count() }}</h4>
                   {{--  <small class="text-success">(+29%)</small> --}}
                  </div>
                  <small>Total general de Roles</small>
                </div>
                <span class="badge bg-label-primary rounded p-2">
                  <i class="bx bx-user bx-sm"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                  <span>Roles inactivos</span>
                  <div class="d-flex align-items-end mt-2">
                    <h4 class="mb-0 me-2">{{ Spatie\Permission\Models\Role::where('status',0)->count() }}</h4>
                    {{-- <small class="text-success">(+18%)</small> --}}
                  </div>
                  <small>Total general de Roles</small>
                </div>
                <span class="badge bg-label-danger rounded p-2">
                  <i class="bx bx-user-plus bx-sm"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                  <span>Roles activos</span>
                  <div class="d-flex align-items-end mt-2">
                    <h4 class="mb-0 me-2">{{ Spatie\Permission\Models\Role::where('status',1)->count() }}</h4>
                    {{-- <small class="text-danger">(-14%)</small> --}}
                  </div>
                  <small>Total general de Roles</small>
                </div>
                <span class="badge bg-label-success rounded p-2">
                  <i class="bx bx-group bx-sm"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
       </div>
   <div class="row">
      <div class="col-md-12">
        <div class="card card-line-primary">
          <div class="card-header card-header-primary">
           
            <p class="card-category">
              @can('Agregar Roles')
            <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="zmdi zmdi-plus fa-1x"></i> Nuevo role</a>
            @endcan
            </p>
          </div>
          <div class="card-body">
          
            <div class="table-responsive">
              <table id="tableExport" class="table table-sm table-hover table-outline mb-0" >
                <thead class="text-primary">
                  <th width="200"> ID </th>
                  <th> Nombre </th>
                  {{-- <th> Guard </th> --}}
                 
                  <th> Permisos </th>
                  <th class="text-right"> Acciones </th>
                </thead>
                <tbody>
                  @forelse ($roles as $role)
                  <tr>
                    <td width="200">{{ $role->id }}</td>
                    <td width="200" >{{ $role->name }}</td>
                    {{--<td>{{ $role->guard_name }}</td>
                     <td class="text-primary">{{ $role->created_at->toFormattedDateString() }}</td> --}}
                    <td>
                      @forelse ($role->permissions as $permission)
                          <span class="badge bg-info">{{ $permission->name }}</span>
                      @empty
                          <span class="badge bg-danger">Sin permisos asignados</span>
                      @endforelse
                    </td>
                    <td class="td-actions text-cente">
                  
                      <div class="dropdown">
                        <a href="#" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cog"></i> Opciones
                        </a>
                        <div class="dropdown-menu">
                           
                          @can('Editar Roles')
                            <a href="{{ route('roles.edit', $role->id) }}" class="dropdown-item"> <i
                                class="mdi mdi-pencil"></i> Modificar registro </a>
                          @endcan
                          <div role="separator" class="dropdown-divider"></div>
                          @can('Eliminar Roles')
                            <form action="{{ route('roles.destroy', $role->id) }}" method="post"
                              onsubmit="return confirm('areYouSure')" style="display: inline-block;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" rel="tooltip" class="dropdown-item">
                                <i class="mdi mdi-delete"></i>
                                Eliminar registros
                              </button>
                            </form>
                          @endcan
                        </div>
                    </div>
                    </td>
                  </tr>
                  @empty
                  
                  @endforelse
                </tbody>
              </table>
              {{-- {{ $users->links() }} --}}
            </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>

   
@endsection
@section('scripts')
   <script>
      tablaModulos = $('#tableExport').DataTable({  
       language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
            },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
        },
       
         responsive:true,
         lengthChange: true,
        
      });
    </script>
@endsection

