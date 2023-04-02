<?php
namespace App\Repository;

use Illuminate\Http\Request;

interface StudentsRepositoryInterface{

    public function getstudents();
    public function create();
    public function getclassesroom($id);
    public function getsection($id);
    public function stor(Request $request);
    public function edti($id);
    public function update(Request $request,$id);
    public function delete($id);
    public function show($id);
    public function attachments(Request $request);
    public function Download_attachment($studentsname,$filename);
    public function delete_attachment(Request $request,$id);
}