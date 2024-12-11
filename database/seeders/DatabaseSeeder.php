<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            EmployeeSeeder::class,
            VaccineSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);
    }
}
