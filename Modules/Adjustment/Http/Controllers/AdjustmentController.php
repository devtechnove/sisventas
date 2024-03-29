<?php

namespace Modules\Adjustment\Http\Controllers;

use Modules\Adjustment\DataTables\AdjustmentsDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Adjustment\Entities\AdjustedProduct;
use Modules\Adjustment\Entities\Adjustment;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\LineaProducto;
use Modules\Product\Notifications\NotifyQuantityAlert;

class AdjustmentController extends Controller
{

    public function index(AdjustmentsDataTable $dataTable) {
        //dd(settings());
        abort_if(Gate::denies('access_adjustments'), 403);
        $ajustes = Adjustment::where('empresa_id',\Auth::user()->empresa_id)->get();
        return $dataTable->render('adjustment::index',compact('ajustes'));
    }


    public function create() {
        abort_if(Gate::denies('create_adjustments'), 403);

        return view('adjustment::create');
    }


    public function store(Request $request) {
        abort_if(Gate::denies('create_adjustments'), 403);

        $request->validate([
            'reference'   => 'required|string|max:255',
            'date'        => 'required|date',
            'note'        => 'nullable|string|max:1000',
            'product_ids' => 'required',
            'quantities'  => 'required',
            'types'       => 'required'
        ]);

        DB::transaction(function () use ($request) {
            $adjustment = Adjustment::create([
                'date'       => $request->date,
                'empresa_id' => \Auth::user()->empresa_id,
                'note'       => $request->note
            ]);

            foreach ($request->product_ids as $key => $id) {
                AdjustedProduct::create([
                    'adjustment_id' => $adjustment->id,
                    'product_id'    => $id,
                    'quantity'      => $request->quantities[$key],
                    'type'          => $request->types[$key]
                ]);

                $product = Product::findOrFail($id);

                if ($request->types[$key] == 'add') {

                    $linea = new LineaProducto();
                    $linea->producto_id = $id;
                    $linea->usuario_id = \Auth::id();
                    $linea->descripcion =  "Ingreso de stock: " . $request->quantities[$key];
                    $linea->fecha = date("Y-m-d H:i:s");
                    $linea->empresa_id = \Auth::user()->empresa_id;
                    $linea->stock =  $product->product_quantity;
                    $linea->precioUnitario = $product->product_price;
                    $linea->cantidad = $request->quantities[$key];
                    $linea->save();


                    $product->update([
                        'product_quantity' => $product->product_quantity + $request->quantities[$key]
                    ]);
                } elseif ($request->types[$key] == 'sub') {

                    $linea = new LineaProducto();
                    $linea->producto_id = $id;
                    $linea->usuario_id = \Auth::id();
                    $linea->descripcion =  "Disminución de stock: " . $request->quantities[$key];
                    $linea->empresa_id = \Auth::user()->empresa_id;
                    $linea->fecha = date("Y-m-d H:i:s");
                    $linea->stock =  $product->product_quantity;
                    $linea->precioUnitario = $product->product_price;
                    $linea->cantidad = $request->quantities[$key];
                    $linea->save();


                    $product->update([
                        'product_quantity' => $product->product_quantity - $request->quantities[$key]
                    ]);
                }
            }
        });

         toast('¡Ajuste creado!', 'success');

        return redirect()->route('adjustments.index');
    }


    public function show(Adjustment $adjustment) {
        abort_if(Gate::denies('show_adjustments'), 403);

        return view('adjustment::show', compact('adjustment'));
    }


    public function edit(Adjustment $adjustment) {
        abort_if(Gate::denies('edit_adjustments'), 403);

        return view('adjustment::edit', compact('adjustment'));
    }


    public function update(Request $request, Adjustment $adjustment) {
        abort_if(Gate::denies('edit_adjustments'), 403);

        $request->validate([
            'reference'   => 'required|string|max:255',
            'date'        => 'required|date',
            'note'        => 'nullable|string|max:1000',
            'product_ids' => 'required',
            'quantities'  => 'required',
            'types'       => 'required'
        ]);

        DB::transaction(function () use ($request, $adjustment) {
            $adjustment->update([
                'reference' => $request->reference,
                'date'      => $request->date,
                'empresa_id' => \Auth::user()->empresa_id,
                'note'      => $request->note
            ]);

            foreach ($adjustment->adjustedProducts as $adjustedProduct) {
                $product = Product::findOrFail($adjustedProduct->product->id);

                if ($adjustedProduct->type == 'add') {

                    $product->update([
                        'product_quantity' => $product->product_quantity - $adjustedProduct->quantity
                    ]);
                } elseif ($adjustedProduct->type == 'sub') {
                    $product->update([
                        'product_quantity' => $product->product_quantity + $adjustedProduct->quantity
                    ]);
                }

                $adjustedProduct->delete();
            }

            foreach ($request->product_ids as $key => $id) {
                AdjustedProduct::create([
                    'adjustment_id' => $adjustment->id,
                    'product_id'    => $id,
                    'quantity'      => $request->quantities[$key],
                    'type'          => $request->types[$key]
                ]);

                $product = Product::findOrFail($id);

                if ($request->types[$key] == 'add') {
                    $product->update([
                        'product_quantity' => $product->product_quantity + $request->quantities[$key]
                    ]);
                } elseif ($request->types[$key] == 'sub') {
                    $product->update([
                        'product_quantity' => $product->product_quantity - $request->quantities[$key]
                    ]);
                }
            }
        });

        toast('¡Ajuste modificado!', 'success');

        return redirect()->route('adjustments.index');
    }


    public function destroy(Adjustment $adjustment) {
        abort_if(Gate::denies('delete_adjustments'), 403);

        $adjustment->delete();

        toast('¡Ajuste eliminado!', 'success');

        return redirect()->route('adjustments.index');
    }
}
