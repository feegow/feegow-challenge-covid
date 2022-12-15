<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;
    protected $table = 'funcionarios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'vacinaAplicada_id', 'nomeCompleto', 'cpf', 'portadorComorbidade', 
        'dataNascimento', 'dataPrimeiraDose', 'dataSegundaDose', 'dataTerceiraDose', 'vacinaAplicada'
    ];
}
