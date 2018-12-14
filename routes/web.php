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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('gudang')->group(function(){
	Route::get('/all', "GudangController@all")->name("semua_gudang");
	Route::get("/add", "GudangController@add")->name("tambah_gudang");
	Route::post("/save", "GudangController@save")->name("simpan_gudang");
	Route::get("/edit/{id}", "GudangController@edit")->name("edit_gudang");
	Route::post("/update", "GudangController@update")->name("update_gudang");
	Route::get("/delete/{id}", "GudangController@delete")->name("hapus_gudang");
});

Route::prefix('barang')->group(function(){
	Route::get('/all', "BarangController@all")->name("semua_barang");
	Route::get("/add", "BarangController@add")->name("tambah_barang");
	Route::post("/save", "BarangController@save")->name("simpan_barang");
	Route::get("/edit/{id}", "BarangController@edit")->name("edit_barang");
	Route::post("/update", "BarangController@update")->name("update_barang");
	Route::get("/delete/{id}", "BarangController@delete")->name("hapus_barang");
});
