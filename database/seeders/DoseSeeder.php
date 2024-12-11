<?php

namespace Database\Seeders;

use App\Models\Dose;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dose::factory()->count(rand(0,3))->create();
    }
}
