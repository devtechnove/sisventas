@extends('layouts.app')
@section('content')
@php
    $suma=0;
@endphp
 @foreach ($venta as $vent)
@php
  $suma+=$vent->total_amount;
@endphp             
@endforeach

<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div id="ui-view"></div>
            <div>
                
                <div class="row" id="contenido" style="display:none">
                    @if(Session::has('warning'))
                        <div class="col-lg-12">
                            <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                                {{Session::get('warning')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif 
                    <form action="{{route('store_cerrar_caja.contabilidad',$caja->id)}}" method="POST">

                        {{ csrf_field() }}
                        @method('PATCH')
    
                        <div class="row">
                    
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <input type="hidden" name="monto" id="monto" value="0">
                                <div class="card">
                                    <div class="card-header centrar">
                                        Cierre de bolso
                                    </div>
                                    <div class="card-body">
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
                                                    <input type="hidden" name="denominacion[]" value="{{$item->denominacion}}">
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
                                        Monto: $<span id="total">0.00 </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-12 col-md-7 col-sm-12">
                                       <div class="row">
                                           <div class="col-lg-6 col-md-12">
                                                <div class="card overflow-hidden">
                                                    <div class="card-body ">
                                                      
                                                        <div>
                                                            <div class="text-value text-primary"><span id="total">{{$caja->monto}}</span> USD</div>
                                                            <div class="text-muted text-uppercase font-weight-bold small">Monto base</div>
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                           <div class="col-lg-6 col-md-12">
                                            <div class="card overflow-hidden">
                                                <div class="card-body">
                                                      
                                                        <div>
                                                            <div class="text-value text-primary">{{$caja->hora}}</div>
                                                            <div class="text-muted text-uppercase font-weight-bold small">Hora de apertura</div>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                           </div>
    
                                       </div>
                                    </div>
                                   
                                    <div class="col-lg-12 col-md-7 col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12 form-group">
                                                       
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                              <div class="col-lg-4 hidden-md-down">
                                                                <img src="{{asset('images/perfiles/5e960001ba952.png')}}" style="width:100%">
                                                            </div>
                                                            <div class="col-lg-8 col-md-12">
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
                                                                            <td><b>Fecha de apertura</b></td>
                                                                            <td>{{$fecha}}</td>
                                                                        </tr>
                                                                       <tr>
                                                                            <td><b>Total en caja</b></td>
                                                                            <td>${{$suma}}</td>
                                                                        </tr>
                                                                         
                                            
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                           
                                                            <div class="col-lg-12">
                                                                <hr>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="chk-c">
                                                                    <label class="form-check-label" for="chk-c">Confirmar el cierre correcto de la caja</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                             <input type="hidden" name="total_cierre" value="{{$suma}}">
                                            <div class="card-footer">
                                                <button type="submit" id="btnsub" disabled class="btn btn-download btn-sm" style="background-color: #69e781;">
                                                    Cerrar caja
                                                </button>
                                            </div>
                                        </div>
                                    </div>
    
                                  
                                </div>
                                
                            </div>
              
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </main>
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

        $(document).ready(function() {
        $('.mdb-select').materialSelect();
        });

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
