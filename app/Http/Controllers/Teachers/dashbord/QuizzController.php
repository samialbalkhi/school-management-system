<?php

namespace App\Http\Controllers\Teachers\dashbord;

use App\Models\Grade;
use App\Models\Degree;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizzController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quizze::where('teacher_id', auth()->user()->id)->get();
        return view('pages.Teacher.dashboard.Quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id', auth()->user()->id)->get();
        return view('pages.Teacher.dashboard.Quizzes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Quizze::create([
            'name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
            'subject_id' => $request->subject_id,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'teacher_id' => auth()->user()->id,
        ]);

        toastr()->success(trans('messages.success'));
        return redirect()->route('Quizzes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $questions = Question::where('quizze_id',$id)->get();
        $quizz = Quizze::findorFail($id);
        return view('pages.Teacher.dashboard.Questions.index',compact('questions','quizz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $quizz = Quizze::findorFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id', auth()->user()->id)->get();
        return view('pages.Teacher.dashboard.Quizzes.edit', $data, compact('quizz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $quizz = Quizze::findorFail($id);
        $quizz->update([
            'name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
            'subject_id' => $request->subject_id,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'teacher_id' => auth()->user()->id,
        ]);
        toastr()->success(trans('messges.Update'));
        return redirect()->route('Quizzes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Quizze::destroy($id);

        toastr()->success(trans('messges.Delete'));
        return redirect()->route('Quizzes.index');
    }

    public function student_quizze($quizze_id)
    {
        $degrees = Degree::where('quizze_id', $quizze_id)->get();
        return view('pages.Teacher.dashboard.Quizzes.student_quizze', compact('degrees'));
    }

    public function repeat_quizze(Request $request,$quizze_id)
    {
        
        Degree::where('student_id', $request->student_id)->where('quizze_id', $request->quizze_id)->delete();
        toastr()->success('تم فتح الاختبار مرة اخرى للطالب');
        return redirect()->back();
    }
}
