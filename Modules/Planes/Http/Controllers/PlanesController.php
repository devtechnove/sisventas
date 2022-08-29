<?php

namespace Modules\Planes\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Planes\Entities\Planes;

class PlanesController extends Controller
{


    public function __construct()
    {
        $this->middleware(['actived','auth','verified']);
    }



    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        if(\Gate::denies('Ver Planes'))
        {
            \Alert::alert('¡Uuups!', 'No tienes permitido ingresar a este módulo.', 'error');

            return redirect()->to('home');
        }
        $planes = Planes::get();
        return view('planes::index',compact('planes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if(\Gate::denies('Registrar Planes'))
        {
            \Alert::alert('¡Uuups!', 'No tienes permitido ingresar a este módulo.', 'error');

            return redirect()->to('home');
        }
        return view('planes::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tipo_plan' => ['required', 'string'],
            'amount' => ['required'],

         ]);

         try {
            $plan = new Planes();
            $plan->name = $request->name;
            $plan->tipo_plan = $request->tipo_plan;
            $plan->amount = $request->amount;
            $plan->save();

            \Alert::alert('¡Bien hecho!', '¡Datos ingresados satisfactoriamente!.', 'success');
            return \Redirect::to('planes');

         } catch (\Throwable $th)
         {

            \Alert::alert('¡Uppps!', '¡Error en envío del formulario!.', 'error');
            return \Redirect::to('planes');
         }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('planes::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        if(\Gate::denies('Editar Planes'))
        {
            \Alert::alert('¡Uuups!', 'No tienes permitido ingresar a este módulo.', 'error');

            return redirect()->to('home');
        }
        $plan = Planes::find($id);
        return view('planes::edit',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if(\Gate::denies('Editar Planes'))
        {
            \Alert::alert('¡Uuups!', 'No tienes permitido ingresar a este módulo.', 'error');

            return redirect()->to('home');
        }
        try {
            $plan =  Planes::find($id);
            $plan->name = $request->name;
            $plan->tipo_plan = $request->tipo_plan;
            $plan->amount = $request->amount;
            $plan->save();

            \Alert::alert('¡Bien hecho!', '¡Datos modificados satisfactoriamente!.', 'success');
            return \Redirect::to('planes');

         } catch (\Throwable $th)
         {

            \Alert::alert('¡Uppps!', '¡Error en envío del formulario!.', 'error');
            return \Redirect::to('planes');
         }

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
