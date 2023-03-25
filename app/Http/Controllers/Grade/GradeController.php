<?php

namespace App\Http\Controllers\Grade;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;
use App\Models\Classroom;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::all();
        return view('pages.grades.grades', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        if (
            Grade::where('Name->ar', $request->Name)
                ->orWhere('Name->en', $request->Name_en)
                ->exists()
        ) {
            // return redirect()->back()->withErrors(trans('GradesTranslation.exists'));
            toastr()->error(trans('GradesTranslation.exists'));
            return redirect()->route('grades.index');
        }

        Grade::create([
            'name' => ['en' => $request->Name_en, 'ar' => $request->Name],
            'notes' => $request->Notes,
        ]);

        // $grade=new Grade();
        // $grade->name =['en'=>$request->Name_en, 'ar'=>$request->Name];
        // $grade->notes=$request->Notes ;

        // $grade->save();

        toastr()->success(trans('messges.success'));
        return redirect()->route('grades.index');
    }

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $grades = Grade::find($id);
        $grades->update([($grades->name = ['en' => $request->Name_en, 'ar' => $request->Name]), ($grades->notes = $request->Notes)]);

        toastr()->success(trans('messges.Update'));
        return redirect()->route('grades.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = Classroom::where('grade_id', $id)->pluck('grade_id');

        if ($class->count() == 0) {
            Grade::destroy($id);
            toastr()->success(trans('messges.Delete'));
            return redirect()->route('grades.index');
        } else {
            toastr()->error(trans('messges.Delete_grades'));
            return redirect()->route('grades.index');
        }
    }
  
}
