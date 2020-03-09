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

Route::get('/','TVShowController@index');

Route::post("/insert","TVShowController@store");
Route::post("/update","TVShowController@update");
Route::post("/delete","TVShowController@destroy");

?>