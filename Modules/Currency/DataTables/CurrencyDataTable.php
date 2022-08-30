<?php

namespace Modules\Currency\DataTables;

use Modules\Currency\Entities\Currency;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CurrencyDataTable extends DataTable
{

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)

            ->addColumn('action', function ($data) {
                return view('currency::partials.actions', compact('data'));
            })
             ->addColumn('principal', function ($data) {
                if ($data->principal) {
                    $html = '<span class="badge badge-success">Activo</span>';
                } else {
                    $html = '<span class="badge badge-danger">Inactivo</span>';
                }

                return $html;
            })
              ->rawColumns(['principal']);
    }

    public function query(Currency $model) {
        return $model->where('empresa_id',\Auth::user()->empresa_id)->newQuery();
    }

    public function html() {
        return $this->builder()
            ->setTableId('currency-table')
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
            Column::make('currency_name')
                ->className('text-center align-middle'),

            Column::make('code')
                ->className('text-center align-middle'),

            Column::make('symbol')
                ->className('text-center align-middle'),

            Column::make('thousand_separator')
                ->className('text-center align-middle'),

            Column::make('decimal_separator')
                ->className('text-center align-middle'),

            Column::make('principal')
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
        return 'Currency_' . date('YmdHis');
    }
}
