<?php

namespace App\Http\Controllers\Attendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\AttendanceRepositoryInterface;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $Attendance ;
    public function __construct(AttendanceRepositoryInterface $Attendance)
    {
        $this->Attendance= $Attendance ;
     }
    public function index()
    {
        return $this->Attendance->index();
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
        return $this->Attendance->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->Attendance->show($id);
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
