<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->words(4, true),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber('regex:/^\d{11}$/'),
            'status' => fake()->randomElement(['active','disable']),
            'designation' => fake()->randomElement(['doctor','assistant']),
                        
            'department_id' => function () {
                return Department::first()->id;
            },
            'course_id' => function () {
                $teacher = Teacher::inRandomOrder()->first();
                return Course::where('department_id', $teacher->department_id)->inRandomOrder()->first()->id;
            },
            
        ];
    }
}
