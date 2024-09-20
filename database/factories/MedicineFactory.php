<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->companySuffix(),
            'lot' => $this->faker->randomNumber(5),
            'expiration_date' => $this->faker->dateTimeBetween('-2 months', '+5 months'),
        ];
    }
}
