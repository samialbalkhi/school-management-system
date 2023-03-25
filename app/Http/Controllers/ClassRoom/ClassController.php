<?php

namespace App\Http\Controllers\ClassRoom;

use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\claases\ClassRequest;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grad = Grade::all();
        $classes = Classroom::all();

        return view('pages.classes.classesroom', compact('grad', 'classes'));
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
    public function store(ClassRequest $request)
    {
        for ($i = 0; $i < count($request->List_Classes); $i++) {
            // dd($request->List_Classes[$i]['Grade_id']);
            Classroom::create([
                'name' => ['en' => $request->List_Classes[$i]['Name_class_en'], 'ar' => $request->List_Classes[$i]['Name']],
                'grade_id' => $request->List_Classes[$i]['grade_id'],
            ]);
        }
        toastr()->success(trans('messges.success'));
        return redirect()->route('classes.index');
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
        $classes = Classroom::find($id);

        $classes->update([
            'name' => ['ar' => $request->Name, 'en' => $request->Name_en],
            'grade_id' => $request->grade_id,
        ]);

        toastr()->success(trans('messges.Update'));
        return redirect()->route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Classroom::destroy($id);

        toastr()->success(trans('messges.Delete'));
        return redirect()->route('classes.index');
    }
    public function delete_all(Request $request)
    {
        $delete_all_id = explode(',', $request->delete_all_id);
        Classroom::whereIn('id', $delete_all_id)->delete();

        toastr()->success(trans('messges.Delete'));
        return redirect()->route('classes.index');
    }
    public function filter_class(Request $request)
    {
        $grad = Grade::all();
        $search = Classroom::select('*')
            ->where('grade_id', '=', $request->Grade_id)
            ->get();
        return view('pages.classes.classesroom', compact('grad'))->withDetails($search);
    }
}
