<?php

namespace App\Http\Controllers;

use App\Repositories\VacinaRepository;
use Illuminate\Http\Request;
use App\Models\Funcionario;

class VacinaController extends Controller
{
    protected $vacinaRepo;

    public function __construct(VacinaRepository $vacinaRepo)
    {
        $this->vacinaRepo = $vacinaRepo;
    }

    public function index()
    {
        $vacinas = $this->vacinaRepo->getAll();
        return response()->json($vacinas);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'lote' => 'required|string|max:255',
            'data_validade' => 'required|date',
        ]);

        $vacina = $this->vacinaRepo->create($validatedData);
        return response()->json($vacina, 201);
    }

    public function show($id)
    {   
        $vacina = $this->vacinaRepo->find($id);
        if (!$vacina) {
            return response()->json(['message' => 'Vacina não encontrado.'], 404);
        }
        return response()->json($vacina);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'lote' => 'required|string|max:255',
            'data_validade' => 'required|date',
        ]);

        $vacina = $this->vacinaRepo->find($id);
        $vacina = $this->vacinaRepo->update($vacina, $validatedData);
        return response()->json($vacina);
    }

    public function destroy($id)
    {
        $vacina = $this->vacinaRepo->find($id);
        $this->vacinaRepo->delete($vacina);
        return response()->json(null, 204);
    }
}
