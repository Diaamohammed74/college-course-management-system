<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return in_array($user->type,['super_admin','admin','college_advisor']);
    }

    public function create(User $user)
    {
        return in_array($user->type,['super_admin','admin']);
    }

    public function edit(User $user)
    {
        return in_array($user->type,['super_admin','admin']);
    }
    public function update(User $user)
    {
        return in_array($user->type,['super_admin','admin']);
    }

    public function destroy(User $user)
    {
        return in_array($user->type,['super_admin','admin']);
    }

    public function restore(User $user)
    {
        return in_array($user->type,['super_admin','admin']);
    }

    public function forceDelete(User $user)
    {
        return in_array($user->type,['super_admin','admin']);
    }
}
