@extends('layouts.app')
@section('title', 'Categorías')
@section('content')
 <div class="page-content">
  <nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-style1">
    <li class="breadcrumb-item">
      <a href="/"><i class="fas fa-home"></i> Inicio</a>
    </li>
    <li class="breadcrumb-item">
      <a href="javascript:void(0);"> <i class="fas fa-store-alt"></i> Productos</a>
    </li>
     <li class="breadcrumb-item">
      <a href="javascript:void(0);"> <i class="fas fa-lock"></i> Categorías</a>
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
                  <span>Categorías registrados</span>
                  <div class="d-flex align-items-end mt-2">
                    <h4 class="mb-0 me-2">{{\App\Models\Categoria::count() }}</h4>
                   {{--  <small class="text-success">(+29%)</small> --}}
                  </div>
                  <small>Total general de categorías</small>
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
                  <span>Categorías inactivos</span>
                  <div class="d-flex align-items-end mt-2">
                    <h4 class="mb-0 me-2">{{ \App\Models\Categoria::where('status',0)->count() }}</h4>
                    {{-- <small class="text-success">(+18%)</small> --}}
                  </div>
                  <small>Total general de categorías</small>
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
                  <span>Categorías activos</span>
                  <div class="d-flex align-items-end mt-2">
                    <h4 class="mb-0 me-2">{{ \App\Models\Categoria::where('status',1)->count() }}</h4>
                    {{-- <small class="text-danger">(-14%)</small> --}}
                  </div>
                  <small>Total general de categorías</small>
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
          <div class="col-sm-12 col-xl-12">
            <div class="row">
             <div class="col-sm-4">
                <div class="btn-group">
                <a class="btn btn-primary btn-md mb-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser" aria-controls="offcanvasAddUser"><span class="text-white">Nueva categoría</span></a>
              </div>
             </div>
            </div>
            <div class="card">
              
              <div class="card-body">
                
                  
             
                <div class="card-datatable table-responsive">
                  <table class="datatables-users table border-top table-sm" id="tablaModulos">
                    <thead>
                      <tr> 
                        <th>#</th>
                        <th>Nombre completo</th>
                        
                        <th>Estado</th>
                        <th></th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
       </div>
      
    </div>

  @include('admin.categorias.partials.modal.create')
  @include('admin.categorias.partials.modal.edit')  


@endsection

@section('styles')
 <!-- gridjs css -->
 <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}">
 
@endsection

@section('scripts')
<script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="/assets/js/forms-selects.js"></script>
  <script>
    var user_id, opcion;
    opcion = 4;
    tablaModulos =  $('#tablaModulos').DataTable({ 
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
        
          
         responsive:false,
         lengthChange: true,

    "ajax":{            
        "url": "{{ url('categorias') }}", 
        "method": 'GET', //usamos el metodo POST
        "dataSrc":""
    },
    "columns":[
        {"data": "id"},
        {"data": "descripcion"},
               
        {
         "data": "status",
            render:function(data, type, row)
            {
             if (data == 1)
             {
               return '<div class="text-center badge bg-success">Activo</div>';
             } 
             else
             {
              return '<div class="text-center badge bg-danger">Inactivo</div>';
             }           
             
             
            },
        },
        
        {"defaultContent": " <div class='btn-group'><button class='btn btn-primary btn-md btn-circle btnEditar'><i class='mdi mdi-pencil'></i></button><button class='btn btn-danger btn-md btn-circle btnBorrar'><i class='mdi mdi-delete'></i></button></div>"}
    ]
});
    var fila; //captura la fila, para editar o eliminar
//Editar        
$(document).on("click", ".btnEditar", function(){           
    opcion = 2;//editar
    fila = $(this).closest("tr");   
    user_id  = parseInt(fila.find('td:eq(0)').text()); //capturo el ID               
    nombre   = fila.find('td:eq(1)').text();
    usuario  = fila.find('td:eq(2)').text();
    if (usuario == 'Activo') {
       usuario  = 1;
    }
    else
    {
      usuario  = 0;
    }
    emailInput  = fila.find('td:eq(3)').text();
    //status = parseInt(fila.find('td:eq(4)').text());
    console.log(status);
    $("#nombreusuario").val(nombre);
    $("#status_permission").val(usuario);
    $("#emailInput").val(emailInput);
    $(".modal-title").text("Edición de Permiso");   
    $('#ModulosEdit').modal('show');       
});
var fila; //captura la fila, para editar o eliminar
//submit para el Alta y Actualización
$('#main-form').submit(function(e){                        
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    name = $.trim($('#nombreusuario').val());    
    last_name = $.trim($('#apellido').val());
    status = $.trim($('#status').val());
    username = $.trim($('#usuario').val());
    codigo = $.trim($('#txtCodigo').val());  
    var data = $('#main-form').serialize();        
    $('#ajax-icon').removeClass('far fa-save').addClass('fas fa-spin fa-sync-alt');             
    $.ajax({
         url: "/categoria/" + user_id,
          headers: {'X-CSRF-TOKEN': $('#main-form #_token').val()},
          type: "PUT",
          datatype:"json",  
          cache: false,  
          data:  data, 
        success: function (response) {
          var json = $.parseJSON(response);
          if(json.success){
            $('#main-form #edit-button').removeClass('hide');
            tablaModulos.ajax.reload(null, false);
            Swal.fire({
              title:'¡Bien hecho!',
              text:'Datos ingresados',
              icon:"success",
              customClass:{confirmButton:"btn btn-primary"},
              buttonsStyling:!1
            })
          }
        },error: function (data) {
          var errors = data.responseJSON;
          $.each( errors.errors, function( key, value ) {
            toastr.error(value);
            return false;
          });
          //$('input').iCheck('enable');
          $('#main-form input, #main-form button').removeAttr('disabled');
          $('#ajax-icon').removeClass('fas fa-spin fa-sync-alt').addClass('far fa-save');
        }
     });        
    $('#ModulosEdit').modal('hide');                                
});
</script>
  <script>
    $('#edit-button').hide();
     $('#usuarios-form').on('submit', function (e) {
      var isValid = $('#usuarios-form').valid();
      e.preventDefault();                        
  
       if (isValid) {
         var data = $('#usuarios-form').serialize();
        //$('input').iCheck('disable');
        //$('#usuarios-form input, #usuarios-form button').attr('disabled','true');
        $('#ajax-icon').removeClass('far fa-save').addClass('fas fa-spin fa-sync-alt');
       
            $.ajax({
              url: $('#usuarios-form #_url').val(),
              headers: {'X-CSRF-TOKEN': $('#usuarios-form #_token').val()},
              type: 'POST',
              cache: false,
              data: data,
              success: function (response) {
                var json = $.parseJSON(response);
                if(json.success){
                  $('#usuarios-form #submit').hide();
                  $('#usuarios-form #edit-button').attr('href', $('#usuarios-form #_url').val() + '/' + json.user_id + '/edit');
                  $('#usuarios-form #edit-button').removeClass('hide');
                  tablaModulos.ajax.reload(null, false);
                  var timerInterval;
                  Swal.fire({
                       title:'¡Bien hecho!',
                      text:'Datos ingresados',
                      icon:"success",
                      customClass:{confirmButton:"btn btn-primary"},
                      buttonsStyling:!1
                    })
                  
                  
               }
              },error: function (data) {
                var errors = data.responseJSON;
                $.each( errors.errors, function( key, value ) {
                  toastr.error(value);
                  return false;
                });
                //$('input').iCheck('enable');
                $('#formModulos input, #main-form button').removeAttr('disabled');
                $('#ajax-icon').removeClass('fas fa-spin fa-sync-alt').addClass('far fa-save');
              }
           });
       
      
       }
       else
       {
         return false;
       }
    });
  </script>
  <script>
   $(document).on("click", ".btnBorrar", function(e){
    e.preventDefault();
    fila = $(this);           
    user_id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;   
    opcion = 3; //eliminar        
    Swal.fire({
        title: '¿Estás seguro(a)?',
        text: "¡Si confirmas no habrá marcha atrás!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '¡Eliminar!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false
      }).then(function (result) {
        if (result.value) {
        $.ajax({
          url: "/categoria/"+user_id+'/delete' ,
          type: "GET",
          datatype:"json",    
          
          success: function() {
              tablaModulos.row(fila.parents('tr')).remove().draw();  
               var timerInterval;
                  Swal.fire({
                       title:'¡Bien hecho!',
                      text:'Datos eliminados',
                      icon:"success",
                      customClass:{confirmButton:"btn btn-primary"},
                      buttonsStyling:!1
                    }).then(result => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                      console.log('I was closed by the timer');
                    }
                  });         
           }
        }); 
         
        }
      });        
    
 });
  </script>
@endsection