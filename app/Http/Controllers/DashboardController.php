<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if(Auth::user()->userType==USER_TYPE[8]){
            return view('dashboard.user');
        }
        return view('main');
    }
}
