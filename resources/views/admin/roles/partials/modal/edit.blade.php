
<div class="modal fade" id="ModulosEdit" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog modal-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Grid Modals</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="main-form" >
                 
                     <input type="hidden" id="_token" value="{{ csrf_token() }}">
                    <div class="row g-3">
                        <div class="col-xxl-12">
                            <div>
                                <label for="name" class="form-label">Descripción</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nombre del módulo"  id="nombreusuario" aria-describedby="register-name" tabindex="1" autofocus value="{{ old('name') }}" />
                            </div>
                        </div><!--end col-->
                     
                       
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                
                                <button type="submit" class="btn btn-primary float-right" id="boton">
                         <i class="float-left far fa-save text-white" id="ajax-icon"></i> <span class="text-white ml-1">{{ __('Guardar datos') }}</span>
                         </button>   
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>