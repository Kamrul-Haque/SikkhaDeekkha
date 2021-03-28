<?php

namespace App\Http\Controllers;

use App\Course;
use App\DiscussionPanel;
use App\Reply;
use App\Solution;
use App\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course, DiscussionPanel $discussionPanel, Thread $thread)
    {
        $request->validate([
            'message'=>'required|string|max:255'
        ]);

        $reply = new Reply();
        $reply->thread_id = $thread->id;
        $reply->message = $request->message;

        if (auth()->guard('student')->check())
            $reply->student_id = auth()->user()->id;
        elseif (auth()->guard('instructor')->check())
            $reply->instructor_id = auth()->user()->id;

        $reply->save();

        return redirect()
            ->route('thread.show', ['course'=>$course, 'discussionPanel'=>$discussionPanel, 'thread'=>$thread])
            ->with('toast_success','Reply Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course, DiscussionPanel $discussionPanel, Thread $thread, Reply $reply)
    {
        $this->authorizeForUser(auth()->user(),'modify',$reply);

        $request->validate([
            'message'=>'required|string|max:255'
        ]);

        $reply->message = $request->message;

        $reply->save();

        return redirect()
            ->route('thread.show', ['course'=>$course, 'discussionPanel'=>$discussionPanel, 'thread'=>$thread])
            ->with('toast_info','Reply Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, DiscussionPanel $discussionPanel, Thread $thread, Reply $reply)
    {
        $this->authorizeForUser(auth()->user(),'modify',$reply);

        $reply->delete();

        return redirect()
            ->route('thread.show', ['course'=>$course, 'discussionPanel'=>$discussionPanel, 'thread'=>$thread])
            ->with('toast_error','Reply Deleted');
    }

    public function markSolution(Reply $reply)
    {
        $this->authorizeForUser(auth()->user(),'modify', $reply->thread);

        $id = $reply->thread->hasSolution();

        if ($id)
        {
            $oldSolution = Reply::find($id);
            $oldSolution->is_solution = false;
            $oldSolution->save();
        }

        $reply->is_solution = true;
        $reply->save();

        return back()->with('toast_success','marked as solution!');
    }
}
