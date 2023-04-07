<?php
namespace App\Repository;

use App\Models\Grade;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Repository\QuizzRepositoryInterface;

class QuizzRepository implements QuizzRepositoryInterface
{
    public function index()
    {
        $quizzes=Quizze::all();
        return view('pages.Quizzes.index',compact('quizzes'));
    }

    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('pages.Quizzes.create',$data);
    }

    public function store(Request $request)
    {
        Quizze::create([

            'name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar],
            'subject_id'=>$request->subject_id,
            'grade_id'=>$request->Grade_id,
            'classroom_id'=>$request->Classroom_id,
            'section_id'=>$request->section_id,
            'teacher_id'=>$request->teacher_id,
        ]);

        toastr()->success(trans('messages.success'));
        return redirect()->route('Quizzes.index');
    }

    public function edit($id)
    {
        $quizz=Quizze::findorFail($id);
        $grades= Grade::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        
        return view('pages.quizzes.edit',compact('quizz','grades','subjects','teachers'));
    }

    public function update(Request $request, $id)
    {
        $quizz=Quizze::findorFail($id);
        $quizz->update([

            'name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar],
            'subject_id'=>$request->subject_id,
            'grade_id'=>$request->Grade_id,
            'classroom_id'=>$request->Classroom_id,
            'section_id'=>$request->section_id,
            'teacher_id'=>$request->teacher_id,
        ]);

        toastr()->success(trans('messges.Update'));
        return redirect()->route('Quizzes.index');
    }

    public function destroy($id)
    {
        Quizze::destroy($id);

        toastr()->success(trans('messges.Delete'));
        return redirect()->route('Quizzes.index');
    }
}
