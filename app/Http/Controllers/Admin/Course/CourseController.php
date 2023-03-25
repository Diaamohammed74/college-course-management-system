<?php

namespace App\Http\Controllers\Admin\Course;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;

class CourseController extends Controller
{
    private DepartmentRepositoryInterface $departmentRepository;
    private CourseRepositoryInterface $courseRepository;
    public function __construct(CourseRepositoryInterface $courseRepository,DepartmentRepositoryInterface $departmentRepository) 
    {
        $this->courseRepository = $courseRepository;
        $this->departmentRepository = $departmentRepository;
    }


    public function index(Request $request)
    {
        $this->authorize('index',Course::class);
        $query = $this->courseRepository->index();
        $departmentFilter = $request->department;
        $creditFilter = $request->credit;
    
        if ($departmentFilter) {
            $query->where('department_id', '=', $departmentFilter);
        }
        if ($creditFilter) {
            $query->where('credit_hours', '=', $creditFilter);
        }
        $courses = $query->paginate(20);
        $courses->appends([
            'credit'=>$creditFilter,
            'department'=>$departmentFilter
        ]);
        // dd($courses);   
        return view('admin.courses.courses-index', compact('courses', 'departmentFilter', 'creditFilter'));
    }

    public function create()
    {
        $this->authorize('create',Course::class);

        $departments=$this->departmentRepository->index();
        return view('admin.courses.courses-create',compact('departments'));
    }


    public function store(Request $request)
    {
        $validated=$request->validate([
            'name'=>'required|min:3|max:20,unique:courses,name',
            'department_id'=>'required',
            'full_mark'=>'required|integer|max:100',
            'credit_hours'=>'required|integer|in:2,3',
            'description'=>'required|string|max:100|min:5',
        ]);
        Course::create($validated);
        return back()->with('success','Course Added Successfuly');
    }


    public function edit($id)
    {
        $this->authorize('edit',Course::class);
        $course=$this->courseRepository->find($id);
        $departments=$this->departmentRepository->index();
        return view('admin.courses.courses-edit',compact('course','departments'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update',Course::class);

        $course = $this->courseRepository->find($id);
    
        $validated = [
            'department_id' => 'required',
            'full_mark' => 'required|integer|max:100',
            'credit_hours' => 'required|integer|in:2,3',
            'description' => 'required|string|max:100|min:5',
        ];
    
        if ($course->name != $request->name) {
            $validated['name'] = 'required|min:3|max:20|unique:courses,name';
        }

        $validated = $request->validate($validated);
        $course->update($validated);
        $course->save();
    
        return redirect(route('courses'))->with('success', 'Course Updated Successfully');
    }


    public function destroy($id)
    {
        $this->authorize('destroy',Course::class);

        $course=$this->courseRepository->find($id);
        $course->delete();
        return back()->with('deleted','Course Archived Successfuly');
    }

}
