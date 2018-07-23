<?php

namespace App\Http\Controllers;

use App\Client;
use App\Shift;
use App\User;
use App\Overtime;
use App\OvertimeAssign;
use App\Late;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;
use Session;

class TimeController extends Controller
{
    public function overtime(){
        $clients = Client::select('clientId', 'clientName')
            ->get();
        $users=User::select('userId','loginId')
            ->where('userType','!=',USER_TYPE['Admin'])
            ->where('userType','!=',USER_TYPE['Client'])
            ->where('userType','!=',USER_TYPE['Human Resource Management'])
            ->get();

        $shifts=Shift::get();



        return view('time.overtime',compact('clients','users','shifts'));
    }

    public function getOverTimeData(Request $r){
        $overtime=OvertimeAssign::select('overtime.date','client.clientName','u1.name as userName','overtime.startTime','overtime.endTime','hr.name as assignBy','shift.shiftName')
            ->leftJoin('overtime','overtime.overtimeId','overtimeassign.overtimeId')
            ->leftJoin('user as u1','u1.userId','overtimeassign.userId')
            ->leftJoin('user as hr','hr.userId','overtime.createdBy')
            ->leftJoin('client','client.clientId','overtime.clientId')
            ->leftJoin('shift','shift.shiftId','overtime.shiftId')
            ->where('overtime.date',date("Y-m-d"))
            ->get();
        $datatables = Datatables::of($overtime);

        return $datatables->make(true);


    }

    public function postOverTime(Request $r){
        $overtime=new Overtime();
        $overtime->startTime=$r->startTime;
        $overtime->endTime=$r->endTime;
        $overtime->date=$r->date;
        $overtime->clientId=$r->clientId;
        $overtime->shiftId=$r->shiftId;
        $overtime->createdBy=Auth::user()->userId;
        $overtime->save();

        foreach ($r->userId as $userId){
            $overtimeAssign=new OvertimeAssign();
            $overtimeAssign->overtimeId=$overtime->overtimeId;
            $overtimeAssign->userId=$userId;
            $overtimeAssign->save();

        }
        Session::flash('message', 'Overtime Assigned  Successfully!');
        return back();
    }

    public function late(){
        $users=User::select('userId','loginId')
            ->where('userType','!=',USER_TYPE['Admin'])
            ->where('userType','!=',USER_TYPE['Client'])
            ->where('userType','!=',USER_TYPE['Human Resource Management'])
            ->get();
        return view('time.late',compact('users'));
    }

    public function submitLate(Request $r){
        $late=new Late();
        $late->createdBy=Auth::user()->userId;
        $late->userId=$r->userId;
        $late->minute=$r->minute;
        $late->save();


        return response()->json(['title'=>'Success','body'=>'Late Submitted Successfully']);
    }


}
