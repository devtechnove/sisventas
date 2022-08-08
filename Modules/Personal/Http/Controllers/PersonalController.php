<?php

namespace Modules\Personal\Http\Controllers;

use Modules\Personal\DataTables\PersonalDataTable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Modules\Personal\Entities\Personal;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(PersonalDataTable $dataTable)
    {

        abort_if(Gate::denies('access_personal'), 403);

        return $dataTable->render('personal::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        abort_if(Gate::denies('create_personal'), 403);

        return view('personal::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {

            $personal = new Personal();
            $personal->name = $request->name;
            $personal->lastname = $request->lastname;
            $personal->cedula = $request->cedula;
            $personal->telefono = $request->telefono;
            $personal->cargo = $request->cargo;
            $personal->status = $request->status;
            $personal->save();

             toast('¡Datos guardados    !', 'success');
        return redirect()->route('personal.index');

        } catch (\Exception $e) {


        toast('¡Error al enviar formulario!', 'error');
        return redirect()->route('personal.index');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('personal::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Personal $personal)
    {




        return view('personal::edit',compact('personal'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
         try {

            $personal =  Personal::find($id);
            $personal->name = $request->name;
            $personal->lastname = $request->lastname;
            $personal->cedula = $request->cedula;
            $personal->telefono = $request->telefono;
            $personal->cargo = $request->cargo;
            $personal->status = $request->status;
            $personal->save();

             toast('¡Datos guardados    !', 'success');
        return redirect()->route('personal.index');

        } catch (\Exception $e) {


        toast('¡Error al enviar formulario!', 'error');
        return redirect()->route('personal.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {

             $personal =  Personal::find($id);
             $personal->delete();

               toast('¡Datos eliminados!', 'success');
               return redirect()->route('personal.index');

        } catch (\Exception $e) {

            toast('¡Error al enviar formulario!', 'error');
            return redirect()->route('personal.index');
        }
    }
}
