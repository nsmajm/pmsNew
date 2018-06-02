<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\BriefItem;
use App\BriefInstructions;
use Session;


class BriefController extends Controller
{
    public function check(){
        return view('brief.check');
    }

    public function index(){
        $clients=Client::select('clientId','clientName')->get();

        return view('brief.brief',compact('clients'));
    }

    public function showBrief(Request $r){
        $briefItems=BriefItem::where('clientId',$r->clientId)
            ->get();
        $instructions=BriefInstructions::select('brief_instructions.brief_itemId','brief_instructions.brief_instructionsId','brief_instructions.specialInstruction','brief_instructions.created_at')->leftJoin('brief_item','brief_item.brief_itemId','brief_instructions.brief_itemId')
            ->where('brief_item.clientId',$r->clientId)
            ->orderBy('brief_instructionsId','desc')
            ->get();

        return view('brief.showBriefPage')
            ->with('briefItems',$briefItems)
            ->with('instructions',$instructions);
    }

    public function edit($id){
        $briefItems=BriefItem::select('brief_item.*','client.clientName')
            ->where('brief_itemId',$id)
            ->leftJoin('client','client.clientId','brief_item.clientId')->first();

        $instruction=BriefInstructions::where('brief_itemId',$id)
            ->orderBy('brief_instructionsId','desc')->first();


        return view('brief.edit')
            ->with('briefItems',$briefItems)
            ->with('instruction',$instruction);
    }


    public function add(){
        $clients=Client::select('clientId','clientName')->get();

        return view('brief.add',compact('clients'));
    }

    public function insert(Request $r){
        $this->validate($r,[
            'folderName'=>'required|max:45',
        ]);

        if($r->brief_itemId){
            $briefItem=BriefItem::findOrFAil($r->brief_itemId);
            Session::flash('message', 'Brief Edited Successfully!');
        }
        else{
            $briefItem=new BriefItem();
            Session::flash('message', 'Brief Added Successfully!');
        }

        $briefItem->clientId=$r->clientId;

        if($r->clipping){
            $briefItem->clipping=1;
        }
        else{
            $briefItem->clipping=0;
        }
        if($r->masking){
            $briefItem->masking=1;
        }
        else{
            $briefItem->masking=0;
        }

        if($r->multipath){
            $briefItem->multipath=1;
        }
        else{
            $briefItem->multipath=0;
        }

        if($r->shadow){
            $briefItem->shadow=1;
        }
        else{
            $briefItem->shadow=0;
        }
        if($r->cleanUp){
            $briefItem->cleanUp=1;
        }
        else{
            $briefItem->cleanUp=0;
        }

        if($r->liquify){
            $briefItem->liquify=1;
        }
        else{
            $briefItem->liquify=0;
        }

        if($r->shaping){
            $briefItem->shaping=1;
        }
        else{
            $briefItem->shaping=0;
        }

        if($r->templates){
            $briefItem->templates=1;
        }
        else{
            $briefItem->templates=0;
        }
        if($r->neckLabelSize){
            $briefItem->neckLabelSize=1;
        }
        else{
            $briefItem->neckLabelSize=0;
        }

        if($r->wrinkleRemove){
            $briefItem->wrinkleRemove=1;
        }
        else{
            $briefItem->wrinkleRemove=0;
        }
        if($r->symmetrical){
            $briefItem->symmetrical=1;
        }
        else{
            $briefItem->symmetrical=0;
        }



        $briefItem->resize=$r->resize;
        $briefItem->rename=$r->rename;
        $briefItem->referenceLocation=$r->referenceLocation;
        $briefItem->folderName=$r->folderName;
        $briefItem->save();

        if($r->specialInstruction){
            $briefInsTruction=new BriefInstructions();
            $briefInsTruction->brief_itemId=$briefItem->brief_itemId;
            $briefInsTruction->specialInstruction=$r->specialInstruction;
            $briefInsTruction->save();
        }





        return back();
    }
}
