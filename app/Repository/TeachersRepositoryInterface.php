<?php

namespace App\Repository;

interface TeachersRepositoryInterface
{
    public function getteaches();
    public function getspecialization();
    public function getgenders();
    public function storteacher($request);
    public function edit($id);
    public function update($id,$request);
    public function delete($id);
}
