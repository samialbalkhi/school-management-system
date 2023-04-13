<?php

namespace App\Http\Controllers\Section;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Section\SectionRequest;
use App\Models\Teacher;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gards = Grade::with('sections')->get();
        $list_grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Sections.section', compact('list_grades', 'gards','teachers'));
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
    public function store(SectionRequest $request)
    {
        // dd($request);
       $Section= Section::create([
            'name' => ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En],
            'status' => 1,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Class_id,
        ]);
        $Section->teachers()->attach($request->teacher_id);
        toastr()->success(trans('messges.success'));
        return redirect()->route('Sections.index');
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
    public function update(SectionRequest $request, string $id)
    {
          
        $section=Section::find($id);

        $section->update([

            'name' => ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En],
            'grade_id'=>$request->Grade_id,
            'classroom_id'=>$request->Class_id,
            'status'=>$request->status =="on" ? 1 : 2,
           
        ]);

        toastr()->success(trans('messges.Update'));
        return redirect()->route('Sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Section::destroy($id);

        toastr()->success(trans('messges.Delete'));
        return redirect()->route('Sections.index');
    }
    public function clasessection($id)
    {
        // return $request->id;
        return Classroom::where('grade_id', $id)->pluck('name', 'id');
    }
}
