<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Vacina;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class FuncionarioVacinaSeeder extends Seeder
{
    public function run()
    {
        // Insere 10 funcionários
        #Funcionario::factory()->count(10)->create()->each(function ($funcionario, $key) {
        Factory::factoryForModel(Funcionario::class)->count(10)->create()->each(function ($funcionario, $key) {
            // Define a lógica de vacinação
            if ($key == 0) {
                // 1 funcionário toma apenas 1 dose da primeira vacina
                $funcionario->vacinas()->attach(1, ['data_dose' => now(), 'dose' => 1]);
            } elseif (in_array($key, [1, 2])) {
                // 2 funcionários tomam 2 doses (dose 1 e 2 da vacina 1)
                $funcionario->vacinas()->attach(1, ['data_dose' => now(), 'dose' => 1]);
                $funcionario->vacinas()->attach(1, ['data_dose' => now()->addMonth(1), 'dose' => 2]);
            } elseif ($key > 2 && $key < 9) {
                // 6 restantes tomam as 3 vacinas
                foreach ([1, 2, 3] as $vacina_id) {
                    $funcionario->vacinas()->attach($vacina_id, ['data_dose' => now()->addMonths($vacina_id), 'dose' => $vacina_id]);
                }
            }
            // O 1 funcionário restante não toma vacina, então não precisa de ação.
        });
    }
}
