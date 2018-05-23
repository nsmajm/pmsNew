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

        $service=new Service();
        $service->serviceName=$r->serviceName;
        $service->complexity=$r->complexity;
        $service->type=$r->type;
        $service->save();

        Session::flash('message', 'Service Added Successfully!');
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
}
