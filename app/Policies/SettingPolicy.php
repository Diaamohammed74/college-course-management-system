<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;
    public function show(User $user)
    {
        return in_array($user->type,['super_admin','admin']);
    }
    public function edit(User $user)
    {
        return $user->type === 'super_admin';
    }
    public function update(User $user)
    {
        return $user->type === 'super_admin';
    }
}
