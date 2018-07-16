<?php

namespace App\Http\Controllers;

use App\Group;
use App\Shift;
use App\Status;
use App\Team;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employeeinfo;

use Illuminate\Support\Facades\DB;

use Session;
use Image;

use Hash;



class EmployeeController extends Controller
{
    public function editEmployee($id){

        $employee=Employeeinfo::leftJoin('user','employee_info.userId','user.userId')->findOrFail($id);

        $group=Group::all();
        $shift=Shift::all();
        $teams=Team::all();
        $status=Status::where('statusType','userStatus')->get();


       return view('employee.editEmployee',compact('employee','group','shift','status','teams'));
    }
    public function addNewEmployee(){


        $group=Group::all();
        $shift=Shift::all();
        $teams=Team::all();
        $status=Status::where('statusType','userStatus')->get();


       return view('employee.addNewEmployee',compact('group','shift','status','teams'));
    }
    public function saveNewEmployee(Request $r){

        $this->validate($r,[
            'empName'=>'required|max:45',
            'empUserName' => 'required|max:45',
            'employeePassword' => 'required|max:20',

        ]);

        $user=new User();

        $user->name=$r->empName;
        $user->loginId=$r->empUserName;
        $user->userType=$r->userType;
        $user->teamId=$r->team;
        $user->statusId=$r->empStatus;
        $user->groupId=$r->group;

        $user->password=Hash::make($r->employeePassword);

        $user->save();


        $employee= new Employeeinfo();

        $employee->gender=$r->gender;
        $employee->number=$r->employeemobileNo;
        $employee->designation=$r->empDesignation;
        $employee->address=$r->address;
        $employee->rfId=$r->empRfId;
        $employee->sudoName=$r->empSudoName;
        $employee->employeeId=$r->employeeId;
        $employee->joinDate=$r->empJoinDate;

        $employee->userId=$user->userId;





        if($r->hasFile('empImage')){
            $img = $r->file('empImage');
            $filename= $user->userId.".".$img->getClientOriginalExtension();

            $pathName='public/userimage';
            $location = $pathName.'/'. $filename;

            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location);

            $employee->image=$filename;

        }

        $employee->save();

        Session::flash('message', 'Information Save Successfully!');
        return redirect(route('employee.addNewEmp'));



    }
    public function updateEmployee($id, Request $r){

        $this->validate($r,[
            'empName'=>'required|max:45',

        ]);

        $employee=Employeeinfo::findOrFail($id);

        $employee->gender=$r->gender;
        $employee->number=$r->employeemobileNo;
        $employee->designation=$r->empDesignation;
        $employee->address=$r->address;
        $employee->rfId=$r->empRfId;
        $employee->sudoName=$r->empSudoName;
        $employee->employeeId=$r->employeeId;


        $data=array(
            'statusId'=>$r->empStatus,
            'teamId'=>$r->team,
            'name'=>$r->empName,
            'loginId'=>$r->empUserName,

        );


        if($r->hasFile('empImage')){
            $img = $r->file('empImage');
            $filename= $employee->userId.".".$img->getClientOriginalExtension();

            $pathName='public/userimage';
            $location = $pathName.'/'. $filename;

            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location);

            $employee->image=$filename;

        }
        $employee->save();


        DB::table('user')
            ->where('userId',$employee->userId)
            ->update($data);

       // return $data;
        Session::flash('message', 'Information Updated Successfully!');
        return back();



    }

}