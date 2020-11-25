<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('title')->paginate('10');
        return view('Course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Course.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'title'=>'required|string|min:5|unique:courses',
           'level'=>'required',
           'difficulty'=>'required',
           'duration'=>'required',
           'duration_unit'=>'required',
           'category'=>'required',
           'topic'=>'required',
           'date_starting'=>'required|after:today',
           'description'=>'required|string|min:20',
           'syllabus'=>'required|string|min:20',
           'prerequisites'=>'required|string|min:10',
           'expected_outcome'=>'required|string|min:10',
           'marks_required'=>'required|digits_between:1,3|gt:40|lte:100',
           'fee'=>'nullable|gt:0|lte:99999.99',
           'image'=>'nullable|file|mimes:jpeg,jpg,png|max:2024'
        ]);

        $course = new Course;
        $course->title = $request->title;
        $course->level = $request->level;
        $course->difficulty = $request->difficulty;
        $course->duration = $request->duration.' '.$request->duration_unit;
        $course->category_id = $request->category;
        $course->topic = $request->topic;
        $course->date_starting = $request->date_starting;
        $course->description = $request->description;
        $course->syllabus = $request->syllabus;
        $course->prerequisites = $request->prerequisites;
        $course->expected_outcome = $request->expected_outcome;
        $course->marks_required_for_completion = $request->marks_required;
        $course->fee = $request->fee;
        $course->has_certificate = $request->has('certificate');
        $course->is_paid = $request->has('paid');

        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('CourseImage');
            $course->course_image = 'storage/'.$path;
        }

        $course->save();

        return redirect()->route('admin.course.index')->with('toast_success','Successfully Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $course = Course::find($course->id);
        return view('Course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $course = Course::find($course->id);
        $duration = explode(" ",$course->duration);
        $categories = Category::all();
        return view('Course.edit', compact('course','categories','duration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title'=>'required|string|min:5|unique:courses,title,'.$course->id,
            'level'=>'required',
            'difficulty'=>'required',
            'duration'=>'required',
            'duration_unit'=>'required',
            'category'=>'required',
            'topic'=>'required',
            'date_starting'=>'required|after:today',
            'description'=>'required|string|min:20',
            'syllabus'=>'required|string|min:20',
            'prerequisites'=>'required|string|min:10',
            'expected_outcome'=>'required|string|min:10',
            'marks_required'=>'required|digits_between:1,3|gt:40|lte:100',
            'fee'=>'nullable|gt:0|lte:99999.99',
            'image'=>'nullable|file|mimes:jpeg,jpg,png|max:2024'
        ]);

        $course = Course::find($course->id);
        $course->title = $request->title;
        $course->level = $request->level;
        $course->difficulty = $request->difficulty;
        $course->duration = $request->duration.' '.$request->duration_unit;
        $course->category_id = $request->category;
        $course->topic = $request->topic;
        $course->date_starting = $request->date_starting;
        $course->description = $request->description;
        $course->syllabus = $request->syllabus;
        $course->prerequisites = $request->prerequisites;
        $course->expected_outcome = $request->expected_outcome;
        $course->marks_required_for_completion = $request->marks_required;
        $course->fee = $request->fee;
        $course->has_certificate = $request->has('certificate');
        $course->is_paid = $request->has('paid');
        $oldImage = $course->getOriginal('course_image');

        if($request->hasFile('image'))
        {
            if (File::exists($oldImage))
            {
                File::delete($oldImage);
            }
            $path = $request->file('image')->store('CourseImage');
            $course->course_image = 'storage/'.$path;
        }

        $course->save();

        return redirect()->route('admin.course.index')->with('toast_info','Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course = Course::find($course->id);
        $image = $course->getOriginal('course_image');
        if (File::exists($image))
        {
            File::delete($image);
        }
        $course->delete();

        return redirect()->route('admin.course.index')->with('toast_error','Course Deleted!');
    }
}
