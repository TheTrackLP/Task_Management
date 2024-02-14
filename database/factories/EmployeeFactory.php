<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'emp_id' => fake()->randomNumber(7),
            'firstname' => fake()->firstname(),
            'middlename' =>  'A',
            'lastname' =>  fake()->lastname(),
            'contact' =>  fake()->phoneNumber,
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address,
            'position_id' => fake()->randomDigit,
            'status' => 'inactive',
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
        ];
    }
}