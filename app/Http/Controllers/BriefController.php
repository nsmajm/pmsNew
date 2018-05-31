<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BriefController extends Controller
{
    public function check(){
        return view('brief.check');
    }

    public function index(){

        return view('brief.brief');
    }

    public function add(){

        return view('brief.add');
    }
}
