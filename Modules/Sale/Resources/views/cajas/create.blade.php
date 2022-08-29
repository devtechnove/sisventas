@extends('layouts.app')
@section('title','CAJAS')
@section('content')
@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/panel/contabilidad') }}">Listado de cajas</a>
            <li class="breadcrumb-item active"> Apertura de caja
            </li>
        </ol>
    </ol>
@endsection
            <div class="container-fluid">
             
                <div class="row " id="contenido" style="display:none !important">
                    @if(count($caja)<=0)
                       <!-- Alert With Icon start -->
               <div class="col-md-12 ">
                <div class="demo-spacing-0">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                           Esta caja es la primera del sistema, ingrese el monto total de la caja.
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>       
                  </div><br>
                <!-- Alert With Icon end -->
                    @endif 
                    @if(Session::has('warning'))
                        <div class="col-lg-12">
                             <div class="demo-spacing-0">
			                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
			                        <div class="alert-body">
			                          {{Session::get('warning')}}
			                        </div>
			                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                            <span aria-hidden="true">&times;</span>
			                        </button>
			                    </div>       
			                  </div><br>
                        </div>
                    @endif 
                    <form action="{{route('store_abrir_caja.contabilidad')}}" method="POST">

                        {{ csrf_field() }}
    
                        <div class="row">
                             <div class="col-sm-12">
                                <div class="card card-line-primary">

                                    <div class="card-body">
                                      <div class="row">
                                          <div class="col-sm-12">
                                                <label for="select_cuenta">Cuenta</label>
                                                 {!! Form::select('cuenta_id', $cuenta, null, [
                                                 'class' => 'form-control','placeholder' =>'Seleccione']) !!}
                                          </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <input type="hidden" name="monto" id="monto" value="0">
                                <div class="card card-line-primary">
                                    <div class="card-header centrar">
                                        Apertura de bolso
                                    </div>
                                    @php
                                        $mon = \DB::table('currencies')->where('principal', true)->first();
                                    @endphp
                                    <div class="card-body table-responsive">
                                       <table class="table table-sm">
                                           <thead class="thead-dark">
                                               <th class="text-center">Denominación</th>
                                               <th class="text-center">Cantidad</th>
                                               <th class="text-center">Valor</th>
                                           </thead>
                                        @foreach ($deno as $key => $item)

                                            <tbody>
                                                <td class="text-center">
                                                    {{$item->denominacion}}
                                                    <input type="hidden" name="denominacion[]" value="{{$item->denominacion}}"> {{ $mon->code }}
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" data-cantidad="{{$key}}" class="cantidad" min="0" id="cantidad-{{$key}}" value="0" style="width:100%;text-align: center;" name="cantidad[]">
                                                </td>
                                                <td>
                                                    <input type="number" readonly id="valor-{{$key}}" value="{{$item->valor}}" style="width:100%;text-align: center;" name="valor[]">
                                                </td>
                                                <td class="display: hidden">
                                                    <input type="hidden" id="subtotal-{{$key}}" style="width:100%" value="0">
                                                </td>
                                            </tbody>


                                        @endforeach
                                       </table>
                                    </div>

                                    <div class="card-footer">
                                        Monto:<span id="total"> 0.00  {{ $mon->code }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12">

                                    <div class="col-lg-12 col-md-7 col-sm-12">
                                        <div class="card card-line-primary">
                                            <div class="card-body"> 
                                                <div class="row">
                                                    <div class="col-lg-12 form-group">
                                                       <h2 class="text-center">Datos del usuario aperturador</h2>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-4 hidden-md-down">
                                                                <img src="{{asset('images/perfiles/5e960001ba952.png')}}" style="width:100%">
                                                            </div>
                                                            <div class="col-lg-8 col-md-12 mt-4 table-responsive">
                                                                <table class="table table-sm">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><b>Nombres</b></td>
                                                                            <td>{{auth()->user()->name}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>Correo Electónico</b></td>
                                                                            <td>{{auth()->user()->email}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>Tipo de usuario</b></td>
                                                                            
                                                                                @if(auth()->user()->hasRole('Administrador'))

                                                                                <td>
                                                                                    <b>Administrador</b>
                                                                                </td>
                                                                                @else
                                                                                 <td>
                                                                                    <b>Usuario del sistema</b>
                                                                                </td>
                                                                                @endif
                                                                        
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>Fecha de apertura</b></td>
                                                                            <td>{{$fecha}}</td>
                                                                        </tr>
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                           
                                                            <div class="col-lg-12">
                                                                <hr>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="chk-c">
                                                                    <label class="form-check-label" for="chk-c">Confirmar la correcta apertura de caja</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" id="btnsub" disabled class="btn btn-primary purple darken-4 text-white form-control btn-sm">
                                                    Abrir caja
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
              
                        </div>
                    </form>
    
     
    <style>
        .select-wrapper input.select-dropdown{
        margin-bottom: 0px !important
    }
    </style>
 
</div>

@push('page_scripts')
    <script>
        window.onload = function(){
           var loader = document.getElementById('loader');
           var contenido = document.getElementById('contenido');

            contenido.style.display = 'block';
 
            $('#loader').remove();
       }
      
        var count = "<?php echo count($deno)?>";

        var total = 0.00;


        $('.cantidad').change(function(e){
         
         
            var idcantidad = $(this).attr('id');
            var identificador = $(this).attr('data-cantidad');
            
            var cantidad = document.getElementById(idcantidad).value;
            var valor = document.getElementById('valor-'+identificador).value;
            var subtotal = cantidad * valor;

            $('#subtotal-'+identificador).val(subtotal);
            
            total= 0;
            for(var i = 0; i < count; i++){
                    let sub = document.getElementById('subtotal-'+i).value;
                    console.log(sub);
                    
                    total = total + parseInt(sub);
                    console.log(total);
                    
            }
            $('#total').text(total.toFixed(2));
            $('#monto').val(total.toFixed(2));
        });

      
        
        $( '#chk-c' ).on( 'click', function() {
            if( $(this).is(':checked') ){
                $('#btnsub').prop('disabled', false);
            } else {
   
                $('#btnsub').prop('disabled', true);
            }
        });
       


    </script>
@endpush
@endsection
