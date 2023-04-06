<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\FeesinvoicesRepositoryInterface;

class FeesinvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $Feesinvoices ;
    public function __construct(FeesinvoicesRepositoryInterface $Feesinvoices)
    {
       $this->Feesinvoices=$Feesinvoices ; 
    }
    public function index()
    {
        return $this->Feesinvoices->index();
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
        return $this->Feesinvoices->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->Feesinvoices->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Feesinvoices->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->Feesinvoices->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Feesinvoices->delete($id);
    }
}
