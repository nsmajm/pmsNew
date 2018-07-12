<?php

namespace App\Http\Controllers;

use App\Shift;
use App\Status;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employeeinfo;

use Session;



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

        return $id;
    }

}