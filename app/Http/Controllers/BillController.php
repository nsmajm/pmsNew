<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Job;
use App\Status;
use App\JobServiceRelation;
use App\Client;
use App\ClientServiceRelation;
use Auth;
class BillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addRate(){
        if(USER_TYPE['Admin']== Auth::user()->userType || USER_TYPE['Supervisor']== Auth::user()->userType || USER_TYPE['Accounts']== Auth::user()->userType){
            $status=Status::where('statusType','jobStatus')
                ->where('statusName','done')
                ->first();

            $jobs=Job::select('job.jobId','client.clientName','file.folderName','job.quantity','job.created_at')
                ->where('statusId',$status->statusId)
                ->where('fileCheck','!=',null)
                ->where('job.invoiceNumber',null)
                ->leftJoin('client','client.clientId','job.clientId')
                ->leftJoin('file','file.jobId','job.jobId')
                ->get();

            return view('bill.add')
                ->with('jobs',$jobs);

        }

        return back();

    }

    public function addBillModal(Request $r){
        $jobService=JobServiceRelation::select('job_service_relation.job_service_relationId','job.jobId','service.serviceId','service.serviceName','job_service_relation.quantity','job_service_relation.rate')
            ->where('job_service_relation.jobId',$r->jobId)
            ->leftJoin('job','job.jobId','job_service_relation.jobId')
            ->leftJoin('service','service.serviceId','job_service_relation.serviceId')
            ->get();

        return view('bill.addBillModal')->with('jobService',$jobService);
    }

    public function rate(){
        if(USER_TYPE['Admin']== Auth::user()->userType) {
            $clients = Client::select('clientId', 'clientName')->get();

            return view('bill.rate')
                ->with('clients', $clients);
        }
        return back();

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
