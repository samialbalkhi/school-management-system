<?php

namespace App\Http\Controllers\Library;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\LibraryRepositoryInterface;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $Library ;
    public function __construct(LibraryRepositoryInterface $Library)
    {
        return $this->Library=$Library ;
    }
    public function index()
    {
        return $this->Library->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Library->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Library->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Library->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->Library->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // return $this->Library->destroy($id);
    }

    public function downloadAttachment($filename)
    {
      return  $this->Library->download($filename);
    }
    public function delete(Request $request ,$id)
    {
        return $this->Library->destroy($request,$id);
    }
}
