<?php

namespace App\Http\Controllers\Teachers\dashbord;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Question::create([
            'title' => $request->title,
            'answers' => $request->answers,
            'correct_answer' => $request->right_answer,
            'score' => $request->score,
            'quizze_id' => $request->quizz_id,
        ]);

        toastr()->success(trans('messges.success'));
        return redirect()->route('Question.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $quizz_id = $id;
        return view('pages.Teacher.dashboard.Questions.create', compact('quizz_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = Question::findorFail($id);
        return view('pages.Teacher.dashboard.Questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $question = Question::findorFail($id);
        $question->update([
            'title' => $request->title,
            'answers' => $request->answers,
            'correct_answer' => $request->right_answer,
            'score' => $request->score,
            
        ]);

        toastr()->success(trans('messges.success'));
        return redirect()->route('Question.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Question::destroy($id);

        toastr()->success(trans('messges.Delete'));
        return redirect()->route('Question.index');
    }
}
