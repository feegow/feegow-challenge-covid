<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'cpf';
    protected $fillable = [
        'name',
        'cpf',
        'dob',
        'comorbidities'
    ];

    protected $casts = [
        'dob' => 'datetime',
    ];

    public function doses(): HasMany
    {
        return $this->hasMany(Dose::class);
    }

    public function getCpfMaskedAttribute(): string
    {
        return substr($this->cpf, 0, 3) . '.***.***-**';
    }
}
