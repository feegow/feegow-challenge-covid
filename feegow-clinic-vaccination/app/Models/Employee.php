<?php

namespace App\Models;

use App\Concerns\HasEventTriggers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, HasEventTriggers;

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
        return substr($value, 0, 3) . '***.***-**';
    }

    public function getFullCpf()
    {
        return $this->attributes['cpf'];
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

    public function scopeUnvaccinated($query)
    {
        return $query->whereDoesntHave('vaccine')
            ->orWhereNull('first_dose_date');
    }

    public function scopeVaccinationReport($query)
    {
        return $query->with('vaccine')
            ->selectRaw('vaccine_id, COUNT (*) as total, SUM(CASE WHEN first_dose_date IS NOT NULL THEN 1 ELSE 0 END) as vaccinated_count')
            ->groupBy('vaccine_id');
    }
}
