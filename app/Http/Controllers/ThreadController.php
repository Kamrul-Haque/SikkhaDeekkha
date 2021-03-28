<?php

namespace App\Http\Controllers;

use App\Course;
use App\DiscussionPanel;
use App\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course, DiscussionPanel $discussionPanel)
    {
        $threads = $discussionPanel->threads()->latest()->paginate(3);
        return view('Thread.index', compact('threads','course', 'discussionPanel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course, DiscussionPanel $discussionPanel)
    {
        return view('Thread.create', compact('course','discussionPanel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course, DiscussionPanel $discussionPanel)
    {
        $request->validate([
            'select'=>'required',
            'subject'=>'required|string|max:30',
            'message'=>'required|string'
        ]);

        $thread = new Thread();
        $thread->discussion_panel_id = $discussionPanel->id;
        $thread->content_id = $request->select;
        $thread->subject = $request->subject;
        $thread->body = $request->message;

        if (auth()->guard('student')->check())
            $thread->student_id = auth()->user()->id;
        elseif(auth()->guard('instructor')->check())
            $thread->instructor_id = auth()->user()->id;

        $thread->save();

        return redirect()
            ->route('thread.show', ['course'=>$course, 'discussionPanel'=>$discussionPanel, 'thread'=>$thread])
            ->with('toast_success','Post Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, DiscussionPanel $discussionPanel, Thread $thread)
    {
        return view('Thread.show', compact('course','discussionPanel','thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, DiscussionPanel $discussionPanel, Thread $thread)
    {
        $this->authorizeForUser(auth()->user(),'modify', $thread);
        return view('Thread.edit',compact('course','discussionPanel','thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course, DiscussionPanel $discussionPanel, Thread $thread)
    {
        $this->authorizeForUser(auth()->user(),'modify', $thread);

        $request->validate([
            'subject'=>'required|string|max:30',
            'message'=>'required|string'
        ]);

        $thread->subject = $request->subject;
        $thread->body = $request->message;
        $thread->save();

        return redirect()
            ->route('thread.show', ['course'=>$course, 'discussionPanel'=>$discussionPanel, 'thread'=>$thread])
            ->with('toast_info','Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, DiscussionPanel $discussionPanel, Thread $thread)
    {
        $this->authorizeForUser(auth()->user(),'modify', $thread);

        $thread->delete();

        return redirect()
            ->route('thread.index', ['course'=>$course, 'discussionPanel'=>$discussionPanel])
            ->with('toast_error','Post Deleted');
    }
}
