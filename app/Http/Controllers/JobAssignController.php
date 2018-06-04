<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Jobassign;
use Illuminate\Support\Facades\Auth;

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

}
