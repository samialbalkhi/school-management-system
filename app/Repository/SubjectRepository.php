<?php
namespace App\Repository;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Repository\SubjectRepositoryInterface;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function index()
    {
        $subjects=Subject::all();

        return view('pages.Subjects.index',compact('subjects'));
    }
    public function create()
    {
        $grades=Grade::all();
        $teachers=Teacher::all();
        return view('pages.Subjects.create',compact('grades','teachers'));
    }
    public function store(Request $request)
    {
        try {
            Subject::create([

                    'name' => ['en'=>$request->Name_en,'ar'=>$request->Name_ar],
                    'grade_id'=>$request->Grade_id,
                    'classroom_id'=>$request->Class_id,
                    'teacher_id'=>$request->teacher_id
            ]);

            toastr()->success(trans('messges.success'));
            return redirect()->route('Subject.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $grades=Grade::all();
        $teachers=Teacher::all();
        $subject=Subject::findorFail($id);

        return view('pages.Subjects.edit',compact('grades', 'teachers', 'subject'));
    }
    public function update(Request $request, $id)
    {
        $subject=Subject::findorFail($id);

        $subject->update([

            'name' => ['en'=>$request->Name_en,'ar'=>$request->Name_ar],
            'grade_id'=>$request->Grade_id,
            'classroom_id'=>$request->Class_id,
            'teacher_id'=>$request->teacher_id   
        ]);

        toastr()->success(trans('messges.Update'));
        return redirect()->route('Subject.index');
    }
    public function destroy($id)
    {
        Subject::destroy($id);
        toastr()->success(trans('messges.Delete'));
        return redirect()->route('Subject.index');
    }
}
