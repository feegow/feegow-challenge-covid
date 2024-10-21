<?php

namespace App\Models;

use App\Concerns\HasEventTriggers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vaccine extends Model
{
    use HasFactory, HasEventTriggers;

    protected $fillable = [
        'name',
        'short_name',
        'lot_number',
        'expiration_date',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
