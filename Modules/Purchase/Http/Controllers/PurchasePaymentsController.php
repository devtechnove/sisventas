<?php

namespace Modules\Purchase\Http\Controllers;

use Modules\Purchase\DataTables\PurchasePaymentsDataTable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Purchase\Entities\Purchase;
use Modules\Purchase\Entities\PurchasePayment;
use Modules\Cuentas\Entities\Cuentas;

class PurchasePaymentsController extends Controller
{

    public function index($purchase_id, PurchasePaymentsDataTable $dataTable) {
        abort_if(Gate::denies('access_purchase_payments'), 403);

        $purchase = Purchase::findOrFail($purchase_id);

        return $dataTable->render('purchase::payments.index', compact('purchase'));
    }


    public function create($purchase_id) {
        abort_if(Gate::denies('access_purchase_payments'), 403);

        $purchase = Purchase::findOrFail($purchase_id);

        return view('purchase::payments.create', compact('purchase'));
    }


    public function store(Request $request) {
        abort_if(Gate::denies('access_purchase_payments'), 403);




        $request->validate([
            'date' => 'required|date',
            'reference' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'note' => 'nullable|string|max:1000',
            'purchase_id' => 'required',
            'payment_method' => 'required|string|max:255'
        ]);

        DB::transaction(function () use ($request) {
            PurchasePayment::create([
                'date' => $request->date,
                'cuenta_id' => $request->cuenta_id,
                'reference' => $request->reference,
                'amount' => $request->amount,
                'note' => $request->note,
                'purchase_id' => $request->purchase_id,
                'payment_method' => $request->payment_method
            ]);


             $mytime =  \Carbon\Carbon::now('America/Caracas');
             $fecha = $mytime->format('Y-m-d');

             //dd($request);

            $mov = new \Modules\Cuentas\Entities\MovimientoCuentas();
            $mov->cuenta_id       = $request->cuenta_id;
            $mov->fecha_emision   = $fecha;
            $mov->mes             = date('m');
            $mov->hora            = date('H:i:s');
            $mov->ano             = date('Y');
            $mov->tipo_movimiento = 'Ingreso';
            $mov->credito         = '0.00';
            $mov->debito          =  $request->amount;
            $mov->descripcion     = $request->note;
            $mov->save();

            $cuenta =  Cuentas::find($request->cuenta_id);
            $cuenta->saldo_actual -= $request->amount;
            $cuenta->save();



            $purchase = Purchase::findOrFail($request->purchase_id);

            $due_amount = $purchase->due_amount - $request->amount;

            if ($due_amount == $purchase->total_amount) {
                $payment_status = 'Sin pagar';
            } elseif ($due_amount > 0) {
                $payment_status = 'Parcial';
            } else {
                $payment_status = 'Pagado';
            }

            $purchase->update([
                'paid_amount' => ($purchase->paid_amount + $request->amount) * 100,
                'due_amount' => $due_amount * 100,
                'payment_status' => $payment_status
            ]);
        });

       toast('¡Pago de compra creada!', 'success');

        return redirect()->route('purchases.index');
    }


    public function edit($purchase_id, PurchasePayment $purchasePayment) {
        abort_if(Gate::denies('access_purchase_payments'), 403);

        $purchase = Purchase::findOrFail($purchase_id);

        return view('purchase::payments.edit', compact('purchasePayment', 'purchase'));
    }


    public function update(Request $request, PurchasePayment $purchasePayment) {
        abort_if(Gate::denies('access_purchase_payments'), 403);

        $request->validate([
            'date' => 'required|date',
            'reference' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'note' => 'nullable|string|max:1000',
            'purchase_id' => 'required',
            'payment_method' => 'required|string|max:255'
        ]);

        DB::transaction(function () use ($request, $purchasePayment) {
            $purchase = $purchasePayment->purchase;

            $due_amount = ($purchase->due_amount + $purchasePayment->amount) - $request->amount;

            if ($due_amount == $purchase->total_amount) {
                $payment_status = 'Unpaid';
            } elseif ($due_amount > 0) {
                $payment_status = 'Partial';
            } else {
                $payment_status = 'Paid';
            }

            $purchase->update([
                'paid_amount' => (($purchase->paid_amount - $purchasePayment->amount) + $request->amount) * 100,
                'due_amount' => $due_amount * 100,
                'payment_status' => $payment_status
            ]);

            $purchasePayment->update([
                'date' => $request->date,
                'reference' => $request->reference,
                'amount' => $request->amount,
                'note' => $request->note,
                'purchase_id' => $request->purchase_id,
                'payment_method' => $request->payment_method
            ]);
        });

        toast('¡Pago de compra actualizada!', 'success');

        return redirect()->route('purchases.index');
    }


    public function destroy(PurchasePayment $purchasePayment) {
        abort_if(Gate::denies('access_purchase_payments'), 403);

        $purchasePayment->delete();

        toast('¡Pago de compra eliminada!', 'success');

        return redirect()->route('purchases.index');
    }
}
