<?php

namespace Modules\Sale\Http\Controllers;

use Modules\Sale\DataTables\SalePaymentsDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Sale\Entities\Sale;
use Modules\Sale\Entities\SalePayment;
use Modules\Cuentas\Entities\MovimientoCuentas;
use Modules\Cuentas\Entities\Cuentas;

class SalePaymentsController extends Controller
{

    public function index($sale_id, SalePaymentsDataTable $dataTable) {
        abort_if(Gate::denies('access_sale_payments'), 403);

        $sale = Sale::findOrFail($sale_id);

        return $dataTable->render('sale::payments.index', compact('sale'));
    }


    public function create($sale_id) {
        abort_if(Gate::denies('access_sale_payments'), 403);

        $sale = Sale::findOrFail($sale_id);

        return view('sale::payments.create', compact('sale'));
    }


    public function store(Request $request) {
        abort_if(Gate::denies('access_sale_payments'), 403);

        $request->validate([
            'date' => 'required|date',
            'reference' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'note' => 'nullable|string|max:1000',
            'sale_id' => 'required',
            'payment_method' => 'required|string|max:255'
        ]);

        DB::transaction(function () use ($request) {
            SalePayment::create([
                'date' => $request->date,
                'idcuenta' => $request->idcuenta,
                'reference' => $request->reference,
                'amount' => $request->amount,
                'note' => $request->note,
                'sale_id' => $request->sale_id,
                'payment_method' => $request->payment_method,
                'empresa_id' => \Auth::user()->empresa_id
            ]);

            $sale = Sale::findOrFail($request->sale_id);

            $due_amount = $sale->due_amount - $request->amount;

            if ($due_amount == $sale->total_amount) {
                $payment_status = 'Sin pagar';
            } elseif ($due_amount > 0) {
                $payment_status = 'Parcial';
            } else {
                $payment_status = 'Pagado';
            }

            $mytime =  \Carbon\Carbon::now('America/Caracas');
            $fecha  =  $mytime->format('Y-m-d');

            $mov = new MovimientoCuentas();
            $mov->cuenta_id = $request->idcuenta;
            $mov->fecha_emision = $fecha;
            $mov->mes = date('m');
            $mov->hora =date('H:i:s');
            $mov->ano = date('Y');
            $mov->tipo_movimiento = 'Ingreso';
            $mov->credito = $request->amount;
            $mov->debito = '0.00';
            $mov->descripcion ='Ingreso de cobro';
            $mov->save();

            $cuenta = Cuentas::find($request->idcuenta);
            $cuenta->saldo_actual += $request->amount;
            $cuenta->save();

            $sale->update([
                'paid_amount' => ($sale->paid_amount + $request->amount) * 100,
                'due_amount' => $due_amount * 100,
                'payment_status' => $payment_status
            ]);
        });

         toast('Pago por venta creado!', 'success');

        return redirect()->route('sales.index');
    }


    public function edit($sale_id, SalePayment $salePayment) {
        abort_if(Gate::denies('access_sale_payments'), 403);

        $sale = Sale::findOrFail($sale_id);

        return view('sale::payments.edit', compact('salePayment', 'sale'));
    }


    public function update(Request $request, SalePayment $salePayment) {
        abort_if(Gate::denies('access_sale_payments'), 403);




        $request->validate([
            'date' => 'required|date',
            'reference' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'note' => 'nullable|string|max:1000',
            'sale_id' => 'required',
            'payment_method' => 'required|string|max:255'
        ]);

        DB::transaction(function () use ($request, $salePayment) {
            $sale = $salePayment->sale;

            $due_amount = ($sale->due_amount + $salePayment->amount) - $request->amount;

            if ($due_amount == $sale->total_amount) {
                $payment_status = 'Sin pagar';
            } elseif ($due_amount > 0) {
                $payment_status = 'Parcial';
            } else {
                $payment_status = 'Pagado';
            }

            $sale->update([
                'paid_amount' => (($sale->paid_amount - $salePayment->amount) + $request->amount) * 100,
                'due_amount' => $due_amount * 100,
                'payment_status' => $payment_status
            ]);

            $salePayment->update([
                'date' => $request->date,
                'idcuenta' => $request->idcuenta,
                'reference' => $request->reference,
                'amount' => $request->amount,
                'note' => $request->note,
                'sale_id' => $request->sale_id,
                'payment_method' => $request->payment_method,
                 'empresa_id' => \Auth::user()->empresa_id
            ]);


            $mytime =  \Carbon\Carbon::now('America/Caracas');
            $fecha  =  $mytime->format('Y-m-d');

            $mov = new MovimientoCuentas();
            $mov->cuenta_id = $request->idcuenta;
            $mov->fecha_emision = $fecha;
            $mov->mes = date('m');
            $mov->hora =date('H:i:s');
            $mov->ano = date('Y');
            $mov->tipo_movimiento = 'Ingreso';
            $mov->credito = $request->amount;
            $mov->debito = '0.00';
            $mov->descripcion ='Ingreso de cobro';
            $mov->save();

            $cuenta = Cuentas::find($request->idcuenta);
            $cuenta->saldo_actual += $request->amount;
            $cuenta->save();


        });

        toast('Pago por venta modificado!', 'success');

        return redirect()->route('sales.index');
    }


    public function destroy(SalePayment $salePayment) {
        abort_if(Gate::denies('access_sale_payments'), 403);

        $salePayment->delete();

        toast('Pago por venta eliminado!', 'success');

        return redirect()->route('sales.index');
    }
}
