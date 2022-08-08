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

Route::get("/home", "HomeController@index");