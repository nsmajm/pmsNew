<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use Yajra\DataTables\DataTables;
use Session;

class ServiceController extends Controller
{
    public function add(){

        return view('service.add');

    }

    public function insert(Request $r){

        if($r->serviceId){

            $service=Service::findOrFail($r->serviceId);
            Session::flash('message', 'Service Edited Successfully!');

        }
        else{
            $service=new Service();
            Session::flash('message', 'Service Added Successfully!');
        }

        $service->serviceName=$r->serviceName;
        $service->complexity=$r->complexity;
        $service->type=$r->type;
        $service->save();

        return back();
    }

    public function show(){

        return view('service.show');
    }

    public function getData(Request $r){
        $service =Service::get() ;
        $datatables = Datatables::of($service);
        return $datatables->make(true);

    }


    public function getServiceEditModal(Request $r){

        $service=Service::findOrFail($r->serviceId);

        return view('service.ServiceEditModal')->with('service',$service);

    }

}
