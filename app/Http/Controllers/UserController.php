<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Session;
use Yajra\DataTables\DataTables;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){

        return view('user.create');
    }
    public function insert(Request $r){
        $this->validate($r,[
            'name'=>'required|max:45',
            'loginId' => 'required|max:45',
            'userType' => 'required',
            'password' => 'required|max:20',
        ]);

        if($r->userId){
            $user=User::findOrFail($r->userId);
        }
        else{
            $user=new User();
        }

        $user->name=$r->name;
        $user->loginId=$r->loginId;
        $user->userType=$r->userType;
        if($r->userId && !$r->password){

        }

        else{
            $user->password=Hash::make($r->password);
        }

        $user->statusId=1;
        $user->save();

        Session::flash('message', 'User Added Successfully!');

        return back();
    }

    public function show(){
        return view('user.show');
    }

    public function getData(Request $r){
        $users=User::where('userType','!=','client')
            ->get();

        $datatables = Datatables::of($users);
        return $datatables->make(true);
    }

    public function edit($id){
        $user=User::findOrFail($id);
//        return $user;

        return view('user.edit')
            ->with('user',$user);
    }
}
