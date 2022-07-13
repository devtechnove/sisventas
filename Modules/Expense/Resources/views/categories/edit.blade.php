@extends('layouts.app')

@section('title', 'Categoría de los gastos')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('expenses.index') }}">Gastos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('expense-categories.index') }}">Categoría de los gastos</a></li>
        <li class="breadcrumb-item active">Modificación</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7">
                @include('utils.alerts')
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('expense-categories.update', $expenseCategory) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="category_name">Nombre <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="category_name" required value="{{ $expenseCategory->category_name }}">
                            </div>
                            <div class="form-group">
                                <label for="category_description">Descripción</label>
                                <textarea class="form-control" name="category_description" id="category_description" rows="5">{{ $expenseCategory->category_description }}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Actualizar <i class="bi bi-save"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

