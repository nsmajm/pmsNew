<?php

namespace App\Http\Controllers;

use App\Employeeinfo;
use App\UserType;
use Illuminate\Http\Request;
use App\Team;
use App\User;
use Yajra\DataTables\DataTables;
use Session;

class TeamController extends Controller
{
    public function index(){
        $teams=Team::get();

        return view('team.index')
            ->with('teams',$teams);
    }

    public function getIndividualTeamMember(Request $r){
        $users=User::select('name','userType')
            ->where('teamId',$r->teamId)
            ->get();

        return $users;

    }

    public function getTeamData(Request $r){

    }

    public function changeLeaderState(Request $r){
        $user=User::findOrFail($r->userId);
        if($user->teamLeader==0){
            $user->teamLeader=1;
        }
        else{
            $user->teamLeader=0;
        }
        $user->save();

//        return $r;
    }

    public function insert(Request $r){
        $this->validate($r,[
            'teamName'=>'required|max:45|unique:team,teamName',
        ]);

        $team=new Team();
        $team->teamName=$r->teamName;
        $team->save();

        Session::flash('message', 'Team Added Successfully!');
        return back();
    }

    public function assign(Request $r){

        $this->validate($r,[
            'userId'=>'required',
        ]);
        if($r->reset){
            $teamId=null;
        }
        else{
            $teamId=$r->teamId;
        }

        User::whereIn('userId',$r->userId)->update(['teamId' =>$teamId ]);
        Session::flash('message', 'Successfully!');
        return back();

    }

    public function TeamInfo(){
//        $userTypes=UserType::where('id','!=','cl')->get();

        $users=Employeeinfo::select('user.name','user.userType','employee_info.empId','employee_info.number','employee_info.image','employee_info.designation')
            ->where('user.userType','!=','cl')
            ->leftJoin('user','employee_info.userId','user.userId')->get();

        return view('team.showMyTeam',compact('userTypes','users'));


    }
}
