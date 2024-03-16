<?php

namespace App\Repositories;

use App\Models\Funcionario;
use Illuminate\Support\Facades\Log;

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

    public function find($id)
    {
        return Funcionario::find($id);
    }

    public function update(Funcionario $funcionario, array $data)
    {
        Log::info('Atualizando funcionário: ' . $funcionario->id);
        $funcionario->save($data);
        return $funcionario;
    }

    public function delete(Funcionario $funcionario)
    {
        return $funcionario->delete();
    }
}
