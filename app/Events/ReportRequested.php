<?php

namespace App\Events;

use App\Models\Report;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReportRequested
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Report $reportRequest;
    /**
     * Create a new event instance.
     */
    public function __construct(Report $report)
    {
        $this->reportRequest = $report;
    }
}
