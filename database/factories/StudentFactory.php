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
            'name' => "FMI student".fake()->unique()->randomNumber(3, true) % 1001,
            'email' => fake()->email(),
            'phone' => '01550285811',
            'total_completed_hours'=>fake()->randomElement([0,50,100,140]),
            'status' => fake()->randomElement(['undergrad']),
            'department_id' => function () {
                return Department::where('id',2)->first()->id;
            },
            'level_id' => function () {
                return Level::first()->id;
            },
        ];
    }
}
