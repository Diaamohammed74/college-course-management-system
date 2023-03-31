<?php

namespace App\Http\Controllers\Admin\Pdf;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;

class PdfController extends Controller
{
    private DepartmentRepositoryInterface $departmentRepository;
    private CourseRepositoryInterface $courseRepository;
    private TeacherRepositoryInterface $teacherRepository;
    private StudentRepositoryInterface $studentsRepository;

    public function __construct(TeacherRepositoryInterface $teacherRepository
    ,CourseRepositoryInterface $courseRepository
    ,DepartmentRepositoryInterface $departmentRepository
    ,StudentRepositoryInterface $studentsRepository) 
    {
        $this->courseRepository = $courseRepository;
        $this->departmentRepository = $departmentRepository;
        $this->teacherRepository = $teacherRepository;
        $this->studentsRepository = $studentsRepository;
    }
    public function generateUsersPdf()
    {
        $pdf=app('dompdf.wrapper');
        $users = User::all();
        $pdf->loadView('admin/users-pdf', compact('users'));
        return $pdf->download('users.pdf');
    }
    public function generateTeachersPdf(Request $request)
    {
        $pdf=app('dompdf.wrapper');
        $query = $this->teacherRepository->index();
        $department=$request->department;
        $designation=$request->designation;
        $status=$request->status;
        if ($department) {
            $query->where('department_id', '=', $department);
        }
        if ($designation) {
            $query->where('designation', '=', $designation);
        }
        if ($status) {
            $query->where('status', '=', $status);
        }
        $teachers = $query->get();
        $department_name=Department::where('id',$department)->pluck('name');
        $pdf->loadView('admin/pdf/teachers-pdf', compact('teachers','department_name'));
        return $pdf->download('teachers.pdf');
    }
    public function generateStudentsPdf(Request $request){
        $department=$request->department;
        $status=$request->status;
        $query = $this->studentsRepository->index();
        if ($department) {
            $query->where('department_id',$department);
        }
        if ($status) {
            $query->where('status',$status);
        }
        $students=$query->get();
        $department_name=Department::where('id',$department)->pluck('name');
                $pdf=app('dompdf.wrapper');
                $pdf->loadView('admin/pdf/students-pdf', compact('students','department_name'));
                return $pdf->download('students.pdf');
    }
}