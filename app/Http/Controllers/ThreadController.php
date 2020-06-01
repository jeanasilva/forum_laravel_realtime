<?php

namespace App\Http\Controllers;

use App\Events\NewThread;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ThreadsRequest;

class ThreadController extends Controller
{

    public function index()
    {
        $threads = Thread::orderByDesc('updated_at')->paginate(15);
        return response()->json($threads);
    }


    public function store(ThreadsRequest $request)
    {
        $thread             = new Thread;
        $thread->title      = $request->input('title');
        $thread->body       = $request->input('body');
        $thread->user_id    = Auth::user()->id;
        $thread->save();

        broadcast(new NewThread($thread));

        return response()->json(['created' => 'sucess', 'data'=>$thread]);
    }

    public function update(ThreadsRequest $request, Thread $thread)
    {

        $this->authorize('update',$thread);
        $thread->title      = $request->input('title');
        $thread->body       = $request->input('body');
        $thread->update();

        return redirect('/threads/' . $thread->id);

    }

    public function destroy(Thread $thread)
    {
        //
    }
}
