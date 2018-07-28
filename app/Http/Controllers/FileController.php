<?php

namespace App\Http\Controllers;

use App\ClientServiceRelation;
use Illuminate\Http\Request;
use Auth;
use App\Job;
use App\Status;
use App\JobServiceRelation;
class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(){

        if(Auth::user()->userType != USER_TYPE['Supervisor']){
            return back();
        }
        $status=Status::where('statusType','jobStatus')->where('statusName','done')->first();

        $job=Job::select('job.jobId','job.created_at','client.clientName','file.folderName','job.quantity','user.name as doneBy')
            ->where('job.statusId',$status->statusId)
            ->where('fileCheck',null)
            ->leftJoin('client','client.clientId','job.clientId')
            ->leftJoin('file','file.jobId','job.jobId')
            ->leftJoin('user','user.userId','job.doneBy')
            ->get();

        $jobId=array();

        foreach ($job as $jobs){

            array_push($jobId,$jobs->jobId);


        }

        $jobService=JobServiceRelation::select('job_service_relation.serviceId','jobId','service.serviceName')
            ->whereIn('jobId',$jobId)
            ->leftJoin('service','service.serviceId','job_service_relation.serviceId')
            ->get();


        return view('job.filecheck')
            ->with('jobs',$job)
            ->with('jobService',$jobService);
    }

    public function doneCheck(Request $r){
        $job=Job::findOrFail($r->id);
        $job->fileCheck=Auth::user()->userId;
        $job->deliveryDate=date('Y-m-d');
        $client=ClientServiceRelation::where('clientId',$job->clientId)->get();
       foreach ($client as $c){
           $c=JobServiceRelation::where('jobId',$r->id)
               ->where('serviceId',$c->serviceId)
               ->update(array('rate' => $c->rate));

       }

        $job->save();

        return response()->json(['title'=>'Success','content'=>'File Checked successfully','flag'=>1]);

    }
}
