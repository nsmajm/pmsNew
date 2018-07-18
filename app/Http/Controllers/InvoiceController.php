<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class InvoiceController extends Controller
{
    public function index(){
        $clients=Client::select('clientId','clientName')
            ->get();


        return view('invoice.index',compact('clients'));
    }


    public function search(Request $r){

        return $r;
    }
}
