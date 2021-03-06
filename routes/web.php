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
Route::get('/dashboard/fileProcessedRealTime','DashboardController@RealTimeFileProcessed')->name('dashboard.fileProcessedRealTime');

Route::view('/form','form')->name('form');
Route::view('/datatable','datatable')->name('datatable');
Route::view('/onlyDatatable','onlyDatatable')->name('only.datatable');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');



//Client
Route::get('/client/add','ClientController@add')->name('client.add');
Route::post('/client/insert','ClientController@insert')->name('client.insert');
Route::get('/client/show','ClientController@show')->name('client.show');
Route::get('/client/edit/{id}','ClientController@edit')->name('client.edit');
Route::post('/client/update','ClientController@update')->name('client.update');
Route::post('/client/show','ClientController@getData')->name('client.getData');

//Service
//Route::get('/service/add','ServiceController@add')->name('service.add');
Route::post('/service/insert','ServiceController@insert')->name('service.insert');
Route::post('/service/show','ServiceController@getData')->name('service.getData');
Route::post('/service/getServiceEditModal','ServiceController@getServiceEditModal')->name('service.getServiceEditModal');
Route::post('/service/serviceAssign','ServiceController@serviceAssign')->name('service.serviceAssign');
Route::post('/service/serviceAssign/delete','ServiceController@serviceAssignDelete')->name('service.serviceAssignDelete');
Route::post('/service/serviceAssign/assignClientToService','ServiceController@assignClientToService')->name('service.assignClientToService');
Route::get('/service/show','ServiceController@show')->name('service.show');

//JOB
Route::get('/job/information','JobController@information')->name('job.information');
Route::get('/job/add','JobController@add')->name('job.add');
Route::post('/job/insert','JobController@insert')->name('job.insert');
Route::get('/job/edit/{id}','JobController@edit')->name('job.edit');
Route::post('/job/update','JobController@update')->name('job.update');
Route::get('/job/pending','JobController@pending')->name('job.pending');
Route::post('/job/changeFeedbackState','JobController@changeFeedbackState')->name('job.changeFeedbackState');
Route::post('/job/pending','JobController@getPendingData')->name('job.getPendingData');
Route::get('/job/deadline','JobController@deadline')->name('job.deadline');
Route::post('/job/getProductionData','JobController@getProductionData')->name('job.getProductionData');
Route::post('/job/getProcessingData','JobController@getProcessingData')->name('job.getProcessingData');
Route::post('/job/getQcData','JobController@getQcData')->name('job.getQcData');
Route::post('/job/StateChange','JobController@jobStateChange')->name('job.StateChange');
Route::post('/job/ChangeQuantity','JobController@ChangeQuantity')->name('job.ChangeQuantity');

//Assign Job
Route::get('job/assign/history','JobController@assignHistory')->name('assign.history');
Route::post('job/assign/history','JobController@getAssignHistory')->name('assign.getAssignHistory');
Route::post('job/showAssignDetails','JobController@showAssignDetails')->name('assign.showAssignDetails');

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
Route::post('/feedback','JobController@getFeedbackData')->name('job.getFeedbackData');
Route::post('/changeFeedbackStatus','JobController@changeFeedbackStatus')->name('feedback.changeStatus');


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
Route::post('invoice/generate','InvoiceController@generate')->name('invoice.generate');
Route::get('invoice/pdf','InvoiceController@pdf');
Route::post('invoice/edit','InvoiceController@edit')->name('invoice.edit');
Route::post('invoice/changeInvoiceStatus','InvoiceController@changeInvoiceStatus')->name('invoice.changeInvoiceStatus');
Route::post('invoice/changeInvoiceTotal','InvoiceController@changeInvoiceTotal')->name('invoice.changeInvoiceTotal');

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
Route::post('file/editJobService','FileController@editJobService')->name('file.editJobService');


//Password
Route::get('account/password','HomeController@password')->name('account.password');
Route::post('account/password','HomeController@changePassword')->name('account.changePassword');

//Reporting
Route::get('/report/performance','ReportController@performance')->name('report.performance');
Route::get('/report/all','ReportController@all')->name('report.all');
Route::get('/report/invoice','ReportController@invoice')->name('report.invoice');
Route::post('/report/getInvoice','ReportController@getInvoice')->name('report.getInvoice');

Route::post('/report/fileCountDays','ReportController@fileCountDays')->name('report.fileCountDays');
Route::post('/report/fileProcessShift','ReportController@fileProcessShift')->name('report.fileProcessShift');
Route::post('/report/fileTypeDay','ReportController@fileTypeDay')->name('report.fileTypeDay');
Route::post('/report/fileProcessHour','ReportController@fileProcessHour')->name('report.fileProcessHour');
Route::post('/report/fileCountMonth','ReportController@fileCountMonth')->name('report.fileCountMonth');
Route::post('/report/revenueMonth','ReportController@revenueMonth')->name('report.revenueMonth');
Route::post('/report/revenueClient','ReportController@revenueClient')->name('report.revenueClient');
Route::post('/report/fileCountClient','ReportController@fileCountClient')->name('report.fileCountClient');
Route::post('/report/employeeWorkDay','ReportController@employeeWorkDay')->name('report.employeeWorkDay');
Route::post('/report/employeeWorkMonth','ReportController@employeeWorkMonth')->name('report.employeeWorkMonth');

//Employee
Route::get('employee/Edit-Employee/{id}','EmployeeController@editEmployee')->name('employee.empEdit');
Route::get('employee/Add-New-Employee','EmployeeController@addNewEmployee')->name('employee.addNewEmp');
Route::post('employee/Update-Employee/{id}','EmployeeController@updateEmployee')->name('employee.empUpdate');
Route::post('employee/Save-Employee','EmployeeController@saveNewEmployee')->name('employee.insertNewEmp');

//Bank
Route::get('Bank/All-Bank','BankController@allBankInfo')->name('bank.AllBankInfo');
Route::post('Bank/Bank-Info','BankController@getBankInfo')->name('bank.getBankInfo');
Route::post('Bank/Edit-Bank-Info/{id}','BankController@updateBankInfo')->name('bank.EditBankInformation');
Route::post('Bank/Add-Bank-Info','BankController@newBankInfo')->name('bank.getNewBankInfo');
Route::post('Bank/insert-Bank-Info','BankController@saveNewBankInfo')->name('bank.saveNewBankInformation');


//Time
Route::get('time/overtime','TimeController@overtime')->name('time.overtime');
Route::post('time/overtime','TimeController@getOverTimeData')->name('time.getOverTimeData');
Route::post('time/postOverTime','TimeController@postOverTime')->name('time.postOverTime');
Route::get('time/late','TimeController@late')->name('time.late');
Route::post('time/late','TimeController@getLateData')->name('time.getLateData');
Route::post('time/submitLate','TimeController@submitLate')->name('time.submitLate');
Route::get('time','TimeController@time')->name('overtime.late');


//tech cloud
Route::get('Tech-Cloud/Info','tclController@allInfo')->name('tcl.tclInfo');
Route::post('Tech-Cloud/save-Info','tclController@updateTclInfo')->name('tcl.saveInfo');
Route::post('Tech-Cloud/add-Info','tclController@insertTclInfo')->name('tcl.addInfo');

//Employee Attendence
Route::get('Employee/Attendence','EmployeeController@allAttendence')->name('employee.attendence');
Route::post('Employee/Info','EmployeeController@getattendenceData')->name('Employee.getattendenceData');

Route::post('Employee/add-Attendence','EmployeeController@addAttendence')->name('employee.addAttendence');
