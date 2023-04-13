<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Models\Quizze;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth=auth()->user();
        $quizzes = Quizze::where('grade_id',$auth->grade_id)
        ->where('classroom_id', $auth->classroom_id)
        ->where('section_id', $auth->section_id)
        ->orderBy('id','DESC')
        ->get();
    return view('pages.Students.dashboard.exams.index', compact('quizzes'));
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
        $StudentId=auth()->user()->id ;
        return view('pages.Students.dashboard.exams.show',compact('id','StudentId'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
