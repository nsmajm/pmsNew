<?php

namespace App\Http\Controllers;


use App\Client;
use App\Shift;
use App\User;
use App\Overtime;
use App\OvertimeAssign;
use App\Late;
use foo\bar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;
use Session;
use DB;

class TimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function overtime(){
        if(Auth::user()->userType==USER_TYPE['Admin'] || Auth::user()->userType==USER_TYPE['Human Resource Management']){
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
        return back();
    }

    public function getOverTimeData(Request $r){
        $overtime=OvertimeAssign::select('overtime.date','client.clientName','u1.name as userName','overtime.totalHour','hr.name as assignBy','shift.shiftName')
            ->leftJoin('overtime','overtime.overtimeId','overtimeassign.overtimeId')
            ->leftJoin('user as u1','u1.userId','overtimeassign.userId')
            ->leftJoin('user as hr','hr.userId','overtime.createdBy')
            ->leftJoin('client','client.clientId','overtime.clientId')
            ->leftJoin('shift','shift.shiftId','overtime.shiftId');

        if($r->date){
            $overtime=$overtime->where('overtime.date',$r->date);
        }

         $overtime=$overtime->get();
        $datatables = Datatables::of($overtime);

        return $datatables->make(true);


    }

    public function postOverTime(Request $r){
        $overtime=new Overtime();
        $overtime->totalHour=$r->totalHour;
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
        if(Auth::user()->userType==USER_TYPE['Admin'] || Auth::user()->userType==USER_TYPE['Human Resource Management']){
            $users=User::select('userId','loginId')
                ->where('userType','!=',USER_TYPE['Admin'])
                ->where('userType','!=',USER_TYPE['Client'])
                ->where('userType','!=',USER_TYPE['Human Resource Management'])
                ->get();
            return view('time.late',compact('users'));
        }


        return back();
    }

    public function getLateData(Request $r){
        $late=Late::select('user.name','minute','late.created_at')
            ->leftJoin('user','user.userId','late.userId');


        if($r->date){
            $late=$late->where(DB::raw('DATE(late.created_at)'),$r->date);
        }
        $late=$late->get();

        $datatables = Datatables::of($late);
        return $datatables->make(true);
    }

    public function submitLate(Request $r){
        $late=new Late();
        $late->createdBy=Auth::user()->userId;
        $late->userId=$r->userId;
        $late->minute=$r->minute;
        $late->save();

        return response()->json(['title'=>'Success','body'=>'Late Submitted Successfully']);
    }

    public function time(){
        if(Auth::user()->userType==USER_TYPE['Admin'] || Auth::user()->userType==USER_TYPE['Human Resource Management']){
            return view('time.time');
        }

        return back();
    }


}
