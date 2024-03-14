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
        return response()->json($funcionarios);
    }

    public function store(StoreFuncionarioRequest $request)
    {
        $funcionario = Funcionario::create($request->validated());
        return response()->json($funcionario, 201);
    }

    public function show($id)
    {
        $funcionario = $this->funcionarioRepo->findOrFail($id);
        return response()->json($funcionario);
    }

    public function update(UpdateFuncionarioRequest $request, Funcionario $funcionario)
    {
        $funcionario->update($request->validated());
        return response()->json($funcionario);
    }

    public function destroy($id)
    {
        $funcionario = $this->funcionarioRepo->findOrFail($id);
        $this->funcionarioRepo->delete($funcionario);
        return response()->json(null, 204);
    }
}
