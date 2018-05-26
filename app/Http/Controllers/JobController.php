<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\Job;
use App\Brief;
use App\Jobstate;
use App\Status;
use App\ClientServiceRelation;
use Auth;
use Session;
use Yajra\DataTables\DataTables;

class JobController extends Controller
{
    public function information(){
        return view('job.information');
    }
    public function add(){

        $clients=Client::select('clientId','clientName')->get();

        return view('job.add')
                ->with('clients',$clients);
    }

    public function insert(Request $r){
        $status=Status::where('statusType','jobStatus')
            ->where('statusName','pending')
            ->first();



        $job=new Job();
        $job->clientId=$r->clientName;
        $job->quantity=$r->quantity;
        $job->deadLine=date('Y-m-d',strtotime($r->submissionDate));
        $job->userId=Auth::user()->userId;
        $job->statusId=$status->statusId;
//        $job->serviceId=$r->serviceId;
//        $job->priority=$r->priority;
        $job->other=$r->other;
        $job->save();

//        $jobState=new Jobstate();
//        $jobState->jobId=$job->jobId;
//        $jobState->statusId=$status->statusId;
//        $jobState->save();


        $brief=new Brief();
        $brief->jobId=$job->jobId;
        $brief->biefType=$r->briefType;
        $brief->folderName=$r->folderName;
        $brief->userId=Auth::user()->userId;
        $brief->save();


        Session::flash('message', 'Job Added Successfully!');
        return back();
    }
    public function pending(){


        return view('job.pendingJob');

    }

    public function feedback(){

        return view('job.feedback');

    }

    public function getPendingData(Request $r){

        $status=Status::where('statusType','jobStatus')
            ->where('statusName','pending')
            ->first();

        $jobs=Job::select('job.jobId','job.clientId','client.clientName','brief.folderName','job.deadLine','job.quantity')
            ->leftJoin('client','job.clientId','client.clientId')
            ->leftJoin('brief','brief.jobId','job.jobId')
            ->where('job.statusId',$status->statusId)
            ->get();


        $datatables = Datatables::of($jobs);
        return $datatables->make(true);

    }

    public function getServiceModal(Request $r){
        $services=ClientServiceRelation::select('service.serviceId','service.serviceName')
            ->where('clientId',$r->clientId)
            ->leftJoin('service','service.serviceId','client_service_relation.serviceId')
            ->get();
        $job=Job::findOrFail($r->jobId);


        return view('job.addServiceModal')
                ->with('services',$services)
                ->with('job',$job);
    }

    public function deadline(){

//        Getting All the status id
        $productionStatusId=Status::where('statusType','jobStatus')
                                    ->where('statusName','production')->first();

        $processingStatusId=Status::where('statusType','jobStatus')
            ->where('statusName','processing')->first();


        $qcStatusId=Status::where('statusType','jobStatus')
            ->where('statusName','qc')->first();


//       Getting All the jobs

        $productionJob=Jobstate::where('jobstate.statusId',$productionStatusId->statusId)
            ->leftJoin('job','jobstate.jobId','job.jobId')
            ->leftJoin('brief','brief.jobId','job.jobId')
            ->leftJoin('client','client.clientId','job.clientId')
            ->where('endDate',null)->get();

        $processingJob=Jobstate::where('statusId',$processingStatusId->statusId)
            ->where('endDate',null)->get();


        $qcJob=Jobstate::where('statusId',$qcStatusId->statusId)
            ->where('endDate',null)->get();


        return $productionJob;


        return view('job.deadline')
                ->with('productionJob',$productionJob)
                ->with('processingJob',$processingJob)
                ->with('qcJob',$qcJob);
    }





}
