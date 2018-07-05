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
Route::get('/poli', 'Admin\PoliController@index')->name('poli');

