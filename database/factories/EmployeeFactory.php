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
            'emp_id' => fake()->phoneNumber,
            'firstname' => fake()->firstname(),
            'middlename' =>  'A',
            'lastname' =>  fake()->lastname(),
            'contact' =>  fake()->phoneNumber,
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address,
            'position' => fake()->title(),
            'status' => '0',
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
        ];
    }
}