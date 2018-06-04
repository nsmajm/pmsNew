<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaveController extends Controller
{
    public function show(){
        return view('leave.index');
    }

    public function apply(){
        return view('leave.apply');
    }
    public function submit(Request $r){

        return $r;
    }
}
