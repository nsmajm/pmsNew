<?php
namespace App\Http\Controllers;
use App\Absent;
use App\Billing;
use App\EmployeeAttendence;
use App\Group;
use App\JobServiceRelation;
use App\Leave;
use App\OvertimeAssign;
use App\Service;
use App\Shift;
use App\Shiftmain;
use App\Team;
use Illuminate\Http\Request;
use Auth;
use App\Jobassign;
use App\Job;
use App\Status;
use App\Jobstate;
use DB;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        if(Auth::user()->userType==USER_TYPE['User']){
            $todaysDate=date("Y-m-d");
            return view('dashboard.user')
                ->with('todaysDate',$todaysDate);
        }
        return $this->admin();
    }
    public function RealTimeFileProcessed(){
        $qcDonestatus=Status::where('statusType','jobStatus')
            ->where('statusName','qc')
            ->first();
        $productionDonestatus=Status::where('statusType','jobStatus')
            ->where('statusName','production')
            ->first();
        $processingDonestatus=Status::where('statusType','jobStatus')
            ->where('statusName','processing')
            ->first();
        $team=Team::get();
        $fileProcessedPerTeam=array();
        $qcFileProcessedlastdayPerShift=JobServiceRelation::select(DB::raw('SUM(job_service_relation.quantity)  as totalFileProcessed'),'job.shiftId','jobstate.teamId as teamId')
            ->leftJoin('jobstate','jobstate.jobId','job_service_relation.jobId')
            ->leftJoin('job','job.jobId','job_service_relation.jobId')
            ->where('jobstate.statusId',$qcDonestatus->statusId)
            ->groupBy('job.shiftId')
            ->whereDate('jobstate.endDate', '=', Carbon::today()->subDays(0)->format('Y-m-d'))
            ->orderBy('endDate', 'DESC')
            ->get();
        $productionFileProcessedlastdayPerShift=Jobstate::select(DB::raw('SUM(job.quantity)  as totalFileProcessed'),'job.shiftId','jobstate.teamId as teamId')
            ->leftJoin('job','job.jobId','jobstate.jobId')
            ->where('jobstate.statusId',$productionDonestatus->statusId)
            ->groupBy('job.shiftId')
            ->whereDate('jobstate.endDate', '=', Carbon::today()->subDays(0)->format('Y-m-d'))
            ->orderBy('endDate', 'DESC')
            ->get();
        $processingFileProcessedlastdayPerShift=Jobstate::select(DB::raw('SUM(job.quantity)  as totalFileProcessed'),'job.shiftId','jobstate.teamId as teamId')
            ->leftJoin('job','job.jobId','jobstate.jobId')
            ->where('jobstate.statusId',$processingDonestatus->statusId)
            ->groupBy('job.shiftId')
            ->whereDate('jobstate.endDate', '=', Carbon::today()->subDays(0)->format('Y-m-d'))
            ->orderBy('endDate', 'DESC')
            ->get();
        // return $processingFileProcessedlastdayPerShift;
        foreach ($team as $te){
            $filteredBy=$te->teamId;
            $qcProcessedLastDay=json_decode($qcFileProcessedlastdayPerShift,true);
            $productionProcessedLastDay=json_decode($productionFileProcessedlastdayPerShift,true);
            $processingProcessedLastDay=json_decode($processingFileProcessedlastdayPerShift,true);
            $newFileProcessedProduction = array_filter($productionProcessedLastDay, function ($var) use ($filteredBy) {
                return ($var['teamId'] == $filteredBy);
            });
            $newFileProcessedProcessing = array_filter($processingProcessedLastDay, function ($var) use ($filteredBy) {
                return ($var['teamId'] == $filteredBy);
            });
            $newFileProcessedQc = array_filter($qcProcessedLastDay, function ($var) use ($filteredBy) {
                return ($var['teamId'] == $filteredBy);
            });
            $dataLastDayProcessed=array(
                'Team'=>$te->teamId,
                'ProductionProcessed'=>$newFileProcessedProduction,
                'ProcessingProcessed'=>$newFileProcessedProcessing,
                'QcProcessed'=>$newFileProcessedQc,
                '155'=>$newFileProcessedQc,
            );
            array_push($fileProcessedPerTeam,$dataLastDayProcessed);
        }
        return view('dashboard.adminFileProcessedRealTime',compact('fileProcessedPerTeam','team'));
    }
    public function admin(){
        $status=Status::where('statusType','jobStatus')
            ->where('statusName','done')
            ->first();
        $qcDonestatus=Status::where('statusType','jobStatus')
            ->where('statusName','qc')
            ->first();
        $productionDonestatus=Status::where('statusType','jobStatus')
            ->where('statusName','production')
            ->first();
        $processingDonestatus=Status::where('statusType','jobStatus')
            ->where('statusName','processing')
            ->first();
//        Process Job Type / last day Basic/Medium/Advance/Complex
//        $jobService=Job::select('service.complexity',DB::raw('count(job.jobId) as total'))->where('job.statusId',$status->statusId)
//            ->leftJoin('job_service_relation','job_service_relation.jobId','job.jobId')
//            ->leftJoin('service','service.serviceId','job_service_relation.serviceId')
//            ->where('complexity','Basic')
////            ->groupBy('complexity')
//            ->get();
        $jobServiceMorning=Service::select('service.complexity',DB::raw('count(*) as total'))
            ->leftJoin('job_service_relation','service.serviceId','job_service_relation.serviceId')
            ->leftJoin('job','job.jobId','job_service_relation.jobId')
            ->where('job.statusId',$status->statusId)
            ->where(function ($q) {
                $q->where('job.shiftId',1)->orWhere('job.shiftId',2);
            })
            ->groupBy('complexity')
            ->get();
        // return $jobServiceMorningFixed;
//        $jobServiceMorning=Service::select('service.complexity',DB::raw('count(*) as total'))
//            ->leftJoin('job_service_relation','service.serviceId','job_service_relation.serviceId')
//            ->leftJoin('job','job.jobId','job_service_relation.jobId')
//            ->where('job.statusId',$status->statusId)
//            ->where('job.shiftId',2)
//            ->groupBy('complexity')
//            ->get();
        $jobServiceEvening=Service::select('service.complexity',DB::raw('count(*) as total'))
            ->leftJoin('job_service_relation','service.serviceId','job_service_relation.serviceId')
            ->leftJoin('job','job.jobId','job_service_relation.jobId')
            ->where('job.statusId',$status->statusId)
            ->where('job.shiftId',3)
            ->groupBy('service.complexity')
            ->get();
        // $test=Service::
        // return $jobServiceEvening;
        $jobServiceNight=Service::select('service.complexity',DB::raw('count(*) as total'))
            ->leftJoin('job_service_relation','service.serviceId','job_service_relation.serviceId')
            ->leftJoin('job','job.jobId','job_service_relation.jobId')
            ->where('job.statusId',$status->statusId)
            ->where('job.shiftId',4)
            ->groupBy('complexity')
            ->get();
//        return $jobServiceMorningFixed;
        $processStatus=Status::where('statusType','jobStatus')
            ->where('statusName','processing')->first();
        $lastDay= Carbon::yesterday()->format('Y-m-d');
//        Procedure
//        DB::statement('CALL job_information(:date, @created, @delivered);',array($lastDay));
//        $results = DB::select('select @created as created, @delivered as deliveredJob');
//        return $results;
//        $created=Job::whereDate('created_at',$lastDay)
//            ->count();
//        $deliveredJob=Job::whereDate('deliveryDate',$lastDay)
//            ->count();
//
//        $pending=Job::where('job.deadline','<=',$lastDay)
//            ->where('job.statusId','!=',$status->statusId)
//            ->count();
//
//        $processed=Jobstate::where('statusId',$processStatus)
//            ->where('endDate',$lastDay)->count();
        $processed=Jobstate::where('statusId',$processStatus)->where('endDate',$lastDay)->count();
//        $jobInformation = array(
//            "deliveredJob" => $deliveredJob,
//            "pending" => $pending,
//            "processed" => $processed,
//            "created" => $created,
//        );
        $jobRecievedLastDay=Job::select('client.clientName', DB::raw('SUM(job.quantity)  as totalFile'),DB::raw('COUNT(job.jobId)  as totalOrder'))
            ->leftJoin('client','client.clientId','job.clientId')
            ->orderBy('totalFile', 'desc')
            ->limit(5)
            ->groupBy('job.clientId')
            ->whereDate('job.created_at',$lastDay)
            ->get();
        $overTime=OvertimeAssign::select(DB::raw('GROUP_CONCAT(DISTINCT(client.clientName)) as clientsName'),'overtime.date as overTimeDate',DB::raw('totalHour as overTime'),DB::raw('COUNT(overtimeassign.overtimeassignId)  as totalEmployee'))
            ->leftJoin('overtime','overtime.overtimeId','overtimeassign.overtimeId')
            ->leftJoin('client','client.clientId','overtime.clientId')
            ->groupBy('overTimeDate')
            ->whereDate('overtime.date', '>=', Carbon::today()->subDays(7)->format('Y-m-d'))
            ->orderBy('overTimeDate', 'DESC')
            ->get();
        //   return $overTime;
        // job information
        // $today = Carbon::today();
//        $JobInfo=Job::select('job.quantity',DB::raw('DATE(job.created_at) as created_at'))->whereDate('job.created_at', '>=', Carbon::today()->subDays(7)->format('Y-m-d'))->orderBy('job.created_at', 'DESC')->get();
        $fileRecieved = Job::select(DB::raw('SUM(job.quantity)  as totalFileRecieved'),DB::raw('DATE(job.created_at) as recievedDate'))->groupBy('recievedDate')
            ->whereDate('job.created_at', '>=', Carbon::today()->subDays(7)->format('Y-m-d'))->orderBy('recievedDate', 'DESC')->get();
        $fileProcessed=JobServiceRelation::select(DB::raw('SUM(job_service_relation.quantity)  as totalFileProcessed'),DB::raw('DATE(jobstate.endDate) as endDate'))
            ->leftJoin('jobstate','jobstate.jobId','job_service_relation.jobId')
            ->where('jobstate.statusId',$qcDonestatus->statusId)
            ->groupBy('endDate')
            ->whereDate('jobstate.endDate', '>=', Carbon::today()->subDays(7)->format('Y-m-d'))
            ->orderBy('endDate', 'DESC')->get();
        $fileDelivered=Job::select(DB::raw('SUM(job_service_relation.quantity)  as totalFileDelivered'),DB::raw('DATE(job.deliveryDate) as billingDate'))
            ->leftJoin('job_service_relation','job_service_relation.jobId','job.jobId')
            ->where('job.statusId',$status->statusId)
            ->where('job.fileCheck','!=',null)
            ->groupBy('billingDate')
            ->whereDate('job.created_at', '>=', Carbon::today()->subDays(7)->format('Y-m-d'))->orderBy('billingDate', 'DESC')->get();
//            Billing::select(DB::raw('SUM(job.quantity)  as totalFileDelivered'),DB::raw('DATE(billing.created_at) as billingDate'))->leftJoin('job','job.jobId','billing.jobId')
//            ->groupBy('billingDate')->whereDate('billing.created_at', '>=', Carbon::today()->subDays(7)->format('Y-m-d'))->orderBy('billingDate', 'DESC')->get();
        $jobInformation = array();
        $overTimeInformation = array();
        for ($ii=0; $ii < 7; $ii++) {
            $dayOfWeek = Carbon::today()->subDays($ii)->format('Y-m-d');
            $filterBy = $dayOfWeek;
// jobInfo
            $recived=json_decode($fileRecieved,true);
            $processed=json_decode($fileProcessed,true);
            $delivered=json_decode($fileDelivered,true);
            $newFileRecived = array_filter($recived, function ($var) use ($filterBy) {
                return ($var['recievedDate'] == $filterBy);
            });
            $newFileProcessed = array_filter($processed, function ($var) use ($filterBy) {
                return ($var['endDate'] == $filterBy);
            });
            $newFileDelivered = array_filter($delivered, function ($var) use ($filterBy) {
                return ($var['billingDate'] == $filterBy);
            });
            $data=array(
                'date'=>$dayOfWeek,
                'fileRecieved'=>$newFileRecived,
                'fileProcessed'=>$newFileProcessed,
                //'filePending'=>$newFilePending,
                'fileDelivered'=>$newFileDelivered,
            );
            array_push($jobInformation,$data);
            // overTime
            $overTimeRecords=json_decode($overTime,true);
            $newOverTimeRecords = array_filter($overTimeRecords, function ($var) use ($filterBy) {
                return ($var['overTimeDate'] == $filterBy);
            });
            $dataOverTime=array(
                'date'=>$dayOfWeek,
                'overTimeData'=>$newOverTimeRecords
            );
            array_push($overTimeInformation,$dataOverTime);
        }
        $team=Team::get();
        $fileProcessedPerTeam=array();
        $qcFileProcessedlastdayPerShift=JobServiceRelation::select(DB::raw('SUM(job_service_relation.quantity)  as totalFileProcessed'),'job.shiftId','jobstate.teamId as teamId')
            ->leftJoin('jobstate','jobstate.jobId','job_service_relation.jobId')
            ->leftJoin('job','job.jobId','job_service_relation.jobId')
            ->where('jobstate.statusId',$qcDonestatus->statusId)
            ->groupBy('job.shiftId')
            ->whereDate('jobstate.endDate', '=', Carbon::today()->subDays(1)->format('Y-m-d'))
            ->orderBy('endDate', 'DESC')
            ->get();
        $productionFileProcessedlastdayPerShift=Jobstate::select(DB::raw('SUM(job.quantity)  as totalFileProcessed'),'job.shiftId','jobstate.teamId as teamId')
            ->leftJoin('job','job.jobId','jobstate.jobId')
            ->where('jobstate.statusId',$productionDonestatus->statusId)
            ->groupBy('job.shiftId')
            ->whereDate('jobstate.endDate', '=', Carbon::today()->subDays(1)->format('Y-m-d'))
            ->orderBy('endDate', 'DESC')
            ->get();
        $processingFileProcessedlastdayPerShift=Jobstate::select(DB::raw('SUM(job.quantity)  as totalFileProcessed'),'job.shiftId','jobstate.teamId as teamId')
            ->leftJoin('job','job.jobId','jobstate.jobId')
            ->where('jobstate.statusId',$processingDonestatus->statusId)
            ->groupBy('job.shiftId')
            ->whereDate('jobstate.endDate', '=', Carbon::today()->subDays(1)->format('Y-m-d'))
            ->orderBy('endDate', 'DESC')
            ->get();
        // return $qcFileProcessedlastdayPerShift;
        foreach ($team as $te){
            $filteredBy=$te->teamId;
            $qcProcessedLastDay=json_decode($qcFileProcessedlastdayPerShift,true);
            $productionProcessedLastDay=json_decode($productionFileProcessedlastdayPerShift,true);
            $processingProcessedLastDay=json_decode($processingFileProcessedlastdayPerShift,true);
            $newFileProcessedProduction = array_filter($productionProcessedLastDay, function ($var) use ($filteredBy) {
                return ($var['teamId'] == $filteredBy);
            });
            $newFileProcessedProcessing = array_filter($processingProcessedLastDay, function ($var) use ($filteredBy) {
                return ($var['teamId'] == $filteredBy);
            });
            $newFileProcessedQc = array_filter($qcProcessedLastDay, function ($var) use ($filteredBy) {
                return ($var['teamId'] == $filteredBy);
            });
            $dataLastDayProcessed=array(
                'Team'=>$te->teamId,
                'ProductionProcessed'=>$newFileProcessedProduction,
                'ProcessingProcessed'=>$newFileProcessedProcessing,
                'QcProcessed'=>$newFileProcessedQc,
                '155'=>$newFileProcessedQc,
            );
            array_push($fileProcessedPerTeam,$dataLastDayProcessed);
        }
//        $group=Group::get();
        // $allShift=Shift::get();
//
//        $fileProcessedPerShiftLastDay=array();
//
//        $processedPerShift=json_decode($fileProcessedlastdayPerShift,true);
//
//        foreach ($group as $group){
//
//            foreach ($allShift as $shifts){
//
//
//                $filterByShift = $shifts->shiftId;
//                if ($group->)
//
//                $newprocessedPerShiftRecords = array_filter($processedPerShift, function ($var) use ($filterByShift) {
//                    return ($var['shiftId'] == $filterByShift);
//                });
//
//
//
//                $dataq=array(
//                    'shift'=>$filterByShift,
//                    'shiftData'=>$newprocessedPerShiftRecords
//
//                );
//                array_push($fileProcessedPerShiftLastDay,$dataq);
//
//
//            }
//
//
//        }

        //  return $fileProcessedPerTeam;

        $complex = Service::select('complexity')
            ->groupBy('service.complexity')
            ->get();


        $processMoirningBasic = JobServiceRelation::Select(DB::raw('COUNT(job_service_relation.jobId)  as processMoirningBasic'))
            ->leftJoin('service','job_service_relation.serviceId','service.serviceId')
            ->leftJoin('job','job_service_relation.jobId','job.jobId')
            ->where('job.shiftId' , '1')
            ->orWhere('job.shiftId' , '2')
            ->where('service.complexity', 'Basic')
            ->first();

        $processMoirningMedium = JobServiceRelation::Select(DB::raw('COUNT(job_service_relation.jobId)  as processMoirningMedium'))
            ->leftJoin('service','job_service_relation.serviceId','service.serviceId')
            ->leftJoin('job','job_service_relation.jobId','job.jobId')
            ->where('service.complexity', 'Medium')
            ->where('job.shiftId' , '1')
            ->orWhere('job.shiftId' , '2')
            ->first();

        $processMoirningAdvance = JobServiceRelation::Select(DB::raw('COUNT(job_service_relation.jobId)  as processMoirningAdvance'))
            ->leftJoin('service','job_service_relation.serviceId','service.serviceId')
            ->leftJoin('job','job_service_relation.jobId','job.jobId')
            ->where('service.complexity', 'Advance')
            ->where('job.shiftId' , '1')
            ->orWhere('job.shiftId' , '2')
            ->first();

        $processMoirningComplex = JobServiceRelation::Select(DB::raw('COUNT(job_service_relation.jobId)  as processMoirningComplex'))
            ->leftJoin('service','job_service_relation.serviceId','service.serviceId')
            ->leftJoin('job','job_service_relation.jobId','job.jobId')
            ->where('service.complexity', 'Complex')
            ->where('job.shiftId' , '1')
            ->orWhere('job.shiftId' , '2')
            ->first();


        $processEveningBasic = JobServiceRelation::Select(DB::raw('COUNT(job_service_relation.jobId)  as processEveningBasic'))
            ->leftJoin('service','job_service_relation.serviceId','service.serviceId')
            ->leftJoin('job','job_service_relation.jobId','job.jobId')
            ->where('job.shiftId' , '3')
            ->where('service.complexity', 'Basic')
            ->first();

        $processEveningMedium = JobServiceRelation::Select(DB::raw('COUNT(job_service_relation.jobId)  as processEveningMedium'))
            ->leftJoin('service','job_service_relation.serviceId','service.serviceId')
            ->leftJoin('job','job_service_relation.jobId','job.jobId')
            ->where('service.complexity', 'Medium')
            ->where('job.shiftId' , '3')
            ->first();

        $processEveningAdvance = JobServiceRelation::Select(DB::raw('COUNT(job_service_relation.jobId)  as processEveningAdvance'))
            ->leftJoin('service','job_service_relation.serviceId','service.serviceId')
            ->leftJoin('job','job_service_relation.jobId','job.jobId')
            ->where('service.complexity', 'Advance')
            ->where('job.shiftId' , '3')
            ->first();

        $processEveningComplex = JobServiceRelation::Select(DB::raw('COUNT(job_service_relation.jobId)  as processEveningComplex'))
            ->leftJoin('service','job_service_relation.serviceId','service.serviceId')
            ->leftJoin('job','job_service_relation.jobId','job.jobId')
            ->where('service.complexity', 'Complex')
            ->where('job.shiftId' , '3')
            ->first();

      // return $processMoirningBasic;

     //  return view('dashboard.test',compact('processMoirningBasic','processMoirningMedium','processMoirningAdvance','processMoirningComplex','processEveningBasic','processEveningMedium','processEveningAdvance','processEveningComplex'));

       // return view('dashboard.admin',compact('processMoirningBasic','processMoirningMedium','processMoirningAdvance','processMoirningComplex','processEveningBasic','processEveningMedium','processEveningAdvance','processEveningComplex','jobRecievedLastDay','jobInformation','fileProcessedPerTeam','team','jobServiceMorning','jobServiceEvening','jobServiceNight','overTimeInformation'));


        $employeeAttendence=EmployeeAttendence::where('date',date('Y-m-d'))
            ->where(function ($q) {
                $q->where('shift.shiftName','Morning')->orWhere('shift.shiftName','Evening');
            })
            ->leftJoin('shift','shift.shiftId','employeeattendence.shiftId')

            ->groupBy('shift.shiftName')
            ->get();

        $shifMain=Shiftmain::orderBy('shiftmainId','desc')
            ->limit(1)
            ->first();

//        return $shifMain;
        $onLeaveMorning='';
        $onLeaveEvening='';
        if($shifMain){
            $onLeaveMorning=Leave::where(function ($query) {
                $query->where('leave.startDate', '<=', date('Y-m-d'));
                $query->where('leave.endDate', '>=', date('Y-m-d'));
            })
                ->where('leave.statusId',8)
                ->leftJoin('user','user.userId','leave.userId')
                ->leftJoin('group','group.groupId','user.groupId')
                ->leftJoin('shiftassign','shiftassign.groupId','group.groupId')
                ->where('shiftassign.shiftmainId',$shifMain->shiftmainId)
                ->where(function ($query) {
                    $query->orWhere('shiftassign.shiftId', 1);
                    $query->orWhere('shiftassign.shiftId',2);
                })
                ->distinct('user.userId')
                ->count('user.userId');

            $onLeaveEvening=Leave::where(function ($query) {
                $query->where('leave.startDate', '<=', date('Y-m-d'));
                $query->where('leave.endDate', '>=', date('Y-m-d'));
            })
                ->where('leave.statusId',8)
                ->leftJoin('user','user.userId','leave.userId')
                ->leftJoin('group','group.groupId','user.groupId')
                ->leftJoin('shiftassign','shiftassign.groupId','group.groupId')
                ->where('shiftassign.shiftmainId',$shifMain->shiftmainId)
                ->where('shiftassign.shiftId',3)
                ->distinct('user.userId')
                ->count('user.userId');
        }


//        return $onLeaveMorning;



        $absentMorning=Absent::where(DB::raw('DATE(absent.created_at)'),date('Y-m-d'))
            ->where(function ($query) {
                $query->orWhere('absent.shiftId', 1);
                $query->orWhere('absent.shiftId',2);
            })
            ->count();

        $absentEvening=Absent::where(DB::raw('DATE(absent.created_at)'),date('Y-m-d'))
            ->where('absent.shiftId',3)
            ->count();

        return view('dashboard.admin',compact('processMoirningBasic','processMoirningMedium','processMoirningAdvance','processMoirningComplex','processEveningBasic','processEveningMedium','processEveningAdvance','processEveningComplex','jobRecievedLastDay','jobInformation','fileProcessedPerTeam','team','jobServiceMorning','jobServiceEvening','jobServiceNight','overTimeInformation','jobRecievedLastDay','jobInformation','fileProcessedPerTeam','team','jobServiceMorning','jobServiceEvening',
            'employeeAttendence','jobServiceNight','overTimeInformation','onLeaveMorning','onLeaveEvening','absentMorning','absentEvening'));

    }
}