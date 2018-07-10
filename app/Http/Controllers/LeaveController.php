<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Leave;
use App\Status;

class LeaveController extends Controller
{
    public function show(){
        return view('leave.index');
    }

    public function apply(){
        return view('leave.apply');
    }
    public function submit(Request $r){
        $status=Status::where('statusType','leaveStatus')->where('statusName','pending')->first();

        return $status;
        return $r;
    }
}
