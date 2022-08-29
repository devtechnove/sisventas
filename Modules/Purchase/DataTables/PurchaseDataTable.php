<?php

namespace Modules\Purchase\DataTables;

use Modules\Purchase\Entities\Purchase;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PurchaseDataTable extends DataTable
{

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('total_amount', function ($data) {
                return format_currency($data->total_amount);
            })
            ->addColumn('paid_amount', function ($data) {
                return format_currency($data->paid_amount);
            })
            ->addColumn('due_amount', function ($data) {
                return format_currency($data->due_amount);
            })
            ->addColumn('status', function ($data) {
                return view('purchase::partials.status', compact('data'));
            })
            ->addColumn('payment_status', function ($data) {
                return view('purchase::partials.payment-status', compact('data'));
            })
            ->addColumn('action', function ($data) {
                return view('purchase::partials.actions', compact('data'));
            });
    }

    public function query(Purchase $model) {
        return $model->where('empresa_id',\Auth::user()->empresa_id)->newQuery();
    }

    public function html() {
        return $this->builder()
            ->setTableId('purchases-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(8)
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Imprimir'),

            );
    }

    protected function getColumns() {
        return [
            Column::make('reference')
                ->title('Referencia')
                ->className('text-center align-middle'),

            Column::make('supplier_name')
                ->title('Proveedor')
                ->className('text-center align-middle'),

            Column::computed('status')
                ->title('Estado de compra')
                ->className('text-center align-middle'),

            Column::computed('total_amount')
                ->title('Monto total')
                ->className('text-center align-middle'),

            Column::computed('paid_amount')
                ->title('Monto pagado')
                ->className('text-center align-middle'),

            Column::computed('due_amount')
                ->title('Monto de deuda')
                ->className('text-center align-middle'),

            Column::computed('payment_status')
                ->title('Estado de pago')
                ->className('text-center align-middle'),

            Column::computed('action')
                ->title('Opciones')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename() {
        return 'Purchase_' . date('YmdHis');
    }
}
