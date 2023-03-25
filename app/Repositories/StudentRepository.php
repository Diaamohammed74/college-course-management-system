<?php

namespace App\Repositories;

use App\Models\Student;
use App\Interfaces\StudentRepositoryInterface;


class StudentRepository implements StudentRepositoryInterface 
{
    public function index(){
        return Student::query()->with(['department','level','course']);
    }

    public function find($id){
        return Student::with(['department','level','course'])->findOrFail($id);
    }
    public function countStudents(){
        return Student::withoutGlobalScopes();
    }
}

