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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::view('/','login');
Route::view('/main','main')->name('main');
Route::view('/form','form')->name('form');
Route::view('/datatable','datatable')->name('datatable');
Route::view('/onlyDatatable','onlyDatatable')->name('only.datatable');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
