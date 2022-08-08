<?php

namespace Modules\Cuentas\DataTables;

use Modules\Cuentas\Entities\Cuentas;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CuentasDataTable extends DataTable
{ 

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)

            ->addColumn('action', function ($data) {
                return view('Cuentas::partials.actions', compact('data'));
            });
    }

    public function query(Cuentas $model) {
        return $model->newQuery();
    }

    public function html() {
        return $this->builder()
            ->setTableId('cuentas-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                        'tr' .
                                        <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(6)
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Print'),

            );
    }

    protected function getColumns() {
        return [
            Column::make('nb_nombre')
                ->className('text-center align-middle'),

            Column::make('tipo_cuenta')
                ->className('text-center align-middle'),

            Column::make('fe_apertura')
                ->className('text-center align-middle'),

            Column::make('nu_cuenta')
                ->className('text-center align-middle'),

            Column::make('saldo_apertura')
                ->className('text-center align-middle'),



            Column::computed('action')
                ->exportable(true)
                ->printable(true)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename() {
        return 'Cuenta_' . date('YmdHis');
    }
}
