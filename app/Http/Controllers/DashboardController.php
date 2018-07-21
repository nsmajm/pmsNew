<?php

namespace App\Http\Controllers;

use App\JobServiceRelation;
use App\Service;
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

        if(Auth::user()->userType==USER_TYPE['User']){
            $todaysDate=date("Y-m-d");
            return view('dashboard.user')
                ->with('todaysDate',$todaysDate);
        }

        return $this->admin();



    }

    public function admin(){

        $status=Status::where('statusType','jobStatus')
            ->where('statusName','done')
            ->first();


//        Process Job Type / last day Basic/Medium/Advance/Complex

        $jobServiceMorningFixed=Service::select('service.complexity',DB::raw('count(*) as total'))
            ->leftJoin('job_service_relation','service.serviceId','job_service_relation.serviceId')
            ->leftJoin('job','job.jobId','job_service_relation.jobId')
            ->where('job.statusId',$status->statusId)
            ->where('job.shiftId',1)
            ->groupBy('complexity')
            ->get();

        $jobServiceMorning=Service::select('service.complexity',DB::raw('count(*) as total'))
            ->leftJoin('job_service_relation','service.serviceId','job_service_relation.serviceId')
            ->leftJoin('job','job.jobId','job_service_relation.jobId')
            ->where('job.statusId',$status->statusId)
            ->where('job.shiftId',2)
            ->groupBy('complexity')
            ->get();

        $jobServiceEvening=Service::select('service.complexity',DB::raw('count(*) as total'))
            ->leftJoin('job_service_relation','service.serviceId','job_service_relation.serviceId')
            ->leftJoin('job','job.jobId','job_service_relation.jobId')
            ->where('job.statusId',$status->statusId)
            ->where('job.shiftId',3)
            ->groupBy('complexity')
            ->get();

        $jobServiceNight=Service::select('service.complexity',DB::raw('count(*) as total'))
            ->leftJoin('job_service_relation','service.serviceId','job_service_relation.serviceId')
            ->leftJoin('job','job.jobId','job_service_relation.jobId')
            ->where('job.statusId',$status->statusId)
            ->where('job.shiftId',4)
            ->groupBy('complexity')
            ->get();


//        return $jobServiceMorningFixed;

        $processStatus=Status::where('statusType','jobStatus')
            ->where('statusName','processing')->first();

        $lastDay= Carbon::yesterday()->format('Y-m-d');

//        Procedure
//        DB::statement('CALL job_information(:date, @created, @delivered);',array($lastDay));
//        $results = DB::select('select @created as created, @delivered as deliveredJob');
//        return $results;



        $processed=Jobstate::where('statusId',$processStatus)
            ->where('endDate',$lastDay)->count();

//        $jobInformation = array(
//            "deliveredJob" => $deliveredJob,
//            "pending" => $pending,
//            "processed" => $processed,
//            "created" => $created,
//        );
        return view('dashboard.admin',compact('jobServiceMorningFixed','jobServiceMorning','jobServiceEvening','jobServiceNight'));

    }
}
