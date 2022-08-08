<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100)->nullable();
            $table->string('descripcion');
            $table->integer('personal_id');
            $table->integer('porcentaje');
            $table->integer('estado_tarea');
            $table->string('fecha_inicio');
            $table->string('fecha_fin');
            $table->foreign('personal_id')
                   ->references('id')
                   ->on('personals')
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
        Schema::dropIfExists('tareas');
    }
}
