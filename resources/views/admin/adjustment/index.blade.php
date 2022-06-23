@extends('layouts.app')
@section('content')
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

<div class="page-content">
     <div class="row g-4 mb-4">
        <div class="col-sm-12 col-xl-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div class="content-right">
                  <span>Ajustes de invetario elaborados</span>
                  <div class="d-flex align-items-end mt-2">
                    <h4 class="mb-0 me-2">{{\App\Models\Adjustment::count() }}</h4>
                   {{--  <small class="text-success">(+29%)</small> --}}
                  </div>
                  <small>Total general de ajustes.</small>
                </div>
                <span class="badge bg-label-success rounded p-2">
                  <i class="bx bx-user bx-sm"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
       </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6">
                    <div class="btn-group">
                     <a href="{{route('qty_adjustment.create')}}" class="btn btn-info mb-3"><i class="dripicons-plus"></i> {{trans('file.Add Adjustment')}}</a>
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Listado de ajustes</h5>
                </div>
                <div class="card-body">
     <section>
    <div class="table-responsive">
        <table id="tableExport" class="table purchase-list">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Date')}}</th>
                    <th>{{trans('file.reference')}}</th>
                    <th>{{trans('file.Warehouse')}}</th>
                    <th>{{trans('file.product')}}s</th>
                    <th>{{trans('file.Note')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lims_adjustment_all as $key=>$adjustment)
                <tr data-id="{{$adjustment->id}}">
                    <td>{{$key}}</td>
                    <td>{{ date('d-m-Y', strtotime($adjustment->created_at->toDateString())) . ' '. $adjustment->created_at->toTimeString() }}</td>
                    <td>{{ $adjustment->reference_no }}</td>
                    <?php $warehouse = DB::table('warehouses')->find($adjustment->warehouse_id) ?>
                    <td>{{ $warehouse->name }}</td>
                    <td>
                    <?php
                        $product_adjustment_data = DB::table('product_adjustments')->where('adjustment_id', $adjustment->id)->get();
                        foreach ($product_adjustment_data as $key => $product_adjustment) {
                            $product = DB::table('products')->find($product_adjustment->product_id);
                            if($key)
                                echo '<br>';
                            echo $product->name;
                         } 
                    ?>
                    </td>
                    <td>{{$adjustment->note}}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <a href="{{ url('qty_adjustment.edit', ['id' => $adjustment->id]) }}" class="btn btn-link"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}</a> 
                                </li>
                                <li class="divider"></li>
                                {{ Form::open(['route' => ['qty_adjustment.destroy', $adjustment->id], 'method' => 'DELETE'] ) }}
                                <li>
                                    <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> {{trans('file.delete')}}</button>
                                </li>
                                {{ Form::close() }}
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $("ul#product").siblings('a').attr('aria-expanded','true');
    $("ul#product").addClass("show");
    $("ul#product #adjustment-list-menu").addClass("active");

    function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }

</script>
@endsection