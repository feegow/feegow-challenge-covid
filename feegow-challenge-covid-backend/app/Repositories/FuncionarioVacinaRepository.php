<?php

namespace App\Repositories;

use App\Models\Funcionario;
use App\Models\Vacina;
use App\Models\Vacinacao;

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

    public function findByVacinaId($vacinaId)
    {
        return Funcionario::whereHas('vacinas', function ($query) use ($vacinaId) {
            $query->where('vacina_id', $vacinaId);
        })->get();
    }

    public function findByFuncionarioId($funcionarioId)
    {
        return Funcionario::with(['vacinas' => function ($query) use ($funcionarioId) {
            $query->wherePivot('funcionario_id', $funcionarioId);
        }])->find($funcionarioId);
    }

    public function findByFuncionarioCpf($funcionarioCpf)
    {
        return Funcionario::with(['vacinas' => function ($query) use ($funcionarioCpf) {
            $query->whereHas('funcionarios', function ($query) use ($funcionarioCpf) {
                $query->where('cpf', $funcionarioCpf);
            });
        }])->where('cpf', $funcionarioCpf)->first();
    }
    
    public function find($id)
    {
        return Vacinacao::find($id);
    }
}