@extends('layouts.app')

@section('title', 'CUENTAS')
@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('cuentas.index') }}">Listado general</a></li>
        <li class="breadcrumb-item active">Ver cuenta</li>
    </ol>
@endsection

@section('content')
    <div class="c-body">
        @include('sweetalert::alert')
         <main>
           <div>
             <div class="row">
                 <div class="col-sm-12">
                     <div class="card">
                         <div class="card-header">
                             <h4>Detalle de la cuenta</h4>
                         </div>
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table table-hover table-bordered">
                                     <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">Banco</th>
                                            <th class="text-center">Fecha de apertura</th>
                                            <th class="text-center">Nro de cuenta</th>
                                            <th class="text-center">Moneda de cuenta</th>
                                            <th class="text-center">Monto de apertura</th>
                                            <th class="text-center">Monto de actual</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-center">Opciones</th>
                                        </tr>
                                    </thead>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
        </div>
    </div>
</main>


</div>
@endsection

@push('page_scripts')

    <script>

        window.onload = function(){
           var loader = document.getElementById('loader');
           var contenido = document.getElementById('contenido');

            contenido.style.display = 'block';

            $('#loader').remove();
       }
    </script>

@endpush
