<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function information(){


        return view('job.information');
    }
    public function add(){

        return view('job.add');
    }

    public function insert(Request $r){

        return $r;
    }
    public function pending(){
        return view('job.pendingJob');

    }

    public function feedback(){

        return view('job.feedback');

    }

    public function deadline(){

        return view('job.deadline');
    }


}
