<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\Job;
use App\Brief;
use App\Jobstate;
use App\Status;
use App\ClientServiceRelation;
use App\User;
use App\Team;
use App\Jobassign;
use App\File;
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

    public function edit($id){
        $job=Job::select('job.jobId','job.clientId','brief.briefId','client.clientName','job.deadLine','job.submissionTime','job.quantity','job.other','brief.briefMsg','file.folderName')
                ->where('job.jobId',$id)
                ->leftJoin('brief','brief.jobId','job.jobId')
                ->leftJoin('client','client.clientId','job.clientId')
                ->leftJoin('file','file.jobId','job.jobId')
                ->orderBy('briefId','desc')
                ->first();

//        return $job;
        $services=ClientServiceRelation::where('clientId',$job->clientId)
            ->leftJoin('service','service.serviceId','client_service_relation.serviceId')
            ->get();

//        return $services;
        return view('job.edit')
            ->with('job',$job)
            ->with('services',$services);
    }

    public function insert(Request $r){
        $status=Status::where('statusType','jobStatus')
            ->where('statusName','production')
            ->first();

        $job=new Job();
        $job->clientId=$r->clientName;
        $job->quantity=$r->quantity;
        $job->deadLine=date('Y-m-d',strtotime($r->submissionDate));
        $job->userId=Auth::user()->userId;
        $job->statusId=$status->statusId;
        $job->submissionTime=$r->submissionTime;
        if($r->urgent){ $job->urgent=1;}

        $job->other=$r->other;
        $job->save();

        $jobState=new Jobstate();
        $jobState->jobId=$job->jobId;
        $jobState->statusId=$status->statusId;
        //Converting str to date
        $time = strtotime($r->submissionDate);
        $newformat = date('Y-m-d',$time);
        $jobState->deadline=$newformat;
        $jobState->save();

        $file=new File();
        $file->jobId=$job->jobId;
        $file->folderName=$r->folderName;
        $file->save();

        $brief=new Brief();
        $brief->jobId=$job->jobId;
        $brief->briefType=$r->briefType;
        $brief->briefMsg=$r->brief;
        $brief->userId=Auth::user()->userId;
        $brief->save();

        Session::flash('message', 'Job Added Successfully!');
        return back();
    }

    public function update(Request $r){

        return $r;
        $job=Job::findOrFail($r->jobId);
        $job->quantity=$r->quantity;
        $job->save();

        Session::flash('message', 'Job Edited Successfully!');
        return back();

    }
    public function pending(){


        return view('job.pendingJob');

    }

    public function feedback(){

        return view('job.feedback');

    }

    public function getPendingData(Request $r){
        $todaysDate=date("Y-m-d");


        $jobs=Job::select('job.jobId','job.clientId','client.clientName','file.folderName','job.deadLine','job.quantity')
            ->leftJoin('client','job.clientId','client.clientId')
            ->leftJoin('brief','brief.jobId','job.jobId')
            ->leftJoin('file','file.jobId','job.jobId')
            ->where('job.deadline','<=',$todaysDate)
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
        $todaysDate=date("Y-m-d");

        return view('job.deadline')
            ->with('todaysDate',$todaysDate);

    }


    public function getProductionData(Request $r){
        $productionStatusId=Status::where('statusType','jobStatus')
            ->where('statusName','production')->first();

        $time = strtotime($r->date);
        $newformat = date('Y-m-d',$time);

        $productionJob=Jobstate::select('jobstate.jobstateId','job.jobId','job.clientId','brief.briefId','client.clientName','file.folderName','job.quantity','brief.briefType','job.statusId','status.statusName','job.deadline','job.urgent')
            ->where('jobstate.statusId',$productionStatusId->statusId)
            ->leftJoin('job','jobstate.jobId','job.jobId')
            ->leftJoin('file','file.jobId','job.jobId')
            ->leftJoin('brief','brief.jobId','job.jobId')
            ->leftJoin('client','client.clientId','job.clientId')
            ->leftJoin('status','status.statusId','job.statusId')
            ->where('job.deadline','<=',$newformat)
            ->where('endDate',null)
            ->get();


        $datatables = Datatables::of($productionJob);
        return $datatables->make(true);

    }


    public function getProcessingData(Request $r){
        $processingStatusId=Status::where('statusType','jobStatus')
            ->where('statusName','processing')->first();

        $time = strtotime($r->date);
        $newformat = date('Y-m-d',$time);


        $processingJob=Jobstate::select('jobstate.jobstateId','job.jobId','job.clientId','brief.briefId','client.clientName','file.folderName','job.quantity','brief.briefType','job.statusId','status.statusName','job.deadline','job.urgent')
            ->where('jobstate.statusId',$processingStatusId->statusId)
            ->leftJoin('job','jobstate.jobId','job.jobId')
            ->leftJoin('file','file.jobId','job.jobId')
            ->leftJoin('brief','brief.jobId','job.jobId')
            ->leftJoin('client','client.clientId','job.clientId')
            ->leftJoin('status','status.statusId','job.statusId')
            ->where('job.deadline','<=',$newformat)
            ->where('endDate',null)
            ->get();

        $datatables = Datatables::of($processingJob);
        return $datatables->make(true);

    }

    public function getQcData(Request $r){
        $qcStatusId=Status::where('statusType','jobStatus')
            ->where('statusName','qc')->first();

        $time = strtotime($r->date);
        $newformat = date('Y-m-d',$time);


        $qcJob=Jobstate::select('jobstate.jobstateId','job.jobId','job.clientId','brief.briefId','client.clientName','file.folderName','job.quantity','brief.briefType','job.statusId','status.statusName','job.deadline','job.urgent')
            ->where('jobstate.statusId',$qcStatusId->statusId)
            ->leftJoin('job','jobstate.jobId','job.jobId')
            ->leftJoin('file','file.jobId','job.jobId')
            ->leftJoin('brief','brief.jobId','job.jobId')
            ->leftJoin('client','client.clientId','job.clientId')
            ->leftJoin('status','status.statusId','job.statusId')
            ->where('job.deadline','<=',$newformat)
            ->where('endDate',null)
            ->get();

        $datatables = Datatables::of($qcJob);
        return $datatables->make(true);

    }


    public function jobStateChange(Request $r){


        $status=Status::where('statusType','jobStatus')
            ->where('statusName',$r->status)->first();

        $todaysDate=date("Y-m-d");


        Job::where('jobId',$r->jobId)
            ->update(['statusId'=>$status->statusId]);

        Jobstate::where('jobId',$r->jobId)
            ->update(['endDate'=>$todaysDate]);

        $jobStateOld=Jobstate::findOrFail($r->jobStateId);
        $jobStateOld->endDate=$todaysDate;
        $jobStateOld->save();

        $jobState=new Jobstate();
        $jobState->jobId=$r->jobId;
        $jobState->statusId=$status->statusId;
        $jobState->startDate=$todaysDate;
        $jobState->save();

    }



    public function assignJob($id){
        $job=Job::where('job.jobId',$id)
            ->leftJoin('brief','brief.jobId','job.jobId')
            ->orderBy('briefId','desc')
            ->first();

        $teams=Team::get();

        $jobAssignQuantity=Jobassign::where('jobId',$id)->sum('quantity');

//        return $jobAssign;

        return view('job.assignJob')
            ->with('teams',$teams)
            ->with('job',$job)
            ->with('jobAssignQuantity',$jobAssignQuantity);
    }


    public function getTeamMembers(Request $r){

        $users=User::where('teamId',$r->teamId)->get();

        return view('job.getTeamMember')->with('users',$users);

//        return $user;
    }




}
