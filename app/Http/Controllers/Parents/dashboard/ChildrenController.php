<?php

namespace App\Http\Controllers\Parents\dashboard;

use App\Models\Degree;
use App\Models\Father;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Fees_invoice;
use Illuminate\Http\Request;
use App\Models\Receipt_student;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Attendance\AttendanceRequest;

class ChildrenController extends Controller
{
    public function index()
    {
        $sons = Student::where('father_id', auth()->user()->id)->get();

        return view('pages.parents.dashboard.dashboard', compact('sons'));
    }

    public function Children()
    {
        $students = Student::where('father_id', auth()->user()->id)->get();

        return view('pages.parents.Children.index', compact('students'));
    }
    public function ResultsChildren($id)
    {
        $student = Student::findorFail($id);

        $degrees = Degree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {
            toastr()->error('لا توجد نتائج لهذا الطالب');
            return redirect()->route('Children');
        }

        return view('pages.parents.degrees.index', compact('degrees'));
    }

    public function attendances()
    {
        $students = Student::where('father_id', auth()->user()->id)->get();
        return view('pages.parents.Attendance.index', compact('students'));
    }
    public function AttendanceSearch(AttendanceRequest $request)
    {
        $id = DB::table('teacher_sections')
            ->where('teacher_id', auth()->user()->id)
            ->pluck('section_id');
        $students = Student::whereIn('section_id', $id)->get();
        // dd($request);
        if ($request->student_id == 0) {
            $Students = Attendance::whereBetween('date', [$request->from, $request->to])->get();
            return view('pages.Teacher.dashboard.students.report', compact('Students', 'students'));
        }
        $Students = Attendance::whereBetween('date', [$request->from, $request->to])
            ->where('student_id', $request->student_id)
            ->get();
        return view('pages.Teacher.dashboard.students.report', compact('Students', 'students'));
    }

    public function Fees()
    {
        $students_id = Student::where('father_id', auth()->user()->id)->pluck('id');
        $Fee_invoices = Fees_invoice::whereIn('student_id', $students_id)->get();
        return view('pages.parents.fees.index', compact('Fee_invoices'));
    }
    public function Receipt($id)
    {
        $receipt_students = Receipt_student::where('student_id', $id)->get();

        if ($receipt_students->isEmpty()) {
            toastr()->error('لا توجد مدفوعات لهذا الطالب');
            return redirect()->route('sons.fees');
        }
        return view('pages.parents.Receipt.index', compact('receipt_students'));
    }

    public function Profile()
    {
        $information = Father::findorFail(auth()->user()->id);
        return view('pages.parents.profile.profile', compact('information'));
    }
    public function update(Request $request, $id)
    {
        $information = Father::findorFail($id);

        if (!empty($request->password)) {
            $information->update([
                'name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
                'password' => Hash::make($request->password),
            ]);
        } else {
            $information->update([
                'name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
            ]);

            toastr()->success(trans('messages.Update'));
             return redirect()->back();
        }
    }
}
