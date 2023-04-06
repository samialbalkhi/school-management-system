<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Repository\StudentsRepositoryInterface;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $student;
    public function __construct(StudentsRepositoryInterface $student)
    {
        $this->student = $student;
    }
    public function index()
    {
        return $this->student->getstudents();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->student->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        return $this->student->stor($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->student->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->student->edti($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        return $this->student->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->student->delete($id);
    }
    public function getclassesroom($id)
    {
        return $this->student->getclassesroom($id);
    }

    public function getsection($id)
    {
        return $this->student->getsection($id);
    }
    public function attachments(Request $request)
    {
        return $this->student->attachments($request);
    }

    public function Download_attachment($studentsname, $filename)
    {
        return $this->student->download_attachment($studentsname, $filename);
    }

    public function Delete_attachment(Request $request, $id)
    {
        return $this->student->delete_attachment($request, $id);
    }
}
