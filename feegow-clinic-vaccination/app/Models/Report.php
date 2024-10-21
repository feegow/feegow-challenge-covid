<?php

namespace App\Models;

use App\Concerns\HasEventTriggers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Report extends Model
{
    use HasFactory, HasEventTriggers;

    protected $fillable = [
        'type',
        'status',
        'file_path',
        'user_id',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function getDateAttribute()
    {
        return $this->completed_at ? $this->completed_at->format('Y-m-d') : null;
    }

    /**
     * Generate a secure, temporary download link for the report's file.
     */
    public function getSecureDownloadLink(): ?string
    {
        if (empty($this->file_path)) {
            return null;
        }

        return URL::temporarySignedRoute(
            'download.file',
            now()->addMinutes(60),
            ['original' => $this->file_path]
        );
    }
}
