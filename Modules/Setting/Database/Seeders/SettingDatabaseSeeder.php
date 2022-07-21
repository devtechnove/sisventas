<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\Setting;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'company_name' => 'INFINITY POS',
            'company_email' => 'servitechno777@gmail.com',
            'company_phone' => '+58-412-264-68-18',
            'notification_email' => 'servitechno777@gmail.com',
            'default_currency_id' => 1,
            'default_currency_position' => 'prefix',
            'footer_text' => 'INFINITY POS © 2022 || Desarrollador por: <strong><a target="_blank" href="https://instagram.com/servitechno_vnzla">Servitechno</a></strong>',
            'company_address' => 'Caracas - Venezuela'
        ]);
    }
}
