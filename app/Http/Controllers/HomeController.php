<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Redirect::route('main');
        return view('home');
    }
    public function password(){
        return view('account.password');

    }

    public function changePassword(Request $r){
        $old=$r->oldPass;
        $new=$r->password;
        $user=User::findOrFail(Auth::user()->userId);


        if (Hash::check($old, $user->password)) {
            $user->password=Hash::make($r->password);
            $user->save();

            Session::flash('message', 'Password Changed Successfully!');
            return back();

        }


        Session::flash('message', 'Password Did not Match!');
        return back();
    }
}
