<?php

namespace App\Repositories;

use App\Models\Funcionario;
use App\Models\Vacina;

class FuncionarioVacinaRepository
{
    public function addVacinaToFuncionario($funcionarioCpf, $vacinaId, $dadosVacina)
    {
        $funcionario = Funcionario::where('cpf', $funcionarioCpf)->firstOrFail();
        $funcionario->vacinas()->attach($vacinaId, $dadosVacina);
    }

    public function updateVacinaFuncionario($funcionarioCpf, $vacinaId, $dose, $dadosVacina)
    {
        $funcionario = Funcionario::where('cpf', $funcionarioCpf)->firstOrFail();
        $funcionario->vacinas()->updateExistingPivot($vacinaId, array_merge($dadosVacina, ['dose' => $dose]));
    }

    public function removeVacinaFromFuncionario($funcionarioCpf, $vacinaId, $dose)
    {
        $funcionario = Funcionario::where('cpf', $funcionarioCpf)->firstOrFail();
        $funcionario->vacinas()->wherePivot('dose', $dose)->detach($vacinaId);
    }
}
