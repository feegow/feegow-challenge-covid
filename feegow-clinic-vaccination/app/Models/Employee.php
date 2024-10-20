<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpf',
        'full_name',
        'birth_date',
        'first_dose_date',
        'second_dose_date',
        'third_dose_date',
        'vaccine_id',
        'has_comorbidity',
    ];

    // Accessor para anonimizar o CPF
    public function getCpfAttribute($value)
    {
        return substr($value, 0, 3).'***.***-**';
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }
}
