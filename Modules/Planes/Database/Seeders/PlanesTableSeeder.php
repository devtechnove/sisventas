<?php

namespace Modules\Planes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Planes\Entities\Planes;

class PlanesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = new Planes();
        $plan->name = 'Propietario';
        $plan->tipo_plan = 'Indeterminado';
        $plan->amount = 00.00;
        $plan->save();


        $plan = new Planes();
        $plan->name = 'Básico';
        $plan->tipo_plan = 'Mensual';
        $plan->amount = 10.00;
        $plan->save();

        $plan = new Planes();
        $plan->name = 'Standard';
        $plan->tipo_plan = 'Mensual';
        $plan->amount = 25.00;
        $plan->save();

        $plan = new Planes();
        $plan->name = 'Business Plus';
        $plan->tipo_plan = 'Mensual';
        $plan->amount = 40.00;
        $plan->save();

        $plan = new Planes();
        $plan->name = 'Gratuito';
        $plan->tipo_plan = '7 días';
        $plan->amount = 00.00;
        $plan->save();


        $plan = new Planes();
        $plan->name = 'Básico';
        $plan->tipo_plan = 'Anual';
        $plan->amount = 100.00;
        $plan->save();

        $plan = new Planes();
        $plan->name = 'Standard';
        $plan->tipo_plan = 'Anual';
        $plan->amount = 200.00;
        $plan->save();

        $plan = new Planes();
        $plan->name = 'Business Plus';
        $plan->tipo_plan = 'Anual';
        $plan->amount = 400.00;
        $plan->save();





    }
}
