<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Assessment;
use App\Module;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function create(Module $module,Assessment $assessment)
    {
        if (Auth::guard('admin')->check() || $module->course->hasInstructor(Auth::user()->id))
        {
            return view('Question.create', compact('module','assessment'));
        }
        else
        {
            return back()->with('toast_warning','Not authorized to access the page');
        }
    }

    public function store(Module $module,Assessment $assessment,Request $request)
    {
        $request->validate([
            'question'=>'required|string|min:5',
            'type'=>'required|string',
            'option.*'=>'nullable|required_if:type,MCQ',
            'answer'=>'nullable|required_with:review,on',
            'marks'=>'required|numeric|between:0,100',
        ],
            [
                'answer.required_if'=>'The answer field is required when automatically graded is selected'
            ]
        );

        $question = new Question;
        $question->assessment_id = $assessment->id;
        $question->question = $request->question;
        $question->type = $request->type;
        $question->marks = $request->marks;
        if ($request->type == 'MCQ')
            $question->needs_review =  false;
        else
            $question->needs_review = !($request->has('review'));
        $question->save();

        if ($request->type == 'MCQ')
        {
            foreach ($request->input('option') as $key=>$option)
            {
                $answer = new Answer;
                $answer->question_id = $question->id;
                $answer->answer = $option;
                $answer->is_correct = $request->has('correct'.$key);
                $answer->save();
            }
        }
        else if($request->type == 'Short Question' && $request->has('review'))
        {
            $answer = new Answer;
            $answer->question_id = $question->id;
            $answer->answer = $request->answer;
            $answer->is_correct = true;
            $answer->save();
        }

        return redirect()->route('assessment.show', ['module'=>$module,'assessment'=>$assessment])->with('toast_success','Created Successfully!');
    }

    public function show(Module $module,Assessment $assessment,Question $question)
    {
        //
    }

    public function edit(Module $module,Assessment $assessment,Question $question)
    {
        if (Auth::guard('admin')->check() || $module->course->hasInstructor(Auth::user()->id))
        {
            return view('Question.edit', compact('module','assessment','question'));
        }
        else
        {
            return back()->with('toast_warning','Not authorized to access the page');
        }
    }

    public function update(Module $module,Assessment $assessment,Request $request, Question $question)
    {
        $request->validate([
            'question'=>'required|string|min:5',
            'type'=>'required|string',
            'option.*'=>'nullable|required_if:type,MCQ',
            'answer'=>'nullable|required_with:review,on',
            'marks'=>'required|numeric|between:0,100',
        ],
            [
                'answer.required_if'=>'The answer field is required when automatically graded is selected'
            ]
        );

        $question = Question::find($question->id);
        $question->assessment_id = $assessment->id;
        $question->question = $request->question;
        $question->type = $request->type;
        $question->marks = $request->marks;
        if ($request->type == 'MCQ')
            $question->needs_review =  false;
        else
            $question->needs_review = !($request->has('review'));

        foreach ($question->answers as $answer)
        {
            $answer->delete();
        }

        if ($request->type == 'MCQ')
        {
            foreach ($request->input('option') as $key=>$option)
            {
                $answer = new Answer;
                $answer->question_id = $question->id;
                $answer->answer = $option;
                $answer->is_correct = $request->has('correct'.$key);
                $answer->save();
            }
        }
        else if($request->type == 'Short Question' && $request->has('review'))
        {
            $answer = new Answer;
            $answer->question_id = $question->id;
            $answer->answer = $request->answer;
            $answer->is_correct = true;
            $answer->save();
        }
        $question->save();

        return redirect()->route('assessment.show', ['module'=>$module,'assessment'=>$assessment])->with('toast_info','Successfully Updated');
    }

    public function destroy(Module $module,Assessment $assessment,Question $question)
    {
        $question = Question::find($question->id);
        $question->delete();

        return redirect()->route('assessment.show', ['module'=>$module,'assessment'=>$assessment])->with('toast_error','Record Deleted');
    }
}
