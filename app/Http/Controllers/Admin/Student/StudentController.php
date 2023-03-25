<?php

namespace App\Http\Controllers\Admin\Student;

use App\Models\Level;
use App\Helpers\MyEnum;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Interfaces\LevelRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;

class StudentController extends Controller
{
    private DepartmentRepositoryInterface $departmentRepository;
    private LevelRepositoryInterface $levelRepository;
    private StudentRepositoryInterface $studentRepository;
    public function __construct(DepartmentRepositoryInterface $departmentRepository,LevelRepositoryInterface $levelRepository,StudentRepositoryInterface $studentRepository) 
    {
        $this->departmentRepository = $departmentRepository;
        $this->levelRepository = $levelRepository;
        $this->studentRepository = $studentRepository;
    }
    public function index(Request $request)
    {
        $query = $this->studentRepository->index();
        $departmentFilter = $request->department;
        $statusFilter = $request->status;
        $ascGradeFilter = $request->asc;
        $descGradeFilter = $request->descgrade;
        
        if ($departmentFilter) {
            $query->where('department_id', '=', $departmentFilter);
        }
    
        if ($statusFilter) {
            $query->where('status', '=', $statusFilter);
        }
        $students = $query->paginate(20);
        $students->appends(['department'=>$departmentFilter,'status'=>$statusFilter]);
        $departments=$this->departmentRepository->getAllDepartments();
        $status=MyEnum::getEnumOptions('students','status');
        
        return view
        ('admin.students.students-index', 
        compact
        (
            'students', 'departmentFilter'
            , 'statusFilter','departments'
            ,'status'
        ));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->search;
        $students = Student::where('name', 'LIKE', '%'.$searchTerm.'%')->orWhere('id', '=', $searchTerm)->orWhere('id','LIKE', '%'.$searchTerm.'%')->paginate(10);
        return view('admin.students.students-index-search', compact('students'));
    }
    public function studentsGrad(){
        $students=$this->studentRepository->index()->where('status','grad')->withoutGlobalScopes()->paginate(20);
        return view('admin.students.students-index-grad',compact('students'));
    }
    public function studentsUnderGrad(){
        $students=$this->studentRepository->index()->where('status','undergrad')->withoutGlobalScopes()->paginate(20);
        return view('admin.students.students-index-undergrad',compact('students'));
    }

    public function studentsByLevel(Request $request){
        $request->validate([
            'department_id'=>'required',
            'level_id'=>'required'
        ]);

        $students = Student::with('level','department')
        ->where('level_id', $request->level_id)
        ->where('department_id', $request->department_id)
        ->where('total_courses_grades','>',0)
        ->orderBy('total_courses_grades', 'desc')
        ->take(10)
        ->get();
        return view('admin.students.students-index-topstudents',compact('students'));
    }

    public function getByDepartment(Request $request){
        $levels = Level::where('department_id', $request->department_id)->get();
        return response()->json($levels);
    }
    public function create()
    {
        $departments=$this->departmentRepository->getAllDepartments();
        $levels=$this->levelRepository->getAllLevels();
        return view('admin.students.students-create',
        compact('departments','levels'));
    }
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name'=>'required|min:3|max:50|string',
            'email'=>'required|min:3|max:250|email|unique:students,email',
            'phone' => ['required', 'regex:/^\d{11}$/','unique:students,phone'],
            'department_id'=>'required',
            'level_id'=>'required'
        ],
        [
            'level_id.level_id' => 'Please choose a level.',
        ]);
        Student::create($validated);
        return back()->with('success', __('Student added'));
    }

    public function edit($id)
    {
        $student=$this->studentRepository->find($id);
        $departments=$this->departmentRepository->getAllDepartments();
        $levels=$this->levelRepository->getAllLevels();
        $status=MyEnum::getEnumOptions('students','status');
        return view('admin.students.students-edit',compact('student','departments','status','levels'));
    }


    public function update(Request $request, $id)
    {
        $student = $this->studentRepository->find($id);
        $validated = $request->validate([
            'name' => 'required|min:3|max:50|string',
            'email' => [
                'required',
                'min:3',
                'max:250',
                'email',
                Rule::unique('students', 'email')->ignore($student),
            ],
            'phone' => [
                'required',
                'regex:/^\d{11}$/',
                Rule::unique('students', 'phone')->ignore($student),
            ],
            'department_id' => 'required',
        ]);
    
        $student->update($request->except(['_token', 'id']));
        $student->save();
        return redirect(route('students'))->with('success','Student Updated Successfuly');
    }
    public function destroy($id)
    {
        $student=$this->studentRepository->find($id);
        $student->delete();
        return back()->with('deleted','Student Archied Succesfuly');
    }
    public function home(){
        $students=$this->studentRepository->index();
        // dd($students);
        return view('admin.home',compact('students'));
    }
}