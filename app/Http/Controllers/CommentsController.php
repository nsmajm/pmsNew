<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    public function getComments(Request $r){
        $comments=Comment::where('jobId',$r->jobId)
            ->get();

        return view('comment.commentModal')
            ->with('jobId',$r->jobId)
            ->with('comments',$comments);

    }

    public function sendComments(Request $r){

        $comment=new Comment();
        $comment->userId=Auth::user()->userId;
        $comment->jobId=$r->jobId;
        $comment->msg=$r->msg;
        $comment->save();

//        return $r;

    }
}
