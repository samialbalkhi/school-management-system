<?php

namespace App\Http\Controllers\Receipt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\ReceiptRepositoryInterface;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $receipt ;
    public function __construct(ReceiptRepositoryInterface $receipt)
    {
        $this->receipt = $receipt;
    }
    public function index()
    {
        return $this->receipt->index();
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
        return $this->receipt->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->receipt->name($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->receipt->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->receipt->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->receipt->delete($id);
    }
}
