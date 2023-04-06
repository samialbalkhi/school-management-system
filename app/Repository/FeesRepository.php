<?php
namespace App\Repository;

use App\Models\Fee;
use App\Models\Grade;
use Illuminate\Http\Request;

class FeesRepository implements FeesRepositoryInterface
{
    public function index()
    {
        $fees = Fee::all();
        return view('pages.Fees.index', compact('fees'));
    }

    public function create()
    {
        $Grades = Grade::all();

        return view('pages.Fees.add', compact('Grades'));
    }

    public function edit($id)
    {
        $Grades = Grade::all();

        $fees = Fee::find($id);
        return view('pages.Fees.edit', compact('fees', 'Grades'));
    }

    public function update(Request $request, $id)
    {
        $fees = Fee::find($id);

        $fees->Update([
            'title' => ['en' => $request->title_en, 'ar' => $request->title_ar],
            'amount' => $request->amount,
            'description' => $request->description,
            'yeae' => $request->year,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Classroom_id,
            'fee_type' => $request->Fee_type,
        ]);

        toastr()->success(trans('messges.Update'));
        return redirect()->back();
    }

    public function store(Request $request)
    {
        Fee::create([
            'title' => ['en' => $request->title_en, 'ar' => $request->title_ar],
            'amount' => $request->amount,
            'description' => $request->description,
            'yeae' => $request->year,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Classroom_id,
            'fee_type' => $request->Fee_type,
        ]);

        toastr()->success(trans('messges.success'));
        return redirect()->route('fees.index');
    }

    public function delete($id)
    {
        Fee::destroy($id);
        toastr()->success(trans('messges.Delete'));
        return redirect()->back();
    }
}
