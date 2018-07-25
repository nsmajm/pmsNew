<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Employeeinfo;
use App\UserType;
use App\Team;
use App\User;
use Yajra\DataTables\DataTables;
use Session;
use App\Group;

class GroupController extends Controller
{
    public function index(){
        $groups=Group::get();

        return view('group.index')
            ->with('groups',$groups);
    }

    public function getIndividualTeamMember(Request $r){
        $users=User::select('name','userType')
            ->where('groupId',$r->teamId)
            ->get();

        return $users;

    }

    public function getGroupData(Request $r){
        $users=User::select('userId','name','userType','group.groupName','teamLeader','user.groupId')
            ->where('userType','!=',USER_TYPE['Admin'])
            ->where('userType','!=',USER_TYPE['Client'])
            ->where('userType','!=',USER_TYPE['Support'])
            ->leftJoin('group','group.groupId','user.groupId');

        if($r->groupId){
            $users=$users->where('user.groupId',$r->groupId);
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
            'groupName'=>'required|max:45|unique:group,groupName',
        ]);

        $team=new Group();
        $team->groupName=$r->groupName;
        $team->save();

        Session::flash('message', 'Group Added Successfully!');
        return back();
    }

    public function assign(Request $r){

        $this->validate($r,[
            'userId'=>'required',
        ]);
        if($r->reset){
            $groupId=null;
        }
        else{
            $groupId=$r->groupId;
        }

        User::whereIn('userId',$r->userId)->update(['groupId' =>$groupId ]);
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
