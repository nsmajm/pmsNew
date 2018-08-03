<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Billing;
use App\JobServiceRelation;
use Illuminate\Http\Request;
use App\Client;
use App\Job;
use App\File;
use App\Invoice;
use App\TclInfo;
use PDF;
use DB;
class InvoiceController extends Controller
{
    public function index(){
        $clients=Client::select('clientId','clientName')
            ->get();

        return view('invoice.index',compact('clients'));
    }

    public function changeInvoiceStatus(Request $r){
        $billing=Billing::findOrFail($r->id);
        $billing->statusId=$r->statusId;
        $billing->save();
//        return $r;
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

        $clientId=$r->clientId;

        $banks=Bank::select('bankId','bankName')
            ->get();


        return view('invoice.table',compact('jobs','banks','clientId'));



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


        $jobs=Job::select('job.jobId','job.clientId','file.folderName','Service.serviceName','job_service_relation.quantity','job_service_relation.rate',DB::raw('DATE(job.created_at) as date'))
            ->whereIn('job.jobId',$r->jobId)
            ->where('fileCheck','!=',null)
            ->leftJoin('file','file.jobId','job.jobId')
            ->leftJoin('job_service_relation','job_service_relation.jobId','job.jobId')
            ->leftJoin('service','job_service_relation.serviceId','service.serviceId')
            ->get();

        $paid=$r->paid;
        $paymentDate=$r->paymentDate;
        $currency=$r->currency;
        $invoiceNumber=$r->invoiceNumber;


//        return $jobs;


        $tcl=TclInfo::first();
        $bank=Bank::findOrFail($r->bankId);


        if(!$jobs->isEmpty()){
            $client=Client::select('companyName','email','phoneNumber','countryName')
                ->leftJoin('country','country.countryId','client.countryId')
                ->findOrFail($jobs[0]->clientId);


            Job::whereIn('jobId',$r->jobId)
                ->update(['invoiceNumber'=>$r->invoiceNumber]);

            $billing=new Billing();
            $billing->total=$r->paid;
            $billing->bankId=$r->bankId;
            $billing->invoice=$r->invoiceNumber;
            $billing->bill=$r->bill;
            $billing->statusId=11;
            $billing->clientId=$jobs[0]->clientId;
            $billing->save();

        }

        $pdf = PDF::loadView('invoice.pdf',compact('jobs','client','tcl','paid','paymentDate','currency','invoiceNumber','bank'));
        $pdf->save('public/invoice/'.$invoiceNumber.'.pdf');


        return $invoiceNumber;

    }

    public function pdf(){
        $jobs=Job::select('job.jobId','job.clientId','file.folderName','Service.serviceName','job_service_relation.quantity','job_service_relation.rate',DB::raw('DATE(job.created_at) as date'))
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

        $pdf = PDF::loadView('invoice.pdf',compact('jobs','client','tcl'));
        return $pdf->stream('invoice.pdf',array('Attachment'=>0));


    }
}
