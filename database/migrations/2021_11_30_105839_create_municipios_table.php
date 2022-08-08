<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
           $table->increments('id');
           $table->string('municipio');
           $table->integer('estado_id')->unsigned();
           $table->foreign('estado_id')->references('id')->on('estados');
           $table->integer('user_id')->unsigned()->default(1);
           $table->foreign('user_id')->references('id')->on('users');
           $table->smallInteger('status')->default(0);
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
        Schema::dropIfExists('municipios');
    }
}
