@extends('layouts.app')

@section('title', 'Reporte de estados de cuentas')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Reporte de estados de cuentas</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <livewire:reports.estado-cuenta :cuentas="\Modules\Cuentas\Entities\Cuentas::all()"/>
    </div>
@endsection
