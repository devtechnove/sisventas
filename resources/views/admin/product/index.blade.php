@extends('layouts.app')
 @section('content')
@if(session()->has('create_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('create_message') }}</div>
@endif
@if(session()->has('edit_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div>
@endif
@if(session()->has('import_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('import_message') }}</div>
@endif
@if(session()->has('not_permitted'))
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
@if(session()->has('message'))
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
@endif

<div class="page-content">
   <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                  <span>Productos registrados</span>
                  <div class="d-flex align-items-end mt-2">
                    <h4 class="mb-0 me-2">{{\App\Models\Product::count() }}</h4>
                   {{--  <small class="text-success">(+29%)</small> --}}
                  </div>
                  <small>Total general de productos</small>
                </div>
                <span class="badge bg-label-primary rounded p-2">
                  <i class="fas fa-credit-card bx-sm"></i>
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
                  <span>Productos inactivos</span>
                  <div class="d-flex align-items-end mt-2">
                    <h4 class="mb-0 me-2">{{ \App\Models\Product::where('is_active',0)->count() }}</h4>
                    {{-- <small class="text-success">(+18%)</small> --}}
                  </div>
                  <small>Total general de productos</small>
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
                  <span>Productos activos</span>
                  <div class="d-flex align-items-end mt-2">
                    <h4 class="mb-0 me-2">{{ \App\Models\Product::where('is_active',1)->count() }}</h4>
                    {{-- <small class="text-danger">(-14%)</small> --}}
                  </div>
                  <small>Total general de productos</small>
                </div>
                <span class="badge bg-label-success rounded p-2">
                  <i class="mdi mdi-store bx-md"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
       </div>
  
    <div class="row g-4 mb-4">
        <div class="col-sm-12">
            <div class="row">
                <div class="btn-group">
                    <div class="col-sm-6">
                         @if(in_array("Agregar Producto", $all_permission))
                           <a href="{{route('products.create')}}" class="btn btn-info"><i class="dripicons-plus"></i> {{__('file.add_product')}}</a>
                               <a href="#" data-bs-toggle="modal" data-bs-target="#importProduct" class="btn btn-primary"><i class="dripicons-copy"></i> {{__('file.import_product')}}</a><br><br>
                         @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <b>Listado de productos</b>
                </div>
                <div class="card-body">
                     <div class="table-responsive">
                       <table id="tableExport" class="table" style="width: 100%">
                       <thead>
                        <tr>
                        
                         <th>{{trans('file.Image')}}</th>
                         <th>{{trans('file.name')}}</th>
                        <th>{{trans('file.Code')}}</th>
                        <th>{{trans('file.Brand')}}</th>
                        <th>{{trans('file.category')}}</th>
                        <th>{{trans('file.Quantity')}}</th>
                        <th>{{trans('file.Unit')}}</th>
                        <th>{{trans('file.Price')}}</th>
                        <th class="not-exported">{{trans('file.action')}}</th>
                      </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $product)
                            <tr>
                               <td><img src="{{ url('public/images/product',$product->image) }}" height="50" alt=""></td>
                               <td>{{ $product->name }}</td>
                               <td>{{ $product->code }}</td>
                               <td>{{ $product->brand->title }}</td>
                               <td>{{ $product->category->descripcion }}</td>
                               <td>{{ $product->qty }}</td>
                               <td>{{ $product->unit->unit_name }}</td>
                               <td>{{ $product->price }}</td>
                               <td></td>
                            </tr>
                             @endforeach 
                        </tbody>
                    </table>
                </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="importProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['route' => 'product.import', 'method' => 'post', 'files' => true]) !!}
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Import Product</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
           <p>{{trans('file.The correct column order is')}} (image, name*, code*, type*, brand, category*, unit_code*, cost*, price*, product_details) {{trans('file.and you must follow this')}}.</p>
           <p>{{trans('file.To display Image it must be stored in')}} public/images/product {{trans('file.directory')}}. {{trans('file.Image name must be same as product name')}}</p>
           <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('file.Upload CSV File')}} *</label>
                        {{Form::file('file', array('class' => 'form-control','required'))}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> {{trans('file.Sample File')}}</label>
                        <a href="public/sample_file/sample_products.csv" class="btn btn-info btn-block btn-md"><i class="dripicons-download"></i>  {{trans('file.Download')}}</a>
                    </div>
                </div>
           </div>
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>

<div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('Product Details')}}</h5>
          <button id="print-btn" type="button" class="btn btn-default btn-sm ml-3"><i class="dripicons-print"></i> {{trans('file.Print')}}</button>
          <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-5" id="slider-content"></div>
                <div class="col-md-5 offset-1" id="product-content"></div>
                <div class="col-md-5 mt-2" id="product-warehouse-section">
                    <h5>{{trans('file.Warehouse Quantity')}}</h5>
                    <table class="table table-bordered table-hover product-warehouse-list">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-7 mt-2" id="product-variant-warehouse-section">
                    <h5>{{trans('file.Warehouse quantity of product variants')}}</h5>
                    <table class="table table-bordered table-hover product-variant-warehouse-list">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <h5 id="combo-header"></h5>
            <table class="table table-bordered table-hover item-list">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>
@endsection

