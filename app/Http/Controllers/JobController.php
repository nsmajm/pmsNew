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
use Carbon\Carbon;

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
        if(Auth::user()->userType==USER_TYPE['User'] ){
            return back();
        }


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


            return view('job.edit')
                ->with('job', $job)
                ->with('services', $services)
                ->with('jobService', $jobService);

    }

    public function ChangeQuantity(Request $r){
        $job=Job::findOrFail($r->jobId);
        $job->quantity=$r->jobQuantity;
        $job->save();

        return back();
    }


    public function changeFeedbackState(Request $r){
        $job=Job::findOrFail($r->jobId);
        if($job->feedback == null){
            $job->feedback=1;
        }
        else{
            $job->feedback=null;
        }
        $job->save();

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

        if(date("H") <12){

            $job->created_at=Carbon::yesterday()->format('Y-m-d H:i:s');

        }
//        else{
//            return  Carbon::yesterday()->format('Y-m-d H:i:s');
//            return "more than 12";
//        }
        $job->save();
        $jobState=new Jobstate();
        $jobState->jobId=$job->jobId;
        $jobState->statusId=$status->statusId;
        $jobState->teamId=1;

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
        Jobstate::where('jobId',$r->jobId)
            ->where('statusId',5)->update(['endDate'=>date('Y-m-d'),'endTime'=>Carbon::now()->format('H:i')]);

        Jobassign::where('jobId',$r->jobId)
            ->update(['leaveDate'=> date('Y-m-d')]);


        Job::where('jobId',$r->jobId)
                ->update(['doneBy'=>Auth::user()->userId,'statusId'=>6]);


        for($i=0;$i<count($r->quantity);$i++){
            if($r->quantity[$i] !=null && $r->service[$i] !=null){
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
        $status=Status::where('statusType','jobStatus')
            ->where('statusName','feedback')
            ->first();

        $jobs=Job::select('client.clientName','file.folderName','job.quantity','job.created_at');

        if($r->date1 && $r->date2){
            $jobs=$jobs->whereBetween(DB::raw('DATE(job.created_at)'),[$r->date1,$r->date2]);
        }


        $jobs=$jobs->where('job.statusId',$status->statusId)
            ->orWhere('job.feedback','!=',null)
            ->leftJoin('file','file.jobId','job.jobId')
            ->leftJoin('client','client.clientId','job.clientId')
            ->get();;

        $datatables = Datatables::of($jobs);
        return $datatables->make(true);

    }

    public function getPendingData(Request $r){
        $todaysDate=date("Y-m-d");
        $status=Status::where('statusType','jobStatus')
            ->where('statusName','done')
            ->first();


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

//        $time = strtotime($r->date);
//        $newformat = date('Y-m-d',$time);

        $productionJob=Jobstate::select('jobstate.jobstateId','job.jobId','job.clientId','brief.briefId','client.clientName','file.folderName','job.quantity','brief.briefType','job.statusId','status.statusName','job.deadline','job.urgent','job.priority')
            ->where('jobstate.statusId',$productionStatusId->statusId)
            ->leftJoin('job','jobstate.jobId','job.jobId')
            ->leftJoin('file','file.jobId','job.jobId')
            ->leftJoin('brief','brief.jobId','job.jobId')
            ->leftJoin('client','client.clientId','job.clientId')
            ->leftJoin('status','status.statusId','job.statusId');

        if($r->date){
            $productionJob=$productionJob->where('job.deadline',$r->date);
        }
        else{
            $productionJob=$productionJob->where('job.deadline','<=',date('Y-m-d'));
        }


        $productionJob =$productionJob ->where('endDate',null)
            ->orderBy('job.deadline','desc')
            ->get();


        $datatables = Datatables::of($productionJob);
        return $datatables->make(true);

    }


    public function getProcessingData(Request $r){
        $processingStatusId=Status::where('statusType','jobStatus')
            ->where('statusName','processing')->first();

//        $time = strtotime($r->date);
//        $newformat = date('Y-m-d',$time);


        $processingJob=Jobstate::select('jobstate.jobstateId','job.jobId','job.clientId','brief.briefId','client.clientName','file.folderName','job.quantity','brief.briefType','job.statusId','status.statusName','job.deadline','job.urgent','job.priority')
            ->where('jobstate.statusId',$processingStatusId->statusId)
            ->leftJoin('job','jobstate.jobId','job.jobId')
            ->leftJoin('file','file.jobId','job.jobId')
            ->leftJoin('brief','brief.jobId','job.jobId')
            ->leftJoin('client','client.clientId','job.clientId')
            ->leftJoin('status','status.statusId','job.statusId');

        if($r->date){
            $processingJob=$processingJob->where('job.deadline',$r->date);
        }
        else{
            $processingJob=$processingJob->where('job.deadline','<=',date('Y-m-d'));
        }


        $processingJob  =$processingJob ->where('endDate',null)
            ->orderBy('job.deadline','desc')
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
            ->leftJoin('status','status.statusId','job.statusId');

        if($r->date){
            $qcJob=$qcJob->where('job.deadline',$r->date);
        }
        else{
            $qcJob=$qcJob->where('job.deadline','<=',date('Y-m-d'));
        }


        $qcJob=$qcJob->where('endDate',null)
            ->orderBy('job.deadline','desc')
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
        $jobStateOld->endTime=Carbon::now()->format('H:i');
        $jobStateOld->teamId=Auth::user()->teamId;
        $jobStateOld->save();

        Jobassign::where('jobId',$r->jobId)
            ->update(['leaveDate'=> date('Y-m-d')]);

        //Remove Leave date if job state reversed
        $jobStatus=Job::findOrFail($r->jobId)->statusId;
        Jobassign::where('jobId',$r->jobId)
            ->where('jobState',$jobStatus)
            ->update(['leaveDate'=> null]);

        if($r->status=='done'){
            Job::where('jobId',$r->jobId)
                ->update(['doneBy'=>Auth::user()->userId]);
        }

        else{
            $jobState=new Jobstate();
            $jobState->jobId=$r->jobId;
            $jobState->statusId=$status->statusId;
            $jobState->startDate=$todaysDate;
            $jobState->teamId=Auth::user()->teamId;
            $jobState->save();
        }



    }

    public function assignHistory(){

        return view('job.history');
    }

    public function getAssignHistory(Request $r){

        $job=Jobassign::select('job.jobId','folderName','client.clientName',DB::raw('SUM(jobassign.quantity) as total'))
            ->leftJoin('file','file.jobId','jobassign.jobId')
            ->leftJoin('job','job.jobId','jobassign.jobId')
            ->leftJoin('client','client.clientId','job.clientId')
            ->groupBy('jobassign.jobId')
            ->orderBy('jobassignId','desc');


        if(Auth::user()->userType==USER_TYPE['User']){
            $job=$job->where('jobassign.assignTo',Auth::user()->userId);
        }
        else if(Auth::user()->userType==USER_TYPE['Admin'] || Auth::user()->userType==USER_TYPE['Supervisor'] || Auth::user()->userType==USER_TYPE['Human Resource Management']){

        }
        else{
            $job=$job->where('jobassign.assignBy',Auth::user()->userId);
        }

        $job= $job->orderBy('jobassignId','desc')
            ->get();

        $datatables = Datatables::of($job);
        return $datatables->make(true);

    }

    public function showAssignDetails(Request $r){
        $job=Jobassign::select('job.jobId','client.clientName','file.folderName','jobassign.quantity','jobassign.assignDate','jobassign.leaveDate','u1.name as assignBy','u2.name as assignTo')
            ->where('jobassign.jobId',$r->jobId)
            ->leftJoin('job','job.jobId','jobassign.jobId')
            ->leftJoin('client','client.clientId','job.clientId')
            ->leftJoin('file','file.jobId','job.jobId')
            ->leftJoin('user as u1','u1.userId','jobassign.assignBy')
            ->leftJoin('user as u2','u2.userId','jobassign.assignTo');

        $job= $job->orderBy('jobassignId','desc')
            ->get();

//        return $job;
        return view('job.showAssignDetails',compact('job'));
    }



    public function assignJob($id){
        if(Auth::user()->userType==USER_TYPE['User']){
            return back();
        }


        $job=Job::where('job.jobId',$id)
            ->leftJoin('file','file.jobId','job.jobId')
            ->first();

        if(Auth::user()->userType==USER_TYPE['Supervisor']){
            $groups=Group::get();
        }
        else{
            $groups=Group::where('groupId',Auth::user()->groupId)->get();
        }


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
