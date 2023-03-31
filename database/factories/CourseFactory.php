<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => "Fmi Course".fake()->unique()->randomNumber(2, true) % 11,
            'description' => fake()->words(4, true),
            'credit_hours' => fake()->numberBetween(2, 3),
            'full_mark' => 100,
            'department_id' => function () {
                return Department::where('id',2)->first()->id;
            },
        ];
    }
}
