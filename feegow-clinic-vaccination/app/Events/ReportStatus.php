<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReportStatus
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $report;
    public $status;

    /**
     * Create a new event instance.
     */
    public function __construct($report, $status)
    {
        $this->report = $report;
        $this->$status = $status;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('reports'),
        ];
    }
}
