<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;

class HomeController extends Controller
{

    private UserRepositoryInterface $userRepository;
    private StudentRepositoryInterface $studentRepository;
    private DepartmentRepositoryInterface $departmentRepository;
    private TeacherRepositoryInterface $teacherRepository;
    private CourseRepositoryInterface $courseRepository;

public function __construct(UserRepositoryInterface $userRepository
,DepartmentRepositoryInterface $departmentRepository
,StudentRepositoryInterface $studentRepository
,TeacherRepositoryInterface $teacherRepository
,CourseRepositoryInterface $courseRepository) 
{
    $this->userRepository = $userRepository;
    $this->departmentRepository = $departmentRepository;
    $this->studentRepository=$studentRepository;
    $this->teacherRepository=$teacherRepository;
    $this->courseRepository=$courseRepository;
}
    public function index()
    {
        $doctors=$this->teacherRepository->index()->where('designation','doctor')->count();
        $teacherAssistant=$this->teacherRepository->index()->where('designation','assistant')->count();
        $departments=$this->departmentRepository->getAllDepartments();
        $courses=$this->courseRepository->getAllCourses()->count();
        $students=$this->studentRepository->countStudents()->count();
        $gradStudents=$this->studentRepository->countStudents()->where('status','grad')->count();
        $underGradStudents=$students-$gradStudents;

        return view('admin.home'
        ,compact( 
                        'departments','students'
                    ,'gradStudents','underGradStudents'
                    ,'doctors','courses'
                    ,'teacherAssistant'
                    ));
    }

}
