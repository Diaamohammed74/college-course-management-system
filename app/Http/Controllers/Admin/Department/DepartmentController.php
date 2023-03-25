<?php

namespace App\Http\Controllers\Admin\Department;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;

class DepartmentController extends Controller
{
    private DepartmentRepositoryInterface $departmentRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository,UserRepositoryInterface $userRepository) 
    {
        $this->departmentRepository = $departmentRepository;
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $this->authorize('index',Department::class);

        $departments=$this->departmentRepository->index();
        return view('admin.departments.departments-index',compact('departments'));
    }


    public function create()
    {
        $this->authorize('create',Department::class);
            $users=$this->departmentRepository->create();
            return view('admin.departments.departments-create',compact('users'));
    }

    public function store(Request $request)
    {
        $validated=$request->validate([
            'name'=>'required|max:20|min:3',
            'department_head'=>'required|unique:departments,department_head',
        ]);
        Department::create($validated);
        return back()->with('success','Department Added Successfuly');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $this->authorize('edit',Department::class);

        $department=$this->departmentRepository->edit($id);
        $users=$this->userRepository->getSuperAdmin();
        return view('admin.departments.departments-edit',compact('department','users'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update',Department::class);

        $department=Department::findOrFail($id);
        if ($request->department_head==$department->department_head)
        {
            $request->validate([
                'name'=>'required|max:20|min:3',
            ]);
            Department::findOrFail($id)->update([
                'name'=>$request->name
            ]);
        }
        else
        {
            $request->validate([
            'name'=>'required|max:20|min:3',
            'department_head'=>'required|unique:departments,department_head',
        ]);
        Department::findOrFail($id)->update([
            'name'=>$request->name,
            'department_head'=>$request->department_head
        ]);
        }
        return redirect(route('departments'))->with('success','deparmtent updated successfuly');
    }


    public function destroy($id)
    {
        $this->authorize('destroy',Department::class);

        $this->departmentRepository->destroy($id);
        return back()->with('deleted','This Department Deleted Successfuly');
    }
}
