<?php

namespace Modules\PurchasesReturn\DataTables;

use Modules\PurchasesReturn\Entities\PurchaseReturnPayment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PurchaseReturnPaymentsDataTable extends DataTable
{
    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('amount', function ($data) {
                return format_currency($data->amount);
            })
            ->addColumn('action', function ($data) {
                return view('purchasesreturn::payments.partials.actions', compact('data'));
            });
    }

    public function query(PurchaseReturnPayment $model) {
        return $model->newQuery()->byPurchaseReturn()->with('purchaseReturn');
    }

    public function html() {
        return $this->builder()
            ->setTableId('purchase-payments-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(5)
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Print'),

            );
    }

    protected function getColumns() {
        return [
            Column::make('date')
                ->title('Fecha de pago')
                ->className('align-middle text-center'),

            Column::make('reference')
                ->title('Referencia')
                ->className('align-middle text-center'),

            Column::computed('amount')
                ->title('Monto')
                ->className('align-middle text-center'),

            Column::make('payment_method')
                ->title('Método de pago')
                ->className('align-middle text-center'),

            Column::computed('action')
                ->title('Opciones')
                ->exportable(false)
                ->printable(false)
                ->className('align-middle text-center'),

            Column::make('created_at')
                ->visible(false),
        ];
    }

    protected function filename()
    {
        return 'PurchaseReturnPayments_' . date('YmdHis');
    }
}
