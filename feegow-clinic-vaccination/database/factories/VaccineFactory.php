<?php

namespace Database\Factories;

use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Factories\Factory;

class VaccineFactory extends Factory
{
    protected $model = Vaccine::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Pfizer-BioNTech', 'Moderna', 'Johnson & Johnson', 'AstraZeneca', 'Sinovac']),
            'lot_number' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{4}'),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+2 years'),
        ];
    }

    public function createOrUpdate(array $attributes = [])
    {
        $vaccine = Vaccine::where('name', $attributes['name'] ?? $this->definition()['name'])->first();

        if ($vaccine) {
            $vaccine->update(array_merge($this->definition(), $attributes));
        } else {
            $vaccine = $this->create($attributes);
        }

        return $vaccine;
    }
}
