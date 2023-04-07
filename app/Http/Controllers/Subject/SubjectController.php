<?php

namespace App\Http\Controllers\Subject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\SubjectRepositoryInterface;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $Subject ;
    public function __construct(SubjectRepositoryInterface $Subject)
    {
        return $this->Subject=$Subject ;
    }
    public function index()
    {
        return $this->Subject->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Subject->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Subject->store($request);
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
        return $this->Subject->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->Subject->update($request ,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Subject->destroy($id);
    }
}
