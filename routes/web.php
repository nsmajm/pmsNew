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
Route::get('/','Auth\LoginController@loginForm');

Route::get('/dashboard','DashboardController@index')->name('main');

Route::view('/form','form')->name('form');
Route::view('/datatable','datatable')->name('datatable');
Route::view('/onlyDatatable','onlyDatatable')->name('only.datatable');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//Client
Route::get('/client/add','ClientController@add')->name('client.add');
Route::post('/client/insert','ClientController@insert')->name('client.insert');
Route::get('/client/show','ClientController@show')->name('client.show');
Route::post('/client/show','ClientController@getData')->name('client.getData');

//Service
Route::get('/service/add','ServiceController@add')->name('service.add');
Route::post('/service/insert','ServiceController@insert')->name('service.insert');
Route::post('/service/show','ServiceController@getData')->name('service.getData');
Route::post('/service/getServiceEditModal','ServiceController@getServiceEditModal')->name('service.getServiceEditModal');
Route::get('/service/show','ServiceController@show')->name('service.show');

//JOB
Route::get('/job/information','JobController@information')->name('job.information');
Route::get('/job/add','JobController@add')->name('job.add');
Route::post('/job/insert','JobController@insert')->name('job.insert');
Route::get('/job/pending','JobController@pending')->name('job.pending');
Route::post('/job/pending','JobController@getPendingData')->name('job.getPendingData');
Route::get('/job/deadline','JobController@deadline')->name('job.deadline');
Route::post('/job/getProductionData','JobController@getProductionData')->name('job.getProductionData');
Route::post('/job/getProcessingData','JobController@getProcessingData')->name('job.getProcessingData');
Route::post('/job/getQcData','JobController@getQcData')->name('job.getQcData');

Route::post('/job/getServiceModal','JobController@getServiceModal')->name('job.getServiceModal');

//END JOB

//Feedback
Route::get('/feedback','JobController@feedback')->name('job.feedback');


//Brief
Route::get('/brief/check','BriefController@check')->name('brief.check');
Route::get('/brief/','BriefController@index')->name('brief.index');

//Leave
Route::get('/leave','LeaveController@index')->name('leave.index');

//BILL
Route::get('bill/add','BillController@addRate')->name('bill.addRate');
Route::get('bill/summery','BillController@summery')->name('bill.summery');
