<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\Department;
use App\Policies\UserPolicy;
use App\Policies\DepartmentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Department::class=>DepartmentPolicy::class,
        User::class=>UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::define('is_super_admin', function($user) {
            return $user->type == 'super_admin';
        });
        Gate::define('is_admin', function($user) {
            return $user->type == 'admin';
        });
        Gate::define('is_college_advisor', function($user) {
            return $user->type == 'college_advisor';
        });
    }
}
