<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{

    /**
     * @inheritDoc
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('pt_BR');

        return [
            'name' => $this->faker->name(),
            'cpf' => $faker->cpf(),
            'dob' => $this->faker->dateTimeBetween('-60 years', '-18 years'),
            'comorbidities' => $this->faker->boolean(),
        ];
    }
}
