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

Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
Route::get('/patient', 'Admin\PatientController@index')->name('patient');
Route::group(['prefix' => 'poli'], function () {
    Route::get('/', 'Admin\PoliController@index')->name('poli');
    Route::post('/save', 'Admin\PoliController@save')->name('poli.save');
    Route::post('/list', 'Admin\PoliController@list')->name('poli.list');
    Route::delete('/delete', 'Admin\PoliController@delete')->name('poli.delete');
    Route::put('/update', 'Admin\PoliController@update')->name('poli.update');
});

