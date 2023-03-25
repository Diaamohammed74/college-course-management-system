<?php

namespace App\Composers;

use Illuminate\View\View;
use App\Repositories\CourseRepository;
use App\Repositories\StudentRepository;

class HomeComposer
{
    protected $students;
    protected $courses;

    public function __construct(StudentRepository $students,CourseRepository $courses)
    {
        $this->students = $students;
        $this->courses = $courses;
    }

    public function compose(View $view)
    {
        // $students=$this->students->countStudents()->count();
        // $underGrad=$this->students->countStudents()->where('status','undergrad')->count();
        // $grad=$this->students->countStudents()->where('status','grad')->count();
        // $grad=$this->students->countStudents()->where('status','grad')->count();
        // $studentsEnrollCourses = $this->students->countStudents()->where('total_enrolled_courses_marks','>',0)->count();
        // $studentsNotEnrollCourses = $this->students->countStudents()->where('total_enrolled_courses_marks','=',0)->count();
        // $view->with([
        //     'students'=>$students,
        //     "underGrad"=>$underGrad,
        //     "grad"=>$grad,
        //     "coursesEnrolled"=>$studentsEnrollCourses,
        //     "studentsNotEnrollCourses"=>$studentsNotEnrollCourses,
        // ]);
    }
}