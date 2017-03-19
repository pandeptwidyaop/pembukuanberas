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

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
  Route::group(['middleware' => 'active'], function(){
    Route::get('/', function(){
      return redirect('gudang/stok');;
    });
    Route::get('gudang', function(){
      return redirect('gudang/stok');;
    });
    Route::resource('gudang/stok','GudangController');
    Route::resource('gudang/gabah','GabahController');
    Route::resource('gudang/jemurgabah','JemurgabahController');
    Route::resource('gudang/giling','GilingController');
    Route::resource('gudang/beras','BerasController');
    Route::resource('gudang/beliberas','BerasbeliController');
});

});
