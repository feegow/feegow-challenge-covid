<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        $birthDate = $this->faker->dateTimeBetween('-70 years', '-18 years');
        $firstDoseDate = $this->faker->dateTimeBetween('2021-01-01', 'now');
        $secondDoseDate = $this->faker->dateTimeBetween($firstDoseDate, 'now');
        $thirdDoseDate = $this->faker->optional(0.7)->dateTimeBetween($secondDoseDate, 'now');

        return [
            'cpf' => $this->faker->numerify('###########'),
            'full_name' => $this->faker->name(),
            'birth_date' => $birthDate,
            'first_dose_date' => $firstDoseDate,
            'second_dose_date' => $secondDoseDate,
            'third_dose_date' => $thirdDoseDate,
            'has_comorbidity' => $this->faker->boolean(20), // 20% chance of having comorbidity
            'updated_at' => now(),
            'created_at' => now(),
        ];
    }

    public function createOrUpdate(array $attributes = [])
    {
        $employee = Employee::where('cpf', $attributes['cpf'] ?? $this->definition()['cpf'])->first();

        if ($employee) {
            $employee->update(array_merge($this->definition(), $attributes));
        } else {
            $employee = $this->create($attributes);
        }

        return $employee;
    }
}
