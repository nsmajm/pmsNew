<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shift;
use App\Team;

class ShiftController extends Controller
{
    public function create(){
        $shifts=Shift::get();
        $teams=Team::get();


        return view('shift.create')
            ->with('shifts',$shifts)
            ->with('teams',$teams);
    }
    public function show(){

    }
}
