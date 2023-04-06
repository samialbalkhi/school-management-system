<?php

namespace App\Http\Controllers\PaymentStudent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\PaymentStudentRepositoryInterface;

class PaymentStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $PaymentStudent ;
    public function __construct(PaymentStudentRepositoryInterface $PaymentStudent)
    {
        $this->PaymentStudent = $PaymentStudent ;
    }
    public function index()
    {
        return $this->PaymentStudent->index();
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
        return $this->PaymentStudent->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return $this->PaymentStudent->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->PaymentStudent->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->PaymentStudent->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->PaymentStudent->destroy($id);
    }
}
