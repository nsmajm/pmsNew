<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Jobassign;
use App\Job;
use App\Status;
use App\Jobstate;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if(Auth::user()->userType==USER_TYPE[8]){
            $todaysDate=date("Y-m-d");
            return view('dashboard.user')
                ->with('todaysDate',$todaysDate);
        }

        else if(Auth::user()->userType==USER_TYPE[0]){
            return $this->admin();
        }


    }

    public function admin(){
        $status=Status::where('statusType','jobStatus')
            ->where('statusName','done')->first();

        $processStatus=Status::where('statusType','jobStatus')
            ->where('statusName','processing')->first();

        $lastDay= Carbon::yesterday()->format('Y-m-d');

        $created=Job::whereDate('created_at',$lastDay)
            ->count();
        $deliveredJob=Job::whereDate('deliveryDate',$lastDay)
            ->count();

        $pending=Job::where('job.deadline','<=',$lastDay)
            ->where('job.statusId','!=',$status->statusId)
            ->count();

        $processed=Jobstate::where('statusId',$processStatus)
            ->where('endDate',$lastDay)->count();

        $jobInformation = array(
            "deliveredJob" => $deliveredJob,
            "pending" => $pending,
            "processed" => $processed,
            "created" => $created,
        );
        return view('dashboard.admin')->with('jobInformation',$jobInformation);

    }
}
