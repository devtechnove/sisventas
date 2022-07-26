@extends('layouts.app')
@section('title', 'LOGINS')
@section('page_title', 'LOGINS')
@section('content')
 <div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Logins</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="mdi mdi-home"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Seguridad</a>
                    </li>
                    <li class="breadcrumb-item active">Listado de sesiones.
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
  <div class="col-md-12">
    <div class="card card-line-primary">
      <div class="card-header  ">
        <h5 >Listado de inicio de sesión</h5>

      </div>
       <!-- /.card-header -->
          <div class="card-body ">

          <table  class="table table table-striped table-responsive" style="width:100%" id="tableExport">
              <thead>
              <tr>
              <th>#</th>
               <th>Usuario</th>
              <th>Inicio</th>
              <th>Cierre</th>
              <th>IP</th>
              <th>Ciudad</th>
              <th>Cliente</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($logins as $login)
              <tr class="row{{ $login->id }}">
              <td>{{ $login->id }}</td>
              <td>{{ $login->user->name }}</td>
              <td>{{ $login->login_at  }}</td>
              <td>{{ $login->logout_at }}</td>
              <td>{{ $login->ip_address }}</td>
              <td>{{ $login->user_location }}</td>
              <td>{{ $login->user_agent }}</td>
              </tr>
              @endforeach
              </tr>
              </tbody>
          </table>
          </div>
          <!-- /.card-body -->
      </div>
  </div>




@endsection
