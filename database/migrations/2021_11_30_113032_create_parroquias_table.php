<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParroquiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parroquias', function (Blueprint $table) {
           $table->increments('id');
           $table->string('parroquia');
           $table->integer('municipio_id')->unsigned();
           $table->foreign('municipio_id')->references('id')->on('municipios');
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
        Schema::dropIfExists('parroquias');
    }
}
