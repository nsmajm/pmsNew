<?php

namespace App\Http\Controllers;

use App\Service;
use App\Shiftassign;
use foo\bar;
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
use App\JobServiceRelation;
use App\Group;
use Auth;
use Session;
use Yajra\DataTables\DataTables;
use DB;

class JobController extends Controller
{
    public function information(){
//        $job=Job::select('client.clientName','file.folderName','job.deadLine','job.quantity')
//            ->leftJoin('file','file.jobId','job.jobId')
//            ->leftJoin('client','job.clientId','client.clientId')
//            ->get();
//
//        return $job;
        return view('job.information');
    }

    public function getJobInformation(){

    }




    public function all(){
        $clients=Client::select('clientId','clientName')->get();
        $status=Status::where('statusType','jobStatus')->get();

        return view('job.all')
                ->with('clients',$clients)
                ->with('status',$status);
    }

    public function getAllData(Request $r){

        $jobs=Job::select('job.jobId','job.created_at','job.deadLine','job.deliveryDate','job.submissionTime','job.quantity','user.name','file.folderName','client.clientName','status.statusName','rate.amount')
            ->leftJoin('file','file.jobId','job.JobId')
            ->leftJoin('client','client.clientId','job.clientId')
            ->leftJoin('status','status.statusId','job.statusId')
            ->leftJoin('user','user.userId','job.doneBy')
            ->leftJoin('rate','rate.jobId','job.jobId');

        if($r->statusId){
            $jobs=$jobs->where('status.statusId',$r->statusId);
        }
        if($r->date){
            $jobs=$jobs->where(DB::raw('date(job.created_at)'),$r->date);
        }
        if($r->clientId){
            $jobs=$jobs->where('client.clientId',$r->clientId);
        }

        $jobs=$jobs->get();

        $datatables = Datatables::of($jobs);
        return $datatables->make(true);


    }




    public function add(){
        if(USER_TYPE['Admin']== Auth::user()->userType || USER_TYPE['Support']== Auth::user()->userType){
            $clients=Client::select('clientId','clientName')
            ->get();

            return view('job.add')
                ->with('clients',$clients);
        }
        return back();
    }

    public function edit($id){


        if(Auth::user()->userType==USER_TYPE['Admin'] ||Auth::user()->userType==USER_TYPE['Supervisor'] || Auth::user()->userType==USER_TYPE['Qc Manager']) {
            $jobCount=Job::where('jobId',$id)->where('job.statusId',5)->count();
            if($jobCount==0){
                return "Job Is Not In QC Yet";
            }

            $job = Job::select('job.jobId', 'job.clientId', 'brief.briefId', 'client.clientName', 'job.deadLine', 'job.submissionTime', 'job.quantity', 'job.other', 'brief.briefMsg', 'file.folderName')
                ->where('job.jobId', $id)
                ->leftJoin('brief', 'brief.jobId', 'job.jobId')
                ->leftJoin('client', 'client.clientId', 'job.clientId')
                ->leftJoin('file', 'file.jobId', 'job.jobId')
                ->orderBy('briefId', 'desc')
                ->first();

            $services = ClientServiceRelation::where('clientId', $job->clientId)
                ->leftJoin('service', 'service.serviceId', 'client_service_relation.serviceId')
                ->get();


            $jobService = JobServiceRelation::where('jobId', $id)->get();


            return view('job.edit')
                ->with('job', $job)
                ->with('services', $services)
                ->with('jobService', $jobService);
        }
        else{
            return back();
        }
    }

    public function insert(Request $r){
        $status=Status::where('statusType','jobStatus')
            ->where('statusName','production')
            ->first();

        $job=new Job();
        $job->clientId=$r->clientName;
        $job->quantity=$r->quantity;
        $job->deadLine=$r->submissionDate;
        $job->userId=Auth::user()->userId;
        $job->statusId=$status->statusId;
        $job->submissionTime=$r->submissionTime;
        $job->priority=1;
        if($r->urgent)
        { $job->urgent=1;}

        if ($r->feedback){
            $job->feedback=1;
            $status=Status::where('statusType','jobStatus')->where('statusName','feedback')
                ->first();
            $job->statusId=$status->statusId;

        }

        $job->other=$r->other;
        $job->save();

        $jobState=new Jobstate();
        $jobState->jobId=$job->jobId;
        $jobState->statusId=$status->statusId;
        //Converting str to date
        $time = strtotime($r->submissionDate);
        $newformat = date('Y-m-d',$time);
        $jobState->startDate=$newformat;
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
//
//        $job=Job::findOrFail($r->jobId);
//        $job->quantity=$r->jobQuantity;
//        $job->save();
//        job_service_relationId

//        return $r;

        for($i=0;$i<count($r->quantity);$i++){
            if($r->quantity[$i] !=null && $r->service[$i] !=null){
//                echo $r->quantity[$i].$r->service[$i].'<br>';
                if(isset($r->job_service_relationId[$i])){
                    $jobService=JobServiceRelation::findOrFail($r->job_service_relationId[$i]);
                }
                else{
                    $jobService=new JobServiceRelation();
                }

                $jobService->jobId=$r->jobId;
                $jobService->serviceId=$r->service[$i];
                $jobService->quantity=$r->quantity[$i];
                $jobService->addedBy=Auth::user()->userId;
                $jobService->save();
            }
        }

        Session::flash('message', 'Job Edited Successfully!');
        return back();

    }
    public function pending(){

        return view('job.pendingJob');

    }

    public function feedback(){

        return view('job.feedback');

    }

    public function getFeedbackData(Request $r){
        $status=Status::where('statusType','jobStatus')->where('statusName','feedback')
            ->first();

        $jobs=Job::select('client.clientName','file.folderName','job.quantity','job.created_at');

        if($r->date1 && $r->date2){
            $jobs=$jobs->whereBetween(DB::raw('DATE(job.created_at)'),[$r->date1,$r->date2]);
        }


        $jobs=$jobs->where('job.statusId',$status->statusId)
            ->leftJoin('file','file.jobId','job.jobId')
            ->leftJoin('client','client.clientId','job.clientId')
            ->get();;

        $datatables = Datatables::of($jobs);
        return $datatables->make(true);

    }

    public function getPendingData(Request $r){
        $todaysDate=date("Y-m-d");
        $status=Status::where('statusType','jobStatus')
            ->where('statusName','done')->first();


        $jobs=Job::select('job.jobId','job.clientId','client.clientName','file.folderName','job.deadLine','job.quantity')
            ->leftJoin('client','job.clientId','client.clientId')
            ->leftJoin('brief','brief.jobId','job.jobId')
            ->leftJoin('file','file.jobId','job.jobId')
            ->where('job.deadline','<=',$todaysDate)
            ->where('job.statusId','!=',$status->statusId)
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

        $productionJob=Jobstate::select('jobstate.jobstateId','job.jobId','job.clientId','brief.briefId','client.clientName','file.folderName','job.quantity','brief.briefType','job.statusId','status.statusName','job.deadline','job.urgent','job.priority')
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


        $processingJob=Jobstate::select('jobstate.jobstateId','job.jobId','job.clientId','brief.briefId','client.clientName','file.folderName','job.quantity','brief.briefType','job.statusId','status.statusName','job.deadline','job.urgent','job.priority')
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


        $qcJob=Jobstate::select('jobstate.jobstateId','job.jobId','job.clientId','brief.briefId','client.clientName','file.folderName','job.quantity','brief.briefType','job.statusId','status.statusName','job.deadline','job.urgent','job.priority')
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

        Jobassign::where('jobId',$r->jobId)
            ->update(['leaveDate'=> date('Y-m-d')]);

        if($r->status=='done'){
            Job::where('jobId',$r->jobId)
                ->update(['doneBy'=>Auth::user()->userId]);
        }

        else{
            $jobState=new Jobstate();
            $jobState->jobId=$r->jobId;
            $jobState->statusId=$status->statusId;
            $jobState->startDate=$todaysDate;
            $jobState->save();
        }



    }

    public function assignHistory(){

        return view('job.history');
    }

    public function getAssignHistory(Request $r){
        $job=Jobassign::select('job.jobId','client.clientName','file.folderName','jobassign.quantity','jobassign.assignDate','jobassign.leaveDate','u1.name as assignBy','u2.name as assignTo')
            ->leftJoin('job','job.jobId','jobassign.jobId')
            ->leftJoin('client','client.clientId','job.clientId')
            ->leftJoin('file','file.jobId','job.jobId')
            ->leftJoin('user as u1','u1.userId','jobassign.assignBy')
            ->leftJoin('user as u2','u2.userId','jobassign.assignTo');
        if(Auth::user()->userType==USER_TYPE['User']){
            $job=$job->where('jobassign.assignTo',Auth::user()->userId);
        }


        $job= $job->orderBy('jobassignId','desc')
            ->get();

        $datatables = Datatables::of($job);
        return $datatables->make(true);

    }



    public function assignJob($id){
        $job=Job::where('job.jobId',$id)
            ->leftJoin('file','file.jobId','job.jobId')
            ->first();

        $groups=Group::get();

        $jobAssignQuantity=Jobassign::where('jobId',$id)
            ->where('leaveDate',null)
            ->sum('quantity');
        return view('job.assignJob')
            ->with('groups',$groups)
            ->with('job',$job)
            ->with('jobAssignQuantity',$jobAssignQuantity);
    }

    public function checkQuantity(Request $r){

        $job=Job::findOrFail($r->jobId);

        return $job->quantity-$r->quantity;
    }



    public function lessPriority(Request $r){
        $job=Job::findOrFail($r->jobId);
        $job->priority=0;
        $job->save();


        return $r;
    }




}
