<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientoTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_tareas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarea_id');
            $table->string('descripcion');
            $table->string('fecha');
            $table->foreign('tarea_id')
                   ->references('id')
                   ->on('tareas')
                   ->cascadeOnDelete();
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
        Schema::dropIfExists('movimiento_tareas');
    }
}
