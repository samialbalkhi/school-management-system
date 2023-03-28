<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\Specialization;
use App\Repository\TeachersRepositoryInterface;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $teacher;

    public function __construct(TeachersRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }
    public function index()
    {
        $teacher = $this->teacher->getteaches();

        return view('pages.Teacher.Teachers', compact('teacher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $Specialization= $this->teacher->getspecialization();
       $Gender=$this->teacher->getgenders();
        return view('pages.Teacher.create',compact('Specialization','Gender'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       return $this->teacher->storteacher($request);
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
        $Teachers=$this->teacher->edit($id);
        $Gender=$this->teacher->getgenders();
        $Specialization= $this->teacher->getspecialization();

        return view('pages.Teacher.Edit',compact('Teachers','Gender','Specialization'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->teacher->update($id,$request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->teacher->delete($id);
    }
}
