<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/tamagotchi/clear',function(){
    $exitCode1  = Artisan::call('config:cache');
    $exitCode2  = Artisan::call('route:clear');
    $exitCode3  = Artisan::call('view:clear');
    return 'sukses';
});

Route::get('/', function() {
    return response()->redirectTo("/home");
});

Route::get("/login", "AuthController@index")->name("login");
Route::post("/login", "AuthController@login");
Route::get('logout', 'AuthController@logout')->name('logout');
Route::get("/user", "UserController@index");
Route::get("/user/api", "UserController@api");
Route::get("/user/create", "UserController@create");
Route::post("/user/store", "UserController@store");
Route::get("/user/edit/{id}", "UserController@edit");
Route::post("/user/update/{id}", "UserController@update");
Route::get("/user/delete/{id}", "UserController@delete");

Route::get("/menu-makanan", "MenuController@index");
Route::get("/menu-makanan/api", "MenuController@api");
Route::get("/menu-makanan/create", "MenuController@create");
Route::post("/menu-makanan/store", "MenuController@store");
Route::get("/menu-makanan/edit/{id}", "MenuController@edit");
Route::post("/menu-makanan/update/{id}", "MenuController@update");
Route::get("/menu-makanan/delete/{id}", "MenuController@delete");

Route::get("/pelanggan/{id}/toggle", "pelangganController@toggle");
Route::get("/pelanggan/api", "PelangganController@api");
Route::post("/pelanggan/{id}/update", "PelangganController@update");
Route::get("/pelanggan/delete/{id}", "PelangganController@destroy");
Route::resource("/pelanggan", "PelangganController");

Route::resource("/pelayan", "PelayanController");

Route::get("/kasir","CassierController@index");
Route::get("/kasir/menu","CassierController@getMenu");
Route::post("/kasir/order","CassierController@order");

Route::get("/home", "HomeController@index");

Route::get("/pegawai", "EmployeeController@index");
Route::get("/pegawai/api", "EmployeeController@api");
Route::get("/pegawai/create", "EmployeeController@create");
Route::post("/pegawai/store", "EmployeeController@store");
Route::get("/pegawai/edit/{id}", "EmployeeController@edit");
Route::post("/pegawai/update/{id}", "EmployeeController@update");
Route::get("/pegawai/delete/{id}", "EmployeeController@delete");

Route::get("/order","OrderController@index");
Route::get("/order/menu","OrderController@getMenu");
Route::post("/order/store","OrderController@store");
Route::get("/order/{id}/toggle", "KokiController@toggle");

Route::get("/koki", "KokiController@index");

Route::get("/transaksi","TransactionController@index");
Route::get("/transaksi/api","TransactionController@api");
Route::get("/transaksi/pembayaran/{id}","TransactionController@payment");
Route::post("/transaksi/pembayaran/{id}","TransactionController@update");