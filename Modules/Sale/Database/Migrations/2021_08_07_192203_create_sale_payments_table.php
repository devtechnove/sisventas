<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('idcuenta');
            $table->integer('amount');
            $table->date('date');
            $table->string('reference');
            $table->string('payment_method');
            $table->text('note')->nullable();
            //$table->foreign('sale_id')->references('id')->on('sales')->cascadeOnDelete();
            $table->foreign('idcuenta')->references('id')->on('cuentas');
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
        Schema::dropIfExists('sale_payments');
    }
}
