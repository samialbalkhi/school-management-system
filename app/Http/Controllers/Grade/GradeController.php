<?php

namespace App\Http\Controllers\Grade;




use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades=Grade::all();
        return view('pages.grades.grades',compact('grades'));
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
        $grade=new Grade();
        $grade->name =['en'=>$request->Name_en, 'ar'=>$request->Name];
        $grade->notes=$request->Notes ;

        $grade->save();

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
    public function update(Request $request, string $id)
    {
        $grades=Grade::find($id);
        $grades->update([

            $grades->name =['en'=>$request->Name_en, 'ar'=>$request->Name],
            $grades->notes=$request->Notes ,
        ]);

        toastr()->success(trans('messges.Update'));
        return redirect()->route('grades.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grade=Grade::destroy($id);

        toastr()->success(trans('messges.Delete'));
        return redirect()->route('grades.index');
    }
}
