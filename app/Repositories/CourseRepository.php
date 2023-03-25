<?php

namespace App\Repositories;

use App\Models\Course;
use App\Interfaces\CourseRepositoryInterface;
// return 

class CourseRepository implements CourseRepositoryInterface 
{

    public function getAllCourses(){
        return Course::select('id','name')->get();
    }
    public function getAllEnrolledCourses(){
        return Course::with('student');
    }
    public function index(){
        return Course::with('department','student','teacher');
    }
    public function find($id){
        return Course::findOrFail($id);
    }
}

