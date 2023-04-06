<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface GraduatedRepositoryInterface
{
    public function index();

    public function create();

    public function softdelete(Request $request);

    public function retutnstudent(Request $request,$id);
        
    public function deleteStudent($id);
}
