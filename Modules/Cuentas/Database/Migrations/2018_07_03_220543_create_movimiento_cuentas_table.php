<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientoCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_cuentas', function (Blueprint $table) {
            $table->id();
            $table->integer('cuenta_id')->unsigned();
            $table->string('descripcion', 200);
            $table->string('fecha_emision');
            $table->string('mes');
            $table->string('hora');
            $table->string('ano');
            $table->string('tipo_movimiento');
            $table->double('credito', 5, 2);
            $table->double('debito', 5, 2);
            $table->foreign('cuenta_id')->references('id')->on('cuentas')->onDelete('cascade');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimiento_cuentas');
    }
}
