<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacina extends Model
{
    protected $fillable = ['nome', 'lote', 'data_validade'];

    public function funcionarios()
    {
        return $this->belongsToMany(Funcionario::class, 'funcionarios_vacinas')
                    ->withPivot('data_dose', 'dose')
                    ->withTimestamps();
    }
}
