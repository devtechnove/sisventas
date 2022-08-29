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
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Fotocopia B/N (EFECTIVO)';
        $prod->product_code = '48850-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '100';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 1.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Fotocopia B/N (PUNTO DE VENTA)';
        $prod->product_code = '48521-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '100';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 1.50 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Impresiones B/N (EFECTIVO)';
        $prod->product_code = '56325-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '100';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 2.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Impresiones B/N (PUNTO DE VENTA)';
        $prod->product_code = '12555-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '100';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 2.50 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Impresiones a color (EFECTIVO)';
        $prod->product_code = '48556-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '100';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 3.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Impresiones a color (PUNTO DE VENTA)';
        $prod->product_code = '12158-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '100';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 3.50 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Carpeta marron (OFICIO)';
        $prod->product_code = '65889-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '100';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 7.50 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Carpeta marron (CARTA)';
        $prod->product_code = '65888-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '100';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 5.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Carpeta amarilla (OFICIO)';
        $prod->product_code = '98965-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '100';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 3.50 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Carpeta amarilla (CARTA)';
        $prod->product_code = '56225-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '100';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 3.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Boligrafos';
        $prod->product_code = '12558-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '100';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 3.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();

        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Redaccion (carta saime)';
        $prod->product_code = '52585-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 15.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Reduccion (titulo)';
        $prod->product_code = '32568-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 6.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Foto (carnet)';
        $prod->product_code = '82456-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 6.50 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();



        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Foto (pasaporte)';
        $prod->product_code = '45266-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 15.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();

        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Fondo negro';
        $prod->product_code = '12556-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 15.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Porta carnet';
        $prod->product_code = '65484-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 5.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Cinta para porta carnet';
        $prod->product_code = '64827-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 6.50 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Hoja Blanca';
        $prod->product_code = '85669-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 0.50 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();

        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Porta carnet con cinta';
        $prod->product_code = '74525-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 10.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();

        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Fondo Negro ( papel fino)';
        $prod->product_code = '45258-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 9.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Planilla- Seniat';
        $prod->product_code = '68445-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 5.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Plastificacion';
        $prod->product_code = '684548-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 6.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();

        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Plastificación (bolivares)';
        $prod->product_code = '14568-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 6.50 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Scaneo';
        $prod->product_code = '35698-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 1.50 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();

        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Exposicion de motivo';
        $prod->product_code = '85023-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 15.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Carnet PVC (Punto)';
        $prod->product_code = '02563-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 30.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Curriculum';
        $prod->product_code = '11568-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 12.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Foto tipo carta';
        $prod->product_code = '02568-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 33.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Foto tipo postal 10x15';
        $prod->product_code = '03568-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 18.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Foto traje';
        $prod->product_code = '05632-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 19.50 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Paquete básico';
        $prod->product_code = '09566-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 54.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();

        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Paquete económico';
        $prod->product_code = '06855-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 42.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Paquete full';
        $prod->product_code = '07856-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 90.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Pendón 50x90';
        $prod->product_code = '08684-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 90.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();

        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Pendón 60x100';
        $prod->product_code = '09485-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 120.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Pendón 60x40';
        $prod->product_code = '10562-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 60.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Porte carnet completo';
        $prod->product_code = '11255-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 13.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();

        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Reconocimientos';
        $prod->product_code = '12258-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 9.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Redacción';
        $prod->product_code = '13585-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 18.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Sello madera';
        $prod->product_code = '14232-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 90.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();

        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Sello medianos';
        $prod->product_code = '15888-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 120.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Sellos pequeños';
        $prod->product_code = '24588-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 90.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Sellos tipo pendrive';
        $prod->product_code = '30233-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 150.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Sobres';
        $prod->product_code = '36555-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 3.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();

        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Sticker (100)';
        $prod->product_code = '44555-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 30.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Tarjetas de presentación (100)';
        $prod->product_code = '55888-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 30.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Tazas';
        $prod->product_code = '66558-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 33.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();

        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Tóper de tortas';
        $prod->product_code = '75588-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 33.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


        $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Tóper de tortas papel fino';
        $prod->product_code = '76699-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 9.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();


         $prod = new Product();
        $prod->empresa_id = 2;
        $prod->category_id = 2;
        $prod->product_name = 'Volantes (100)';
        $prod->product_code = '66585-8';
        $prod->product_barcode_symbology = 'C128';
        $prod->product_quantity = '1';
        $prod->product_cost = 0.50 ;
        $prod->product_price = 30.00 ;
        $prod->product_stock_alert = 0 ;
        $prod->product_order_tax = 0 ;
        $prod->product_tax_type = 1;
        $prod->product_unit = 'UNID';
        $prod->save();



















    }
}
