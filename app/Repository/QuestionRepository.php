<?php
namespace App\Repository;

use App\Models\Question;
use App\Models\Quizze;
use Illuminate\Http\Request;
use App\Repository\QuestionRepositoryInterface;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function index()
    {

        $questions=Question::all();
        return view('pages.Questions.index',compact('questions'));
    }

    public function create()
    {
        $quizzes=Quizze::all();
        return view('pages.Questions.create',compact('quizzes'));
    }

    public function store(Request $request)
    {
        Question::create([

                'title'=>$request->title,
                'answers'=>$request->answers,
                'correct_answer'=>$request->right_answer,
                'score'=>$request->score,
                'quizze_id'=>$request->quizze_id
        ]);

        toastr()->success(trans('messges.success'));
        return redirect()->route('Question.index');
    
    }

    public function edit($id)
    {   
        $question=Question::findorFail($id);
        $quizzes=Quizze::all();
        return  view('pages.Questions.edit',compact('quizzes','question'));
    }

    public function update(Request $request, $id)
    {

        $question=Question::findorFail($id);
        $question->update([

            'title'=>$request->title,
            'answers'=>$request->answers,
            'correct_answer'=>$request->right_answer,
            'score'=>$request->score,
            'quizze_id'=>$request->quizze_id
        ]);

        toastr()->success(trans('messges.Update'));
        return redirect()->route('Question.index');
    }

    public function destroy($id)
    {
        Question::destroy($id);

        toastr()->success(trans('messges.Delete'));
        return redirect()->route('Question.index');
    }
}
