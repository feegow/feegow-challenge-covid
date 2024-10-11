<?php

namespace App\Jobs;

use App\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;

class GenerateUnvaccinatedReportJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Buscar funcionários sem a primeira dose
        $unvaccinated = Employee::whereNull('first_dose_date')->get(['cpf', 'full_name']);

        // Lógica para gerar e salvar o relatório, por exemplo, salvar em um arquivo:
        Storage::put('reports/unvaccinated_report.csv', $unvaccinated->toJson());
    }
}
