<?php

namespace App\Http\Controllers;

use App\Repositories\FuncionarioVacinaRepository;
use Illuminate\Http\Request;

class FuncionarioVacinaController extends Controller
{
    protected $funcionarioVacinaRepo;

    public function __construct(FuncionarioVacinaRepository $funcionarioVacinaRepo)
    {
        $this->funcionarioVacinaRepo = $funcionarioVacinaRepo;
    }

    public function store(Request $request)
    {
        // Validação e lógica de request...
        $this->funcionarioVacinaRepo->addVacinaToFuncionario($request->funcionario_cpf, $request->vacina_id, [
            'data_dose' => $request->data_dose,
            'dose' => $request->dose
        ]);

        return response()->json(['message' => 'Vacinação registrada com sucesso!'], 201);
    }

    public function update(Request $request, $funcionario_cpf, $vacina_id, $dose)
    {
        // Validação e lógica de request...
        $this->funcionarioVacinaRepo->updateVacinaFuncionario($funcionario_cpf, $vacina_id, $dose, ['data_dose' => $request->data_dose]);

        return response()->json(['message' => 'Registro de vacinação atualizado com sucesso!']);
    }

    public function destroy($funcionario_cpf, $vacina_id, $dose)
    {
        $this->funcionarioVacinaRepo->removeVacinaFromFuncionario($funcionario_cpf, $vacina_id, $dose);

        return response()->json(['message' => 'Registro de vacinação removido com sucesso!'], 204);
    }
}
