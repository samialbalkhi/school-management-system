<?php

namespace App\Http\Controllers\Quizz;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\QuizzRepositoryInterface;

class QuizzController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $Quizz;
    public function __construct(QuizzRepositoryInterface $Quizz)
    {
        return $this->Quizz = $Quizz;
    }
    public function index()
    {
        return $this->Quizz->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Quizz->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Quizz->store($request);
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
        return $this->Quizz->edit($id); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->Quizz->update($request , $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Quizz->destroy($id);
    }
}
