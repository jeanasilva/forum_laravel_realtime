<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReplyRequest;

class RepliesController extends Controller
{
    public function show($id){

        $replies = \App\Reply::where('thread_id', $id)
            ->with('user')
            ->get();

        return $replies;

    }

    public function store(ReplyRequest $request){

        $reply              = new Reply;
        $reply->body        = $request->input('body');
        $reply->thread_id   = $request->input('thread_id');
        $reply->user_id     = Auth::user()->id;
        $reply->save();

        return response()->json($reply);


    }

}
