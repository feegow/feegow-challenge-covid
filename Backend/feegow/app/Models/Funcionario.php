<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use  HasFactory;

    
    protected $table = "funcionario";
    protected $fillable = [
        'nome',
        'cpf',
        'dtNascimento',
        'idPrimeiraDoseCovid',
        'idSegundaDoseCovid',
        'idTerceiraDoseCovid',
        'comorbidade',
    ];

    public function dosesVacinaCovid()
    {
        return $this->hasMany(DoseVacinaCovid::class, 'idFuncionario');
    } 

}