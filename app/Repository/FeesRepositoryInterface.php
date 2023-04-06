<?php
namespace App\Repository ;

use Illuminate\Http\Request;

interface FeesRepositoryInterface 
{
    public function index ();

    public function create();

    public function edit($id);

    public  function update(Request $request,$id);

    public function store(Request $request);

    public function delete($id);
}