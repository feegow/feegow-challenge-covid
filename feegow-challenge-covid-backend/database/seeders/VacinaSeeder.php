<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VacinaSeeder extends Seeder
{
    public function run()
    {
        DB::table('vacinas')->insert([
            ['nome' => 'Vacina A', 'lote' => 'LoteA1', 'data_validade' => '2025-12-31'],
            ['nome' => 'Vacina B', 'lote' => 'LoteB1', 'data_validade' => '2025-12-31'],
            ['nome' => 'Vacina C', 'lote' => 'LoteC1', 'data_validade' => '2025-12-31'],
        ]);
    }
}
