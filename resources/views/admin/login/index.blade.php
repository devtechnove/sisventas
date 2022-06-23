@extends('layouts.app')

@section('title', 'LOGINS')
@section('page_title', 'Logins')
@section('page_subtitle', 'Registros')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-style1">
    <li class="breadcrumb-item">
      <a href="/"><i class="fas fa-home"></i> Inicio</a>
    </li>
    <li class="breadcrumb-item">
      <a href="javascript:void(0);"> <i class="fas fa-shield"></i> Seguridad</a>
    </li>
    <li class="breadcrumb-item active">Listado general</li>
  </ol>
 </nav>
    <section class="page-content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Registros de logins</h3>
            </div>
            <div class="card-body">
          
                <div class="table-responsive">
                  <table id="tableExport" class="table table-sm table-hover table-outline mb-0" >
                    <thead class="text-primary">
                      <th>Usuario</th>
                        <th>Inicio</th>
                        <th>Cierre</th>
                        <th>IP</th>
                        <th>Cliente</th>
                    </thead>
                    <tbody>
                      @foreach ($logins as $login)
                    <tr>
                      <td>{{ $login->user->name }}</td>
                      <td>{{ $login->login_at  }}</td>
                      <td>{{ $login->logout_at }}</td>
                      <td>{{ $login->ip_address }}</td>
                      <td>{{ $login->user_agent }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                  {{-- {{ $users->links() }} --}}
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
   

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
