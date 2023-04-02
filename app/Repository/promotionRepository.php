<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repository\promotionRepositoryInterface;

class promotionRepository implements promotionRepositoryInterface
{
    public function index()
    {
        $Grades = Grade::all();

        return view('pages.Students.promotion.index', compact('Grades'));
    }

    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

        $students = Student::where('grade_id', $request->Grade_id)
            ->where('classroom_id', $request->Classroom_id)
            ->where('section_id', $request->section_id)
            ->get();

            if($students->count() < 1){
                return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }

        foreach ($students as $items) {
            $id = explode(',', $items->id);
            Student::whereIn('id', $id)->update([
                'grade_id' => $request->Grade_id_new,
                'classroom_id' => $request->Classroom_id_new,
                'section_id' => $request->section_id_new,
            ]);

            Promotion::updateOrCreate([
                'student_id' => $items->id,
                'from_grade' => $request->Grade_id,
                'from_Classroom' => $request->Classroom_id,
                'from_section' => $request->section_id,

                'to_grade' => $request->Grade_id_new,
                'to_Classroom' => $request->Classroom_id_new,
                'to_section' => $request->section_id_new,
            ]);
        }
        DB::commit();
        toastr()->success(trans('messages.success'));
        return redirect()->back();

    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }
}
