<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dose extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_cpf',
        'medicine_id',
        'date_applyed',
        'dose_number'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'cpf', 'employee_cpf');
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }
}
