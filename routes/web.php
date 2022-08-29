<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')
         ->name('home')
         ->middleware('verified')
         ->middleware('actived');

    Route::get('/sales-purchases/chart-data', 'HomeController@salesPurchasesChart')
        ->name('sales-purchases.chart');

    Route::get('/current-month/chart-data', 'HomeController@currentMonthChart')
        ->name('current-month.chart');

    Route::get('/payment-flow/chart-data', 'HomeController@paymentChart')
        ->name('payment-flow.chart');

         Route::resource('tasa', 'TasaController');

         Route::get('/logins', 'LoginController@index')
        ->name('logins.index');
});

