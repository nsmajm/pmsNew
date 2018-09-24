<?php
namespace App\Http\Controllers;
use App\Bank;
use App\Employeeinfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use Image;
use Auth;
class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function allBankInfo(){
        if(USER_TYPE['Admin']== Auth::user()->userType) {
            $bankInfo=Bank::select('bankId','bankName','image')->get();
            return view('bank.allBankInfo',compact('bankInfo'));
        }
        return back();
    }
    public function getBankInfo(Request $r){
        $bankId=$r->bankId;
        $bankInformation=Bank::select('bankId','bankName','image')->where('bankId',$bankId)->get();
        return view('bank.editBankInformation',compact('bankInformation'));
    }
    public function newBankInfo(){
        return view('bank.addNewBankInformation');
    }
    public function updateBankInfo($id,Request $r){
        $bank=Bank::findOrFail($id);
        $bank->bankName=$r->bankName;
        if($r->hasFile('bankImage')){
            $img = $r->file('bankImage');
            $filename= $bank->bankId.".".$img->getClientOriginalExtension();
            $pathName='public/bankImage';
            $location = $pathName.'/'. $filename;
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location);
            $bank->image=$filename;
        }
        $bank->save();
        return back();
    }
    public function saveNewBankInfo(Request $r){
        $bank=new Bank;
        $bank->bankName=$r->bankName;
        if($r->hasFile('bankImage')){
            $img = $r->file('bankImage');
            $filename= $bank->bankId.".".$img->getClientOriginalExtension();
            $pathName='public/bankImage';
            $location = $pathName.'/'. $filename;
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location);
            $bank->image=$filename;
        }
        $bank->save();
        return back();
    }
}