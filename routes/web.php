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

Route::get('/procedure', function () {
    $a="2018-05-28";

    DB::statement('CALL job_information(:date, @created, @delivered);',array($a));
    $results = DB::select('select @created as created, @delivered as delivered');
    return $results;

});
//Long Poll
Route::get('/poll','PollController@longPool');


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
//Route::get('/service/add','ServiceController@add')->name('service.add');
Route::post('/service/insert','ServiceController@insert')->name('service.insert');
Route::post('/service/show','ServiceController@getData')->name('service.getData');
Route::post('/service/getServiceEditModal','ServiceController@getServiceEditModal')->name('service.getServiceEditModal');
Route::get('/service/show','ServiceController@show')->name('service.show');

//JOB
Route::get('/job/information','JobController@information')->name('job.information');
Route::get('/job/add','JobController@add')->name('job.add');
Route::post('/job/insert','JobController@insert')->name('job.insert');
Route::get('/job/edit/{id}','JobController@edit')->name('job.edit');
Route::post('/job/update','JobController@update')->name('job.update');
Route::get('/job/pending','JobController@pending')->name('job.pending');
Route::post('/job/pending','JobController@getPendingData')->name('job.getPendingData');
Route::get('/job/deadline','JobController@deadline')->name('job.deadline');
Route::post('/job/getProductionData','JobController@getProductionData')->name('job.getProductionData');
Route::post('/job/getProcessingData','JobController@getProcessingData')->name('job.getProcessingData');
Route::post('/job/getQcData','JobController@getQcData')->name('job.getQcData');
Route::post('/job/StateChange','JobController@jobStateChange')->name('job.StateChange');

//Assign Job

Route::get('/job/assign/{id}','JobController@assignJob')->name('job.assign');

Route::post('/job/getTeamMembers','JobAssignController@getTeamMembers')->name('job.getTeamMembers');
Route::post('/job/assignJobUser','JobAssignController@assignJobUser')->name('job.assignJobUser');

Route::get('/job/search','JobController@all')->name('job.all');//Get All Job
Route::post('/job/search','JobController@getAllData')->name('job.getAllData');

Route::post('/job/getServiceModal','JobController@getServiceModal')->name('job.getServiceModal');
Route::post('/job/checkQuantity','JobController@checkQuantity')->name('job.checkQuantity');

//Job Priority
Route::post('/job/lessPriority','JobController@lessPriority')->name('priority.less');

//END JOB

//User
Route::get('user/create','UserController@create')->name('user.create');
Route::get('user/edit/{id}','UserController@edit')->name('user.edit');
Route::post('user/insert','UserController@insert')->name('user.insert');
Route::get('user/show','UserController@show')->name('user.show');
Route::post('user/show','UserController@getData')->name('user.getData');


Route::post('user/getAssignedJob','JobAssignController@getAssignedJob')->name('user.getAssignedJob');

//Comments For Jobs
Route::post('comments/get','CommentsController@getComments')->name('comments.get');
Route::post('comments/send','CommentsController@sendComments')->name('comments.send');


//Feedback
Route::get('/feedback','JobController@feedback')->name('job.feedback');


//Brief
Route::get('/brief/check','BriefController@check')->name('brief.check');
Route::post('/brief/check','BriefController@getBriefCheckData')->name('brief.getBriefCheckData');
Route::get('/brief/','BriefController@index')->name('brief.index');
Route::get('/brief/add','BriefController@add')->name('brief.add');
Route::post('/brief/insert','BriefController@insert')->name('brief.insert');
Route::post('/brief/showBrief','BriefController@showBrief')->name('brief.showBrief');
Route::get('/brief/edit/{id}','BriefController@edit')->name('brief.edit');

//Leave
Route::get('/leave/requests','LeaveController@showLeaveRequest')->name('leave.showLeaveRequest');
Route::post('/leave/requests','LeaveController@getLeaveRequestData')->name('leave.getLeaveRequestData');
Route::get('/leave/show','LeaveController@show')->name('leave.show');
Route::get('/leave/apply','LeaveController@apply')->name('leave.apply');
Route::post('/leave/apply','LeaveController@submit')->name('leave.submit');
Route::post('/leave/changeStatus','LeaveController@changeStatus')->name('leave.changeStatus');

//BILL
Route::get('bill/add','BillController@addRate')->name('bill.addRate');
Route::post('bill/modal','BillController@addBillModal')->name('bill.addBillModal');
Route::post('bill/changeRate','BillController@changeRate')->name('bill.changeRate');
Route::get('bill/summery','BillController@summery')->name('bill.summery');

//Rate
Route::get('rate','BillController@rate')->name('rate');
Route::post('rate/getClient','BillController@getClient')->name('rate.getClient');
Route::post('rate/setRate','BillController@setRate')->name('rate.setRate');

//Invoice
Route::get('invoice','InvoiceController@index')->name('invoice.index');
Route::post('invoice','InvoiceController@search')->name('invoice.search');

//Group
Route::get('group','GroupController@index')->name('group.index');
Route::post('group/insert','GroupController@insert')->name('group.insert');
Route::post('/group','GroupController@getGroupData')->name('group.getGroupData');
Route::post('/group/assign','GroupController@assign')->name('group.assign');
Route::post('/getIndividualTeamMember','GroupController@getIndividualTeamMember')->name('group.getIndividualTeamMember');

//Team
Route::get('/team/myTeam','TeamController@TeamInfo')->name('team.myTeam');
Route::get('/team','TeamController@index')->name('team.index');
Route::post('/team/insert','TeamController@insert')->name('team.insert');
Route::post('/team/assign','TeamController@assign')->name('team.assign');
Route::post('/team','TeamController@getTeamData')->name('team.getTeamData');
Route::post('/changeLeaderState','TeamController@changeLeaderState')->name('team.changeLeaderState');
//Route::post('/getIndividualTeamMember','TeamController@getIndividualTeamMember')->name('team.getIndividualTeamMember');

//Shift
Route::get('shift/','ShiftController@index')->name('shift.index');
Route::post('shift/','ShiftController@getData')->name('shift.getData');
Route::get('shift/create','ShiftController@create')->name('shift.create');
Route::post('shift/assign','ShiftController@assign')->name('shift.assign');
Route::get('shift/show/{id}','ShiftController@show')->name('shift.show');
Route::get('shift/pdf/{id}','ShiftController@downloadPdf')->name('shift.downloadPdf');

//File Check
Route::get('file/check','FileController@index')->name('file.check');
Route::post('file/check','FileController@doneCheck')->name('file.doneCheck');


//Password
Route::get('account/password','HomeController@password')->name('account.password');
Route::post('account/password','HomeController@changePassword')->name('account.changePassword');

//Reporting
Route::get('/report/performance','ReportController@performance')->name('report.performance');

//Employee
Route::get('employee/Edit-Employee/{id}','EmployeeController@editEmployee')->name('employee.empEdit');

Route::post('employee/Update-Employee/{id}','EmployeeController@updateEmployee')->name('employee.empUpdate');

