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
    Route::get('/app/pos', 'PosController@index')
    ->middleware('verified')
    ->middleware('actived')
    ->name('app.pos.index');
    Route::post('/app/pos', 'PosController@store')
    ->middleware('verified')
    ->middleware('actived')
    ->name('app.pos.store');

    //Generate PDF
    Route::get('/sales/pdf/{id}', 'SaleController@pdf')
    ->middleware('verified')
    ->middleware('actived')
    ->name('sales.pdf');
    Route::get('/sales/pos/pdf/{id}', 'SaleController@pdf')
    ->middleware('verified')
    ->middleware('actived')
    ->name('sales.pos.pdf');

    //Sales
    Route::resource('sales', 'SaleController');

    //Payments
    Route::get('/sale-payments/{sale_id}', 'SalePaymentsController@index')
    ->middleware('verified')
    ->middleware('actived')
    ->name('sale-payments.index');
    Route::get('/sale-payments/{sale_id}/create', 'SalePaymentsController@create')
    ->middleware('verified')
    ->middleware('actived')
    ->name('sale-payments.create');
    Route::post('/sale-payments/store', 'SalePaymentsController@store')
    ->middleware('verified')
    ->middleware('actived')
    ->name('sale-payments.store');
    Route::get('/sale-payments/{sale_id}/edit/{salePayment}', 'SalePaymentsController@edit')
    ->middleware('verified')
    ->middleware('actived')
    ->name('sale-payments.edit');
    Route::patch('/sale-payments/update/{salePayment}', 'SalePaymentsController@update')
    ->middleware('verified')
    ->middleware('actived')
    ->name('sale-payments.update');
    Route::delete('/sale-payments/destroy/{salePayment}', 'SalePaymentsController@destroy')
    ->middleware('verified')
    ->middleware('actived')
    ->name('sale-payments.destroy');

    /**CONTABILIDAD */
    Route::get('panel/contabilidad', 'ContabilidadController@index')
    ->middleware('verified')
    ->middleware('actived')
    ->name('index.contabilidad');
    Route::get('panel/abrir_caja', 'ContabilidadController@abrir_caja')
    ->middleware('verified')
    ->middleware('actived')
    ->name('abrir_caja.contabilidad');
    Route::post('panel/abrir_caja', 'ContabilidadController@store_abrir_caja')
    ->middleware('verified')
    ->middleware('actived')
    ->name('store_abrir_caja.contabilidad');
    Route::get('panel/cerrar_caja/{id}', 'ContabilidadController@cerrar_caja')
    ->middleware('verified')
    ->middleware('actived')
    ->name('cerrar_caja.contabilidad');
    Route::patch('panel/cerrar_caja/{id}', 'ContabilidadController@store_cerrar_caja')
    ->middleware('verified')
    ->middleware('actived')
    ->name('store_cerrar_caja.contabilidad');

    Route::get('panel/ganancias/mensual', 'ContabilidadController@semanal')
    ->middleware('verified')
    ->middleware('actived')
    ->name('semanal.contabilidad');
    Route::get('panel/margen/historial', 'ContabilidadController@historial')
    ->middleware('verified')
    ->middleware('actived')
    ->name('historial.contabilidad');
    Route::get('panel/caja/{codigo}/data', 'CajaController@data_caja')
    ->middleware('verified')
    ->middleware('actived')
    ->name('data_caja.detalle');
});
