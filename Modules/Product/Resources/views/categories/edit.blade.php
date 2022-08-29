@extends('layouts.app')

@section('title', 'CATEGORIA')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('product-categories.index') }}">Categorías</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('utils.alerts')
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('product-categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-sm-6">
                                      <div class="form-group">
                                       <label class="font-weight-bold" for="category_code">Código de categoría <span class="text-danger">*</span></label>
                                     <input class="form-control" type="text" name="category_code" required value="{{ $category->category_code }}">
                                   </div>
                                </div>
                                 <div class="col-sm-6">
                                <div class="form-group">
                                <label class="font-weight-bold" for="category_name">Nombre de categoría <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="category_name" required value="{{ $category->category_name }}">
                              </div>
                              </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Guardar <i class="bi bi-save"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

