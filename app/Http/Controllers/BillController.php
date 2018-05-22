<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
    public function addRate(){
        return view('bill.add');
    }

    public function summery(){

        return view('bill.summery');
    }
}
