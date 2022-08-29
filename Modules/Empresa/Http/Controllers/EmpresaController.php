<?php

namespace Modules\Empresa\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Empresa\Entities\Empresa;
use Modules\Usuarios\Entities\Usuarios;

class EmpresaController extends Controller
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


         if(\Gate::denies('Ver Empresa'))
        {
            \Alert::alert('¡Uuups!', 'No tienes permitido Ver este módulo', 'error');

            return redirect()->to('home');
        }


        if (\Auth::user()->hasRole('Administrador')) {

             $empresa = Empresa::get();

             return view('empresa::index',compact('empresa'));
        }

      $empresa = Empresa::where('id',\Auth::id())->get();
      return view('empresa::index',compact('empresa'));
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        if(\Gate::denies('Registrar Empresa'))
        {
            \Alert::alert('¡Uuups!', 'No tienes permitido Ver este módulo', 'error');

            return redirect()->to('home');
        }


        return view('empresa::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
         $request->validate([
            'razon_social' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'nu_contacto' => ['required'],
            'is_active' => ['required'],
            'tx_direccion' => ['required'],
            'tx_rif' => ['required', 'string', 'max:255', 'unique:empresas'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

            try {

              if ($request->has('logo_empresa'))
               {

                 $image_names = [];

                $file = $request->logo_empresa;

                $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $fileName = strtotime(date('Y-m-d H:i:s'));
                $fileName = $fileName . '.' . $ext;
                $file->move(public_path('images/empresas/'.$request->razon_social), $fileName);

                $empresa = new Empresas();
                $empresa->razon_social = $request->razon_social;
                $empresa->tx_rif = $request->tx_rif;
                $empresa->nu_contacto = $request->nu_contacto;
                $empresa->tx_direccion = $request->tx_direccion;
                $empresa->email = $request->email;
                $empresa->is_active = $request->is_active;
                $empresa->logo_empresa = $fileName;
                $empresa->save();

                \Alert::alert('¡Bien hecho!', '¡Datos ingresados satisfactoriamente!.', 'success');
                return \Redirect::to('empresa');


             }

            } catch (\Exception $e) {
                \Alert::alert('¡Uups!', '¡Algo salió mal!.', 'error');
                return \Redirect::back();
            }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('empresa::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {


         if(\Gate::denies('Editar Empresa'))
        {
            \Alert::alert('¡Uuups!', 'No tienes permitido Ver este módulo', 'error');

            return redirect()->to('home');
        }


        $empresas = Empresa::find($id);
        return view('empresa::edit',compact('empresas'));
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

              if ($request->has('logo_empresa'))
               {


                 $image_names = [];

                $file = $request->logo_empresa;

                $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $fileName = strtotime(date('Y-m-d H:i:s'));
                $fileName = $fileName . '.' . $ext;
                $file->move(public_path('assets/images/logo/'), $fileName);

                $empresa = Empresa::with('users')->find($id);
                $empresa->razon_social = $request->razon_social;
                $empresa->documento = $request->documento;
                $empresa->telefono = $request->telefono;
                $empresa->direccion = $request->direccion;
                $empresa->email = $request->email;
                $empresa->is_active = $request->is_active;
                $empresa->logo_empresa = $fileName;
                //$empresa->users->status = $empresa->is_active;
                $empresa->save();

                  $user = \App\Models\User::where('empresa_id',$id)->get();

                  foreach ($user as $key => $value) {

                    $value->status = $request->is_active;
                    $value->save();

                }


                \Alert::alert('¡Bien hecho!', '¡Datos ingresados satisfactoriamente!.', 'success');
                return \Redirect::to('empresa');


             }
             else
             {

                $empresa = Empresa::with('users')->find($id);;
                $empresa->razon_social = $request->razon_social;
                $empresa->documento = $request->documento;
                $empresa->telefono = $request->telefono;
                $empresa->direccion = $request->direccion;
                $empresa->email = $request->email;
                $empresa->is_active = $request->is_active;
                $empresa->save();

                $user = \App\Models\User::where('empresa_id',$id)->get();

                foreach ($user as $key => $value) {

                    $value->status = $request->is_active;
                    $value->save();

                }




                \Alert::alert('¡Bien hecho!', '¡Datos modificados satisfactoriamente!.', 'success');
                return \Redirect::to('empresa');
             }

            } catch (\Exception $e) {
                \Alert::alert('¡Uups!', '¡Algo salió mal!.', 'error');
                return \Redirect::to('empresa');
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
