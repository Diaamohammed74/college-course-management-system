<?php

namespace App\Http\Controllers\admin\Result;

use App\Models\Course;
use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;
use App\Rules\maxDegree;

class ResultController extends Controller
{       private DepartmentRepositoryInterface $departmentRepository;
    private CourseRepositoryInterface $courseRepository;
    private StudentRepositoryInterface $studentRepository;
    public function __construct(
        CourseRepositoryInterface $courseRepository
        ,DepartmentRepositoryInterface $departmentRepository
        ,StudentRepositoryInterface $studentRepository
    ) 
    {
        $this->courseRepository = $courseRepository;
        $this->departmentRepository = $departmentRepository;
        $this->studentRepository = $studentRepository;
    }
        public function add()
        {
            $departments = Department::all();
            return view('admin.results.add-results',compact('departments'));
        }

        public function storeResult(Request $request)
        {
            $CourseFullMarkValue=Course::where('id',$request->course_id)->value('full_mark');
            $request->validate([
                'course_id'=>'required',
                'student_id'=>'required',
                'degree' => ['required', 'between:0,100', new maxDegree($CourseFullMarkValue)],
            ]);
            $course_id=$request->course_id;
            $student_id=$request->student_id;
            $degree=$request->degree;
            //check if the user reg this course or not
            $course_enroll=DB::table('course_enroll')
            ->where('course_id',$course_id)
            ->where('student_id',$student_id)
            ->exists();
            //get value of course grade in course enroll
            $course_enroll_grade=DB::table('course_enroll')
            ->where('course_id',$course_id)
            ->where('student_id',$student_id)
            ->value('course_grade');
            if ($course_enroll && $course_enroll_grade==null)
            {
                //add degree
                $this->addDegree($degree,$course_id,$student_id);
                $course=DB::table('course_enroll')
                ->where('course_id',$course_id)
                ->where('student_id',$student_id);
                $courseGrade=$course->value('course_grade');
                $totalCoursesGrades=Student::where('id',$student_id)
                ->value('total_courses_grades');
                $newTotalCoursesGrades=$totalCoursesGrades + $courseGrade;
                //update total courses grades
                $this->updateTotalCoursesGrades($newTotalCoursesGrades,$student_id);
                return back()->with('success','Degree Added Successfuly');
            }
            elseif($course_enroll && $course_enroll_grade!=null)
            {
                return back()->with('error','Degree already added');
            }
            else
            {
                return back()->with('error','This Student didn`t regieter this course yet');
            }
        }


        public function storeResultFromModal(Request $request,$student_id,$course_id)
        {
            $CourseFullMarkValue=Course::where('id',$course_id)
            ->value('full_mark');
            $request->validate([
                'degree' => ['required', 'between:0,100', new maxDegree($CourseFullMarkValue)],
            ]);
            $degree=$request->degree;
            //check if the user reg this course or not
            $course_enroll=DB::table('course_enroll')
            ->where('course_id',$course_id)
            ->where('student_id',$student_id)
            ->exists();
            $course_enroll_grade=DB::table('course_enroll')
            ->where('course_id',$course_id)
            ->where('student_id',$student_id)
            ->value('course_grade');
            if ($course_enroll && $course_enroll_grade==null)
            {
                //add degree
                $this->addDegree($degree,$course_id,$student_id);
                $course=DB::table('course_enroll')
                ->where('course_id',$course_id)
                ->where('student_id',$student_id);

                $courseGrade=$course->value('course_grade');

                $totalCoursesGrades=Student::where('id',$student_id)
                ->value('total_courses_grades');
                
                $newTotalCoursesGrades=$totalCoursesGrades+$courseGrade;
                //update total courses grades
                $this->updateTotalCoursesGrades($newTotalCoursesGrades,$student_id);
                return back()->with('success','Degree Added Successfuly');
            }
        }

        public function updateResult(Request $request,$student_id,$course_id)
        {
            $CourseFullMarkValue=Course::where('id',$request->course_id)->value('full_mark');
            $request->validate([
                'new_degree'=>['required', 'between:0,100', new maxDegree($CourseFullMarkValue)]
            ]);
            $newGrade=$request->new_degree;
            $oldGrade=DB::table('course_enroll')
                ->where('course_id',$course_id)
                ->where('student_id',$student_id)
                ->value('course_grade');
            $this->addDegree($newGrade,$course_id,$student_id);
            $totalCoursesGrades=Student::where('id',$student_id)->value('total_courses_grades');
            $newTotalCoursesGrades=$totalCoursesGrades-$oldGrade;
            $finalTotalCoursesGrades=$newTotalCoursesGrades+$newGrade;
            $this->updateTotalCoursesGrades($finalTotalCoursesGrades,$student_id);
            return back()->with('success','This Course Result Updated.');
        }
        public function addDegree($degree,$course_id,$student_id){
            DB::table('course_enroll')
            ->where('course_id',$course_id)
            ->where('student_id',$student_id)
            ->update([
                'course_grade'=>$degree
            ]);
        }
        public function updateTotalCoursesGrades($newTotalCoursesGrades,$student_id){
            Student::where('id',$student_id)
            ->update([
                'total_courses_grades'=>$newTotalCoursesGrades
            ]);
        }
    }