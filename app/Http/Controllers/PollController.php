<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;


class PollController extends Controller
{
    public function longPool(){

        $msg=Message::where('statusId',1)->first();
        $attempts=1;

        while ($msg==null && $attempts<=5){
            sleep(2);
            $msg=Message::where('statusId',1)->first();
//            $msg=$msg->refresh()->statusId;
            $attempts++;

        }

        if($msg==null){
            return "Not found";
        }

        return $msg;


    }
}
