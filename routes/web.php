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

use Illuminate\Auth\Events\Verified;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]); 

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/regest', 'RedireccionesController@regest')->name('regest')->middleware('verified');

Route::get('/grahum', 'RedireccionesController@grahum')->name('grahum')->middleware('verified');

Route::get('/gratemp', 'RedireccionesController@gratemp')->name('gratemp')->middleware('verified');

Route::get('/muestramonitor', 'RedireccionesController@muestramonitor')->name('muestramonitor')->middleware('verified');

Route::get('/formtest', 'RedireccionesController@formtest')->name('formtest')->middleware('verified');

//Route::post('/formtest','formtestController@getRemoteData')->name('formtest');

Route::get('/mgt','RedireccionesController@mgt')->name('mgt')->middleware('verified');

Route::get('/mtt','RedireccionesController@mtt')->name('mtt')->middleware('verified');

Route::get('/mgtp','RedireccionesPublicasController@mtt')->name('mgtp');