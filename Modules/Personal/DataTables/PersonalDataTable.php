<?php

namespace Modules\Personal\DataTables;


use Modules\Personal\Entities\Personal;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PersonalDataTable extends DataTable
{

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('personal::partials.actions', compact('data'));
            })
             ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    $html = '<span class="badge badge-success">Activo</span>';
                } else {
                    $html = '<span class="badge badge-danger">Inactivo</span>';
                }

                return $html;
            })
            ->rawColumns(['status']);
    }

    public function query(Personal $model) {
        return $model->newQuery();
    }

    public function html() {
        return $this->builder()
            ->setTableId('empleados-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                       'tr' .
                                 <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(4)
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Print'),
            );
    }

    protected function getColumns() {
        return [
            Column::make('name')
                ->className('text-center align-middle'),

            Column::make('lastname')
                ->className('text-center align-middle'),

            Column::make('cedula')
                ->className('text-center align-middle'),

             Column::make('cargo')
                ->className('text-center align-middle'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename() {
        return 'Empleados_' . date('YmdHis');
    }
}
