<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Cuentas\Entities\MovimientoCuentas;

class EstadoCuenta extends Component
{
     use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $start_date;
    public $end_date;
    public $cuenta_id;
    public $cuentas;


     protected $rules = [
        'start_date' => 'required|date|before:end_date',
        'end_date'   => 'required|date|after:start_date',
    ];


     public function mount($cuentas) {
        $this->cuentas = $cuentas;
        $this->start_date = today()->subDays(30)->format('Y-m-d');
        $this->end_date = today()->format('Y-m-d');
        $this->cuenta_id = '';
    }


    public function render()
    {

        $estados = MovimientoCuentas::whereDate('fecha_emision', '>=', $this->start_date)
            ->whereDate('fecha_emision', '<=', $this->end_date)
            ->when($this->cuenta_id, function ($query) {
                return $query->where('cuenta_id', $this->cuenta_id);
            })->orderBy('fecha_emision', 'desc')->paginate(10);



        return view('livewire.reports.estado-cuenta', [
            'estados' => $estados
        ]);
    }

     public function generateReport() {
        $this->validate();
        $this->render();
    }
}
