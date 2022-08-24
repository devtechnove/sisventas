<?php

namespace Modules\Sale\Http\Controllers;

use Modules\Sale\DataTables\SalesDataTable;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\People\Entities\Customer;
use Modules\Product\Entities\Product;
use Modules\Sale\Entities\Sale;
use Modules\Sale\Entities\SaleDetails;
use Modules\Sale\Entities\SalePayment;
use Modules\Sale\Http\Requests\StoreSaleRequest;
use Modules\Sale\Http\Requests\UpdateSaleRequest;
use Modules\Product\Entities\LineaProducto;
use Illuminate\Support\Facades\Storage;
use Codedge\Fpdf\Fpdf\Fpdf;
use Modules\Cuentas\Entities\MovimientoCuentas;
use Modules\Cuentas\Entities\Cuentas;


class SaleController extends Controller
{



    public function index(SalesDataTable $dataTable) {
        abort_if(Gate::denies('access_sales'), 403);

        return $dataTable->render('sale::index');
    }


    public function create() {
        abort_if(Gate::denies('create_sales'), 403);

         $mytime =  \Carbon\Carbon::now('America/Caracas');
         $fecha=$mytime->format('Y-m-d');

         $caja = DB::table('cajas')
            ->where([
                //['caja','=',$request->get('caja')],
                ['fecha','=',$fecha],
                ['estado','=','Abierta']
            ])
            ->first();

        if ($caja) {

            Cart::instance('sale')->destroy();
            return view('sale::create',compact('caja'));
        }
        else
        {
             toast('¡Debes aperturar la caja!', 'error');
            return redirect()->to('panel/abrir_caja');
        }

    }


    public function store(StoreSaleRequest $request) {
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
             //dd($tbolivares)

             $cuenta = Cuentas::find($request->cuenta_id);

            $sale = Sale::create([
                'date' => $request->date,
                'idcaja' => $caja->id,
                'idtasa' => $tbolivares->id,
                'mes' => date('m'),
                'year' => date('Y'),
                'customer_id' => $request->customer_id,
                'customer_name' => Customer::findOrFail($request->customer_id)->customer_name,
                'tax_percentage' => $request->tax_percentage,
                'discount_percentage' => $request->discount_percentage,
                'shipping_amount' => $request->shipping_amount * 100,
                'paid_amount' => $request->paid_amount * 100,
                'total_amount' => $request->total_amount * 100,
                'due_amount' => $due_amount * 100,
                'status' => $request->status,
                'idcuenta' => $cuenta->id,
                'payment_status' => $payment_status,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
                'tax_amount' => Cart::instance('sale')->tax() * 100,
                'discount_amount' => Cart::instance('sale')->discount() * 100,
            ]);

            foreach (Cart::instance('sale')->content() as $cart_item) {
                 $product = Product::find($cart_item->id);
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

                $mov = new MovimientoCuentas();
                $mov->cuenta_id       = $cuenta->id;
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

                if ($request->status == 'Enviado' || $request->status == 'Completado') {
                    $product = Product::findOrFail($cart_item->id);
                    $product->update([
                        'product_quantity' => $product->product_quantity - $cart_item->qty
                    ]);
                }
            }

            Cart::instance('sale')->destroy();

            if ($sale->paid_amount > 0) {
                SalePayment::create([
                    'date' => $request->date,
                    'reference' => 'INV/'.$sale->reference,
                    'amount' => $sale->paid_amount,
                    'sale_id' => $sale->id,
                    'payment_method' => $request->payment_method,
                    'idcuenta' => $cuenta->id
                ]);
            }
        });



         toast('Venta creada satisfactoriamente!', 'success');

        return redirect()->route('sales.index');
    }


    public function show(Sale $sale) {
        abort_if(Gate::denies('show_sales'), 403);

        $customer = Customer::findOrFail($sale->customer_id);

        return view('sale::show', compact('sale', 'customer'));
    }


    public function edit(Sale $sale) {
        abort_if(Gate::denies('edit_sales'), 403);

        $sale_details = $sale->saleDetails;

        Cart::instance('sale')->destroy();

        $cart = Cart::instance('sale');

        foreach ($sale_details as $sale_detail) {
            $cart->add([
                'id'      => $sale_detail->product_id,
                'name'    => $sale_detail->product_name,
                'qty'     => $sale_detail->quantity,
                'price'   => $sale_detail->price,
                'weight'  => 1,
                'options' => [
                    'product_discount' => $sale_detail->product_discount_amount,
                    'product_discount_type' => $sale_detail->product_discount_type,
                    'sub_total'   => $sale_detail->sub_total,
                    'code'        => $sale_detail->product_code,
                    'stock'       => Product::findOrFail($sale_detail->product_id)->product_quantity,
                    'product_tax' => $sale_detail->product_tax_amount,
                    'unit_price'  => $sale_detail->unit_price
                ]
            ]);
        }

        return view('sale::edit', compact('sale'));
    }


    public function update(UpdateSaleRequest $request, Sale $sale) {
        DB::transaction(function () use ($request, $sale) {

            $due_amount = $request->total_amount - $request->paid_amount;

            if ($due_amount == $request->total_amount) {
                $payment_status = 'Sin pagar';
            } elseif ($due_amount > 0) {
                $payment_status = 'Parcial';
            } else {
                $payment_status = 'Pagado';
            }

            foreach ($sale->saleDetails as $sale_detail) {
                //dd($sale_detail);
                 $product = Product::find($sale_detail->product_id);
                $linea = new LineaProducto();
                $linea->producto_id = $sale_detail->product_id;
                $linea->usuario_id = \Auth::id();
                $linea->comprobante_id = $sale->id;
                $linea->descripcion = "x $sale_detail->qty  $product->product_name  -  TOTAL $ $request->total_amount";
                $linea->fecha = date("Y-m-d H:i:s");;
                $linea->precioUnitario = $sale_detail->price;
                $linea->cantidad = $sale_detail->quantity;
                $linea->subTotal = $sale_detail->sub_total;
                $linea->total = $request->total_amount;
                $linea->save();
                if ($sale->status == 'Enviado' || $sale->status == 'Completado') {
                    $product = Product::findOrFail($sale_detail->product_id);
                    $product->update([
                        'product_quantity' => $product->product_quantity + $sale_detail->quantity
                    ]);
                }
                $sale_detail->delete();
            }

            $sale->update([
                'date' => $request->date,
                'reference' => $request->reference,
                'customer_id' => $request->customer_id,
                'customer_name' => Customer::findOrFail($request->customer_id)->customer_name,
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

                if ($request->status == 'Enviado' || $request->status == 'Completado') {
                    $product = Product::findOrFail($cart_item->id);
                    $product->update([
                        'product_quantity' => $product->product_quantity - $cart_item->qty
                    ]);
                }
            }

            Cart::instance('sale')->destroy();
        });

         toast('Venta modificada satisfactoriamente!', 'success');

        return redirect()->route('sales.index');
    }


    public function destroy(Sale $sale) {
        abort_if(Gate::denies('delete_sales'), 403);

        $sale->delete();

        toast('Sale Deleted!', 'warning');

        return redirect()->route('sales.index');
    }


    public function pdf($id)
    {
            $venta = Sale::where('reference',$id)->first();
            $moneda = \DB::table('currencies')->where('principal',true)->first();
            //dd($moneda);
            $pago  = SalePayment::get();


            //create pdf document
            $fecha = "04/07/2018";
            $pdf= app('Fpdf');
            $pdf->AddPage();
            $pdf->Ln(1);

            $pdf->Image('images/logo/logo.jpg',65,10,70,35,'JPG');
            $pdf->Ln(45);
            $pdf->SetFont('Arial','B',16);
            $pdf->Cell(190,5,utf8_decode('Factura a') );
            $pdf->SetFillColor(200,220,255);

            $pdf->SetXY(10,70);
            $pdf->SetFont('Times','B',10);
            $pdf->Cell(190,5,utf8_decode($venta->clientes->customer_name) );
            $pdf->SetXY(10,77);
            $pdf->Cell(190,5,utf8_decode($venta->clientes->customer_documento) );
            $pdf->SetXY(10,84);
            $pdf->Cell(190,5,utf8_decode($venta->clientes->customer_phone) );

            $pdf->SetXY(145,55);
            $pdf->SetFont('Arial','B',16);
            $pdf->Cell(190,5,utf8_decode('Detalle de la factura') );
            $pdf->SetXY(145,70);
            $pdf->SetFont('Times','B',10);
            $pdf->Cell(190,5,utf8_decode('Factura #:'.' '. $venta->reference ) );
            $pdf->SetXY(145,77);
            $pdf->SetFont('Times','B',10);
            $pdf->Cell(190,5,utf8_decode('Fecha de Factura:'.' '. $venta->date ) );
            $pdf->SetXY(145,84);
            $pdf->SetFont('Times','B',10);
            $pdf->Cell(190,5,utf8_decode('Estado de Factura:'.' '. $venta->payment_status ) );

            $pdf->SetFont('Arial','B',10);
            $pdf->Ln(20);
            $pdf->SetX(10);
            $pdf->Cell(30,6,"Producto",1,0,'C',true);
            $pdf->Cell(25,6,"Cantidad",1,0,'C',true);
            $pdf->Cell(30,6,"Costo Unitario",1,0,'C',true);
            $pdf->Cell(30,6,"Descuento(%)",1,0,'C',true);
            $pdf->Cell(30,6,"Impuesto (%)",1,0,'C',true);
            $pdf->Cell(45,6,"Monto Total",1,0,'C',true);

            $pdf->SetFont('Arial','B',10);

            //$sub_total = SaleDetails::where('sale_id',$id)->sum('sub_total');


            //dd($venta);


            foreach ($venta->saleDetails as $key => $value)
            {

                $pago = 0;
                $iva = 0;
                $descuento = 0;
                $total = 0;

                $pago      =  ($value->quantity * $value->unit_price );

                $iva       +=  ($venta->tax_percentage )/100;

                $descuento +=  ($pago * $venta->discount_percentage )/100;

                $total += $pago + $iva;

                $pdf->Ln(6);
                $pdf->Cell(30,6,$value->product->product_name,1,0,'C');
                $pdf->Cell(25,6,$value->quantity,1,0,'C');
                $pdf->Cell(30,6,format_currency($value->unit_price),1,0,'C');
                $pdf->Cell(30,6,$venta->discount_percentage,1,0,'C');
                $pdf->Cell(30,6,$venta->tax_percentage,1,0,'C');
                $pdf->Cell(45,6,format_currency($pago) ,1,0,'C');
            }

                //dd($venta);


                $pdf->SetFont('Arial','B',10);
                $pdf->Ln(20);
                $pdf->SetX(120);
                $pdf->Cell(40,12,"Impuesto:",1,0,'C');
                $pdf->Cell(40,12,format_currency($venta->tax_amount)  ,1,0,'C');
                $pdf->Ln(12);
                $pdf->SetX(120);
                $pdf->Cell(40,12,"Descuento:",1,0,'C');
                $pdf->Cell(40,12,format_currency($venta->discount_amount) ,1,0,'C');
                $pdf->Ln(12);
                $pdf->SetX(120);
                $pdf->Cell(40,12,utf8_decode("Costo de envío:"),1,0,'C');
                $pdf->Cell(40,12,format_currency($venta->shipping_amount) ,1,0,'C');
                $pdf->Ln(12);
                $pdf->SetX(120);
                $pdf->Cell(40,12,utf8_decode("Total pagado:"),1,0,'C');
                $pdf->Cell(40,12,format_currency($venta->paid_amount ) ,1,0,'C');
                $pdf->Ln(12);
                $pdf->SetX(120);
                $pdf->Cell(40,12,utf8_decode("Cantidad debida:"),1,0,'C');
                $pdf->Cell(40,12,format_currency($venta->due_amount ) ,1,0,'C');
                $pdf->Ln(12);
                $pdf->SetX(120);
                $pdf->Cell(40,12,utf8_decode("Total a pagar:"),1,0,'C',true);
                $pdf->Cell(40,12,format_currency($venta->total_amount ) ,1,0,'C',true);

                $pdf->Ln(20);
                $pdf->Cell(190,12,"HISTORIAL DE PAGO:",1,0,'C');
                $pdf->Ln(12);

                $pdf->Cell(30,6,"Fecha",1,0,'C',true);
                $pdf->Cell(50,6,"Cuenta",1,0,'C',true);
                $pdf->Cell(35,6,"Cantidad pagada",1,0,'C',true);
                $pdf->Cell(30,6,"Deuda base",1,0,'C',true);
                $pdf->Cell(45,6,utf8_decode("Método de pago"),1,0,'C',true);





                foreach ($venta->salePayments as $key => $value)
                {
                    $pdf->Ln(6);
                    $cuenta = \DB::table('cuentas')->where('id',$value->idcuenta)->first();
                    $pdf->Cell(30,6,$value->date,1,0,'C');
                    $pdf->Cell(50,6,$cuenta->nb_nombre,1,0,'C');
                    $pdf->Cell(35,6,format_currency($venta->paid_amount),1,0,'C');
                    $pdf->Cell(30,6,format_currency($venta->total_amount),1,0,'C');
                    $pdf->Cell(45,6,$value->payment_method,1,0,'C');
                }











            $headers=['Content-Type'=>'application/pdf'];
            return Response($pdf->Output(), 200, $headers);
        //save file


    }


}
