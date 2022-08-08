<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name');
           $table->string('iso_3166-2')->nullable();
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
        Schema::dropIfExists('estados');
    }
}
