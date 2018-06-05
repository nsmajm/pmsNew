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

        $users=User::where('teamId',$r->teamId)->get();

        return view('assignJob.getTeamMember')
            ->with('users',$users);

    }

    public function assignJobUser(Request $r){

        for($i=0;$i<count($r->quantity);$i++){
            $assign=new Jobassign();
            $assign->jobId=$r->jobId;
            $assign->assignBy=Auth::user()->userId;
            $assign->assignTo=$r->user[$i];
            $assign->quantity=$r->quantity[$i];
            $assign->save();
        }

    }

    public function getAssignedJob(Request $r){
        $assignJob=Jobassign::select('client.clientName','file.folderName','jobassign.quantity','user.name','jobassign.assignDate')
            ->where('jobassign.assignTo',Auth::user()->userId)
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
