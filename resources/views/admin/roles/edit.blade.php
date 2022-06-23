@extends('layouts.app')
@section('title', 'ROLES')
@section('content')
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
      <a href="/roles"> <i class="fas fa-lock"></i> Listado general</a>
    </li>
    <li class="breadcrumb-item active">Modificación de role</li>
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
    
         <form role="form" id="main-form" autocomplete="off" class="form-horizontal">
            <input type="hidden" id="_url" value="{{ route('roles.update', $role->id) }}">
            <input type="hidden" id="_token" value="{{ csrf_token() }}">   
          <div class="card card-line-primary">
            <!--Header-->
            <div class="card-header card-header-primary">
              <h2 class="card-title">Editar role</h2>
             
            </div>
            <!--End header-->
            <!--Body-->
            <div class="card-body">
              <div class="row">
                <label for="name" class="col-sm-2 col-form-label">Nombre del rol</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="name" value="{{ old('name', $role->name) }}" autocomplete="off" autofocus>
                </div>
              </div>
              <div class="row">
                <label for="name" class="col-sm-2 col-form-label">Permisos</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <div class="tab-content">
                      <div class="tab-pane active" id="profile">
                        <table class="table">
                          <tbody>
                            @foreach ($permissions as $id => $permission)
                            <tr>
                              <td>
                                <div class="checkbox icheck">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                      value="{{ $id }}" {{ $role->permissions->contains($id) ? 'checked' : '' }}>
                                    <span class="form-check-sign">
                                      <span class="check" value=""></span>
                                    </span>
                                  </label>
                                </div>
                              </td>
                              <td>
                                {{ $permission }}
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <!--End body-->
              <!--Footer--> 
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary ajax" id="submit">
                  <i id="ajax-icon" class="far fa-save"></i> Ingresar
                </button>
              </div>
            </div>
            <!--End footer-->
          </form>
        </div>
      </div>
  </div>


@endsection
@section('styles')
 <!-- gridjs css -->
 <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}">
 
@endsection
@section('scripts')
  <script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
  <script>
    $(document).ready(function(){

  $('#main-form').submit(function(){

        $('.missing_alert').css('display', 'none');

        if ($('#main-form #name').val() === '') {
            $('#main-form #name_alert').text('Ingrese nombre de role').show();
            $('#main-form #name').addClass('is-invalid');
            $('#main-form #name').focus();
            return false;
        }


        var data = $('#main-form').serialize();
        
      
        $('#ajax-icon').removeClass('fa fa-save').addClass('spinner-border spinner-border-sm');

      
            $.ajax({
              url: $('#main-form #_url').val(),
              headers: {'X-CSRF-TOKEN': $('#main-form #_token').val()},
              type: 'PUT',
              cache: false,
              data: data,
              success: function (response) {
                var json = $.parseJSON(response);
                if(json.success){
                  
                  $('#ajax-icon').removeClass('spinner-border spinner-border-sm').addClass('fa fa-save');
                  var timerInterval;
                  Swal.fire({
                    title: '¡Datos ingresados!',
                    icon: 'success',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                      Swal.showLoading();
                      timerInterval = setInterval(() => {
                        const content = Swal.getHtmlContainer();
                        if (content) {
                          const b = content.querySelector('b');
                          if (b) {
                            b.textContent = Swal.getTimerLeft();
                          }
                        }
                      }, 100);
                    },
                    willClose: () => {
                      clearInterval(timerInterval);
                    }
                  }).then(result => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                      console.log('I was closed by the timer');
                    }
                  });
                }
              },error: function (data) {
                var errors = data.responseJSON;
                console.log(errors);
                $.each( errors.errors, function( key, value ) {
                  toastr.error(value);
                  return false;
                });
                $('input').iCheck('enable');
               
                $('#ajax-icon').removeClass('spinner-border spinner-border-sm').addClass('fa fa-save');
              }
           });
      

       return false;

    });
});
  </script>
@endsection 