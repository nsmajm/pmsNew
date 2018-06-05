<?php

namespace App\Http\Controllers;

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

    public function getTeamData(Request $r){
        $users=User::select('userId','name','userType','team.teamName','teamLeader','user.teamId')
                ->where('userType','!=',USER_TYPE[0])
                ->where('userType','!=',USER_TYPE[9])
                ->where('userType','!=',USER_TYPE[5])
                ->leftJoin('team','team.teamId','user.teamId');

        if($r->teamId){
            $users=$users->where('user.teamId',$r->teamId);
        }

        $users=$users->get();

        $datatables = Datatables::of($users);
        return $datatables->make(true);
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
}
