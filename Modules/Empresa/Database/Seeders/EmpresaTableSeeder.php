<?php

namespace Modules\Empresa\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Empresa\Entities\Empresa;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class EmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empresa = new Empresa();
        $empresa->razon_social = 'Servitechno';
        $empresa->documento    = 'J-25212293-8';
        $empresa->telefono     = '04241703465';
        $empresa->direccion    = 'Caracas - Veneuela';
        $empresa->email        = 'devtechve@gmail.com';
        $empresa->logo_empresa = '20220827_155817_00002.png';
        $empresa->is_active    = 1;
        $empresa->save();


        $empresa = new Empresa();
        $empresa->razon_social = 'Inv. Colorito D&D C.A';
        $empresa->documento    = 'J-26632073-8';
        $empresa->telefono     = '04242115948';
        $empresa->direccion    = 'Caracas - Veneuela';
        $empresa->email        = 'inversionescolorito@gmail.com';
        $empresa->logo_empresa = '20220827_155817_00002.png';
        $empresa->is_active    = 1;
        $empresa->save();





    }
}
