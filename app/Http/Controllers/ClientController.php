<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Service;
use App\Client;
use App\Status;
use App\Country;
use App\ClientServiceRelation;
use App\Timezone;
use Session;
use Hash;
use Yajra\DataTables\DataTables;
use Auth;

class ClientController extends Controller
{
    public function add(){
        if(Auth::user()->userType ==USER_TYPE['Admin'] ||Auth::user()->userType ==USER_TYPE['Accounts'] || Auth::user()->userType ==USER_TYPE['Human Resource Management']){
            $services=Service::select('serviceId','serviceName')->get();
            $countries=Country::get();
            $timezones=Timezone::get();

            return view('client.add')
                ->with('services',$services)
                ->with('countries',$countries)
                ->with('timezones',$timezones);
        }


    }

    public function insert(Request $r){
        $this->validate($r,[
            'clientName'=>'required|max:45',
            'contactPerson' => 'max:45',
            'clientEmail' => 'required|max:45',
            'clientNumber' => 'required|max:45',
            'companyName' => 'required|max:45',
            'country' => 'required',
        ]);

        $status=Status::where('statusType','userStatus')
            ->where('statusName','active')
            ->first();

        $password=Hash::make($r->password);

        $user=new User();
        $user->name=$r->companyName;
        $user->loginId=$r->clientEmail;
        $user->userType='client';
        $user->statusId=$status->statusId;
        $user->password=$password;
        $user->save();

        $client=new Client();
        $client->userId=$user->userId;
        $client->clientName=$r->clientName;
        $client->companyName=$r->companyName;
        $client->contactPerson=$r->contactPerson;
        $client->email=$r->clientEmail;
        $client->phoneNumber=$r->clientNumber;
        $client->countryId=$r->country;
        $client->address=$r->address;
        $client->timezoneId=$r->timezone;
        $client->save();

        if($r->service){
            foreach ($r->service as $serviceId){
                $clientServiceRelation=new ClientServiceRelation();
                $clientServiceRelation->serviceId=$serviceId;
                $clientServiceRelation->clientId=$client->clientId;
                $clientServiceRelation->save();
            }
        }

        Session::flash('message', 'Client Added Successfully!');
        return back();
    }

    public function edit($id){
        $client=Client::findOrFail($id);
        $services=Service::select('serviceId','serviceName')->get();
        $countries=Country::get();
        $timezones=Timezone::get();

//        return $client;

        return view('client.edit',compact('client','services','countries','timezones'));
    }

    public function update(Request $r){
        $client=Client::findOrFail($r->id);
        $client->clientName=$r->clientName;
        $client->companyName=$r->companyName;
        $client->contactPerson=$r->contactPerson;
        $client->email=$r->clientEmail;
        $client->phoneNumber=$r->clientNumber;
        $client->countryId=$r->country;
        $client->address=$r->address;
        $client->timezoneId=$r->timezone;
        $client->save();


        Session::flash('message', 'Client Edited Successfully!');
        return back();
    }

    public function show(){

        return view('client.show');
    }


    public function getData(Request $r){

        $client=Client::select('clientId','clientName','companyName','contactPerson','email','phoneNumber','country.countryName','timezone.timezoneName')
            ->leftJoin('country','client.countryId','country.countryId')
            ->leftJoin('timezone','client.timezoneId','timezone.timezoneId')
            ->get();

        $datatables = Datatables::of($client);
        return $datatables->make(true);


    }
}
