<?php
namespace App\Repository;

use Illuminate\Http\Request;

interface FeesinvoicesRepositoryInterface
{
    public function index();
    public function show($id);
    public function store(Request $request);
    public function  edit($id);
    public function update(Request $request, $id);
    public function delete($id);
}
