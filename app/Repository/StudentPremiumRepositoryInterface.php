<?php

namespace App\Repository ;

use Illuminate\Http\Request;

interface StudentPremiumRepositoryInterface 
{
    public function index();
    public function show($id);
    public function edit($id);
    public function store(Request $request);
    public function update(Request $request ,$id);
    public function delete($id); 
    
}