<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\FeesRepositoryInterface;

class FeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $fees ;
    public function __construct(FeesRepositoryInterface $fees)
    {
        $this->fees= $fees ;
    }
    public function index()
    {
        return $this->fees->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return $this->fees->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $this->fees->store($request);
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
        return $this->fees->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->fees->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->fees->delete($id);
    }
}
