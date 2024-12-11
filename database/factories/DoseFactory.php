<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dose>
 */
class DoseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'vaccine_id' => Vaccine::factory(),
            'dose_date' => fake()->dateTimeBetween('-1 year'),
        ];
    }
}
