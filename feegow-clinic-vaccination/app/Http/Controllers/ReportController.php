<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Http\Resources\ReportResource;
use App\Jobs\GenerateReportJob;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 50);
        $reports = Report::paginate($perPage);

        return ReportResource::collection($reports);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportRequest $request)
    {
        $reportInProgress = Report::where('user_id', $request->user_id)
            ->whereIn('status', ['queued', 'processing'])
            ->first();

        if ($reportInProgress) {
            $reportInProgress->update(['status' => 'canceled']);
        }

        $newReport = Report::create($request->validated());
        GenerateReportJob::dispatch($newReport, $request->anonymize_cpf);

        return new ReportResource($newReport);
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        return new ReportResource($report);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReportRequest $request, Report $report)
    {
        $report->update($request->validated());

        return new ReportResource($report);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();

        // destroy the file also
        if ($report->file_path) {
            Storage::delete($report->file_path);
        }

        return response()->noContent();
    }
}
