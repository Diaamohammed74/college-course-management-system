<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return $user->type === 'super_admin';
    }

    public function show(User $user)
    {
        return in_array($user->type,['super_admin','admin']);
    }

    public function create(User $user)
    {
        return $user->type === 'super_admin';
    }

    public function edit(User $user)
    {
        return $user->type === 'super_admin';
    }
    public function update(User $user)
    {
        return $user->type === 'super_admin';
    }

    public function delete(User $user)
    {
        return $user->type === 'super_admin';
    }

    public function restore(User $user)
    {
        return $user->type === 'super_admin';
    }

    public function forceDelete(User $user)
    {
        return $user->type === 'super_admin';
    }
}
