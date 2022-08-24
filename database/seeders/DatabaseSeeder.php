<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Currency\Database\Seeders\CurrencyDatabaseSeeder;
use Modules\Setting\Database\Seeders\SettingDatabaseSeeder;
use Modules\User\Database\Seeders\PermissionsTableSeeder;
use Modules\Expense\Database\Seeders\ExpenseDatabaseSeeder;
use Modules\Cuentas\Database\Seeders\CuentasDatabaseSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(SuperUserSeeder::class);
        $this->call(CurrencyDatabaseSeeder::class);
        $this->call(SettingDatabaseSeeder::class);
        $this->call(ExpenseDatabaseSeeder::class);
        $this->call(CuentasDatabaseSeeder::class);
    }
}
