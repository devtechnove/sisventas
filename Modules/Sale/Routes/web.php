<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {

    //POS
    Route::get('/app/pos', 'PosController@index')->name('app.pos.index');
    Route::post('/app/pos', 'PosController@store')->name('app.pos.store');

    //Generate PDF
    Route::get('/sales/pdf/{id}', 'SaleController@pdf')->name('sales.pdf');
    Route::get('/sales/pos/pdf/{id}', 'SaleController@pdf')->name('sales.pos.pdf');

    //Sales
    Route::resource('sales', 'SaleController');

    //Payments
    Route::get('/sale-payments/{sale_id}', 'SalePaymentsController@index')->name('sale-payments.index');
    Route::get('/sale-payments/{sale_id}/create', 'SalePaymentsController@create')->name('sale-payments.create');
    Route::post('/sale-payments/store', 'SalePaymentsController@store')->name('sale-payments.store');
    Route::get('/sale-payments/{sale_id}/edit/{salePayment}', 'SalePaymentsController@edit')->name('sale-payments.edit');
    Route::patch('/sale-payments/update/{salePayment}', 'SalePaymentsController@update')->name('sale-payments.update');
    Route::delete('/sale-payments/destroy/{salePayment}', 'SalePaymentsController@destroy')->name('sale-payments.destroy');

    /**CONTABILIDAD */
    Route::get('panel/contabilidad', 'ContabilidadController@index')->name('index.contabilidad');
    Route::get('panel/abrir_caja', 'ContabilidadController@abrir_caja')->name('abrir_caja.contabilidad');
    Route::post('panel/abrir_caja', 'ContabilidadController@store_abrir_caja')->name('store_abrir_caja.contabilidad');
    Route::get('panel/cerrar_caja/{id}', 'ContabilidadController@cerrar_caja')->name('cerrar_caja.contabilidad');
    Route::patch('panel/cerrar_caja/{id}', 'ContabilidadController@store_cerrar_caja')->name('store_cerrar_caja.contabilidad');

    Route::get('panel/ganancias/mensual', 'ContabilidadController@semanal')->name('semanal.contabilidad');
    Route::get('panel/margen/historial', 'ContabilidadController@historial')->name('historial.contabilidad');
    Route::get('panel/caja/{codigo}/data', 'CajaController@data_caja')->name('data_caja.detalle');
});
