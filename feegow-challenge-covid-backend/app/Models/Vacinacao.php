<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacinacao extends Model
{
    protected $model = Vacinacao::class;
    protected $table = 'funcionarios_vacinas';
    protected $fillable = ['funcionario_id', 'vacina_id', 'data_dose', 'dose'];
    
}
