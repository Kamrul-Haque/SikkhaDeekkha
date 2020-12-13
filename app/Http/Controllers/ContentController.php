<?php

namespace App\Http\Controllers;

use App\Content;
use App\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ContentController extends Controller
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
            return view('Content.create', compact('module'));
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
           'type'=>'required|string',
           'description'=>'required_if:type,Text',
           'link'=>'nullable|required_if:type,Link|url',
           'video'=>'nullable|required_if:type,Video|url',
           'file'=>'nullable|required_if:type,File|file',
        ]);

        $content = new Content;
        $content->module_id = $module->id;
        $content->title = $request->title;
        $content->type = $request->type;
        $content->description = $request->description;
        $content->web_link = $request->link;
        $content->video_link = $request->video;
        $content->is_protected = $request->has('protected');

        if ($request->hasFile('file'))
        {
            $path = $request->file('file')->storeAs($module->course->title, $request->file('file')->getClientOriginalName());
            $content->file_path = 'storage/'.$path;
        }
        $content->save();

        return redirect()->route('module.index', $module->course)->with('toast_success','Content Created Successfully!');
    }


    public function show(Module $module, Content $content)
    {
        $content = Content::find($content->id);
        return view('Content.show', compact('content','module'));
    }

    public function edit(Module $module, Content $content)
    {
        if (Auth::guard('admin')->check() || $module->course->hasInstructor(Auth::user()->id))
        {
            $module = Module::find($module->id);
            $content = Content::find($content->id);
            return view('Content.edit', compact('module','content'));
        }
        else
        {
            return back()->with('toast_warning','Not authorized to access the page');
        }
    }

    public function update(Request $request, Module $module, Content $content)
    {
        $request->validate([
            'title'=>'required|string|min:5',
            'type'=>'required|string',
            'description'=>'required_if:type,Text',
            'link'=>'nullable|required_if:type,Link|url',
            'video'=>'nullable|required_if:type,Video|url',
            'file'=>'nullable|required_if:type,File|file',
        ]);

        $content = Content::find($content->id);
        $content->module_id = $module->id;
        $content->title = $request->title;
        $content->type = $request->type;
        $content->description = $request->description;
        $content->web_link = $request->link;
        $content->video_link = $request->video;
        $content->is_protected = $request->has('protected');
        $oldFile = $content->getOriginal('file_path');

        if ($request->hasFile('file'))
        {
            if (File::exists($oldFile))
            {
                File::delete($oldFile);
            }
            $path = $request->file('file')->storeAs($module->course->title, $request->file('file')->getClientOriginalName());
            $content->file_path = 'storage/'.$path;
        }
        $content->save();

        return redirect()->route('module.index', $module->course)->with('toast_info','Content Updated');
    }

    public function destroy(Module $module, Content $content)
    {
        $content = Content::find($content->id);
        $oldFile = $content->getOriginal('file_path');

        if (File::exists($oldFile))
        {
            File::delete($oldFile);
        }

        $content->delete();

        return redirect()->route('module.index', $module->course)->with('toast_error','Content Deleted');
    }
}
