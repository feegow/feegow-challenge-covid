<?php

namespace App\Repositories;

use App\Models\Vacina;

class VacinaRepository
{
    public function getAll()
    {
        return Vacina::all();
    }

    public function create(array $data)
    {
        return Vacina::create($data);
    }

    public function findOrFail($id)
    {
        return Vacina::findOrFail($id);
    }

    public function update(Vacina $vacina, array $data)
    {
        $vacina->update($data);
        return $vacina;
    }

    public function delete(Vacina $vacina)
    {
        return $vacina->delete();
    }
}
