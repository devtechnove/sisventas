<?php

namespace Modules\Tarea\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Tarea\Entities\Tarea;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        abort_if(Gate::denies('access_tarea'), 403);

        $tareas = Tarea::where('empresa_id',\Auth::user()->empresa_id)->get();
        //dd($tareas);
        return view('tarea::index', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
       abort_if(Gate::denies('create_tarea'), 403);

        return view('tarea::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
         abort_if(Gate::denies('create_tarea'), 403);

         try {

            $tarea = new Tarea();
            $tarea->titulo = $request->titulo;
            $tarea->descripcion = $request->descripcion;
            $tarea->personal_id = $request->personal_id;
            $tarea->porcentaje = $request->porcentaje;
            $tarea->estado_tarea = $request->estado_tarea;
            $tarea->empresa_id   = \Auth::user()->empresa_id;
            $tarea->fecha_inicio = $request->fecha_inicio;
            $tarea->fecha_fin = $request->fecha_fin;
            $tarea->personal_id = $request->personal_id;
            $tarea->save();

             toast('¡Datos registrados!', 'success');
             return redirect()->route('tarea.index');

         } catch (\Exception $e) {

             toast('¡Error al enviar formulario!', 'error');
             return redirect()->route('tarea.index');

         }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('tarea::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Tarea $tarea)
    {
        abort_if(Gate::denies('edit_tarea'), 403);

        //$tareas = Tarea::find($id);
        //dd($tareas);
        return view('tarea::edit', compact('tarea'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Tarea $tarea)
    {
        abort_if(Gate::denies('edit_tarea'), 403);

        try {

           
           $tarea->titulo = $request->titulo;
           $tarea->descripcion = $request->descripcion;
           $tarea->empresa_id = \Auth::user()->empresa_id;
           $tarea->personal_id = $request->personal_id;
           $tarea->porcentaje = $request->porcentaje;
           $tarea->estado_tarea = $request->estado_tarea;
           $tarea->fecha_inicio = $request->fecha_inicio;
           $tarea->fecha_fin = $request->fecha_fin;
           $tarea->personal_id = $request->personal_id;
           $tarea->save();

            toast('¡Datos modificados!', 'success');
            return redirect()->route('tarea.index');

        } catch (\Exception $e) {

            toast('¡Error al enviar formulario!', 'error');
            return redirect()->route('tarea.index');

        }
   
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Tarea $tarea)
    {
          $tarea->delee();
          toast('¡Datos eliminados!', 'success');
          return redirect()->route('tarea.index');
    }
}
