<?php

namespace App\Http\Controllers;

use App\ClientServiceRelation;
use Illuminate\Http\Request;
use Auth;
use App\Job;
use App\Status;
use App\JobServiceRelation;
use App\Service;
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

    public function editJobService(Request $r){
        $id=$r->jobId;
        $job = Job::select('job.jobId','job.feedback','job.clientId', 'brief.briefId', 'client.clientName', 'job.deadLine', 'job.submissionTime', 'job.quantity', 'job.other', 'brief.briefMsg', 'file.folderName')
            ->where('job.jobId', $id)
            ->leftJoin('brief', 'brief.jobId', 'job.jobId')
            ->leftJoin('client', 'client.clientId', 'job.clientId')
            ->leftJoin('file', 'file.jobId', 'job.jobId')
            ->orderBy('briefId', 'desc')
            ->first();

        if(Auth::user()->userType==USER_TYPE['Supervisor'] ){
            $services=Service::get();


        }
        else{
            $services = ClientServiceRelation::where('clientId', $job->clientId)
                ->leftJoin('service', 'service.serviceId', 'client_service_relation.serviceId')
                ->get();
        }





        $jobService = JobServiceRelation::where('jobId', $id)->get();


        return view('job.editJobService')
            ->with('job', $job)
            ->with('services', $services)
            ->with('jobService', $jobService);
    }
}
