<?php

namespace App\Http\Controllers;

use App\TclInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Session;

class tclController extends Controller
{
    public function allInfo(){

        $tclInfo=TclInfo::first();
        //return $tclInfo;
        if (!empty($tclInfo)){
            return view('tcl.editAllInformation',compact('tclInfo'));
        }else{
            return view('tcl.addAllInformation');
        }

    }
    public function updateTclInfo(Request $r){

        $data=array(
            'companyTitle'=>$r->title,
            'companyPhone1'=>$r->phone1,
            'companyEmail'=>$r->email,
            'companyPhone2'=>$r->phone2,
            'companyAddress'=>$r->address
        );
        DB::table('tcl_info')
            ->update($data);
        Session::flash('message', 'Information Updated Successfully!');
        return back();
    }
    public function insertTclInfo(Request $r){

        $data=array(
            'companyTitle'=>$r->title,
            'companyPhone1'=>$r->phone1,
            'companyEmail'=>$r->email,
            'companyPhone2'=>$r->phone2,
            'companyAddress'=>$r->address
        );
        DB::table('tcl_info')
            ->insert($data);
        Session::flash('message', 'Information Updated Successfully!');
        return back();
    }



}