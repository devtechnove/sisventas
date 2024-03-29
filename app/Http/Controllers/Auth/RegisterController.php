<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Empresa\Entities\Empresa;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'razon_social' => ['required', 'string', 'max:255'],
            'documento' => ['required', 'string', 'max:255','unique:empresas'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {



       $empresa = new Empresa();
       $empresa->razon_social    = $data['razon_social'];
       $empresa->documento       = $data['documento'];
       $empresa->email        = $data['email'];
       $empresa->is_active       = 0;
       $empresa->plan_id         = 5;
       $empresa->save();


       $user = new  User();
       $user->name         = $data['name'];
       $user->email        = $data['email'];
       $user->password     =  Hash::make($data['password']);
       $user->empresa_id   = $empresa->id;
       $user->role_id      = 2;
       $user->status       = 0;
       $user->save();

        $user->assignRole('Administrador');


        \Alert::alert('¡Bienvenido (a)!', '¡Por favor verifica tu cuenta!', 'success');

        return $user;
    }
}
