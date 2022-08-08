<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('lastname', 100);
            $table->string('cedula', 100);
            $table->string('telefono', 100);
            $table->string('cargo', 100);
            $table->string('genero', 100);
            $table->string('estado_civil', 100);
            $table->string('email', 100);
            $table->string('fecha_nacimiento', 100);
            $table->string('lugar_nacimiento', 100);
            $table->string('edad', 100);
            $table->string('ano_ingreso',100);
            $table->string('nacionalidad',100);
            $table->string('tipo_sangre',100);
            $table->string('grado_instruccion',100);
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->integer('municipio_id')->unsigned();
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->integer('parroquia_id')->unsigned();
            $table->foreign('parroquia_id')->references('id')->on('parroquias');
            $table->string('direccion',100);
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
        Schema::dropIfExists('personals');
    }
}
