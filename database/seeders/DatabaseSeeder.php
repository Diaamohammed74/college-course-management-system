<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // User::factory(20)->create();
        // Course::factory(20)->create();
        Student::factory(500)->create();
        // Teacher::factory(500)->create();
    }
}
