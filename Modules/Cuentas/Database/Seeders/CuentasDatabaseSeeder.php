<?php

namespace Modules\Cuentas\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Cuentas\Entities\Cuentas;
class CuentasDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        $cuenta = new Cuentas();
        $cuenta->nb_nombre = 'Banco de Venezuela';
        $cuenta->fe_apertura = date('Y-m-d');
        $cuenta->nu_cuenta = '0102-0000-00-00000-00000';
        $cuenta->moneda_id = 1 ;
        $cuenta->saldo_apertura = 25000 ;
        $cuenta->saldo_actual = 25000 ;
        $cuenta->tx_nota ='Cuenta corriente' ;
        $cuenta->is_active =1 ;
        $cuenta->save();
    }
}
