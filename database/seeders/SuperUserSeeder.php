<?php

namespace Database\Seeders;

use App\Models\User;
use Modules\Product\Entities\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => Hash::make(12345678),
            //'is_active' => true
        ]);



        $user->assignRole('Super Administrador');


         $category = Category::create([
            'category_code' => '242353',
            'category_name' => 'Productos de almacén'

        ]);

          $category = Category::create([
            'category_code' => '254864',
            'category_name' => 'Servicios'

        ]);


         \DB::table('denominacions')->insert([
            'denominacion' => 'Moneda de 25 centimos',
            'valor' => '0.50',
            'user_id'=> 1,

        ]);


        \DB::table('denominacions')->insert([
            'denominacion' => 'Moneda de 50 centimos',
            'valor' => '0.50',
            'user_id'=> 1,

        ]);

         \DB::table('denominacions')->insert([
            'denominacion' => 'Moneda de 1 ',
            'valor' => '1.00',
            'user_id'=> 1,

        ]);

         \DB::table('denominacions')->insert([
            'denominacion' => 'Billete de 5 ',
            'valor' => '5.00',
            'user_id'=> 1,

        ]);


        \DB::table('denominacions')->insert([
            'denominacion' => 'Billete de 10 ',
            'valor' => '10.00',
            'user_id'=> 1,

        ]);


         \DB::table('denominacions')->insert([
            'denominacion' => 'Billete de 20 ',
            'valor' => '20.00',
            'user_id'=> 1,

        ]);

        \DB::table('denominacions')->insert([
            'denominacion' => 'Billete de 50 ',
            'valor' => '50.00',
            'user_id'=> 1,

        ]);


        \DB::table('denominacions')->insert([
            'denominacion' => 'Billete de 100 ',
            'valor' => '100.00',
            'user_id'=> 1,

        ]);



    }
}
