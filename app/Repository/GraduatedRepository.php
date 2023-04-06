<?php
namespace App\Repository;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Repository\GraduatedRepositoryInterface;

class GraduatedRepository implements GraduatedRepositoryInterface
{
    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.Students.Graduated.index', compact('students'));
    }
    public function create()
    {
        $Grades = Grade::all();

        return view('pages.Students.Graduated.create', compact('Grades'));
    }

    public function softdelete(Request $request)
    {
        $students = Student::where('grade_id', $request->Grade_id)
            ->where('classroom_id', $request->Classroom_id)
            ->where('section_id', $request->section_id)
            ->get();

        if ($students->count() < 1) {
            return redirect()
                ->back()
                ->with('error_Graduated', __('لاتوجد بيانات في جدول الطلاب'));
        }

        foreach ($students as $student) {
            $id = explode(',', $student->id);
            Student::whereIn('id', $id)->Delete();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    public function retutnstudent(Request $request, $id)
    {
        Student::onlyTrashed()
            ->where('id', $id)
            ->first()
            ->restore();
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }
    public function deleteStudent($id)
    {
        Student::onlyTrashed()
            ->where('id', $id)
            ->first()
            ->forceDelete();
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }
}
