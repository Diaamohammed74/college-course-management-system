<?php

namespace App\Repositories;

use App\Models\Teacher;
use App\Interfaces\TeacherRepositoryInterface;


class TeacherRepository implements TeacherRepositoryInterface 
{
    public function index(){
        return Teacher::with(['course','department']);
    }
    public function find($id){
        return Teacher::with(['department','course'])->findOrFail($id);
    }
}

