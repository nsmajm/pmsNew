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

//        $jobService=Job::select('service.complexity',DB::raw('count(job.jobId) as total'))->where('job.statusId',$status->statusId)
//            ->leftJoin('job_service_relation','job_service_relation.jobId','job.jobId')
//            ->leftJoin('service','service.serviceId','job_service_relation.serviceId')
//            ->where('complexity','Basic')
////            ->groupBy('complexity')
//            ->get();


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



//        $created=Job::whereDate('created_at',$lastDay)
//            ->count();
//        $deliveredJob=Job::whereDate('deliveryDate',$lastDay)
//            ->count();
//
//        $pending=Job::where('job.deadline','<=',$lastDay)
//            ->where('job.statusId','!=',$status->statusId)
//            ->count();
//
//        $processed=Jobstate::where('statusId',$processStatus)
//            ->where('endDate',$lastDay)->count();



        $processed=Jobstate::where('statusId',$processStatus)->where('endDate',$lastDay)->count();


//        $jobInformation = array(
//            "deliveredJob" => $deliveredJob,
//            "pending" => $pending,
//            "processed" => $processed,
//            "created" => $created,
//        );


        $jobRecievedLastDay=Job::select('client.clientName', DB::raw('SUM(job.quantity)  as totalFile'),DB::raw('COUNT(job.jobId)  as totalOrder'))
            ->leftJoin('client','client.clientId','job.clientId')
            ->orderBy('totalFile', 'desc')
            ->limit(5)
            ->groupBy('job.clientId')
            ->whereDate('job.created_at',$lastDay)
            ->get();

        $jobInformation = array();

        for ($ii=0; $ii < 7; $ii++) {

            $dayOfWeek = Carbon::today()->subDays($ii)->format('Y-m-d');

            $fileRecieved = Job::whereDate('created_at','=',$dayOfWeek )->sum('quantity');
            $fileDelivered = Job::whereDate('deliveryDate','=',$dayOfWeek )->sum('quantity');

//            $jobRecieved = Job::whereDate('created_at','=',$dayOfWeek )->sum('quantity');
//            $jobRecieved = Job::whereDate('created_at','=',$dayOfWeek )->sum('quantity');

            $data=array(
                'date'=>$dayOfWeek,
                'fileRecieved'=>$fileRecieved,
//                'fileProcessed'=>$jobRecieved,
//                'filePending'=>$jobRecieved,
                'fileDelivered'=>$fileDelivered,
            );
            array_push($jobInformation,$data);

        }

//        return $jobInformation;

        return view('dashboard.admin',compact('jobRecievedLastDay','jobInformation'));


    }
}
