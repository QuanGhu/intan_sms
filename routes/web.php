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
Route::group(['middleware' => ['auth']], function(){
    Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
    Route::group(['prefix' => 'poli'], function () {
        Route::get('/', 'Admin\PoliController@index')->name('poli');
        Route::post('/save', 'Admin\PoliController@save')->name('poli.save');
        Route::post('/list', 'Admin\PoliController@list')->name('poli.list');
        Route::delete('/delete', 'Admin\PoliController@delete')->name('poli.delete');
        Route::put('/update', 'Admin\PoliController@update')->name('poli.update');
    });
    Route::group(['prefix' => 'super'], function () {
        Route::get('/', 'Admin\AdminController@index')->name('admin');
        Route::post('/save', 'Admin\AdminController@save')->name('admin.save');
        Route::post('/list', 'Admin\AdminController@list')->name('admin.list');
        Route::delete('/delete', 'Admin\AdminController@delete')->name('admin.delete');
        Route::put('/update', 'Admin\AdminController@update')->name('admin.update');
    });
    Route::group(['prefix' => 'message'], function () {
        Route::get('/', 'Admin\MessageController@index')->name('message');
        Route::post('/list', 'Admin\MessageController@list')->name('message.list');
    });
    Route::group(['prefix' => 'patient'], function () {
        Route::get('/', 'Admin\PatientController@index')->name('patient');
        Route::post('/list', 'Admin\PatientController@list')->name('patient.list');
    });
});

Route::get('/test', 'Admin\MessageController@getEachWord')->name('getWord');
Route::get('/do', 'Admin\MessageController@saveSms')->name('save');
Route::get('/send', 'Admin\MessageController@sendSms')->name('send');

// Auth::routes();

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
