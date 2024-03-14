<?php

namespace App\Repositories;

use App\Models\Funcionario;

class FuncionarioRepository
{
    public function getAll()
    {
        return Funcionario::all();
    }

    public function create(array $data)
    {
        return Funcionario::create($data);
    }

    public function findOrFail($id)
    {
        return Funcionario::findOrFail($id);
    }

    public function update(Funcionario $funcionario, array $data)
    {
        $funcionario->update($data);
        return $funcionario;
    }

    public function delete(Funcionario $funcionario)
    {
        return $funcionario->delete();
    }
}
