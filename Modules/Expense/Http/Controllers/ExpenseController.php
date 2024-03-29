<?php

namespace Modules\Expense\Http\Controllers;

use Modules\Expense\DataTables\ExpensesDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Expense\Entities\Expense;
use Modules\Currency\Entities\Currency;
use Modules\Cuentas\Entities\Cuentas;
use Modules\Cuentas\Entities\MovimientoCuentas;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class ExpenseController extends Controller
{

    public function index(ExpensesDataTable $dataTable) {
        abort_if(Gate::denies('access_expenses'), 403);

        return $dataTable->render('expense::expenses.index');
    }


    public function create() {
        abort_if(Gate::denies('create_expenses'), 403);

        $moneda = Currency::where('empresa_id',\Auth::user()->empresa_id)->where('principal',true)->first();
        $cuentas = Cuentas::where('empresa_id',\Auth::user()->empresa_id)->pluck('nb_nombre','id');

        return view('expense::expenses.create',compact('moneda','cuentas'));
    }


    public function store(Request $request) {



        abort_if(Gate::denies('create_expenses'), 403);

        $request->validate([
            'date' => 'required|date',
            'reference' => 'required|string|max:255',
            'category_id' => 'required',
            'amount' => 'required|numeric|max:2147483647',
            'details' => 'nullable|string|max:1000'
        ]);

        try {
         $hora = new DateTime("now", new DateTimeZone('America/Caracas'));
        Expense::create([
            'date' => $request->date,
            'category_id' => $request->category_id,
            'empresa_id' => \Auth::user()->empresa_id,
            'mes'         => date('m'),
            'ano'         => date('Y'),
            'hora'         => $hora->format('H:i:s'),
            'amount' => $request->amount,
            'details' => $request->details,
            'cuenta_id' => $request->cuenta_id,
        ]);


            $mytime =  \Carbon\Carbon::now('America/Caracas');
            $fecha  =  $mytime->format('Y-m-d');

            $mov = new MovimientoCuentas();
            $mov->cuenta_id       = $request->cuenta_id;
            $mov->empresa_id      = \Auth::user()->empresa_id;
            $mov->fecha_emision   = $fecha;
            $mov->mes             = date('m');
            $mov->hora            = date('H:i:s');
            $mov->ano             = date('Y');
            $mov->tipo_movimiento = 'Egreso';
            $mov->credito         = '0.00';
            $mov->debito          = $request->amount;
            $mov->descripcion     = $request->details;
            $mov->save();


            $cuenta = Cuentas::find($request->cuenta_id);

            $cuenta->saldo_actual -= $request->amount;

            $cuenta->save();



        toast('Gasto creado!', 'success');
        return redirect()->route('expenses.index');

        } catch (\Exception $e) {
            dd($e);
        toast('¡Algo salió mal!', 'error');
        return redirect()->route('expenses.index');

        }



    }


    public function edit(Expense $expense) {
        abort_if(Gate::denies('edit_expenses'), 403);

        return view('expense::expenses.edit', compact('expense'));
    }


    public function update(Request $request, Expense $expense) {
        abort_if(Gate::denies('edit_expenses'), 403);

        $request->validate([
            'date' => 'required|date',
            'reference' => 'required|string|max:255',
            'category_id' => 'required',
            'amount' => 'required|numeric|max:2147483647',
            'details' => 'nullable|string|max:1000'
        ]);

        $expense->update([
            'date' => $request->date,
            'reference' => $request->reference,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'details' => $request->details
        ]);

        toast('Gasto actualizado!', 'success');

        return redirect()->route('expenses.index');
    }


    public function destroy(Expense $expense) {
        abort_if(Gate::denies('delete_expenses'), 403);

        $expense->delete();

        toast('Gasto eliminadi!', 'success');

        return redirect()->route('expenses.index');
    }
}
