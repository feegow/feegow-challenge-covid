<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFuncionarioRequest;
use App\Http\Requests\UpdateFuncionarioRequest;
use App\Repositories\FuncionarioRepository;
use App\Models\Funcionario;
class FuncionarioController extends Controller
{
    protected $funcionarioRepo;

    public function __construct(FuncionarioRepository $funcionarioRepo)
    {
        $this->funcionarioRepo = $funcionarioRepo;
    }

    public function index()
    {
        $funcionarios = $this->funcionarioRepo->getAll();
        if (!$funcionarios) {
            return response()->json(['message' => 'Nenhum Funcionário encontrado.'], 404);
        }
        return response()->json($funcionarios);
    }

    public function store(StoreFuncionarioRequest $request)
    {
        $funcionario = Funcionario::create($request->validated());
        return response()->json($funcionario, 201);
    }
   
    public function show($id)
    {
        $funcionario = $this->funcionarioRepo->find($id);
        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado.'], 404);
        }
        return response()->json($funcionario);
    }

    public function update(UpdateFuncionarioRequest $request)
    {
        $funcionario = $this->funcionarioRepo->find($request->id);
        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado.'], 404);
        }
        var_dump($request->all());
        $funcionario = $this->funcionarioRepo->update($funcionario, $request->all());
        return response()->json($funcionario);
    }

    public function destroy($id)
    {
        $funcionario = $this->funcionarioRepo->find($id);
        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado.'], 404);
        }
        $this->funcionarioRepo->delete($funcionario);
        return response()->json(null, 204);
    }
}
