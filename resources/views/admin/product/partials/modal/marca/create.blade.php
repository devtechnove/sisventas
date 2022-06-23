<div class="modal fade" id="formMarca" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Registro de nueva marca</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          {!! Form::open(['route' => 'brand.product', 'method' => 'post', 'files' => true]) !!}
    
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
              <div class="form-group">
                  <label>{{trans('file.Title')}} *</label>
                  {{Form::text('title',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type brand title...'))}}
              </div>
              <div class="form-group">
                  <label>{{trans('file.Image')}}</label>
                  {{Form::file('image', array('class' => 'form-control'))}}
              </div>                
             
          </div>
          <div class="modal-footer">
             <div class="form-group">       
                <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
              </div>
          </div>
          {{ Form::close() }}
      </div>
    </div>
</div>
