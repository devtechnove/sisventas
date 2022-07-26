<?php

namespace Modules\Sale\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\People\Entities\Customer;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Sale\Entities\Sale;
use Modules\Sale\Entities\SaleDetails;
use Modules\Sale\Entities\SalePayment;
use Modules\Sale\Http\Requests\StorePosSaleRequest;
use Modules\Product\Entities\LineaProducto;

class PosController extends Controller
{

    public function index() {
        Cart::instance('sale')->destroy();

        $customers = Customer::all();
        $product_categories = Category::all();

        return view('sale::pos.index', compact('product_categories', 'customers'));
    }


    public function store(StorePosSaleRequest $request) {


         $mytime =  \Carbon\Carbon::now('America/Caracas');
         $fecha=$mytime->format('Y-m-d');

              $caja_aperturada = DB::table('cajas')
            ->where([
                //['caja','=',$request->get('caja')],
                ['fecha','=',$fecha],
                ['estado','=','Abierta']
            ])
            ->first();

         if ($caja_aperturada) {

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

              $caja = DB::table('cajas')
              ->where([
                //['caja','=',$request->get('caja')],
                ['fecha','=',$fecha],
                ['estado','=','Abierta']
            ])
            ->first();

              $tbolivares = \DB::table('tasas')->where('fecha_emision',date('Y-m-d'))
             ->first();

            $sale = Sale::create([
                'date' => now()->format('Y-m-d'),
                'idcaja' => $caja->id,
                'idtasa' => $tbolivares->id,
                'mes' => date('m'),
                'year' => date('Y'),
                'reference' => 'PSL',
                'customer_id' => $request->customer_id,
                'customer_name' => Customer::findOrFail($request->customer_id)->customer_name,
                'tax_percentage' => $request->tax_percentage,
                'discount_percentage' => $request->discount_percentage,
                'shipping_amount' => $request->shipping_amount * 100,
                'paid_amount' => $request->paid_amount * 100,
                'total_amount' => $request->total_amount * 100,
                'due_amount' => $due_amount * 100,
                'status' => 'Completado',
                'payment_status' => $payment_status,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
                'tax_amount' => Cart::instance('sale')->tax() * 100,
                'discount_amount' => Cart::instance('sale')->discount() * 100,
            ]);

            foreach (Cart::instance('sale')->content() as $cart_item) {
                SaleDetails::create([
                    'sale_id' => $sale->id,
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

                $product = Product::findOrFail($cart_item->id);

                $linea = new LineaProducto();
                $linea->producto_id = $cart_item->id;
                $linea->usuario_id = \Auth::id();
                $linea->comprobante_id = $sale->id;
                $linea->descripcion = "x $cart_item->qty  $product->product_name  -  TOTAL $ $request->total_amount";
                $linea->fecha = date("Y-m-d H:i:s");;
                $linea->precioUnitario = $cart_item->price;
                $linea->cantidad = $cart_item->qty;
                $linea->subTotal = $cart_item->options->sub_total;
                $linea->total = $request->total_amount;
                $linea->save();
                $product->update([
                    'product_quantity' => $product->product_quantity - $cart_item->qty
                ]);
            }

            Cart::instance('sale')->destroy();

            if ($sale->paid_amount > 0) {
                SalePayment::create([
                    'date' => now()->format('Y-m-d'),
                    'reference' => 'INV/'.$sale->reference,
                    'amount' => $sale->paid_amount,
                    'sale_id' => $sale->id,
                    'payment_method' => $request->payment_method
                ]);
            }
        });

            toast('POS Sale Created!', 'success');

            return redirect()->route('sales.index');
            }
            else
            {
            toast('¡Debes aperturar la caja!', 'error');

            return redirect()->to('/panel/abrir_caja');
            }

    }
}
