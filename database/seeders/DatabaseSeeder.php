<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Medicine;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Medicine::factory(10)->create();
        Employee::factory(10)->create();
    }
}
