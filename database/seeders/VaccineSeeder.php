<?php

namespace Database\Seeders;

use App\Models\Vaccine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineSeeder extends Seeder
{
    public function run(): void
    {
        Vaccine::factory()->create([
            'name' => fake()->word(),
            'batch' => fake()->regexify('[A-Z]{5}[0-4]{4}'),
            'expiry' => fake()->dateTimeBetween('+2 years', '+5 years'),
        ]);
    }
}
