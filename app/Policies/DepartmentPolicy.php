<?php

namespace App\Policies;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function index(User $user)
    {
        return in_array($user->type,['super_admin','admin','college_advisor']);
    }
    public function create(User $user)
    {
        return $user->type==='super_admin';
    }

    public function edit(User $user)
    {
        return $user->type==='super_admin';
    }
    public function update(User $user)
    {
        return $user->type==='super_admin';
    }

    public function destroy(User $user)
    {
        return $user->type==='super_admin';
    }

    public function restore(User $user)
    {
        //
    }

}
