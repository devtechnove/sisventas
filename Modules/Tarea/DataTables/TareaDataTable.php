<?php

namespace Modules\Personal\DataTables;


use Modules\Tarea\Entities\Tarea;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TareaDataTable extends DataTable
{

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('personal', function ($data) {
                return view('tarea::partials.personal', [
                    'personal' => $data->getRoleNames()
                ]);
            })
            ->addColumn('action', function ($data) {
                return view('tarea::partials.actions', compact('data'));
            })
            ->addColumn('estado_tarea', function ($data) {
                if ($data->estado_tarea == 1)
                {
                    $html = '<span class="badge badge-success">Finalizado</span>';
                }
                elseif ($data->estado_tarea == 2)
                {
                $html = '<span class="badge badge-warning">Sin Iniciar</span>';
                }
                else
                {
                    $html = '<span class="badge badge-danger">Sin Asignar</span>';
                }

                return $html;
            })
            ->rawColumns(['estado_tarea']);
    }

    public function query(Tarea $model) {
        return $model->newQuery();
    }

    public function html() {
        return $this->builder()
            ->setTableId('tareas-table')
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
            Column::make('titulo')
                ->className('text-center align-middle'),

            Column::make('porcentaje')
                ->className('text-center align-middle'),

            Column::make('fecha_inicio')
                ->className('text-center align-middle'),

             Column::make('fecha_fin')
                ->className('text-center align-middle'),

             Column::computed('estado_tarea')
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
        return 'Tareas_' . date('YmdHis');
    }
}
