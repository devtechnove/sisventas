<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth'], function () {

    //User Profile
    Route::get('/user/profile', 'ProfileController@edit')->middleware('actived')->name('profile.edit');
    Route::patch('/user/profile', 'ProfileController@update')->middleware('actived')->name('profile.update');
    Route::patch('/user/password', 'ProfileController@updatePassword')->middleware('actived')->name('profile.update.password');

    //Users
    Route::resource('users', 'UsersController')->middleware('actived')->except('show');

    //Roles
    Route::resource('roles', 'RolesController')->middleware('actived')->except('show');

});
