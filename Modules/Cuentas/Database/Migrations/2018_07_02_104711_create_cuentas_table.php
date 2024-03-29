<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->string('nb_nombre', 100)->nullable();
            //$table->integer('tipo_cuenta');
            $table->string('fe_apertura')->nullable();
            $table->string('nu_cuenta')->nullable();
            $table->string('moneda_id')->nullable();
            $table->double('saldo_apertura')->nullable();
            $table->double('saldo_actual')->nullable();
            $table->string('tx_nota')->nullable();
            $table->smallInteger('is_active')->nullable();
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
        Schema::dropIfExists('cuentas');
    }
}
