<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientServiceRelation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use Yajra\DataTables\DataTables;
use Session;
use DB;

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
        $service =Service::select(DB::raw('GROUP_CONCAT(DISTINCT(client.clientName)) as clientsName'),'service.*')
            ->leftJoin('client_service_relation','client_service_relation.serviceId','service.serviceId')
            ->leftJoin('client','client.clientId','client_service_relation.clientId')
            ->groupBy('service.serviceId')
            ->get() ;
        $datatables = Datatables::of($service);
        return $datatables->make(true);

    }


    public function getServiceEditModal(Request $r){

        $service=Service::findOrFail($r->serviceId);

        return view('service.ServiceEditModal')->with('service',$service);

    }


    public function serviceAssign(Request $r){
        $id=$r->serviceId;
        $notAssignedClients=Client::select('client.clientId','client.clientName')
            ->whereNotIn('client.clientId',function ($query)use ($r){
                $query->select('client_service_relation.clientId')
                    ->from('client_service_relation')
                    ->where('client_service_relation.serviceId',$r->serviceId);
            })
            ->get();


        $clients=ClientServiceRelation::select('client_service_relationId','client.clientId','client.clientName')
            ->where('client_service_relation.serviceId',$r->serviceId)
            ->leftJoin('client','client.clientId','client_service_relation.clientId')
//            ->leftJoin('service','service.serviceId','client_service_relation.serviceId')
            ->get();


        return view('service.serviceAssignModal',compact('clients','notAssignedClients','id'));

    }

    public function assignClientToService(Request $r){
        $service=new ClientServiceRelation();
        $service->clientId=$r->clientId;
        $service->serviceId=$r->serviceId;
        $service->save();
//        return $r;
    }

    public function serviceAssignDelete(Request $r){
        $service=ClientServiceRelation::findOrFail($r->id);
        $service->delete();

    }

}
