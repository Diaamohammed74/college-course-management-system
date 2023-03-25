<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => fake()->words(3, true),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'status' => fake()->randomElement(['grad','undergrad']),
            'department_id' => function () {
                return Department::first()->id;
            },
            'level_id' => function () {
                return Level::first()->id;
            },
        ];
    }
}
