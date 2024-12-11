<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Dose extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'vaccine_id', 'dose_date'];

    protected function doseDateFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->dose_date)->format('m/d/Y'),
        );
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function vaccine(): BelongsTo
    {
        return $this->belongsTo(Vaccine::class);
    }
}
