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
        $user = new User();
        $user->name              = 'Marcos Gonzalez';
        $user->empresa_id        = 2;
        $user->email             = 'mgonzalez@mail.com';
        $user->email_verified_at = date('Y-m-d H:i:s') ;
        $user->password          = Hash::make('admin123');
        $user->status            = 1;
        $user->role_id           = 2;
        $user->save();

        $user->assignRole('Administrador');

        $user = new User();
        $user->name              = 'Theizer Gonzalez';
        $user->empresa_id        = 2;
        $user->email             = 'tgonzalez@mail.com';
        $user->email_verified_at = date('Y-m-d H:i:s') ;
        $user->password          = Hash::make('admin123');
        $user->status            = 1;
        $user->role_id           = 1;
        $user->save();

        $user->assignRole('Super Administrador');


        $user = new User();
        $user->name              = 'Theizer Gonzalez';
        $user->empresa_id        = 1;
        $user->email             = 'devtechve@gmail.com';
        $user->email_verified_at = date('Y-m-d H:i:s') ;
        $user->password          = Hash::make('admin123');
        $user->status            = 1;
        $user->role_id           = 1;
        $user->save();

        $user->assignRole('Super Administrador');


         $category = Category::create([
            'category_code' => '242353',
            'category_name' => 'Productos de almacén',
            'empresa_id'    => 2

        ]);

          $category = Category::create([
            'category_code' => '254864',
            'category_name' => 'Servicios',
            'empresa_id'    => 2

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
