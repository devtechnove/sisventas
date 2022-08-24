<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $prod = new Product();
        $prod->category_id = 2;
        $prod->product_name = 'Fotocopia B/N (EFECTIVO)';
        $prod->product_code = '48850-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '100';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 1.00 ;
        $prod->product_unit = 100;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->save();


    }
}
