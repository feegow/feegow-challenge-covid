<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoseVacinaCovid extends Model
{
    use HasFactory;

    protected $table = "dose_vacina_covid";
    protected $fillable = [
        'idFuncionario',
        'dtDoseCovid',
        'nome',
        'lote',
        'dtValidade',
       
    ];

    public function dosesVacinaCovid()
    {
        return $this->hasMany(Funcionario::class, 'idFuncionario');
    } 
}
