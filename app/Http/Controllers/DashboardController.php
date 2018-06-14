<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Jobassign;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
//        $assignJob=Jobassign::select('u.name ')->where('assignTo',Auth::user()->userId)
//            ->leftJoin('user as u','u.userId','jobassign.assignTo')
//            ->leftJoin('user as p','p.userId','jobassign.assignBy')->get();
//
//
//
//        return $assignJob;


        if(Auth::user()->userType==USER_TYPE[8]){
            $todaysDate=date("Y-m-d");
            return view('dashboard.user')
                ->with('todaysDate',$todaysDate);
        }
        return view('dashboard.admin');
        return view('main');
    }
}
