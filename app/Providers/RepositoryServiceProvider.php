<?php

namespace App\Providers;
use App\Interfaces\StudentRepositoryInterface;
use App\Repositories\StudentRepository;
use App\Repositories\UserRepository;
use App\Repositories\LevelRepository;
use App\Repositories\CourseRepository;
use App\Repositories\TeacherRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\DepartmentRepository;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\LevelRepositoryInterface;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(LevelRepositoryInterface::class, LevelRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
    }
    


    public function boot()
    {
        //
    }
}
