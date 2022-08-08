 <!-- Modal -->
<div class="modal fade" id="exampleModalCenter{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Vertically Centered</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

               <div class="modal-body">
                 {!! Form::model($item, ['route' => ['cuentas.update',$item->id],'method' => 'PUT','enctype' =>'multipart/form-data']) !!}
                   <div class="row">
                         @php
                          $monedas  =  \DB::table('currencies')->pluck('currency_name','id');
                         @endphp
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="register-email" class="form-label">Titulo de la cuenta</label>

                                {!! Form::text('nb_nombre',null,['class'=>'form-control', 'required' => 'required','autocomplete' =>'off']) !!}
                                @error('nb_nombre')
                                  <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                  </span>
                                @enderror
                             </div>
                         </div>
                           <div class="col-sm-6">
                              <label for="name">Fecha de apertura de la cuenta</label>
                              <input type="date" class="form-control" name="fe_apertura" required value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                          </div>
                          <div class="col-sm-6">

                              <div class="form-group">
                                <label for="register-email" class="form-label">Número de cuenta</label>
                                {!! Form::text('nu_cuenta',null,['class'=>'form-control', 'required' => 'required','autocomplete' =>'off']) !!}
                                @error('nu_cuenta')
                                  <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                  </span>
                                @enderror
                             </div>
                          </div>
                          <div class="col-sm-6 mt-1">
                             <label for="nu_contacto">Moneda principal de la cuenta</label>
                                {!! Form::select('moneda_id', $monedas, null, [
                             'class' => 'form-control','placeholder' =>'Seleccione']) !!}
                          </div>
                          <div class="col-sm-6 mt-1">
                                <div class="form-group">
                                <label for="register-email" class="form-label">Saldo de apertura</label>
                                {!! Form::text('saldo_apertura',null,['class'=>'form-control', 'required' => 'required','autocomplete' =>'off']) !!}
                                @error('saldo_apertura')
                                  <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                  </span>
                                @enderror
                             </div>
                          </div>
                            @php
                        $estados  =  [1 => 'Activo' ,0 => 'Inactivo'];
                    @endphp
                     <div class="col-sm-6 mt-1">
                        <label for="nu_contacto">Estado de la cuenta</label>
                      {!! Form::select('is_active', $estados, null, [
                         'class' => 'form-control','placeholder' =>'Seleccione']) !!}
                      </div>
                          <div class="col-sm-12 mt-1">
                            <div class="form-group">
                                <label for="register-email" class="form-label">Nota</label>
                                {!! Form::textarea('tx_nota',null,['class'=>'form-control', 'required' => 'required','autocomplete' =>'off']) !!}
                                @error('tx_nota')
                                  <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                  </span>
                                @enderror
                             </div>
                         </div>
                       </div>
                    </div>
                        <div class="modal-footer">
                 <button type="submit" class="btn btn-primary" >Accept</button>
              </div>
                  {!! Form::close()!!}
              </div>
            </div>
        </div>
