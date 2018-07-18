<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Employeeinfo;
use Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use Yajra\DataTables\DataTables;
use Image;
use App\UserType;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        if(!(Auth::user()->userType==USER_TYPE[0] || Auth::user()->userType==USER_TYPE[1])){
            return back();
        }

        $userTypes=UserType::where('id','!=','cl')->get();



        return view('user.create',compact('userTypes'));
    }

    public function insert(Request $r){

        if($r->userId){
            $this->validate($r,[
                'name'=>'required|max:45',
                'loginId' => 'required|max:45',
                'userType' => 'required',
                'password' => 'max:20',
            ]);
            $user=User::findOrFail($r->userId);
        }
        else{
            $this->validate($r,[
                'name'=>'required|max:45',
                'loginId' => 'required|max:45',
                'userType' => 'required',
                'password' => 'required|max:20',
            ]);

            $user=new User();
        }

        $user->name=$r->name;
        $user->loginId=$r->loginId;
        $user->userType=$r->userType;
        if($r->userId){

        }

        else{
            $user->password=Hash::make($r->password);
        }

        $user->statusId=1;
        $user->save();



        if($r->empId ){
            $emp=Employeeinfo::findOrFail($r->empId);
        }
        else{
            $emp=new Employeeinfo();
        }

        $emp->userId=$user->userId;
        $emp->gender=$r->gender;
        $emp->number=$r->number;
        $emp->bankAccount=$r->bankAccount;
        $emp->salary=$r->salary;
        $emp->joinDate=$r->joinDate;
        $emp->address=$r->address;
        if($r->hasFile('image')){
            $img = $r->file('image');

//            $filename = 'test.'.$img->getClientOriginalName();
            $filename= $user->userId.'.'.$img->getClientOriginalExtension();
            $pathName='public/userimage';
            $location = $pathName.'/'. $filename;
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location);
            $emp->image=$location;

        }
        $emp->save();

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
        if(!(Auth::user()->userType==USER_TYPE[0] || Auth::user()->userType==USER_TYPE[1])){
            return back();
        }
        $user=User::select('user.*','employee_info.empId','employee_info.gender','employee_info.bankAccount','employee_info.number','employee_info.salary','employee_info.joinDate','employee_info.address','employee_info.image')
            ->where('user.userId',$id)
            ->leftJoin('employee_info','employee_info.userId','user.userId')
            ->first();

        return view('user.edit')
            ->with('user',$user);
    }
}
