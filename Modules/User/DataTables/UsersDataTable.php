<?php

namespace Modules\User\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('role', function ($data) {
                return view('user::users.partials.roles', [
                    'roles' => $data->getRoleNames()
                ]);
            })
            ->addColumn('action', function ($data) {
                return view('user::users.partials.actions', compact('data'));
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    $html = '<span class="badge badge-success">Activo</span>';
                } else {
                    $html = '<span class="badge badge-danger">Inactivo</span>';
                }

                return $html;
            })
            ->addColumn('image', function ($data) {
                $url = asset('images/perfiles/'.$data->image);

                return '<img src="' . $url . '" style="width:50px;height:50px;" class="img-thumbnail rounded-circle"/>';
            })
            ->rawColumns(['image', 'status']);
    }

    public function query(User $model) {
        if (\Auth::user()->hasRole('Super Administrador')) {

            return $model->newQuery()
            ->with(['roles' => function ($query) {
                $query->select('name')->get();
            }]);
        }
        else
        {
            return $model->where('empresa_id',\Auth::user()->empresa_id)->newQuery()
            ->with(['roles' => function ($query) {
                $query->select('name')->get();
            }]);
        }
    }

    public function html() {
        return $this->builder()
            ->setTableId('users-table')
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
                    ->text('<i class="bi bi-printer-fill"></i> Print')

            );
    }

    protected function getColumns() {
        return [
            Column::computed('image')
                ->className('text-center align-middle'),

            Column::make('name')
                ->className('text-center align-middle'),

            Column::make('email')
                ->className('text-center align-middle'),

            Column::computed('role')
                ->className('text-center align-middle'),

            Column::computed('status')
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
        return 'Users_' . date('YmdHis');
    }
}
