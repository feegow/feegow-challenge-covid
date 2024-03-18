<?php

namespace App\Repositories;

use App\Models\Funcionario;
use App\Models\Vacina;
use App\Models\Vacinacao;

class FuncionarioVacinaRepository
{

    public function getAll()
    {
        return Vacinacao::all();
    }

    public function addVacinaToFuncionario(array $data,)
    {
        return Vacinacao::create($data);

    }

    public function updateVacinaFuncionario($funcionarioCpf, $vacinaId, $dose, $dadosVacina)
    {
        $funcionario = Funcionario::where('cpf', $funcionarioCpf)->firstOrFail();
        $funcionario->vacinas()->updateExistingPivot($vacinaId, array_merge($dadosVacina, ['dose' => $dose]));
    }

    public function removeVacinaFromFuncionario($id)
    {
        return Vacinacao::find($id)->delete();
    }

    public function findByVacinaId($vacinaId)
    {
        return Funcionario::whereHas('vacinas', function ($query) use ($vacinaId) {
            $query->where('vacina_id', $vacinaId);
        })->get();
    }

    public function findByFuncionarioId($funcionarioId)
    {
        return Funcionario::with(['vacinas' => function ($query) {
             $query->select('vacinas.id', 'vacinas.nome', 'vacinas.lote',  'vacinas.data_validade', 'funcionarios_vacinas.dose', 'funcionarios_vacinas.data_dose');
        }])->find($funcionarioId);
    }

    public function findByVacinaIdAndFuncionarioId($vacinaId, $funcionarioId)
    {
        return Funcionario::with(['vacinas' => function ($query) use ($vacinaId) {
            $query->where('vacina_id', $vacinaId);
        }])->find($funcionarioId);
    }

    
    public function find($id)
    {
        return Vacinacao::find($id);
    }

    public function update(Vacinacao $vacinacao, array $data)
    {
        $vacinacao->update($data);
        return $vacinacao;
    }
}