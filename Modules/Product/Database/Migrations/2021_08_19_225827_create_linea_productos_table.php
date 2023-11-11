<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineaProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linea_productos', function (Blueprint $table) {
            $table->increments('id');
            // Producto asociado
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('products');
            // Usuario asociado
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            // Cinoribante asociado : NULLABLE
            $table->unsignedBigInteger('comprobante_id')->nullable();
            //$table->foreign('comprobante_id')->references('id')->on('comprobantes');

            $table->string('descripcion');
            $table->DateTime('fecha')->default(date("Y-m-d H:i:s"));
            $table->double('stock')->default(0);

            $table->double('precioUnitario')->nullable();
            $table->integer('cantidad');

            $table->double('subTotal')->nullable();
            $table->double('iva')->nullable();
            $table->double('total')->nullable();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas')->restrictOnDelete();
            $table->index(['fecha']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('linea_productos');
    }
}
