<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function add(){

        return view('job.add');
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
