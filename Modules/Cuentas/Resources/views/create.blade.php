@extends('layouts.app')

@section('title', 'CUENTAS')
@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">CUENTAS</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Registro de cuenta</h3>
                    </div>
                    <form action="{{ route('cuentas.store') }}" autocomplete="off" method="POST">
                         @csrf
                        <div class="card-body">
                      <div class="row">
                         @php
                          $monedas  =  \DB::table('currencies')
                          ->where('empresa_id',\Auth::user()->empresa_id)
                          ->pluck('currency_name','id');
                         @endphp
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="register-email" class="form-label">Titulo de la cuenta</label>
                                <input type="text" class="form-control @error('nb_nombre') is-invalid @enderror" id="register-nb_nombre" name="nb_nombre" placeholder="Banco de Venezuela C.A" aria-describedby="register-nb_nombre" tabindex="2" value="{{ old('nb_nombre') }}" />
                                @error('nb_nombre')
                                  <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                  </span>
                                @enderror
                             </div>
                         </div>
                           <div class="col-sm-4">
                              <label for="name">Fecha de apertura de la cuenta</label>
                              <input type="date" class="form-control" name="fe_apertura" required value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                          </div>
                          <div class="col-sm-4">

                              <div class="form-group">
                                <label for="register-email" class="form-label">Número de cuenta</label>
                                <input type="text" class="form-control @error('nu_cuenta') is-invalid @enderror" id="register-nu_cuenta" name="nu_cuenta" placeholder="N° de la cuenta" aria-describedby="register-nu_cuenta" tabindex="2" value="{{ old('nu_cuenta') }}" />
                                @error('nu_cuenta')
                                  <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                  </span>
                                @enderror
                             </div>
                          </div>
                          <div class="col-sm-4 mt-1">
                             <label for="nu_contacto">Moneda principal de la cuenta</label>
                                {!! Form::select('moneda_id', $monedas, null, [
                             'class' => 'form-control','placeholder' =>'Seleccione']) !!}
                          </div>
                          <div class="col-sm-4 mt-1">
                                <div class="form-group">
                                <label for="register-email" class="form-label">Saldo de apertura</label>
                                <input type="text" class="form-control @error('saldo_apertura') is-invalid @enderror" id="register-saldo_apertura" name="saldo_apertura" placeholder="N° de la cuenta" aria-describedby="register-saldo_apertura" tabindex="2" value="{{ old('saldo_apertura') }}" />
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
                     <div class="col-sm-4 mt-1">
                        <label for="nu_contacto">Estado de la cuenta</label>
                      {!! Form::select('is_active', $estados, null, [
                         'class' => 'form-control','placeholder' =>'Seleccione']) !!}
                      </div>
                          <div class="col-sm-12 mt-1">
                            <div class="form-group">
                                <label for="register-email" class="form-label">Nota</label>
                                <textarea type="text" class="form-control @error('tx_nota') is-invalid @enderror" id="register-tx_nota" name="tx_nota" placeholder="Contacto de la empresa" aria-describedby="register-tx_nota" tabindex="2" value="{{ old('tx_nota') }}" cols="30" rows="5">
                                </textarea>
                                @error('tx_nota')
                                  <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                  </span>
                                @enderror
                             </div>
                         </div>
                       </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-relief-primary">Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')

@endpush



