@if ($data->status == 'Pendiente')
    <span class="badge badge-info">
        {{ $data->status }}
    </span>
@elseif ($data->status == 'Ordenado')
    <span class="badge badge-primary">
        {{ $data->status }}
    </span>
@else
    <span class="badge badge-success">
        {{ $data->status }}
    </span>
@endif
