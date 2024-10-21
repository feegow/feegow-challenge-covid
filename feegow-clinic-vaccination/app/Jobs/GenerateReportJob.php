<?php

namespace App\Jobs;

use App\Models\Employee;
use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class GenerateReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function handle($anonymizeCpf = true)
    {
        if ($this->report->status === 'canceled') {
            return;
        }

        // Update status to 'processing'
        $this->report->update(['status' => 'processing']);

        // Fetch unvaccinated employees
        $unvaccinatedEmployees = Employee::unvaccinated()->get(['full_name', 'cpf']);
        // Generate CSV report
        $fileName = 'report_unvaccinated_' . $this->report->id . '.csv';

        // Determine the correct file path based on the filesystem driver
        $filePath = config('filesystems.default') === 'local'
        ? 'private/reports/' . $fileName
        : 'reports/' . $fileName;

        $fullPath = storage_path('app/' . $filePath);

        // Ensure the reports directory exists
        $reportsDir = dirname($fullPath);
        if (!file_exists($reportsDir)) {
            mkdir($reportsDir, 0755, true);
        }

        $file = fopen($fullPath, 'w');
        fputcsv($file, ['Nome', 'CPF']); // CSV headers

        foreach ($unvaccinatedEmployees as $employee) {
            $fileContent = [
                $employee->full_name,
                $anonymizeCpf ? $employee->getFullCpf() : $employee->cpf,
            ];

            fputcsv($file, $fileContent);
        }

        fclose($file);

        // Update report status
        $this->report->update([
            'status' => 'completed',
            'file_path' => $filePath,
            'completed_at' => now(),
        ]);
    }

    /**
     * Handle a job failure.
     */
    public function failed(?Throwable $exception): void
    {
        // Send user notification of failure, etc...
        Log::error('GenerateReportJob failed: ' . $exception->getMessage());
    }
}
