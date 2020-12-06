<?php

namespace App\Http\Controllers;

use App\Module;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{

    public function index(Course $course)
    {
        if ($course->hasStudent(Auth::user()->id) || Auth::guard('admin')->check() || $course->hasInstructor(Auth::user()->id))
        {
            $course = Course::find($course->id);
            return view('Module.index', compact('course'));
        }
        else
        {
            if (!$course->hasStudent(Auth::user()->id))
            {
                return redirect()->route('course.show', $course)->with('toast_warning','You need to enroll first');
            }
            else
            {
                return back()->with('toast_warning','Not authorized to access the page');
            }
        }
    }

    public function create(Course $course)
    {
        if (Auth::guard('admin')->check() || $course->hasInstructor(Auth::user()->id))
        {
            $course = Course::find($course->id);
            return view('Module.create',compact('course'));
        }
        else
        {
            return back()->with('toast_warning','Not authorized to access the page');
        }
    }


    public function store(Request $request, Course $course)
    {
        $request->validate([
           'module_name'=>'required|min:3'
        ]);

        $module = new Module;
        $module->module_name = $request->module_name;
        $module->course_id = $course->id;
        $module->save();

        return redirect()->route('module.index', $course)->with('toast_success','Successfully Created!');
    }

    public function show(Module $module)
    {
        //
    }

    public function edit(Course $course, Module $module)
    {
        if (Auth::guard('admin')->check() || $course->hasInstructor(Auth::user()->id))
        {
            $module = Module::find($module->id);
            $course = Course::find($course->id);
            return view('Module.edit',compact('module','course'));
        }
        else
        {
            return back()->with('toast_warning','Not authorized to access the page');
        }
    }

    public function update(Request $request, Course $course, Module $module)
    {
        $request->validate([
            'module_name'=>'required|min:3'
        ]);

        $course = Course::find($course->id);
        $module = Module::find($module->id);
        $module->module_name = $request->module_name;
        $module->save();

        return redirect()->route('module.index', $course)->with('toast_info','Successfully Updated!');
    }

    public function destroy(Course $course, Module $module)
    {
        $module = Module::find($module->id);
        $module->delete();

        return redirect()->route('module.index', $course)->with('toast_error','Module Deleted!');
    }
}
