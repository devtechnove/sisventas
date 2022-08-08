<div class="btn-group">
    @can('edit_personal')
    <a href="{{ route('personal.edit', $data->id) }}" class="btn btn-relief-info btn-sm">
        <i class="bi bi-pencil"></i>
    </a>
@endcan
@can('delete_personal')
    <button id="delete" class="btn btn-relief-danger btn-sm" onclick="
        event.preventDefault();
        if (confirm('¿Estás seguro (a)? Los datos se eliminarán permanentemente!')) {
        document.getElementById('destroy{{ $data->id }}').submit()
        }
        ">
        <i class="bi bi-trash"></i>
        <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('personal.destroy', $data->id) }}" method="POST">
            @csrf
            @method('delete')
        </form>
    </button>
@endcan
</div>
