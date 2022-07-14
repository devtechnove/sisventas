@extends('layouts.app')

@section('title', 'Usuarios')
@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            Nuevo Usuario <i class="bi bi-plus"></i>
                        </a>

                        <hr>

                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
@endpush
