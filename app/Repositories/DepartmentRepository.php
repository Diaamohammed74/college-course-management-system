<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Department;
use App\Interfaces\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface 
{
public function getAllDepartments()
{
    return Department::with('course','level','student')->get();
}
public function index()
{
    return Department::with('user')->get();
}

public function create()
{
    return User::where('type','=','super_admin')->select('id','name')->get();
}
public function edit($id)
{
    return Department::findOrFail($id);
}
public function destroy($id)
{
    return Department::findOrFail($id)->delete();
}
public function update($departmentId)
{
    return Department::all();
}

}