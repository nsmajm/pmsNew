<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shift;
use App\Shiftassign;
use App\Team;
use App\Status;
use Illuminate\Support\Facades\Auth;
use Session;
use PDF;

class ShiftController extends Controller
{
    public function create(){
        $shifts=Shift::get();
        $teams=Team::get();


        return view('shift.create')
            ->with('shifts',$shifts)
            ->with('teams',$teams);
    }
    public function assign(Request $r){

        $from=$r->fromDate;
        $to=$r->toDate;

        $production=Status::where('statusType','jobStatus')
            ->where('statusName','production')->first();

        $processing=Status::where('statusType','jobStatus')
            ->where('statusName','processing')->first();

        $qc=Status::where('statusType','jobStatus')
            ->where('statusName','qc')->first();


        $shift=Shift::where('shiftName','Morning (Fixed)')->first();
        $shiftMorningFixed=$shift->shiftId;

        $shift=Shift::where('shiftName','Morning')->first();
        $shiftMorning=$shift->shiftId;

        $shift=Shift::where('shiftName','Evening')->first();
        $shiftEvening=$shift->shiftId;

        $shift=Shift::where('shiftName','Night')->first();
        $shiftNight=$shift->shiftId;





        //Morning Fixed
        $morningFixedProductionTeam1=$r['Morning_(Fixed)_production1'];
        $morningFixedProductionTeam2=$r['Morning_(Fixed)_production2'];
        $morningFixedProductionTeam3=$r['Morning_(Fixed)_production3'];


        if($morningFixedProductionTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->teamId=$morningFixedProductionTeam1;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($morningFixedProductionTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->teamId=$morningFixedProductionTeam2;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($morningFixedProductionTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->teamId=$morningFixedProductionTeam3;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }


        $morningFixedProcessingTeam1=$r['Morning_(Fixed)_processing1'];
        $morningFixedProcessingTeam2=$r['Morning_(Fixed)_processing2'];
        $morningFixedProcessingTeam3=$r['Morning_(Fixed)_processing3'];

        if($morningFixedProcessingTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->teamId=$morningFixedProductionTeam1;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($morningFixedProcessingTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->teamId=$morningFixedProcessingTeam2;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }


        if($morningFixedProcessingTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->teamId=$morningFixedProcessingTeam3;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        $morningFixedQcTeam1=$r['Morning_(Fixed)_qc1'];
        $morningFixedQcTeam2=$r['Morning_(Fixed)_qc2'];
        $morningFixedQcTeam3=$r['Morning_(Fixed)_qc3'];

        if($morningFixedQcTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->teamId=$morningFixedQcTeam1;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($morningFixedQcTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->teamId=$morningFixedQcTeam2;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($morningFixedQcTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->teamId=$morningFixedQcTeam3;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        //End Morning Fixed

        //Morning
        $morningProductionTeam1=$r['Morning__production1'];
        $morningProductionTeam2=$r['Morning__production2'];
        $morningProductionTeam3=$r['Morning__production3'];

        if($morningProductionTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->teamId=$morningProductionTeam1;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }


        if($morningProductionTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->teamId=$morningProductionTeam2;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }


        if($morningProductionTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->teamId=$morningProductionTeam3;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        $morningProcessingTeam1=$r['Morning__processing1'];
        $morningProcessingTeam2=$r['Morning__processing2'];
        $morningProcessingTeam3=$r['Morning__processing3'];

        if($morningProcessingTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->teamId=$morningProcessingTeam1;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($morningProcessingTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->teamId=$morningProcessingTeam2;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }


        if($morningProcessingTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->teamId=$morningProcessingTeam3;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        $morningQcTeam1=$r['Morning__qc1'];
        $morningQcTeam2=$r['Morning__qc2'];
        $morningQcTeam3=$r['Morning__qc3'];

        if($morningQcTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->teamId=$morningQcTeam1;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($morningQcTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->teamId=$morningQcTeam2;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($morningQcTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->teamId=$morningQcTeam3;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        //End Morning

        //Evening

        $eveningProductionTeam1=$r['Evening_production1'];
        $eveningProductionTeam2=$r['Evening_production2'];
        $eveningProductionTeam3=$r['Evening_production3'];

        if($eveningProductionTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->teamId=$eveningProductionTeam1;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($eveningProductionTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->teamId=$eveningProductionTeam2;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }


        if($eveningProductionTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->teamId=$eveningProductionTeam3;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }


        $eveningProcessingTeam1=$r['Evening_processing1'];
        $eveningProcessingTeam2=$r['Evening_processing2'];
        $eveningProcessingTeam3=$r['Evening_processing3'];

        if($eveningProcessingTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->teamId=$eveningProcessingTeam1;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($eveningProcessingTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->teamId=$eveningProcessingTeam2;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($eveningProcessingTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->teamId=$eveningProcessingTeam3;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        $eveningQcTeam1=$r['Evening_qc1'];
        $eveningQcTeam2=$r['Evening_qc2'];
        $eveningQcTeam3=$r['Evening_qc3'];


        if($eveningQcTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->teamId=$eveningQcTeam1;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($eveningQcTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->teamId=$eveningQcTeam2;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($eveningQcTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->teamId=$eveningQcTeam3;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }
        //End Evening

        //Night
        $nightProductionTeam1=$r['Night_production1'];
        $nightProductionTeam2=$r['Night_production2'];
        $nightProductionTeam3=$r['Night_production3'];

        if($nightProductionTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->teamId=$nightProductionTeam1;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($nightProductionTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->teamId=$nightProductionTeam2;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($nightProductionTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->teamId=$nightProductionTeam3;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }



        $nightProcessingTeam1=$r['Night_processing1'];
        $nightProcessingTeam2=$r['Night_processing2'];
        $nightProcessingTeam3=$r['Night_processing3'];

        if($nightProcessingTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->teamId=$nightProcessingTeam1;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($nightProcessingTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->teamId=$nightProcessingTeam2;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        if($nightProcessingTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->teamId=$nightProcessingTeam3;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        $nightQcTeam1=$r['Night_qc1'];
        $nightQcTeam2=$r['Night_qc2'];
        $nightQcTeam3=$r['Night_qc3'];

        if($nightQcTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->teamId=$nightQcTeam1;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }
        if($nightQcTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->teamId=$nightQcTeam2;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }
        if($nightQcTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->teamId=$nightQcTeam3;
            $shiftAssign->fromDate=$from;
            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->save();
        }

        //End Night

        Session::flash('message', 'Shift Assigned Successfully!');

        return back();
    }

    public function show(){

        $shifts=Shift::get();
        $production=Status::where('statusType','jobStatus')
            ->where('statusName','production')->first();

        $processing=Status::where('statusType','jobStatus')
            ->where('statusName','processing')->first();

        $qc=Status::where('statusType','jobStatus')
            ->where('statusName','qc')->first();


        $ProductionManager=Shiftassign::select('team.teamName','team.teamId','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
            ->where('jobStatus',$production->statusId)
            ->leftJoin('team','team.teamId','shiftassign.teamId')
            ->leftJoin('user','user.teamId','team.teamId')
//            ->where('user.teamLeader','!=',1)
            ->orderBy('teamName')
            ->orderBy('user.teamLeader','desc')
            ->get();

//        return $ProductionManager;





        $ProcessingManager=Shiftassign::select('team.teamId','team.teamName','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
            ->where('jobStatus',$processing->statusId)
            ->leftJoin('team','team.teamId','shiftassign.teamId')
            ->leftJoin('user','user.teamId','team.teamId')
//            ->where('user.teamLeader','!=',1)
            ->orderBy('teamName')
            ->orderBy('user.teamLeader','desc')
            ->get();


        $QcManager=Shiftassign::select('team.teamId','team.teamName','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
            ->where('jobStatus',$qc->statusId)
            ->leftJoin('team','team.teamId','shiftassign.teamId')
            ->leftJoin('user','user.teamId','team.teamId')
//            ->where('user.teamLeader','!=',1)
            ->orderBy('teamName')
            ->orderBy('user.teamLeader','desc')
            ->get();





        $productionTeams=Shiftassign::select('teamId')
            ->where('jobStatus',$production->statusId)
            ->groupBy('teamId')
            ->get();

        $processingnTeams=Shiftassign::select('teamId')
            ->where('jobStatus',$processing->statusId)
            ->groupBy('teamId')
            ->get();

        $qcTeams=Shiftassign::select('teamId')
            ->where('jobStatus',$qc->statusId)
            ->groupBy('teamId')
            ->get();

//        return $qcTeams;
//Only Gets The Leader Of the Team

//        $ProductionLeader=Shiftassign::select('team.teamName','team.teamId','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
//            ->where('jobStatus',$production->statusId)
//            ->leftJoin('team','team.teamId','shiftassign.teamId')
//            ->leftJoin('user','user.teamId','team.teamId')
//            ->where('user.teamLeader',1)
//            ->get();
//
//        $ProcessingLeader=Shiftassign::select('team.teamId','team.teamName','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
//            ->where('jobStatus',$processing->statusId)
//            ->leftJoin('team','team.teamId','shiftassign.teamId')
//            ->leftJoin('user','user.teamId','team.teamId')
//            ->where('user.teamLeader','!=',1)
//            ->get();
//        $QcLeader=Shiftassign::select('team.teamId','team.teamName','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
//            ->where('jobStatus',$qc->statusId)
//            ->leftJoin('team','team.teamId','shiftassign.teamId')
//            ->leftJoin('user','user.teamId','team.teamId')
//            ->where('user.teamLeader','!=',1)
//            ->get();


//        return view('shift.test',compact('shifts','ProductionManager','ProcessingManager','QcManager','productionTeams','processingnTeams','qcTeams'))
//                        ->with('shifts',$shifts)
//                        ->with('ProductionManager',$ProductionManager)
//                        ->with('ProcessingManager',$ProcessingManager)
//                        ->with('QcManager',$QcManager)
//                        // Variable For Teams
//                        ->with('productionTeams',$productionTeams)
//                        ->with('processingnTeams',$processingnTeams)
//                        ->with('qcTeams',$qcTeams)
//        ;

        $pdf = PDF::loadView('shift.test',compact('shifts','ProductionManager','ProcessingManager','QcManager','productionTeams','processingnTeams','qcTeams'));


        return $pdf->stream('test.pdf',array('Attachment'=>0));

//        return view('shift.show')
//            ->with('shifts',$shifts)
//            ->with('ProductionManager',$ProductionManager)
//            ->with('ProcessingManager',$ProcessingManager)
//            ->with('QcManager',$QcManager)
//            // Variable For Teams
//            ->with('productionTeams',$productionTeams)
//            ->with('processingnTeams',$processingnTeams)
//            ->with('qcTeams',$qcTeams);


    }
}
