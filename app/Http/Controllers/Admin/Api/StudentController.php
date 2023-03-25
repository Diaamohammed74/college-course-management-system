<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{

    public function __invoke(Request $request)
    {
        $student=Student::get();
        return $student;
    }
}
