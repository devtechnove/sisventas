<?php

namespace Modules\Expense\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Expense\Entities\ExpenseCategory;

class ExpenseDatabaseSeeder extends Seeder
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

        $cate = new ExpenseCategory();
        $cate->category_name = 'Compra de materiales';
        $cate->category_description = 'Cuando se adquiere material estratégico para laborar.';
        $cate->save();


        $cate = new ExpenseCategory();
        $cate->category_name = 'Compra de material de limpieza';
        $cate->category_description = 'Cuando se adquiere material limpieza para la oficina.';
        $cate->save();


        $cate = new ExpenseCategory();
        $cate->category_name = 'Entrega de viáticos';
        $cate->category_description = 'Cuando se adquiere viáticos para los trabajadores cuando van a visitar a un cliente.';
        $cate->save();


        $cate = new ExpenseCategory();
        $cate->category_name = 'Entrega de efectivo';
        $cate->category_description = 'Cuando se entrega efectivo para el pasaje de los trabajadores en la semana.';
        $cate->save();

        $cate = new ExpenseCategory();
        $cate->category_name = 'Pago a proveedores';
        $cate->category_description = 'Cuando se les paga dinero pendiente a los proveedores.';
        $cate->save();



    }
}
