<?php

namespace Modules\Currency\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Currency\Entities\Currency;

class CurrencyDatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {



            Currency::create([
            'currency_name'      => 'Bolívar Soberano',
            'code'               => Str::upper('VES'),
            'symbol'             => 'Bs',
            'thousand_separator' => ',',
            'decimal_separator'  => '.',
            'exchange_rate'      => null,
            'empresa_id'         => 1
        ]);


            Currency::create([
            'currency_name'      => 'Bolívar Soberano',
            'code'               => Str::upper('VES'),
            'symbol'             => 'Bs',
            'thousand_separator' => ',',
            'decimal_separator'  => '.',
            'exchange_rate'      => null,
            'empresa_id'         => 2
        ]);
    }
}
