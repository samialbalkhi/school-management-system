<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $information = Student::findorFail(auth()->user()->id);
        return view('pages.Students.dashboard.profile.profile', compact('information'));
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
    public function store(Request $request)
    {
        //
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
        $Teacher = Student::findOrFail($id);

        if (!empty($request->password)) {
            $Teacher->update([
                'name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
                'password' => Hash::make($request->password),
            ]);
        } else {
            $Teacher->update([
                'name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
            ]);

            toastr()->success(trans('messages.Update'));
             return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}