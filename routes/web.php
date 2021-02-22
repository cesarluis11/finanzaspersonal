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

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('test',['as' => 'test','uses' => 'Controller@index' ]);
/*=========================================
=           CuentasController            =
=========================================*/
Route::get('cuentas/index',['as' => 'cuentas.index','uses' => 'CuentasController@index']);
Route::post('cuentas/store',['as' => 'cuentas.store','uses' => 'CuentasController@store']);
Route::get('cuentas/destroy/{id}',['as' => 'cuentas.destroy','uses' => 'CuentasController@destroy']);
/*=====  End ofCuentasController  ======*/
/*=============================================
=            MovimientosController            =
=============================================*/
Route::get('movientos/index',['as' => 'movimientos.index','uses' => 'MovimientosController@index']);
Route::post('movimientos/store',['as' => 'movimientos.store','uses' => 'MovimientosController@store']);
/*=====  End of MovimientosController  ======*/
/*========================================
=            SaldosController            =
========================================*/
Route::get('saldos/index',['as' => 'saldos.index','uses' => 'SaldosController@index']);
Route::get('saldos/show/{id}',['as' =>'saldos.show','uses' => 'SaldosController@show']);
/*=====  End of SaldosController  ======*/




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
