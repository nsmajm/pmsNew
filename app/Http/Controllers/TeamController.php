<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\User;


use Session;

class TeamController extends Controller
{
    public function index(){
        $teams=Team::get();
        $users=User::select('userId','name','userType','team.teamName')
            ->where('userType',USER_TYPE[1])
            ->orWhere('userType',USER_TYPE[2])
            ->orWhere('userType',USER_TYPE[3])
            ->orWhere('userType',USER_TYPE[4])
            ->orWhere('userType',USER_TYPE[8])
            ->leftJoin('team','team.teamId','user.teamId')
            ->get();

        return view('team.index')
            ->with('teams',$teams)
            ->with('users',$users);
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

//        return $r;
    }
}
