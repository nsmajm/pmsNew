<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function add(){

        return view('client.add');

    }

    public function insert(Request $r){


        return $r;
    }

    public function show(){

        return view('client.show');
    }
}
