<?php

namespace Modules\Purchase\Http\Controllers;

use Modules\Purchase\DataTables\PurchaseDataTable;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\People\Entities\Supplier;
use Modules\Product\Entities\Product;
use Modules\Purchase\Entities\Purchase;
use Modules\Purchase\Entities\PurchaseDetail;
use Modules\Purchase\Entities\PurchasePayment;
use Modules\Purchase\Http\Requests\StorePurchaseRequest;
use Modules\Purchase\Http\Requests\UpdatePurchaseRequest;
use Modules\Product\Entities\LineaProducto;
use Modules\Cuentas\Entities\MovimientoCuentas;
use Modules\Cuentas\Entities\Cuentas;

class PurchaseController extends Controller
{

    public function index(PurchaseDataTable $dataTable) {
        abort_if(Gate::denies('access_purchases'), 403);

        return $dataTable->render('purchase::index');
    }


    public function create() {
        abort_if(Gate::denies('create_purchases'), 403);

        Cart::instance('purchase')->destroy();

        return view('purchase::create');
    }


    public function store(StorePurchaseRequest $request) {

        DB::transaction(function () use ($request) {
            $due_amount = $request->total_amount - $request->paid_amount;
            if ($due_amount == $request->total_amount) {
                $payment_status = 'Sin pagar';
            } elseif ($due_amount > 0) {
                $payment_status = 'Parcial';
            } else {
                $payment_status = 'Pagado';
            }
            $mytime =  \Carbon\Carbon::now('America/Caracas');
         $fecha=$mytime->format('Y-m-d');
             $cuenta = Cuentas::where('empresa_id',\Auth::user()->empresa_id)->find($request->cuenta_id);

            $purchase = Purchase::create([
                'idcuenta' => $cuenta->id,
                'date' => $request->date,
                'supplier_id' => $request->supplier_id,
                'supplier_name' => Supplier::findOrFail($request->supplier_id)->supplier_name,
                'tax_percentage' => $request->tax_percentage,
                'discount_percentage' => $request->discount_percentage,
                'shipping_amount' => $request->shipping_amount * 100,
                'paid_amount' => $request->paid_amount * 100,
                'total_amount' => $request->total_amount * 100,
                'due_amount' => $due_amount * 100,
                'status' => $request->status,
                'empresa_id' => \Auth::user()->empresa_id ,
                'payment_status' => $payment_status,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
                'tax_amount' => Cart::instance('purchase')->tax() * 100,
                'discount_amount' => Cart::instance('purchase')->discount() * 100,
            ]);

            foreach (Cart::instance('purchase')->content() as $cart_item) {
                 $product = Product::find($cart_item->id);

                $linea = new LineaProducto();
                $linea->producto_id = $cart_item->id;
                $linea->usuario_id = \Auth::id();
                //$linea->comprobante_id = $purchase->id;
                $linea->descripcion = "Compra de artículos: x $cart_item->qty  $product->product_name  -  TOTAL $ $request->total_amount";
                $linea->fecha = date("Y-m-d H:i:s");;
                $linea->precioUnitario = $cart_item->price;
                $linea->cantidad = $cart_item->qty;
                $linea->subTotal = $cart_item->options->sub_total;
                $linea->total = $request->total_amount;
                $linea->empresa_id = \Auth::user()->empresa_id;
                $linea->save();

                $mov = new MovimientoCuentas();
                $mov->cuenta_id       = $cuenta->id;
                $mov->empresa_id       = \Auth::user()->empresa_id;
                $mov->fecha_emision   = $fecha;
                $mov->mes             = date('m');
                $mov->hora            = date('H:i:s');
                $mov->ano             = date('Y');
                $mov->tipo_movimiento = 'Compra';
                $mov->credito         = '0.00';
                $mov->debito          = $request->total_amount;
                $mov->descripcion     = $linea->descripcion;
                $mov->save();

                $cuenta->saldo_actual -= $request->total_amount;
                $cuenta->save();
                PurchaseDetail::create([
                    'purchase_id' => $purchase->id,
                    'empresa_id' => \Auth::user()->empresa_id ,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'quantity' => $cart_item->qty,
                    'price' => $cart_item->price * 100,
                    'unit_price' => $cart_item->options->unit_price * 100,
                    'sub_total' => $cart_item->options->sub_total * 100,
                    'product_discount_amount' => $cart_item->options->product_discount * 100,
                    'product_discount_type' => $cart_item->options->product_discount_type,
                    'product_tax_amount' => $cart_item->options->product_tax * 100,
                ]);

                if ($request->status == 'Completado') {
                    $product = Product::findOrFail($cart_item->id);

                    $product->update([
                        'product_quantity' => $product->product_quantity + $cart_item->qty
                    ]);
                }
            }



            Cart::instance('purchase')->destroy();

            if ($purchase->paid_amount > 0) {
                PurchasePayment::create([
                    'cuenta_id' => $cuenta->id,
                    'empresa_id' => \Auth::user()->empresa_id ,
                    'date' => $request->date,
                    'reference' => 'INV/'.$purchase->reference,
                    'amount' => $purchase->paid_amount,
                    'purchase_id' => $purchase->id,
                    'payment_method' => $request->payment_method
                ]);
            }
        });

        toast('¡Compra creada!', 'success');

        return redirect()->route('purchases.index');
    }


    public function show(Purchase $purchase) {
        abort_if(Gate::denies('show_purchases'), 403);

        $supplier = Supplier::findOrFail($purchase->supplier_id);

        return view('purchase::show', compact('purchase', 'supplier'));
    }


    public function edit(Purchase $purchase) {
        abort_if(Gate::denies('edit_purchases'), 403);

        $purchase_details = $purchase->purchaseDetails;

        Cart::instance('purchase')->destroy();

        $cart = Cart::instance('purchase');

        foreach ($purchase_details as $purchase_detail) {
            $cart->add([
                'id'      => $purchase_detail->product_id,
                'name'    => $purchase_detail->product_name,
                'qty'     => $purchase_detail->quantity,
                'price'   => $purchase_detail->price,
                'weight'  => 1,
                'options' => [
                    'product_discount' => $purchase_detail->product_discount_amount,
                    'product_discount_type' => $purchase_detail->product_discount_type,
                    'sub_total'   => $purchase_detail->sub_total,
                    'code'        => $purchase_detail->product_code,
                    'stock'       => Product::findOrFail($purchase_detail->product_id)->product_quantity,
                    'product_tax' => $purchase_detail->product_tax_amount,
                    'unit_price'  => $purchase_detail->unit_price
                ]
            ]);
        }

        return view('purchase::edit', compact('purchase'));
    }


    public function update(UpdatePurchaseRequest $request, Purchase $purchase) {
        DB::transaction(function () use ($request, $purchase) {
            $due_amount = $request->total_amount - $request->paid_amount;
            if ($due_amount == $request->total_amount) {
                $payment_status = 'Sin pagar';
            } elseif ($due_amount > 0) {
                $payment_status = 'Parcial';
            } else {
                $payment_status = 'Pagado';
            }

            foreach ($purchase->purchaseDetails as $purchase_detail) {
                if ($purchase->status == 'Completado') {
                    $product = Product::findOrFail($purchase_detail->product_id);
                    $product->update([
                        'product_quantity' => $product->product_quantity - $purchase_detail->quantity
                    ]);
                }
                $purchase_detail->delete();
            }

            $purchase->update([
                'date' => $request->date,
                'reference' => $request->reference,
                'supplier_id' => $request->supplier_id,
                'supplier_name' => Supplier::findOrFail($request->supplier_id)->supplier_name,
                'tax_percentage' => $request->tax_percentage,
                'discount_percentage' => $request->discount_percentage,
                'shipping_amount' => $request->shipping_amount * 100,
                'paid_amount' => $request->paid_amount * 100,
                'total_amount' => $request->total_amount * 100,
                'due_amount' => $due_amount * 100,
                'status' => $request->status,
                'payment_status' => $payment_status,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
                'tax_amount' => Cart::instance('purchase')->tax() * 100,
                'discount_amount' => Cart::instance('purchase')->discount() * 100,
            ]);

            foreach (Cart::instance('purchase')->content() as $cart_item) {
                PurchaseDetail::create([
                    'purchase_id' => $purchase->id,
                    'empresa_id' => \Auth::user()->empresa_id ,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'quantity' => $cart_item->qty,
                    'price' => $cart_item->price * 100,
                    'unit_price' => $cart_item->options->unit_price * 100,
                    'sub_total' => $cart_item->options->sub_total * 100,
                    'product_discount_amount' => $cart_item->options->product_discount * 100,
                    'product_discount_type' => $cart_item->options->product_discount_type,
                    'product_tax_amount' => $cart_item->options->product_tax * 100,
                ]);

                if ($request->status == 'Completado') {
                    $product = Product::findOrFail($cart_item->id);
                    $product->update([
                        'product_quantity' => $product->product_quantity + $cart_item->qty
                    ]);
                }
            }

            Cart::instance('purchase')->destroy();
        });

        toast('¡Compra actualizada!', 'success');

        return redirect()->route('purchases.index');
    }


    public function destroy(Purchase $purchase) {
        abort_if(Gate::denies('delete_purchases'), 403);

        $purchase->delete();

        ttoast('¡Compra eliminada!', 'success');

        return redirect()->route('purchases.index');
    }
}
