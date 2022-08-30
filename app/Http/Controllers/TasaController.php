<?php

namespace App\Http\Controllers;

use App\Models\Tasa;
use Illuminate\Http\Request;

class TasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       try
       {

            $tasa = new Tasa();
            $tasa->fecha_emision = date('Y-m-d');
            $tasa->amount = $request->amount;
            $tasa->empresa_id = \Auth::user()->empresa_id;
            $tasa->save();


            toast('¡Tasa registrada!', 'success');
             return \Redirect::back();

      } catch (Exception $e) {

      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasa  $tasa
     * @return \Illuminate\Http\Response
     */
    public function show(Tasa $tasa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasa  $tasa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasa $tasa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tasa  $tasa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tasa $tasa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasa  $tasa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasa $tasa)
    {
        //
    }
}
