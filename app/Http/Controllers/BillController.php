<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Job;
use App\Status;
use App\JobServiceRelation;
use App\Client;
use App\ClientServiceRelation;

class BillController extends Controller
{
    public function addRate(){
        $status=Status::where('statusType','jobStatus')
            ->where('statusName','done')
            ->first();

        $jobs=Job::select('job.jobId','client.clientName','file.folderName','job.quantity','job.created_at')
            ->where('statusId',$status->statusId)
            ->where('fileCheck','!=',null)
            ->leftJoin('client','client.clientId','job.clientId')
            ->leftJoin('file','file.jobId','job.jobId')
            ->get();

//        return $jobs;
        return view('bill.add')
            ->with('jobs',$jobs);
    }

    public function addBillModal(Request $r){
        $jobService=JobServiceRelation::select('job_service_relation.job_service_relationId','job.jobId','service.serviceId','service.serviceName','job_service_relation.quantity','job_service_relation.rate')
            ->where('job_service_relation.jobId',$r->jobId)
            ->leftJoin('job','job.jobId','job_service_relation.jobId')
            ->leftJoin('service','service.serviceId','job_service_relation.serviceId')
            ->get();

//        return $jobService;

        return view('bill.addBillModal')->with('jobService',$jobService);
    }

    public function rate(){
        $clients=Client::select('clientId','clientName')->get();

//        return $clients;
        return view('bill.rate')
            ->with('clients',$clients);

    }

    public function getClient(Request $r){
        $clientInfo=Client::findOrFail($r->clientId);
        $client=ClientServiceRelation::select('client_service_relation.client_service_relationId','client_service_relation.clientId','service.serviceId','service.serviceName','client_service_relation.rate')
            ->where('clientId',$r->clientId)
            ->leftJoin('service','service.serviceId','client_service_relation.serviceId')
            ->get();

        return view('bill.setRate')
            ->with('client',$client)
            ->with('clientInfo',$clientInfo);
    }

    public function setRate(Request $r){

        $i=0;
        for($i=0;$i<count($r->primaryKey);$i++){
            $rate=ClientServiceRelation::findOrFail($r->primaryKey[$i]);
            $rate->rate=$r->rates[$i];
            $rate->save();

        }
        return response()->json(['title'=>'Success','content'=>'Rate set successfully','flag'=>1]);
    }

    public function changeRate(Request $r){

        $jobService=JobServiceRelation::findOrFail($r->id);
        $jobService->rate=$r->rate;

        $jobService->save();
        return response()->json(['title'=>'Success','content'=>'Rate set successfully','flag'=>1]);
    }

    public function summery(){

        return view('bill.summery');
    }
}
