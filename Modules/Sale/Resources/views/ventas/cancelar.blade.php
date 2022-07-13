<div class="modal fade" id="modal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form action="{{route('admin.cancelar_venta.venta',$item->id)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Cancelar la venta</h5>
                <button style="padding:0px" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <div class="modal-body">
            
                Al cancelar la venta, se regresaran al inventario los productos comprados.
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>&nbsp;
                <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
        </div>
    </form>
</div>