<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\Setting;
use Modules\People\Entities\Customer;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


       Customer::create([


        'customer_name' => 'Cliente genérico',
        'customer_documento' => '1111111',
        'customer_phone' => '00000000000',
        'address' => 'Caracas - Venezuela',
        'empresa_id' => 1


       ]);

       Customer::create([

        'customer_name' => 'Cliente genérico',
        'customer_documento' => '1111111',
        'customer_phone' => '00000000000',
        'address' => 'Caracas - Venezuela',
        'empresa_id' => 2


       ]);


         Setting::create([
            'company_name' => 'DEVTECH',
            'company_email' => 'servitechno777@gmail.com',
            'company_phone' => '+58-424-236-80-48',
            'notification_email' => 'servitechno777@gmail.com',
            'default_currency_id' => 1,
            'default_currency_position' => 'prefix',
            'footer_text' => 'DEVTECHPOS © 2022 || Desarrollador por: <strong><a target="_blank" href="https://instagram.com/dectechve_">DEVTECHO</a></strong>',
            'company_address' => 'Caracas - Venezuela',
            'empresa_id' => 1
        ]);



        Setting::create([
            'company_name' => 'Inv. Colorito D&D C.A',
            'company_email' => 'inversionescolorito@gmail.com',
            'company_phone' => '+58-424-236-80-48',
            'notification_email' => 'inversionescolorito@gmail.com',
            'default_currency_id' => 1,
            'default_currency_position' => 'prefix',
            'footer_text' => 'DEVTECHPOS © 2022 || Desarrollador por: <strong><a target="_blank" href="https://instagram.com/dectechve_">DEVTECHO</a></strong>',
            'company_address' => 'Caracas - Venezuela',
            'empresa_id' => 2
        ]);
    }
}
