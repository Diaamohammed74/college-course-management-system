<?php

namespace App\Http\Controllers\Admin\Student;
use App\Http\Controllers\Controller;
use App\Jobs\StudentStatus;

class StudentStatusController extends Controller
{
    public function updateStudentStatus(){
        StudentStatus::dispatch();
        return back()->with('success','Task In Progress');
    }
}
