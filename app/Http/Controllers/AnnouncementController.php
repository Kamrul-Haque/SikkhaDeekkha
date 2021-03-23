<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Course;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
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
    public function create(Course $course)
    {
        return view('Announcement.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'message'=>'required|string|min:10',
        ]);

        $announcement = new Announcement();
        $announcement->course_id = $course->id;
        $announcement->message = $request->message;
        $announcement->save();

        return redirect()->route('module.index', $course)->with('toast_success','Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, Announcement $announcement)
    {
        return view('Announcement.edit', compact('announcement','course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course, Announcement $announcement)
    {
        $request->validate([
           'message'=>'required|string|min:10',
        ]);

        $announcement->course_id = $announcement->course->id;
        $announcement->message = $request->message;
        $announcement->save();

        return redirect()->route('module.index', $course)->with('toast_info','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('toast_error','Record Deleted');
    }
}
