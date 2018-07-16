<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shift;
use App\Shiftassign;
use App\Team;
use App\Group;
use App\Status;
use App\Shiftmain;
use Illuminate\Support\Facades\Auth;
use Session;
use PDF;

use Yajra\DataTables\DataTables;

class ShiftController extends Controller
{

    public function index(){

        return view('shift.index');
    }

    public function getData(Request $r){

        $shiftMain=Shiftmain::select('shiftmain.*','user.name')
            ->leftJoin('user','user.userId','shiftmain.assignBy')
            ->orderBy('shiftmain.shiftmainId','desc')
            ->get();

        $datatables = Datatables::of($shiftMain);
        return $datatables->make(true);

    }



    public function create(){
        $shifts=Shift::get();
        $teams=Team::get();
        $groups=Group::get();


        return view('shift.create')
            ->with('shifts',$shifts)
            ->with('teams',$groups);
    }


    public function assign(Request $r){



        $from=$r->fromDate;
        $to=$r->toDate;

        $shiftMain=new Shiftmain();
        $shiftMain->assignBy=Auth::user()->userId;
        $shiftMain->shiftName=$r->shiftName;
        $shiftMain->fromDate=$from;
        $shiftMain->toDate=$to;
        $shiftMain->save();




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
            $shiftAssign->groupId=$morningFixedProductionTeam1;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;

            $shiftAssign->save();
        }

        if($morningFixedProductionTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->groupId=$morningFixedProductionTeam2;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($morningFixedProductionTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->groupId=$morningFixedProductionTeam3;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }


        $morningFixedProcessingTeam1=$r['Morning_(Fixed)_processing1'];
        $morningFixedProcessingTeam2=$r['Morning_(Fixed)_processing2'];
        $morningFixedProcessingTeam3=$r['Morning_(Fixed)_processing3'];

        if($morningFixedProcessingTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->groupId=$morningFixedProductionTeam1;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($morningFixedProcessingTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->groupId=$morningFixedProcessingTeam2;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }


        if($morningFixedProcessingTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->groupId=$morningFixedProcessingTeam3;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        $morningFixedQcTeam1=$r['Morning_(Fixed)_qc1'];
        $morningFixedQcTeam2=$r['Morning_(Fixed)_qc2'];
        $morningFixedQcTeam3=$r['Morning_(Fixed)_qc3'];

        if($morningFixedQcTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->groupId=$morningFixedQcTeam1;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($morningFixedQcTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->groupId=$morningFixedQcTeam2;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($morningFixedQcTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorningFixed;
            $shiftAssign->groupId=$morningFixedQcTeam3;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
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
            $shiftAssign->groupId=$morningProductionTeam1;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }


        if($morningProductionTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->groupId=$morningProductionTeam2;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }


        if($morningProductionTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->groupId=$morningProductionTeam3;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        $morningProcessingTeam1=$r['Morning__processing1'];
        $morningProcessingTeam2=$r['Morning__processing2'];
        $morningProcessingTeam3=$r['Morning__processing3'];

        if($morningProcessingTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->groupId=$morningProcessingTeam1;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($morningProcessingTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->groupId=$morningProcessingTeam2;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }


        if($morningProcessingTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->groupId=$morningProcessingTeam3;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        $morningQcTeam1=$r['Morning__qc1'];
        $morningQcTeam2=$r['Morning__qc2'];
        $morningQcTeam3=$r['Morning__qc3'];

        if($morningQcTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->groupId=$morningQcTeam1;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($morningQcTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->groupId=$morningQcTeam2;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($morningQcTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftMorning;
            $shiftAssign->groupId=$morningQcTeam3;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
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
            $shiftAssign->groupId=$eveningProductionTeam1;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($eveningProductionTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->groupId=$eveningProductionTeam2;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }


        if($eveningProductionTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->groupId=$eveningProductionTeam3;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }


        $eveningProcessingTeam1=$r['Evening_processing1'];
        $eveningProcessingTeam2=$r['Evening_processing2'];
        $eveningProcessingTeam3=$r['Evening_processing3'];

        if($eveningProcessingTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->groupId=$eveningProcessingTeam1;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($eveningProcessingTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->groupId=$eveningProcessingTeam2;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($eveningProcessingTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->groupId=$eveningProcessingTeam3;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        $eveningQcTeam1=$r['Evening_qc1'];
        $eveningQcTeam2=$r['Evening_qc2'];
        $eveningQcTeam3=$r['Evening_qc3'];


        if($eveningQcTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->groupId=$eveningQcTeam1;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($eveningQcTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->groupId=$eveningQcTeam2;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($eveningQcTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftEvening;
            $shiftAssign->groupId=$eveningQcTeam3;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
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
            $shiftAssign->groupId=$nightProductionTeam1;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($nightProductionTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->groupId=$nightProductionTeam2;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($nightProductionTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->groupId=$nightProductionTeam3;
            $shiftAssign->jobStatus=$production->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }



        $nightProcessingTeam1=$r['Night_processing1'];
        $nightProcessingTeam2=$r['Night_processing2'];
        $nightProcessingTeam3=$r['Night_processing3'];

        if($nightProcessingTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->groupId=$nightProcessingTeam1;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($nightProcessingTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->groupId=$nightProcessingTeam2;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        if($nightProcessingTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->groupId=$nightProcessingTeam3;
            $shiftAssign->jobStatus=$processing->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        $nightQcTeam1=$r['Night_qc1'];
        $nightQcTeam2=$r['Night_qc2'];
        $nightQcTeam3=$r['Night_qc3'];

        if($nightQcTeam1 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->groupId=$nightQcTeam1;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }
        if($nightQcTeam2 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->groupId=$nightQcTeam2;
//            $shiftAssign->fromDate=$from;
//            $shiftAssign->toDate=$to;
            $shiftAssign->jobStatus=$qc->statusId;
//            $shiftAssign->assignBy=Auth::user()->userId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }
        if($nightQcTeam3 !=null){
            $shiftAssign=new Shiftassign();
            $shiftAssign->shiftId=$shiftNight;
            $shiftAssign->groupId=$nightQcTeam3;
            $shiftAssign->jobStatus=$qc->statusId;
            $shiftAssign->shiftmainId=$shiftMain->shiftmainId;
            $shiftAssign->save();
        }

        //End Night
        $this->makepdf($shiftMain->shiftmainId);


        Session::flash('message', 'Shift Assigned Successfully!');

        return back();
    }

    public function show($id)
    {
        $shiftMain=Shiftmain::findOrFail($id);
        $shifts=Shift::get();
        $production=Status::where('statusType','jobStatus')
            ->where('statusName','production')
            ->first();
        $processing=Status::where('statusType','jobStatus')
            ->where('statusName','processing')
            ->first();
        $qc=Status::where('statusType','jobStatus')
            ->where('statusName','qc')
            ->first();
        $ProductionManager=Shiftassign::select('group.groupName','group.groupId','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
            ->where('jobStatus',$production->statusId)
            ->leftJoin('group','group.groupId','shiftassign.groupId')
            ->leftJoin('user','user.groupId','group.groupId')
            ->where('shiftassign.shiftmainId',$id)
            ->orderBy('groupName')
            ->orderBy('user.teamLeader','desc')
            ->get();
//        return $ProductionManager;
        $ProcessingManager=Shiftassign::select('group.groupId','group.groupName','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
            ->where('jobStatus',$processing->statusId)
            ->leftJoin('team','group.groupId','shiftassign.groupId')
            ->leftJoin('user','user.groupId','group.groupId')
            ->where('shiftassign.shiftmainId',$id)
            ->orderBy('groupName')
            ->orderBy('user.teamLeader','desc')
            ->get();
        $QcManager=Shiftassign::select('group.groupId','group.groupName','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
            ->where('jobStatus',$qc->statusId)
            ->leftJoin('team','group.groupId','shiftassign.groupId')
            ->leftJoin('user','user.groupId','group.groupId')
            ->where('shiftassign.shiftmainId',$id)
            ->orderBy('groupName')
            ->orderBy('user.teamLeader','desc')
            ->get();
        $productionTeams=Shiftassign::select('groupId')
            ->where('jobStatus',$production->statusId)
            ->groupBy('groupId')
            ->get();
        $processingnTeams=Shiftassign::select('groupId')
            ->where('jobStatus',$processing->statusId)
            ->groupBy('groupId')
            ->get();
        $qcTeams=Shiftassign::select('groupId')
            ->where('jobStatus',$qc->statusId)
            ->groupBy('groupId')
            ->get();

        return view('shift.show')
            ->with('shifts',$shifts)
            ->with('ProductionManager',$ProductionManager)
            ->with('ProcessingManager',$ProcessingManager)
            ->with('QcManager',$QcManager)
            // Variable For Teams
            ->with('productionTeams',$productionTeams)
            ->with('processingnTeams',$processingnTeams)
            ->with('qcTeams',$qcTeams)
            ->with('shiftMain',$shiftMain);
    }

    public function makepdf($id){
        $shiftMain=Shiftmain::findOrFail($id);

        $shifts=Shift::get();
        $production=Status::where('statusType','jobStatus')
            ->where('statusName','production')
            ->first();

        $processing=Status::where('statusType','jobStatus')
            ->where('statusName','processing')
            ->first();

        $qc=Status::where('statusType','jobStatus')
            ->where('statusName','qc')
            ->first();


        $ProductionManager=Shiftassign::select('group.groupName','group.groupId','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
            ->where('jobStatus',$production->statusId)
            ->leftJoin('group','group.groupId','shiftassign.groupId')
            ->leftJoin('user','user.groupId','group.groupId')
            ->where('shiftassign.shiftmainId',$id)
            ->orderBy('groupName')
            ->orderBy('user.teamLeader','desc')
            ->get();



        $ProcessingManager=Shiftassign::select('group.groupId','group.groupName','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
            ->where('jobStatus',$processing->statusId)
            ->leftJoin('group','group.groupId','shiftassign.groupId')
            ->leftJoin('user','user.groupId','group.groupId')
            ->where('shiftassign.shiftmainId',$id)
            ->orderBy('groupName')
            ->orderBy('user.teamLeader','desc')
            ->get();


        $QcManager=Shiftassign::select('group.groupId','group.groupName','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
            ->where('jobStatus',$qc->statusId)
            ->leftJoin('group','group.groupId','shiftassign.groupId')
            ->leftJoin('user','user.groupId','group.groupId')
            ->where('shiftassign.shiftmainId',$id)
            ->orderBy('groupName')
            ->orderBy('user.teamLeader','desc')
            ->get();





        $productionTeams=Shiftassign::select('groupId')
            ->where('jobStatus',$production->statusId)
            ->groupBy('groupId')
            ->get();

        $processingnTeams=Shiftassign::select('groupId')
            ->where('jobStatus',$processing->statusId)
            ->groupBy('groupId')
            ->get();

        $qcTeams=Shiftassign::select('groupId')
            ->where('jobStatus',$qc->statusId)
            ->groupBy('groupId')
            ->get();




        $pdf = PDF::loadView('shift.pdf',compact('shifts','ProductionManager','ProcessingManager','QcManager','productionTeams','processingnTeams','qcTeams','shiftMain'));

        $pdf->save('public/pdf/tst.pdf');


    }
    public function downloadPdf($id)
    {
        $shiftMain=Shiftmain::findOrFail($id);

        $shifts=Shift::get();
        $production=Status::where('statusType','jobStatus')
            ->where('statusName','production')
            ->first();

        $processing=Status::where('statusType','jobStatus')
            ->where('statusName','processing')
            ->first();

        $qc=Status::where('statusType','jobStatus')
            ->where('statusName','qc')
            ->first();


        $ProductionManager=Shiftassign::select('group.groupName','group.groupId','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
            ->where('jobStatus',$production->statusId)
            ->leftJoin('group','group.groupId','shiftassign.groupId')
            ->leftJoin('user','user.groupId','group.groupId')
            ->where('shiftassign.shiftmainId',$id)
            ->orderBy('groupName')
            ->orderBy('user.teamLeader','desc')
            ->get();



        $ProcessingManager=Shiftassign::select('group.groupId','group.groupName','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
            ->where('jobStatus',$processing->statusId)
            ->leftJoin('group','group.groupId','shiftassign.groupId')
            ->leftJoin('user','user.groupId','group.groupId')
            ->where('shiftassign.shiftmainId',$id)
            ->orderBy('groupName')
            ->orderBy('user.teamLeader','desc')
            ->get();


        $QcManager=Shiftassign::select('group.groupId','group.groupName','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
            ->where('jobStatus',$qc->statusId)
            ->leftJoin('group','group.groupId','shiftassign.groupId')
            ->leftJoin('user','user.groupId','group.groupId')
            ->where('shiftassign.shiftmainId',$id)
            ->orderBy('groupName')
            ->orderBy('user.teamLeader','desc')
            ->get();





        $productionTeams=Shiftassign::select('groupId')
            ->where('jobStatus',$production->statusId)
            ->groupBy('groupId')
            ->get();

        $processingnTeams=Shiftassign::select('groupId')
            ->where('jobStatus',$processing->statusId)
            ->groupBy('groupId')
            ->get();

        $qcTeams=Shiftassign::select('groupId')
            ->where('jobStatus',$qc->statusId)
            ->groupBy('groupId')
            ->get();


        $ProductionManager=Shiftassign::select('group.groupName','group.groupId','shiftassign.shiftId','user.name','user.userType','user.teamLeader')
            ->where('jobStatus',$production->statusId)
            ->leftJoin('group','group.groupId','shiftassign.groupId')
            ->leftJoin('user','user.groupId','group.groupId')
            ->where('shiftassign.shiftmainId',$id)
            ->orderBy('groupName')
            ->orderBy('user.teamLeader','desc')
            ->get();



        $pdf = PDF::loadView('shift.pdf',compact('shifts','ProductionManager','ProcessingManager','QcManager','productionTeams','processingnTeams','qcTeams','shiftMain'));

        //        $pdf->save('public/pdf/tst.pdf'); Saving Pdf To Server

        if($shiftMain->shiftName !=null){
            return $pdf->stream($shiftMain->shiftName.'.pdf',array('Attachment'=>0));
        }



        return $pdf->stream('test.pdf',array('Attachment'=>0));

        
    }
}
