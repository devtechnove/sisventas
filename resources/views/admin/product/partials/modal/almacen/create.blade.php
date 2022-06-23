<div class="modal fade" id="formFamiliaProducto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Nuevo almacén</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
       <form id="main-form" class="mb-3" >
          <input type="hidden" id="_url" value="{{ url('productos/wharehouse/nueva') }}">
          <input type="hidden" id="_redirect" value="{{ url('/') }}">
          <input type="hidden" id="_token" value="{{ csrf_token() }}">
            <div class="modal-body">
          <div class="row">
            <div class="col mb-2">
              <label for="nameWithTitle" class="form-label">Nombre</label>
              <input type="text" id="nameWithTitle" name="name" class="form-control" placeholder="Ingrese el nombre del almacén">
              <span class="missing_alert text-danger" id="nameWithTitle_alert"></span>
            </div>

          </div>
          <div class="row g-2">
            <div class="col mb-2">
              <label for="emailWithTitle" class="form-label">Dirección</label>
              <input type="text" id="addressWithTitle" name="address" class="form-control" placeholder="xxxx@xxx.xx">
              <span class="missing_alert text-danger" id="addressWithTitle_alert"></span>
            </div>
        </div>
        <div class="row g-2">
           <div class="col mb-0">
              <label for="dobWithTitle" class="form-label">Teléfono</label>
              <input type="text" id="phoneWithTitle" name="phone" class="form-control validar" placeholder="(00) 000-000-00-00">
              <span class="missing_alert text-danger" id="phoneWithTitle_alert"></span>
            </div>
          </div>
        </div>
    
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
          <input class="btn btn-success btn-block" type="submit" name="" value="Guardar">
        </div>
      </form>
      </div>
    </div>
</div>
@section('scripts')
  
@endsection

