<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Client;
use App\Jobassign;
use App\Jobstate;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Job;
use DB;
use stdClass;
use App\JobServiceRelation;
use App\Shift;

class ReportController extends Controller
{
    public function performance(){

        return view('report.performance');
    }

    public function all(){
//        return $this->employeeWorkDay();


        return view('report.all');

    }

    public function fileCountDays(Request $r){
        $month=Carbon::now();
        $Y=Carbon::now()->format('Y');
        $M=Carbon::now()->format('m');

        $start = Carbon::parse($month)->startOfMonth()->format('Y-m-d');
        $startDate = Carbon::parse($month)->startOfMonth()->format('d');
        $end = Carbon::parse($month)->endOfMonth()->format('Y-m-d');
        $endDate = Carbon::parse($month)->endOfMonth()->format('d');

        $jobProcessed=JobServiceRelation::select(DB::raw('sum(quantity) as total'),DB::raw('date(created_at) as date'))
            ->whereBetween(DB::raw('date(created_at)'),array([$start,$end]))
            ->groupBy(DB::raw('date(created_at)'))
            ->get();

//        return $jobProcessed;

        $jobsCreated=Job::select(DB::raw('sum(quantity) as total'),DB::raw('date(created_at) as date'))
            ->whereBetween(DB::raw('date(created_at)'),array([$start,$end]))
            ->groupBy(DB::raw('date(created_at)'))
            ->get();

//        return $jobsCreated;

        $allDates=array();

        for($i=$startDate;$i<=$endDate;$i++){

            $o = new stdClass();
            $tempCreated=false;
            $tempProcessed=false;
            foreach ($jobsCreated as $job){
                if($job->date == Carbon::parse($Y.'-'.$M.'-'.$i)->format('Y-m-d')){
                    $o->totalFileRecieved=$job->total;
                    $tempCreated=true;
                    break;
                }
            }

            foreach ($jobProcessed as $job){
                if($job->date == Carbon::parse($Y.'-'.$M.'-'.$i)->format('Y-m-d')){
                    $o->totalFileProcessed=$job->total;
                    $tempProcessed=true;
                    break;
                }
            }
            if($tempCreated==false){
                $o->totalFileRecieved=0;
            }

            if($tempProcessed==false){
                $o->totalFileProcessed=0;
            }
            $o->date=Carbon::parse($Y.'-'.$M.'-'.$i)->format('Y-m-d');
            array_push($allDates,$o);
        }

        return view('report.fileCountDays',compact('allDates'));

    }

    public function fileProcessShift(){
        $month=Carbon::now();
        $Y=Carbon::now()->format('Y');
        $M=Carbon::now()->format('m');

        $start = Carbon::parse($month)->startOfMonth()->format('Y-m-d');
        $startDate = Carbon::parse($month)->startOfMonth()->format('d');
        $end = Carbon::parse($month)->endOfMonth()->format('Y-m-d');
        $endDate = Carbon::parse($month)->endOfMonth()->format('d');

        $jobShiftMorning=Job::select(DB::raw('date(job_service_relation.created_at) as date'),DB::raw('sum(job_service_relation.quantity) as total'))
            ->where(function($q) {
                $q->where('job.shiftId', 1)
                    ->orWhere('job.shiftId', 2);
            })
            ->leftJoin('jobassign','jobassign.jobId','job.jobId')
            ->leftJoin('job_service_relation','job_service_relation.jobId','job.jobId')
            ->groupBy(DB::raw('date(job_service_relation.created_at)'))
            ->whereBetween(DB::raw('date(job_service_relation.created_at)'),array([$start,$end]))
            ->get();

        $jobShiftEvening=Job::select(DB::raw('date(job_service_relation.created_at) as date'),DB::raw('sum(job_service_relation.quantity) as total'))
            ->where('job.shiftId',3)
            ->leftJoin('jobassign','jobassign.jobId','job.jobId')
            ->leftJoin('job_service_relation','job_service_relation.jobId','job.jobId')
            ->groupBy(DB::raw('date(job_service_relation.created_at)'))
            ->whereBetween(DB::raw('date(job_service_relation.created_at)'),array([$start,$end]))
            ->get();

        $jobShiftNight=Job::select(DB::raw('date(job_service_relation.created_at) as date'),DB::raw('sum(job_service_relation.quantity) as total'))
            ->where('job.shiftId',4)
            ->leftJoin('jobassign','jobassign.jobId','job.jobId')
            ->leftJoin('job_service_relation','job_service_relation.jobId','job.jobId')
            ->groupBy(DB::raw('date(job_service_relation.created_at)'))
            ->whereBetween(DB::raw('date(job_service_relation.created_at)'),array([$start,$end]))
            ->get();


        $allDates=array();
        for($i=$startDate;$i<=$endDate;$i++){
            $o = new stdClass();
            $tempMorning=false;
            $tempEvening=false;
            $tempNight=false;
            foreach ($jobShiftMorning as $job){
                if($job->date == Carbon::parse($Y.'-'.$M.'-'.$i)->format('Y-m-d')){
                    $o->morningTotal= $job->total;
                    $tempMorning=true;
                    break;
                }
            }

            foreach ($jobShiftEvening as $job){
                if($job->date == Carbon::parse($Y.'-'.$M.'-'.$i)->format('Y-m-d')){
                    $o->eveningTotal= $job->total;
                    $tempEvening=true;
                    break;
                }
            }

            foreach ($jobShiftNight as $job){
                if($job->date == Carbon::parse($Y.'-'.$M.'-'.$i)->format('Y-m-d')){
                    $o->nightTotal= $job->total;
                    $tempNight=true;
                    break;
                }
            }


            if($tempMorning==false){
                $o->morningTotal=0;
            }

            if($tempEvening==false){
                $o->eveningTotal=0;
            }
            if($tempNight==false){
                $o->nightTotal=0;
            }
            $o->date=Carbon::parse($Y.'-'.$M.'-'.$i)->format('Y-m-d');
            array_push($allDates,$o);
        }

//        return $allDates;
        return view('report.fileProcessShift',compact('allDates'));
    }

    public function fileTypeDay(){
        $month=Carbon::now();
        $Y=Carbon::now()->format('Y');
        $M=Carbon::now()->format('m');

        $start = Carbon::parse($month)->startOfMonth()->format('Y-m-d');
        $startDate = Carbon::parse($month)->startOfMonth()->format('d');
        $end = Carbon::parse($month)->endOfMonth()->format('Y-m-d');
        $endDate = Carbon::parse($month)->endOfMonth()->format('d');

        $basic=JobServiceRelation::select(DB::raw('sum(quantity) as total'),DB::raw('date(job_service_relation.created_at) as date'))
            ->leftJoin('service','service.serviceId','job_service_relation.serviceId')
            ->where('service.complexity',SERVICE_COMPLEXITY[0])
            ->groupBy(DB::raw('DATE(job_service_relation.created_at)'))
            ->whereBetween(DB::raw('date(job_service_relation.created_at)'),array([$start,$end]))
            ->get();

        $medium=JobServiceRelation::select(DB::raw('sum(quantity) as total'),DB::raw('date(job_service_relation.created_at) as date'))
            ->leftJoin('service','service.serviceId','job_service_relation.serviceId')
            ->where('service.complexity',SERVICE_COMPLEXITY[2])
            ->groupBy(DB::raw('DATE(job_service_relation.created_at)'))
            ->whereBetween(DB::raw('date(job_service_relation.created_at)'),array([$start,$end]))
            ->get();

        $advanced=JobServiceRelation::select(DB::raw('sum(quantity) as total'),DB::raw('date(job_service_relation.created_at) as date'))
            ->leftJoin('service','service.serviceId','job_service_relation.serviceId')
            ->where('service.complexity',SERVICE_COMPLEXITY[3])
            ->groupBy(DB::raw('DATE(job_service_relation.created_at)'))
            ->whereBetween(DB::raw('date(job_service_relation.created_at)'),array([$start,$end]))
            ->get();

        $complex=JobServiceRelation::select(DB::raw('sum(quantity) as total'),DB::raw('date(job_service_relation.created_at) as date'))
            ->leftJoin('service','service.serviceId','job_service_relation.serviceId')
            ->where('service.complexity',SERVICE_COMPLEXITY[1])
            ->groupBy(DB::raw('DATE(job_service_relation.created_at)'))
            ->whereBetween(DB::raw('date(job_service_relation.created_at)'),array([$start,$end]))
            ->get();

        $allDates=array();
        for($i=$startDate;$i<=$endDate;$i++){
            $o = new stdClass();
            $tempBasic=false;
            $tempMedium=false;
            $tempAdvanced=false;
            $tempComplex=false;
            foreach ($basic as $job){
                if($job->date == Carbon::parse($Y.'-'.$M.'-'.$i)->format('Y-m-d')){
                    $o->basicTotal= $job->total;
                    $tempBasic=true;
                    break;
                }
            }

            foreach ($medium as $job){
                if($job->date == Carbon::parse($Y.'-'.$M.'-'.$i)->format('Y-m-d')){
                    $o->mediumTotal= $job->total;
                    $tempMedium=true;
                    break;
                }
            }

            foreach ($advanced as $job){
                if($job->date == Carbon::parse($Y.'-'.$M.'-'.$i)->format('Y-m-d')){
                    $o->advancedTotal= $job->total;
                    $tempAdvanced=true;
                    break;
                }
            }

            foreach ($complex as $job){
                if($job->date == Carbon::parse($Y.'-'.$M.'-'.$i)->format('Y-m-d')){
                    $o->complexTotal= $job->total;
                    $tempComplex=true;
                    break;
                }
            }

            if($tempBasic==false){
                $o->basicTotal=0;
            }

            if($tempMedium==false){
                $o->mediumTotal=0;
            }
            if($tempAdvanced==false){
                $o->advancedTotal=0;
            }
            if($tempComplex==false){
                $o->complexTotal=0;
            }
            $o->date=Carbon::parse($Y.'-'.$M.'-'.$i)->format('Y-m-d');
            array_push($allDates,$o);


        }

        return view('report.fileTypeDay',compact('allDates'));


    }

    public function fileProcessHour(){

        $morning=Jobstate::select(DB::raw('HOUR(jobstate.endTime)  as endHour'),DB::raw('SUM(job_service_relation.quantity)  as total'))->where('jobstate.statusId',5)
            ->where('endDate',date('Y-m-d'))
            ->leftJoin('job','job.jobId','jobstate.jobId')
            ->leftJoin('job_service_relation','job_service_relation.jobId','jobstate.jobId')
            ->leftJoin('shift','shift.shiftId','job.shiftId')
            ->where(function($q) {
                $q->where('shift.shiftName', 'Morning (Fixed)')
                    ->orWhere('shift.shiftName', 'Morning');
            })
            ->groupBy('endHour')
            ->get();

        $evening=Jobstate::select(DB::raw('HOUR(jobstate.endTime)  as endHour'),DB::raw('SUM(job_service_relation.quantity)  as total'))->where('jobstate.statusId',5)
            ->where('endDate',date('Y-m-d'))
            ->leftJoin('job','job.jobId','jobstate.jobId')
            ->leftJoin('job_service_relation','job_service_relation.jobId','jobstate.jobId')
            ->leftJoin('shift','shift.shiftId','job.shiftId')
            ->where('shift.shiftName', 'Evening')
            ->groupBy('endHour')
            ->get();

        $night=Jobstate::select(DB::raw('HOUR(jobstate.endTime)  as endHour'),DB::raw('SUM(job_service_relation.quantity)  as total'))->where('jobstate.statusId',5)
            ->where('endDate',date('Y-m-d'))
            ->leftJoin('job','job.jobId','jobstate.jobId')
            ->leftJoin('job_service_relation','job_service_relation.jobId','jobstate.jobId')
            ->leftJoin('shift','shift.shiftId','job.shiftId')
            ->where('shift.shiftName', 'Night')
            ->groupBy('endHour')
            ->get();


        return view('report.fileProcessHour',compact('morning','evening','night'));
    }

    public function fileCountMonth(){
        $month=Carbon::now();
        $Y=Carbon::now()->format('Y');
        $M=Carbon::now()->format('m');


        $jobProcessed=JobServiceRelation::select(DB::raw('sum(quantity) as total'),DB::raw('Month(created_at) as month'),DB::raw('Year(created_at) as year'))
            ->groupBy(DB::raw('month(created_at)'))
            ->get();
        return view('report.fileCountMonth',compact('jobProcessed'));

    }

    public function revenueMonth(){
        $jobProcessed=Billing::select(DB::raw('sum(total) as total'),DB::raw('Month(created_at) as month'),DB::raw('Year(created_at) as year'))
            ->groupBy(DB::raw('month(created_at)'))
            ->get();

        return view('report.revenueMonth',compact('jobProcessed'));
    }

    public function revenueClient(){
        $clients=Client::select('clientName','clientId')
            ->get();

        $Y=date('Y');
        $start=$Y.'-01-01';
        $end=$Y.'-12-31';

        $bills=Billing::select('client.clientId',DB::raw('Month(billing.created_at) as month'),DB::raw('sum(billing.total) as total'))
            ->leftJoin('job','job.jobId','billing.jobId')
            ->leftJoin('client','client.clientId','job.clientId')
            ->groupBy(DB::raw('month(billing.created_at)'))
            ->groupBy('client.clientId')
            ->whereBetween(DB::raw('date(billing.created_at)'),array([$start,$end]))
            ->get();

        return view('report.revenueClient',compact('clients','bills'));
    }


    public function fileCountClient(){
        $clients=Client::select('clientName','clientId')
            ->get();

        $Y=date('Y');
        $start=$Y.'-01-01';
        $end=$Y.'-12-31';


        $bills=JobServiceRelation::select('client.clientId',DB::raw('sum(job_service_relation.quantity) as total'),DB::raw('Month(job_service_relation.created_at) as month'))
            ->leftJoin('job','job.jobId','job_service_relation.jobId')
            ->leftJoin('client','client.clientId','job.clientId')
            ->groupBy(DB::raw('month(job_service_relation.created_at)'))
            ->groupBy('client.clientId')
            ->whereBetween(DB::raw('date(job_service_relation.created_at)'),array([$start,$end]))
            ->get();


        return view('report.fileCountClient',compact('clients','bills'));

    }

    public function employeeWorkDay(){
        $month=Carbon::now();
        $Y=Carbon::now()->format('Y');
        $M=Carbon::now()->format('m');

        $start = Carbon::parse($month)->startOfMonth()->format('Y-m-d');
        $startDate = Carbon::parse($month)->startOfMonth()->format('d');

        $end = Carbon::parse($month)->endOfMonth()->format('Y-m-d');
        $endDate = Carbon::parse($month)->endOfMonth()->format('d');

        $employee=User::select('userId','name')->where('userType',USER_TYPE['User'])
            ->get();

        $jobs=Jobassign::select('user.userId',DB::raw('sum(jobassign.quantity) as total'),DB::raw('Day(jobassign.assignDate) as day'))
            ->leftJoin('user','user.userId','jobassign.assignTo')
            ->whereBetween(DB::raw('date(jobassign.assignDate)'),array([$start,$end]))
            ->groupBy('user.userId')
            ->groupBy(DB::raw('Day(jobassign.assignDate)'))
            ->get();


//        return $startDate;
        return view('report.employeeWorkDay',compact('startDate','endDate','employee','jobs'));


    }

}
