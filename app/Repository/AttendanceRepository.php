<?php
namespace App\Repository;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Repository\AttendanceRepositoryInterface;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function index()
    {
        $Grades=Grade::with('sections')->get();
        $Teacher=Teacher::all();

        return view('pages.Attendance.Sections',compact('Grades','Teacher'));
    }
    public function show($id)
    {
        $students=Student::with('attendances')->where('section_id',$id)->get();
        // dd($students);
        return view('pages.Attendance.index', compact('students'));
    }
    public function store(Request $request)
    {
        try {
            foreach ($request->attendences as $studentid=>$attendence){
                if( $attendence == 'presence' ) {
                    $status = true;
                } else if( $attendence == 'absent' ){
                    $status = false;
                }

                Attendance::create([
                    'student_id'=> $studentid,
                    'grade_id'=> $request->grade_id,
                    'classroom_id'=> $request->classroom_id,
                    'section_id'=> $request->section_id,
                    'teacher_id'=> 1,
                    'date'=> date('Y-m-d'),
                    'status'=> $status
                ]);
            }

            toastr()->success(trans('messages.success'));
            return redirect()->back();

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
    }
    public function delete($id)
    {
    }
}
