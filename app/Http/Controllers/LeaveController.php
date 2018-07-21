<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Leave;
use App\Status;
use Auth;
use Session;
use Yajra\DataTables\DataTables;
class LeaveController extends Controller
{
    public function showLeaveRequest(){
        if(Auth::user()->userType == USER_TYPE['Human Resource Management']){
            $status=Status::where('statusType','leaveStatus')->get();
            return view('leave.showLeaveRequest')->with('status',$status);
        }

        return back();

    }

    public function getLeaveRequestData(Request $r){
        $leaves=Leave::select('leaveId','leave.statusId','user.name','leave.startDate','leave.endDate','leave.createdAt','cause','leaveDetails')
            ->leftJoin('user','user.userId','leave.userId');

        if($r->statusId){

            $leaves=$leaves->where('leave.statusId',$r->statusId);
        }

        $leaves=$leaves->get();
        $datatables = Datatables::of($leaves);
        return $datatables->make(true);


    }

    public function show(){
        $leaves=Leave::where('userId',Auth::user()->userId)->get();

//        return $leaves;
        return view('leave.index')
            ->with('leaves',$leaves);
    }

    public function apply(){
        return view('leave.apply');
    }

    public function submit(Request $r){
        $status=Status::where('statusType','leaveStatus')->where('statusName','pending')->first();

        $leave=new Leave();
        $leave->userId=Auth::user()->userId;
        $leave->statusId=$status->statusId;
        $leave->startDate=$r->fromDate;
        $leave->endDate=$r->toDate;
        $leave->cause=$r->cause;
        $leave->leaveDetails=$r->leaveDetails;
        $leave->save();

        Session::flash('message', 'Leave request has been placed wait until it approved!');
        return back();
    }

    public function changeStatus(Request $r){
        $leave=Leave::findOrFail($r->leaveId);
        if($leave->statusId ==7){
            $leave->statusId=8;
        }
        else if ($leave->statusId ==8){
            $leave->statusId=7;
        }
        $leave->approvedBy=Auth::user()->userId;
        $leave->save();
        return $leave;
    }
}
