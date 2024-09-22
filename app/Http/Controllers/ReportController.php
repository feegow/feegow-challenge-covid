<?php

namespace App\Http\Controllers;

use App\Events\ReportRequested;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::paginate(10);
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        $name = 'employees-without-doses-' . date('d-m-Y-H-i-s');

        $report = Report::create([
            'status' => 'generating',
            'file_name' => "{$name}"
        ]);

        ReportRequested::dispatch($report);

        return redirect()->route('report.index')->with('success', 'Relatório em fila de processamento!');
    }

    public function download($fileName)
    {
        return response()->download(storage_path('app/private/reports/' . $fileName . '.csv'));
    }

    public function delete(Report $report)
    {
        if (!Storage::exists("reports/{$report->file_name}.csv")) {
            return redirect()->route('report.index')->with('error', 'Relatório não encontrado!');
        }

        Storage::delete("reports/{$report->file_name}.csv");
        $report->delete();

        return redirect()->route('report.index')->with('success', 'Relatório deletado com sucesso!');
    }
}
