<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Report;
use App\Models\Vaccine;
use Illuminate\Support\Facades\Cache;

class StatsController extends Controller
{
    public function index()
    {

        $cachedStats = Cache::remember('stats', 60, function () {

            $employees = Employee::count();
            $vaccines = Vaccine::count();
            $reports = Report::count();

            return [
                'employees' => $employees,
                'vaccines' => $vaccines,
                'reports' => $reports,
            ];

        });

        return response()->json($cachedStats);
    }

    public function vaccinationReport()
    {
        $cachedReport = Cache::remember('vaccination_report', 60, function () {
            $report = Employee::vaccinationReport()->get();

            return $report->map(function ($item) {
                return [
                    'vaccine' => $item->vaccine->short_name ?? 'Não vacinados',
                    'total' => $item->total,
                    'vaccinated_count' => $item->vaccinated_count,
                ];
            });
        });

        return response()->json($cachedReport);
    } 
}
