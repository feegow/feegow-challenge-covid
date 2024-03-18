<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Vacina;
use App\Repositories\FuncionarioVacinaRepository;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Domain\Use_cases\VacinacaoUseCases;
use Exception;

class FuncionarioVacinaController extends Controller
{
    protected $funcionarioVacinaRepo;
    protected $vacinacaoUseCases;

    public function __construct(FuncionarioVacinaRepository $funcionarioVacinaRepo, VacinacaoUseCases $vacinacao)
    {
        $this->funcionarioVacinaRepo = $funcionarioVacinaRepo;
        $this->vacinacaoUseCases = $vacinacao;
    }

    public function index()
    {
        $funcionarioVacinas = $this->funcionarioVacinaRepo->getAll();

        return response()->json($funcionarioVacinas);
    }

    public function show($id)
    {
        $funcionarioVacinaRepo = $this->funcionarioVacinaRepo->find($id);
        if (!$funcionarioVacinaRepo) {
            return response()->json(['message' => 'Vacinação não encontrada.'], 404);
        }
        return response()->json($funcionarioVacinaRepo);
    }

    public function indexByVacinaId($vacina_id)
    {
        $funcionarioVacinas = $this->funcionarioVacinaRepo->findByVacinaId($vacina_id);

        if ($funcionarioVacinas->isEmpty()) {
            return response()->json(['message' => 'Nenhuma vacinação de funcionário encontrada.'], 404);
        }

        return response()->json($funcionarioVacinas);
    }

    public function indexByFuncionarioId($funcionario_id)
    {
        $funcionario = $this->funcionarioVacinaRepo->findByFuncionarioId($funcionario_id);

        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado.'], 404);
        }

        $vacinas = $funcionario->vacinas->map(function ($vacina) {
            return [
                'id' => $vacina->id,
                'nome' => $vacina->nome,
                'lote' => $vacina->lote,
                'data_validade' => $vacina->data_validade,
                'dose' => $vacina->pivot->dose,
                'data_dose' => $vacina->pivot->data_dose,
            ];
        });

        $response = [
            'funcionario_id' => $funcionario->id,
            'nome_completo' => $funcionario->nome_completo,
            'portador_comorbidade' => $funcionario->portador_comorbidade,
            'vacinas' => $vacinas,
        ];

        return response()->json([$response]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->funcionarioVacinaRepo->addVacinaToFuncionario($data);

        return response()->json(['message' => 'Vacinação registrada com sucesso!'], 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $vacinacao = $this->funcionarioVacinaRepo->find($id);
            $this->vacinacaoUseCases->updateDose($vacinacao->dose, $request->dose, $vacinacao->data_dose, $request->data_dose);
            $vacinacao = $this->funcionarioVacinaRepo->update($vacinacao, $request->all());
            return response()->json($vacinacao);
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return response()->json(['error' => 'Não foi possível atualizar a vacinação. A vacina selecionada não está cadastrada.'], 422);
            }
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function destroy($id)
    {
        $this->funcionarioVacinaRepo->removeVacinaFromFuncionario($id);

        return response()->json(['message' => 'Registro de vacinação removido com sucesso!'], 204);
    }

    public function indexVacinasByFuncionarioId($funcionario_id)
    {
        $funcionario = $this->funcionarioVacinaRepo->findByFuncionarioId($funcionario_id);

        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado.'], 404);
        }

        $vacinas = $funcionario->vacinas->map(function ($vacina) {
            return [
                'vacinacao_id' => $vacina->vacinacao_id,
                'vacina_id' => $vacina->vacina_id,
                'nome' => $vacina->nome,
                'lote' => $vacina->lote,
                'data_validade' => $vacina->data_validade,
                'dose' => $vacina->pivot->dose,
                'data_dose' => $vacina->pivot->data_dose,
            ];
        });

        $response = [
            'funcionario_id' => $funcionario->id,
            'nome_completo' => $funcionario->nome_completo,
            'portador_comorbidade' => $funcionario->portador_comorbidade,
            'vacinas' => $vacinas,
        ];

        return response()->json([$response]);
    }
}
