<?php

namespace App\Listeners;

use App\Models\Employee;
use App\Events\ReportRequested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Jimmyjs\ReportGenerator\ReportMedia\ExcelReport;

class ReportRequestListener implements ShouldQueue
{
    private ExcelReport $report;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->report = new ExcelReport();
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $requestReport = $event->reportRequest;

        try {
            $employees  = Employee::leftJoin('doses', 'employees.cpf', '=', 'doses.employee_cpf')
                ->whereNull('doses.employee_cpf')
                ->select('employees.name', 'employees.cpf')
                ->groupBy('employees.cpf');

            $this->report->of($requestReport->file_name, ['csv'], $employees, ['nome' => 'name', 'cpf'])
                ->showMeta(false)
                ->showNumColumn(false)
                ->store("reports/{$requestReport->file_name}");

            $requestReport->update(['status' => 'completed']);
        } catch (\Exception $e) {
            $requestReport->update(['status' => 'failed']);
            Log::error($e->getMessage());
        }
    }

    public function subscribe()
    {
        return [
            ReportRequested::class => 'handle',
        ];
    }
}
