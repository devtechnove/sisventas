<?php

namespace Modules\Cuentas\Http\Controllers;

use Modules\Cuentas\DataTables\CuentasDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Modules\Cuentas\Entities\Cuentas;
use Modules\Cuentas\Entities\MovimientoCuentas;
use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CuentasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request) {
        abort_if(Gate::denies('access_accounts'), 403);

        $cuentas = Cuentas::where('empresa_id',\Auth::user()->empresa_id)->get();
        //DD($cuentas);
        return view('cuentas::index',compact('cuentas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
         abort_if(Gate::denies('create_accounts'), 403);

         return view('cuentas::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
       // dd();

         abort_if(Gate::denies('create_accounts'), 403);

            $request->validate([
            'nb_nombre'   => 'required|max:255',
            'fe_apertura'        => 'required',
            'nu_cuenta'        => 'required|string',
            'moneda_id' => 'required',
            'saldo_apertura'  => 'required',
            'tx_nota'       => 'required',
            'is_active'       => 'required'
        ]);

           try {

                  $mytime =  \Carbon\Carbon::now('America/Caracas');
                  $fecha  =  $mytime->format('Y-m-d');

                $cuenta = new Cuentas();
                $cuenta->nb_nombre = $request->nb_nombre;
                $cuenta->empresa_id = \Auth::user()->empresa_id;
                $cuenta->fe_apertura = $request->fe_apertura;
                $cuenta->nu_cuenta = $request->nu_cuenta;
                $cuenta->moneda_id = $request->moneda_id;
                $cuenta->saldo_apertura = $request->saldo_apertura;
                $cuenta->saldo_actual = $request->saldo_apertura;
                $cuenta->tx_nota = $request->tx_nota;
                $cuenta->is_active = $request->is_active;
                $cuenta->save();

                $mov = new MovimientoCuentas();
                $mov->cuenta_id = $cuenta->id;
                $mov->fecha_emision = $fecha;
                $mov->mes = date('m');
                $mov->hora =date('H:i:s');
                $mov->ano = date('Y');
                $mov->tipo_movimiento = 'Ingreso';
                $mov->credito = $cuenta->saldo_apertura;
                $mov->debito = '0.00';
                $mov->descripcion ='Saldo de apertura de cuenta';
                $mov->save();

               toast('¡Datos ingresados!', 'success');
               return redirect()->to('/cuentas');


           } catch (\Exception $e) {
             toast('¡Algo salió mal!', 'error');
            return redirect()->to('/cuentas');
           }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {

        abort_if(Gate::denies('delete_accounts'), 403);

        $cuenta = Cuentas::find($id);
        $cuenta->delete();
        toast('¡Cuenta eliminada!', 'success');
        return redirect()->to('/cuentas');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('cuentas::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {


         abort_if(Gate::denies('create_accounts'), 403);

            $request->validate([
            'nb_nombre'   => 'required|max:255',
            'date'        => 'required',
            'nu_cuenta'        => 'required|string',
            'moneda_id' => 'required',
            'saldo_apertura'  => 'required',
            'tx_nota'       => 'required',
            'is_active'       => 'required'
        ]);

            $cuenta = Cuentas::find($id);
            $cuenta->nb_nombre = $request->nb_nombre;
            $cuenta->empresa_id = \Auth::user()->empresa_id;
            $cuenta->fe_apertura = $request->date;
            $cuenta->nu_cuenta = $request->nu_cuenta;
            $cuenta->moneda_id = $request->moneda_id;
            $cuenta->saldo_apertura = $request->saldo_apertura;
            $cuenta->saldo_actual = $request->saldo_apertura;
            $cuenta->tx_nota = $request->tx_nota;
            $cuenta->is_active = $request->is_active;
            $cuenta->save();

            toast('¡Datos modificados!', 'success');
            return redirect()->to('/cuentas/create');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
