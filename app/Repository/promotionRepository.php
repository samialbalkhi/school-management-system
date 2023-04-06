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
                ->where('academic_year', $request->academic_year)
                ->get();

            if ($students->count() < 1) {
                return redirect()
                    ->back()
                    ->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }

            foreach ($students as $items) {
                $id = explode(',', $items->id);
                Student::whereIn('id', $id)->update([
                    'grade_id' => $request->Grade_id_new,
                    'classroom_id' => $request->Classroom_id_new,
                    'section_id' => $request->section_id_new,
                    'academic_year' => $request->academic_year_new,
                ]);

                Promotion::updateOrCreate([
                    'student_id' => $items->id,
                    'from_grade' => $request->Grade_id,
                    'from_Classroom' => $request->Classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->Grade_id_new,
                    'to_Classroom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year' => $request->academic_year,
                    'academic_year_new' => $request->academic_year_new,
                ]);
            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function create()
    {
        $promotions = Promotion::all();

        return view('pages.Students.promotion.management', compact('promotions'));
    }

    public function delete_promotion(Request $request)
    {
        DB::beginTransaction();
        try {
        if ($request->page_id == 1) {
            $promotion = Promotion::all();

            foreach ($promotion as $promotions) {
                $id = explode(',', $promotions->student_id);
                Student::whereIn('id', $id)->update([
                    'grade_id' => $promotions->from_grade,
                    'classroom_id' => $promotions->from_Classroom,
                    'section_id' => $promotions->from_section,
                    'academic_year' => $promotions->academic_year,
                ]);

                Promotion::truncate();
            }
            DB::commit();
            toastr()->success(trans('messges.Delete'));
            return redirect()->back();
        } else {


            $promotion=Promotion::findorFail($request->id);

                Student::where('id',$promotion->student_id)
                ->update([

                    'gender_id'=>$promotion->from_grade,
                    'classroom_id'=>$promotion->from_Classroom,
                    'section_id'=>$promotion->from_section,
                    'academic_year'=>$promotion->academic_year,
                ]);

                Promotion::destroy($request->id);

                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();
        }
    }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    
}
