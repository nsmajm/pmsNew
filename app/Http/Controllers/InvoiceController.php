<?php

namespace App\Http\Controllers;

use App\JobServiceRelation;
use Illuminate\Http\Request;
use App\Client;
use App\Job;
use App\File;
use App\Invoice;
use App\TclInfo;
use PDF;
class InvoiceController extends Controller
{
    public function index(){
        $clients=Client::select('clientId','clientName')->get();


        return view('invoice.index',compact('clients'));
    }


    public function search(Request $r){

        $jobs=Job::select('job.jobId','file.fileId','file.folderName','Service.serviceName','job_service_relation.quantity','job_service_relation.job_service_relationId','job_service_relation.rate','job.created_at')
            ->where('clientId',$r->clientId)
            ->where('fileCheck','!=',null)
            ->leftJoin('file','file.jobId','job.jobId')
            ->leftJoin('job_service_relation','job_service_relation.jobId','job.jobId')
            ->leftJoin('service','job_service_relation.serviceId','service.serviceId');


        if($r->folderName!=null){
            $jobs=$jobs->where('file.folderName', 'like', '%' . $r->folderName. '%');
        }
        $jobs=$jobs->get();

        if ($jobs->isEmpty()){
            return "";
        }

        return view('invoice.table',compact('jobs'));



    }

    public function edit(Request $r){
        if($r->folderName){
            $file=File::findOrFail($r->id);
            $file->folderName=$r->folderName;
            $file->save();
        }

        if($r->quantity){
            $service=JobServiceRelation::findOrFail($r->id);
            $service->quantity=$r->quantity;
            $service->save();

            $sum=JobServiceRelation::where('jobId',$service->jobId)->sum('quantity');

            $job=Job::findOrFail($service->jobId);
            $job->quantity=$sum;
            $job->save();

        }

        if($r->rate){
            $service=JobServiceRelation::findOrFail($r->id);
            $service->rate=$r->rate;
            $service->save();


        }
    }

    public function generate(Request $r){

//        foreach ($r->jobId as $jobId)
//        {
//            $job=Job::findOrFail($jobId);
//        }


        return $r;
        $jobs=Job::select('job.jobId','job.clientId','file.folderName','Service.serviceName','job_service_relation.quantity','job_service_relation.rate','job.created_at')
            ->whereIn('job.jobId',$r->jobId)
            ->where('fileCheck','!=',null)
            ->leftJoin('file','file.jobId','job.jobId')
            ->leftJoin('job_service_relation','job_service_relation.jobId','job.jobId')
            ->leftJoin('service','job_service_relation.serviceId','service.serviceId')
            ->get();

        $tcl=TclInfo::first();



        if(!$jobs->isEmpty()){
            $client=Client::select('companyName','email','phoneNumber','countryName')
                ->leftJoin('country','country.countryId','client.countryId')
                ->findOrFail($jobs[0]->clientId);

        }



        $pdf = PDF::loadView('invoice.pdf',compact('jobs','client','tcl'));
        return $pdf->stream('invoice.pdf',array('Attachment'=>0));

    }

    public function pdf(){
        $jobs=Job::select('job.jobId','job.clientId','file.folderName','Service.serviceName','job_service_relation.quantity','job_service_relation.rate','job.created_at')
            ->where('job.jobId',44)
            ->where('fileCheck','!=',null)
            ->leftJoin('file','file.jobId','job.jobId')
            ->leftJoin('job_service_relation','job_service_relation.jobId','job.jobId')
            ->leftJoin('service','job_service_relation.serviceId','service.serviceId')
            ->get();

        $tcl=TclInfo::first();

        if(!$jobs->isEmpty()){
            $client=Client::select('companyName','email','phoneNumber','countryName')
                ->leftJoin('country','country.countryId','client.countryId')
                ->findOrFail($jobs[0]->clientId);
        }


//        return $jobs;

        return view('invoice.pdf',compact('jobs','client','tcl'));

        $pdf = PDF::loadView('invoice.pdf',compact('jobs','client','tcl'));
        return $pdf->stream('invoice.pdf',array('Attachment'=>0));


    }
}
