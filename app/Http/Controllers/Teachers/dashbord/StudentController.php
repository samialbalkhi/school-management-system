<?php

namespace App\Http\Controllers\Teachers\dashbord;

use App\Models\Section;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Attendance\AttendanceRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = DB::table('teacher_sections')
            ->where('teacher_id', auth()->user()->id)
            ->pluck('section_id');
        $students = Student::whereIn('section_id', $id)->get();

        return view('pages.Teacher.dashboard.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    // public function stoasdre(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $id)
    {
        dd('asd');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd('sad');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function create()
    {
        //
    }

    public function section()
    {
        $id = DB::table('teacher_sections')
            ->where('teacher_id', auth()->user()->id)
            ->pluck('section_id');
        $sections = Section::whereIn('id', $id)->get();
        return view('pages.Teacher.dashboard.sections.index', compact('sections'));
    }
    public function store(Request $request)
    {
        $date = date('Y-m-d');
        foreach ($request->attendences as $studentid => $attendence) {
            if ($attendence == 'presence') {
                $status = true;
            } elseif ($attendence == 'absent') {
                $status = false;
            }

            Attendance::updateorCreate(
                [
                    'student_id' => $studentid,
                    'date' => $date,
                ],
                [
                    'student_id' => $studentid,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => 1,
                    'date' => $date,
                    'status' => $status,
                ],
            );
        }

        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    public function reports()
    {
        $id = DB::table('teacher_sections')
            ->where('teacher_id', auth()->user()->id)
            ->pluck('section_id');
        $students = Student::whereIn('section_id', $id)->get();

        return view('pages.Teacher.dashboard.students.report', compact('students'));
    }

    public function ReportsSearch(AttendanceRequest $request)
    {
        $id = DB::table('teacher_sections')
            ->where('teacher_id', auth()->user()->id)
            ->pluck('section_id');
        $students = Student::whereIn('section_id', $id)->get();

        if ($request->student_id == 0) {
            $Students = Attendance::whereBetween('date', [$request->from, $request->to])->get();
            return view('pages.Teacher.dashboard.students.report', compact('Students', 'students'));
        }
        $Students = Attendance::whereBetween('date', [$request->from, $request->to])
            ->where('student_id', $request->student_id)
            ->get();
        return view('pages.Teacher.dashboard.students.report', compact('Students', 'students'));
    }
}
