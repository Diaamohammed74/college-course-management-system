<?php

namespace App\Http\Controllers\Admin\Faculty;

use App\Models\User;
use App\Helpers\MyEnum;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;

class UserController extends Controller
{
        private UserRepositoryInterface $userRepository;
        private DepartmentRepositoryInterface $departmentRepository;

    public function __construct(UserRepositoryInterface $userRepository,DepartmentRepositoryInterface $departmentRepository) 
    {
        $this->userRepository = $userRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function login()
    {
        return view("login");
    }

    public function loginrequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter a valid email address',
        ]);
        $credentials=Auth::attempt($request->except("_token"));
        if($credentials){
        return redirect(route('home'))->with('success','Logged in Successfuly');
        }
        return redirect('login')->withErrors([
            'email'=>'Failed!',
            'password'=>'Failed!',
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return view("login");
    }

    public function show(Request $request)
    {
        $this->authorize('show',User::class);
        $query=$this->userRepository->getAllUsers();
        $statusFilter=$request->status;
        $typeFilter=$request->type;
        if ($statusFilter) {
            $query->where('status','=',$statusFilter);
        }
        if ($typeFilter) {
            $query->where('type','=',$typeFilter);
        }
        $type=MyEnum::getEnumOptions('users','type');
        $status=MyEnum::getEnumOptions('users','status');
        $users=$query->paginate(20);
        $users->appends([
            'status'=>$statusFilter,
            'type'=>$typeFilter
        ]);
        return view('admin.users.users-index',compact('users','status','type','typeFilter','statusFilter'));
    }

    public function create()
    {
        $this->authorize('create',User::class);
        $types=MyEnum::getEnumOptions('users','type');
        return view('admin.users.users-create',compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3|max:20|string',
            'email'=>'required|min:4|max:50|email|unique:users,email',
            'password'=>'required|min:8',
            'type'=>'required',
        ]);
        $password=Hash::make($request->password);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$password,
            'type'=>$request->type,
        ]);
        return back()->with('success',"$request->type Member Added Successfuly");
    }

    public function edit($id)
    {
        $this->authorize('edit',User::class);

        $user=$this->userRepository->find($id);
        $types=MyEnum::getEnumOptions('users','type');
        $status=MyEnum::getEnumOptions('users','status');
        return view('admin.users.users-edit',compact('user','status','types'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update',User::class);

        $user=$this->userRepository->find($id);
        
        if (!$request->filled('password')){
            $request->validate([
                'name'=>'required|min:3|max:20|string',
                'email'=>['required','min:4','max:50','email',
                Rule::unique('users', 'email')->ignore($user),],
                'status'=>'required',
                'type'=>'required',
            ]);
            $user->update($request->except(['_token','id','password']));
            $user->save();
        }else {
            $request->validate([
                'name'=>'required|min:3|max:20|string',
                'email'=>['required','min:4','max:50','email',
                Rule::unique('users', 'email')->ignore($user),],
                'status'=>'required',
                'type'=>'required',
                'password' => 'required|min:8|confirmed',
            ]);
            $password=Hash::make($request->password);
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'status'=>$request->status,
                'type'=>$request->type,
                'password'=>$password
            ]);
            // $user->update($request->except(['_token','id']));
            // $user->save();
        }
        return redirect(route('users'))->with('success','User Updated Successfuly');
    }

    public function destroy($id)
    {
        $this->authorize('destroy',User::class);

        $user=$this->userRepository->find($id);
        $user->delete();
        return back()->with('deleted','User Deleted Successfuly');
    }
}