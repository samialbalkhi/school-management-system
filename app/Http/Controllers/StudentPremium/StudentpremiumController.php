<?php

namespace App\Http\Controllers\StudentPremium;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\StudentPremiumRepositoryInterface;

class StudentpremiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $StudentPremium ;
    public  function __construct(StudentPremiumRepositoryInterface $StudentPremium)
    {
        $this->StudentPremium = $StudentPremium;
    }
    public function index()
    {
        return $this->StudentPremium->index();
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
        return $this->StudentPremium->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->StudentPremium->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->StudentPremium->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->StudentPremium->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->StudentPremium->delete($id);
    }
}
