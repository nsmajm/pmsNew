<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function add(){

        return view('service.add');

    }

    public function insert(Request $r){


        return $r;
    }

    public function show(){

        return view('service.show');
    }
}
