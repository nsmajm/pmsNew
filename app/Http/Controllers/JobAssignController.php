<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Jobassign;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use DB;


class JobAssignController extends Controller
{
    public function getTeamMembers(Request $r){

        $users=User::where('teamId',$r->teamId)
//            ->leftJoin('job')
            ->get();
        $jobAssain=Jobassign::where('jobId',$r->jobId)->get();



        return view('assignJob.getTeamMember',compact('users','jobAssain'));

    }

    public function assignJobUser(Request $r){

        for($i=0;$i<count($r->quantity);$i++){
            $assign=Jobassign::where('assignTo',$r->user[$i])
                ->where('jobId',$r->jobId)->first();
            if($assign==null){
                $assign=new Jobassign();
                $assign->jobId=$r->jobId;
                $assign->assignBy=Auth::user()->userId;
                $assign->assignTo=$r->user[$i];
                $assign->quantity=$r->quantity[$i];
                $assign->save();
            }
            else{
                Jobassign::where('assignTo',$r->user[$i])
                    ->where('jobId',$r->jobId)->update(['quantity'=> $r->quantity[$i]]);
            }

        }

    }

    public function getAssignedJob(Request $r){
        $assignJob=Jobassign::select('client.clientName','file.folderName','jobassign.quantity','user.name','jobassign.assignDate')
            ->where('jobassign.assignTo',Auth::user()->userId)
//            ->where('job.fileCheck',null)
            ->where('jobassign.leaveDate',null)
            ->leftJoin('user','user.userId','jobassign.assignBy')
            ->leftJoin('job','job.jobId','jobassign.jobId')
            ->leftJoin('file','job.jobId','file.jobId')
            ->leftJoin('client','client.clientId','job.clientId');

        if($r->date){
            $assignJob=$assignJob->whereDate('jobassign.assignDate',$r->date);

        }

        $assignJob=$assignJob->get();


        $datatables = Datatables::of($assignJob);

        return $datatables->make(true);

    }

}
