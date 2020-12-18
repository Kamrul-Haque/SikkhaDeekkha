<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AssessmentController extends Controller
{
    public function index(Module $module)
    {
        //
    }

    public function create(Module $module)
    {
        if (Auth::guard('admin')->check() || $module->course->hasInstructor(Auth::user()->id))
        {
            $module = Module::find($module->id);
            return view('Assessment.create', compact('module'));
        }
        else
        {
            return back()->with('toast_warning','Not authorized to access the page');
        }
    }

    public function store(Request $request, Module $module)
    {
        $request->validate([
            'title'=>'required|string|min:5',
            'deadline'=>'required|after:today',
            'attachment'=>'nullable|file',
        ]);

        $assessment = new Assessment;
        $assessment->module_id = $module->id;
        $assessment->title = $request->title;
        $assessment->description = $request->description;
        $assessment->deadline = $request->deadline;
        $assessment->total_marks = 0;
        $assessment->is_peer_graded = $request->has('peer');

        if ($request->hasFile('attachment'))
        {
            $path = $request->file('attachment')->storeAs($module->course->title, $request->file('attachment')->getClientOriginalName());
            $assessment->attachment_path = 'storage/'.$path;
        }
        $assessment->save();

        return redirect()->route('module.index', $module->course)->with('toast_success','Assessment Created Successfully!');
    }


    public function show(Module $module, Assessment $assessment)
    {
        $assessment = Assessment::find($assessment->id);
        return view('Assessment.show', compact('assessment','module'));
    }

    public function edit(Module $module, Assessment $assessment)
    {
        if (Auth::guard('admin')->check() || $module->course->hasInstructor(Auth::user()->id))
        {
            $module = Module::find($module->id);
            $assessment = Assessment::find($assessment->id);
            return view('Assessment.edit', compact('module','assessment'));
        }
        else
        {
            return back()->with('toast_warning','Not authorized to access the page');
        }
    }

    public function update(Request $request, Module $module, Assessment $assessment)
    {
        $request->validate([
            'title'=>'required|string|min:5',
            'deadline'=>'nullable|after:today',
            'attachment'=>'nullable|file',
        ]);

        $assessment = Assessment::find($assessment->id);
        $assessment->module_id = $module->id;
        $assessment->title = $request->title;
        $assessment->description = $request->description;
        $assessment->deadline = $request->deadline ?? $assessment->getOriginal('deadline');
        $assessment->is_peer_graded = $request->has('peer');
        $oldFile = $assessment->getOriginal('attachment_path');

        if ($request->hasFile('attachment'))
        {
            if (File::exists($oldFile))
            {
                File::delete($oldFile);
            }
            $path = $request->file('attachment')->storeAs($module->course->title, $request->file('attachment')->getClientOriginalName());
            $assessment->attachment_path = 'storage/'.$path;
        }
        $assessment->save();

        return redirect()->route('module.index', $module->course)->with('toast_info','Assessment Updated');
    }

    public function destroy(Module $module, Assessment $assessment)
    {
        $assessment = Assessment::find($assessment->id);
        $oldFile = $assessment->getOriginal('attachment_path');

        if (File::exists($oldFile))
        {
            File::delete($oldFile);
        }

        $assessment->delete();

        return redirect()->route('module.index', $module->course)->with('toast_error','Assessment Deleted');
    }
}
