<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = ['cpf', 'nome_completo', 'data_nascimento', 'portador_comorbidade'];

    public function vacinas()
    {
        return $this->belongsToMany(Vacina::class, 'funcionarios_vacinas')
                    ->withPivot('data_dose', 'dose')
                    ->withTimestamps();
    }
}
