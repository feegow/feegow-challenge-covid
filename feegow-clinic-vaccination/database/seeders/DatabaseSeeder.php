<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
use App\Models\Vaccine;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $usedCpfs = [];

    public function run(): void
    {
        echo "Starting database seeding...\n";
        // Create admin user
        User::factory()->createOrUpdate([
            'name' => 'Test User',
            'email' => 'exemplo@gmail.com',
            'password' => '12345678',
        ]);
        echo "Admin user created.\n";

        // Create 5 vaccines
        $vaccines = [
            ['name' => 'Pfizer-BioNTech', 'short_name' => 'PFIZER', 'weight' => 40],
            ['name' => 'Moderna', 'short_name' => 'MODERNA', 'weight' => 30],
            ['name' => 'Johnson & Johnson', 'short_name' => 'J&J', 'weight' => 15],
            ['name' => 'AstraZeneca', 'short_name' => 'ASTRAZENECA', 'weight' => 10],
            ['name' => 'Sinovac', 'short_name' => 'SINOVAC', 'weight' => 5],
        ];

        foreach ($vaccines as $vaccine) {
            Vaccine::factory()->createOrUpdate([
                'name' => $vaccine['name'],
                // Other fields will be filled by the factory
            ]);
        }
        echo "5 vaccines created.\n";

        // Create 20,000 employees
        $vaccines = Vaccine::all();
        $chunkSize = 1000;
        $totalEmployees = 20000;
        $createdEmployees = 0;

        echo "Creating {$totalEmployees} employees...\n";

        Employee::factory()->count($totalEmployees)->make()->chunk($chunkSize)->each(function ($chunk) use ($vaccines, &$createdEmployees, $totalEmployees) {
            $data = $chunk->map(function ($employee) use ($vaccines) {
                $vaccine = $this->getWeightedRandomVaccine($vaccines->toArray());
                return [
                    'full_name' => $employee->full_name,
                    'cpf' => $this->generateUniqueCpf(),
                    'birth_date' => $employee->birth_date,
                    'first_dose_date' => $employee->first_dose_date,
                    'second_dose_date' => $employee->second_dose_date,
                    'third_dose_date' => $employee->third_dose_date,
                    'vaccine_id' => $vaccines->firstWhere('name', $vaccine['name'])->id,
                    'has_comorbidity' => (mt_rand(1, 100) <= 20)
                ];
            })->toArray();

            Employee::insert($data);
            $createdEmployees += count($data);
            echo "Created {$createdEmployees} out of {$totalEmployees} employees.\n";
        });

        echo "Database seeding completed successfully!\n";
    }

    private function getWeightedRandomVaccine($vaccines)
    {
        $totalWeight = array_sum(array_column($vaccines, 'weight'));

        if ($totalWeight <= 0) {
            // If total weight is 0 or negative, return a random vaccine
            return $vaccines[array_rand($vaccines)];
        }

        $randomNumber = mt_rand(1, $totalWeight);

        foreach ($vaccines as $vaccine) {
            $randomNumber -= $vaccine['weight'];
            if ($randomNumber <= 0) {
                return $vaccine;
            }
        }

        // Fallback: return the last vaccine if something goes wrong
        return end($vaccines);
    }

    private function generateUniqueCpf(): string
    {
        do {
            $cpf = str_pad(mt_rand(0, 99999999999), 11, '0', STR_PAD_LEFT);
        } while (in_array($cpf, $this->usedCpfs));

        $this->usedCpfs[] = $cpf;
        return $cpf;
    }
}
