<?php

namespace App\Http\Controllers\Exam\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exam;

class ManageExamController extends Controller
{
    public function new_question(Request $request)
    {   
        $title = "New Question  | " . config('global.site_name');

        if ($request->isMethod('GET')) {
            return view('exam.backend.questions.new-question', compact('title'));
        }

         if ($request->isMethod('POST')) {

            $request->validate([
                'question' => 'required',
                'answer1' => 'required',
                'answer2' => 'required',
                'answer3' => 'required',
                'correct_answer' => 'required',
            ]);
            
           
            Exam::create([
                'question'=> $request->input('question'),
                'answer1'=> $request->input('answer1'),
                'answer2'=> $request->input('answer2'),
                'answer3'=> $request->input('answer3'),
                'correct_answer'=> $request->input('correct_answer'),
            ]);


        return redirect()->back()->with('success','Question has been Published.');
   

        }
    }

    // ✅ List all questions
    public function index()
    {
        $title = "All Questions | " . config('global.site_name');
        $questions = Exam::latest()->paginate(10); // paginate for cleaner view
        return view('exam.backend.questions.index', compact('title', 'questions'));
    }

    // ✅ Show edit form
    public function edit($id)
    {
        $title = "Edit Question | " . config('global.site_name');
        $question = Exam::findOrFail($id);
        return view('exam.backend.questions.edit', compact('title', 'question'));
    }

    // ✅ Update question
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'correct_answer' => 'required',
        ]);

        $question = Exam::findOrFail($id);
        $question->update([
            'question' => $request->input('question'),
            'answer1' => $request->input('answer1'),
            'answer2' => $request->input('answer2'),
            'answer3' => $request->input('answer3'),
            'correct_answer' => $request->input('correct_answer'),
        ]);

        return redirect()->route('questions.index')->with('success', 'Question updated successfully.');
    }
}
