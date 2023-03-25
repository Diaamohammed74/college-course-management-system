<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Models\Course;
use App\Helpers\MyEnum;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;

class TeacherController extends Controller
{
    private DepartmentRepositoryInterface $departmentRepository;
    private CourseRepositoryInterface $courseRepository;
    private TeacherRepositoryInterface $teacherRepository;

    public function __construct(TeacherRepositoryInterface $teacherRepository
    ,CourseRepositoryInterface $courseRepository
    ,DepartmentRepositoryInterface $departmentRepository) 
    {
        $this->courseRepository = $courseRepository;
        $this->departmentRepository = $departmentRepository;
        $this->teacherRepository = $teacherRepository;
    }

    public function index(Request $request)
    {
        $this->authorize('index',Teacher::class);
        $query = $this->teacherRepository->index();
        $departmentFilter = $request->department;
        $designationFilter = $request->designation;
        $statusFilter = $request->status;
    
        if ($departmentFilter) {
            $query->where('department_id', '=', $departmentFilter);
        }
        if ($designationFilter) {
            $query->where('designation', '=', $designationFilter);
        }
    
        if ($statusFilter) {
            $query->where('status', '=', $statusFilter);
        }
    
        $teachers = $query->paginate(20);
        $teachers->appends([
            "designation"=>$designationFilter,
            "status"=>$statusFilter,
            "department"=>$departmentFilter
        ]);
        $departments=$this->departmentRepository->getAllDepartments();
        $designations=MyEnum::getEnumOptions('teachers','designation');
        $status=MyEnum::getEnumOptions('teachers','status');
        return view('admin.teachers.teachers-index',
    compact('teachers', 'departmentFilter'
                , 'statusFilter','designationFilter'
                ,'departments','designations'
                ,'status'));
    }
    public function search(Request $request)
    {
        $this->authorize('index',Teacher::class);
        $searchTerm = $request->search;
        $teachers = Teacher::where('name', 'LIKE', '%'.$searchTerm.'%')->orWhere('id', '=', $searchTerm)->orWhere('id','LIKE', '%'.$searchTerm.'%')->paginate(10);
        return view('admin.teachers.teachers-index-search', compact('teachers'));
    }

    public function getByDepartment(Request $request){
        $courses = Course::where('department_id', $request->department_id)->get();
        return response()->json($courses);
    }
    public function create()
    {
        $this->authorize('create',Teacher::class);

        $departments=$this->departmentRepository->getAllDepartments();
        $courses=$this->courseRepository->getAllCourses();
        $designations= MyEnum::getEnumOptions('teachers', 'designation');
        return view('admin.teachers.teachers-create',compact('departments','courses','designations'));
    }
    public function store(Request $request)
    {
        $this->authorize('create',Teacher::class);

        $validated=$request->validate([
            'name'=>'required|min:3|max:50|string',
            'email'=>'required|min:3|max:250|email|unique:teachers,email',
            'phone' => ['required', 'regex:/^\d{11}$/','unique:teachers,phone'],
            'designation'=>'required',
            'department_id'=>'required',
            'course_id'=>'required'
        ],
        [
            'department_id.department_id' => 'Please choose a department.',
        ]);
        Teacher::create($validated);
        return back()->with('success','Teacher Added Successfuly');
    }

    public function edit($id)
    {
        $this->authorize('edit',Teacher::class);

        $teacher=$this->teacherRepository->find($id);
        $departments=$this->departmentRepository->getAllDepartments();
        $designations= MyEnum::getEnumOptions('teachers', 'designation');
        $status= MyEnum::getEnumOptions('teachers', 'status');
        return view('admin.teachers.teachers-edit',compact('teacher','departments','designations','status'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit',Teacher::class);
        $teacher = $this->teacherRepository->find($id);
        $validated = $request->validate([
            'name' => 'required|min:3|max:50|string',
            'email' => [
                'required',
                'min:3',
                'max:250',
                'email',
                Rule::unique('teachers', 'email')->ignore($teacher),
            ],
            'phone' => [
                'required',
                'regex:/^\d{11}$/',
                Rule::unique('teachers', 'phone')->ignore($teacher),
            ],
            'designation' => 'required',
            'department_id' => 'required',
            'course_id' => 'required',
        ]);
    
        $teacher->update($request->except(['_token', 'id']));
        $teacher->save();
        return redirect(route('teachers'))->with('success','Teacher Updated Successfuly');
    }

    public function destroy($id)
    {
        $this->authorize('destroy',Teacher::class);
        $teacher=$this->teacherRepository->find($id);
        $teacher->delete();
        return back()->with('deleted','Teachr Archived Successfuly');
    }
}