<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;


class UserRepository implements UserRepositoryInterface 
{
    public function getSuperAdmin()
    {
        return User::where('type', '=', 'super_admin')->select('id', 'name')->get();
    }
    public function getAllUsers()
    {
        return User::select('id','name','email','status','type');
    }
    public function find($id)
    {
        return User::findOrFail($id);
    }
}

