<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::factory()->count(10)->create([
            'user_id' => User::inRandomOrder()->take(1)->id ?? User::factory(),
            'name' => fake()->name(),
            'birthday' => fake()->dateTimeBetween('-40 years', '-19 years'),
            'comorbidity' => fake()->random_int(0,1),
        ]);
    }
}
