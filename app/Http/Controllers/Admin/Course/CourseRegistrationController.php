<?php

namespace App\Http\Controllers\admin\Course;


use App\Models\Course;
use App\Models\Student;
use App\Models\Settings;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;


class CourseRegistrationController extends Controller
{
    private DepartmentRepositoryInterface $departmentRepository;
    private CourseRepositoryInterface $courseRepository;
    private StudentRepositoryInterface $studentRepository;

    public function __construct(CourseRepositoryInterface $courseRepository,DepartmentRepositoryInterface $departmentRepository,StudentRepositoryInterface $studentRepository) 
    {
        $this->courseRepository = $courseRepository;
        $this->departmentRepository = $departmentRepository;
        $this->studentRepository = $studentRepository;
    }
    public function showForm()
    {
        $departments = Department::all();
    
        return view('admin.CourseRegister.course-register', compact('departments'));
    }
    
    public function getByDepartment(Request $request){
        $courses = Course::where('department_id', $request->department_id)->get();
        return response()->json($courses);
    }


    public function getStudentsByDepartment(Request $request){
        $students = Student::where('department_id', $request->department_id)->where('status','undergrad')->get();
        return response()->json($students);
    }

    public function autocomplete(Request $request){
        $res = Student::select("id")
            ->where("students.id","LIKE","%{$request->term}%")
            ->get();
        return response()->json($res);
    }


    public function registerSubmission(Request $request)
    {
        $student = Student::find($request->student_id);
        $request->validate([
            'department_id'=>'required',
            'course_id'=>'required',
            'student_id'=>'required'
            ]);
            if ($student->course->contains($request->course_id)) {
            return back()->with('error', 'This student has already registered for this course.');
            }
            DB::table('course_enroll')->insert([
                'course_id'=>$request->course_id,
                'student_id'=>$request->student_id
            ]);
            $this->updateCompletedHours($request);
            return back()->with('success','Course Registred Successfuly');
        }

        public function updateCompletedHours(Request $request){
            $courseCreditHours = Course::where('id', $request->course_id)
            ->value('credit_hours');
            $totalEnrolledCoursesMarks = Course::where('id', $request->course_id)
            ->value('full_mark');
            $newTotalCreditHours = Student::where('id', $request->student_id)
            ->value('total_completed_hours') + $courseCreditHours;
            $newTotalEnrolledCoursesMarks = Student::where('id', $request->student_id)
            ->value('total_enrolled_courses_marks') + $totalEnrolledCoursesMarks;
            Student::where('id', $request->student_id)
            ->update([
                'total_completed_hours' => $newTotalCreditHours,
                'total_enrolled_courses_marks' => $newTotalEnrolledCoursesMarks
            ]);
        }
        public function showRegisteredList($id){ 
        $students=Student::with('course','department')->find($id);
        $student = Student::with(['course' => function ($query) {
            $query->onlyTrashed();
        }])->withTrashed()->find($id);
        $requiredHours=Settings::value('required_hours');
        return view('admin.CourseRegister.student-schedule',compact('students','student','requiredHours'));
    }
    public function deleteCourseRegistred($student_id,$course_id){

    $student = Student::with('course', 'department')->find($student_id);
    $course = $student->course->where('id', $course_id)->first();

    if (!$course) {
        return back()->with('error', 'Invalid course id');
    }

    if ($course->pivot->course_grade != null) {
        return back()->with('error', 'Can`t delete this course registration');
    }
                else
                {
                    $student->course()->detach($course_id);
                    $courseCreditHours = Course::where('id', $course_id)->value('credit_hours');
                    $courseFullMark = Course::where('id', $course_id)->value('full_mark');
                    $newTotalCreditHours = Student::where('id', $student_id)->value('total_completed_hours') - $courseCreditHours;
                    $newTotalCoursesEnrolledMarks = Student::where('id', $student_id)
                    ->value('total_enrolled_courses_marks') - $courseFullMark;
                    Student::where('id', $student_id)
                    ->update([
                        'total_completed_hours' => $newTotalCreditHours,
                        'total_enrolled_courses_marks'=>$newTotalCoursesEnrolledMarks
                    ]);
                    return back()->with('deleted','Course Regestration deleted successfuly');
                }
            }
    }


