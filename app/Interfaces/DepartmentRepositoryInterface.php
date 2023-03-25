<?php

namespace App\Interfaces;

interface DepartmentRepositoryInterface 
{
    public function getAllDepartments();
    public function index();
    public function create();
    public function edit($id);
    public function destroy($id);
    public function update($departmentId);
}