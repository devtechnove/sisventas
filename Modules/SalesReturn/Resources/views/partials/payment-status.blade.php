@if ($data->payment_status == 'Parcial')
    <span class="badge badge-warning">
        {{ $data->payment_status }}
    </span>
@elseif ($data->payment_status == 'Pagado')
    <span class="badge badge-success">
        {{ $data->payment_status }}
    </span>
@else
    <span class="badge badge-danger">
        {{ $data->payment_status }}
    </span>
@endif
