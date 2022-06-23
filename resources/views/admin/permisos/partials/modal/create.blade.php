  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Nuevo permiso</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form role="form" id="usuarios-form" autocomplete="off">
        <input type="hidden" id="_url" value="{{ url('permisos') }}">
        <input type="hidden" id="_token" value="{{ csrf_token() }}">
        <div class="mb-3">
          <label class="form-label" for="add-user-fullname">Nombre completo</label>
          <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" name="name" aria-label="John Doe" />
          <span class="missing_alert text-danger" id="name_alert"></span>
        </div>
        
        
        <div class="mb-4">
          <label class="form-label" for="user-plan">Estado del permiso</label>
         <div class="form-group mt-2">
            <div class="checkbox icheck">
              <label>
                <input class="form-check-input" type="radio" name="status" value="1" checked> Activo&nbsp;&nbsp;
                <input class="form-check-input" type="radio" name="status" value="0"> Deshabilitado
              </label>
            </div>
          </div>
        </div>
         <button type="submit" class="btn btn-primary ajax" id="submit">
          <i id="ajax-icon" class="far fa-save"></i> Ingresar
        </button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
      </form>
    </div>
  </div>
</div>
