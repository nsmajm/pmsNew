<?php

namespace App\Http\Controllers;

use App\Shift;
use App\Status;
use App\Team;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employeeinfo;

use Illuminate\Support\Facades\DB;

use Session;
use Image;



class EmployeeController extends Controller
{
    public function editEmployee($id){

        $employee=Employeeinfo::leftJoin('user','employee_info.userId','user.userId')->findOrFail($id);

        $group=Team::all();
        $shift=Shift::all();
        $status=Status::where('statusType','userStatus')->get();

       // return $employee;

       return view('employee.editEmployee',compact('employee','group','shift','status'));
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

        return redirect(route('employee.empEdit',$id));



    }

}