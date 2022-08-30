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
use Modules\Cuentas\Entities\MovimientoCuentas;
use Modules\Cuentas\Entities\Cuentas;


class PosController extends Controller
{

    public function index() {
         $mytime =  \Carbon\Carbon::now('America/Caracas');
         $fecha=$mytime->format('Y-m-d');

         $caja = DB::table('cajas')
            ->where([
                //['caja','=',$request->get('caja')],
                ['fecha','=',$fecha],
                ['estado','=','Abierta'],
                ['empresa_id','=',\Auth::user()->empresa_id]
            ])
            ->first();

        if ($caja) {

              Cart::instance('sale')->destroy();

        $customers = Customer::all();
        $product_categories = Category::all();

        return view('sale::pos.index', compact('product_categories', 'customers'));
        }
        else
        {
             toast('¡Debes aperturar la caja!', 'error');
            return redirect()->to('panel/abrir_caja');
        }


        return view('sale::pos.index', compact('product_categories', 'customers'));
    }


    public function store(StorePosSaleRequest $request) {



         $mytime =  \Carbon\Carbon::now('America/Caracas');
         $fecha=$mytime->format('Y-m-d');

              $caja_aperturada = DB::table('cajas')
            ->where([
                //['caja','=',$request->get('caja')],
                ['fecha','=',$fecha],
                ['estado','=','Abierta'],
                ['empresa_id','=',\Auth::user()->empresa_id]
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
                ['estado','=','Abierta'],
                ['empresa_id','=',\Auth::user()->empresa_id]
            ])
            ->first();

              $tbolivares = \DB::table('tasas')->where('fecha_emision',date('Y-m-d'))
             ->first();


             $cuenta = Cuentas::find($request->cuenta_id);

            $sale = Sale::create([
                'date' => now()->format('Y-m-d'),
                'idcaja' => $caja->id,
                'empresa_id' => \Auth::user()->empresa_id,
                'idtasa' => $tbolivares->id,
                'idcuenta' => $cuenta->id,
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

            $cuentat = 0;




            foreach (Cart::instance('sale')->content() as $cart_item) {
                SaleDetails::create([
                    'sale_id' => $sale->id,
                    'empresa_id' => \Auth::user()->empresa_id,
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
                $linea->empresa_id = \Auth::user()->empresa_id;
                $linea->comprobante_id = $sale->id;
                $linea->descripcion = "$product->product_name x $cart_item->qty  -  TOTAL CANCELADO = Bs. $request->total_amount";
                $linea->fecha = date("Y-m-d H:i:s");;
                $linea->precioUnitario = $cart_item->price;
                $linea->cantidad = $cart_item->qty;
                $linea->subTotal = $cart_item->options->sub_total;
                $linea->total = $request->total_amount;
                $linea->save();


                $mov = new MovimientoCuentas();
                $mov->cuenta_id       = $request->cuenta_id;
                $mov->empresa_id = \Auth::user()->empresa_id;
                $mov->fecha_emision   = $fecha;
                $mov->mes             = date('m');
                $mov->hora            = date('H:i:s');
                $mov->ano             = date('Y');
                $mov->tipo_movimiento = 'Ingreso';
                $mov->credito         = $request->total_amount;
                $mov->debito          = '0.00';
                $mov->descripcion     = $linea->descripcion;
                $mov->save();

                $cuenta->saldo_actual += $request->total_amount;
                $cuenta->save();

                if ($product->category_id <> 1) {

                    $true = true;
                }
                else
                {
                    $product->update([
                    'product_quantity' => $product->product_quantity - $cart_item->qty
                  ]);
                }
            }

            Cart::instance('sale')->destroy();

            if ($sale->paid_amount > 0) {
                SalePayment::create([
                    'date' => now()->format('Y-m-d'),
                    'empresa_id' => \Auth::user()->empresa_id,
                    'idcuenta' => $request->cuenta_id,
                    'reference' => 'INV/'.$sale->reference,
                    'amount' => $sale->paid_amount,
                    'sale_id' => $sale->id,
                    'payment_method' => $request->payment_method
                ]);
            }
        });

        toast('Venta creada satisfactoriamente!', 'success');

        return redirect()->route('app.pos.index');
        }
        else
        {
        toast('¡Debes aperturar la caja!', 'error');

        return redirect()->to('/panel/abrir_caja');
        }

    }
}
