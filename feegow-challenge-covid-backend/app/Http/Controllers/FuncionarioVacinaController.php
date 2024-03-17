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
   /**
     * @OA\Get(
     *     path="/api/funcionario-vacinas",
     *     tags={"FuncionarioVacina"},
     *     summary="Lista todas as vacinações de funcionários",
     *     operationId="index",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de vacinações de funcionários",
     *     ),
     * )
     */
    public function index()
    {
        $funcionarioVacinas = Funcionario::with('vacinas')->get();
        return response()->json($funcionarioVacinas);
    }

    /**
     * @OA\Get(
     *     path="/funcionario-vacina/{funcionario_id}/{vacina_id}",
     *     tags={"FuncionarioVacina"},
     *     summary="Retorna detalhes de uma vacinação específica de um funcionário",
     *     operationId="show",
     *     @OA\Parameter(
     *         name="funcionario_id",
     *         in="path",
     *         description="ID do funcionário",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="vacina_id",
     *         in="path",
     *         description="ID da vacina",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes da vacinação",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vacinação não encontrada",
     *     ),
     * )
     */
    public function show($id)
    {
        $funcionarioVacinaRepo = $this->funcionarioVacinaRepo->find($id);
        if (!$funcionarioVacinaRepo) {
            return response()->json(['message' => 'Vacinação não encontrada.'], 404);
        }
        return response()->json($funcionarioVacinaRepo);
    }

    /**
     * @OA\Get(
     *     path="/funcionario-vacina/vacina/{vacina_id}",
     *     tags={"FuncionarioVacina"},
     *     summary="Lista todas as vacinações de funcionários por ID de vacina",
     *     operationId="indexByVacinaId",
     *     @OA\Parameter(
     *         name="vacina_id",
     *         in="path",
     *         description="ID da vacina",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de vacinações de funcionários por ID de vacina",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nenhuma vacinação de funcionário encontrada",
     *     ),
     * )
     */
    public function indexByVacinaId($vacina_id)
    {
        $funcionarioVacinas = $this->funcionarioVacinaRepo->findByVacinaId($vacina_id);

        if ($funcionarioVacinas->isEmpty()) {
            return response()->json(['message' => 'Nenhuma vacinação de funcionário encontrada.'], 404);
        }

        return response()->json($funcionarioVacinas);
    }

    /**
     * @OA\Get(
     *     path="/funcionario-vacina/funcionario/{funcionario_id}",
     *     tags={"FuncionarioVacina"},
     *     summary="Lista todas as vacinações de um funcionário por ID de funcionário",
     *     operationId="indexByFuncionarioId",
     *     @OA\Parameter(
     *         name="funcionario_id",
     *         in="path",
     *         description="ID do funcionário",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de vacinações de um funcionário por ID de funcionário",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Funcionário não encontrado",
     *     ),
     * )
     */
    public function indexByFuncionarioId($funcionario_id)
    {
        $funcionario = Funcionario::with(['vacinas' => function ($query) {
            $query->select('vacinas.id', 'vacinas.nome', 'vacinas.lote',  'vacinas.data_validade', 'funcionarios_vacinas.dose', 'funcionarios_vacinas.data_dose');
        }])->find($funcionario_id);

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

    /**
     * @OA\Get(
     *     path="/funcionario-vacina/funcionario/cpf/{funcionario_cpf}",
     *     tags={"FuncionarioVacina"},
     *     summary="Lista todas as vacinações de um funcionário por CPF de funcionário",
     *     operationId="indexByFuncionarioCpf",
     *     @OA\Parameter(
     *         name="funcionario_cpf",
     *         in="path",
     *         description="CPF do funcionário",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de vacinações de um funcionário por CPF de funcionário",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Funcionário não encontrado",
     *     ),
     * )
     */
    public function indexByFuncionarioCpf($funcionario_cpf)
    {
        $funcionario = Funcionario::with(['vacinas' => function ($query) {
            $query->select('vacinas.id', 'vacinas.nome', 'vacinas.lote', 'vacinas.data_validade', 'funcionarios_vacinas.dose', 'funcionarios_vacinas.data_dose');
        }])->where('cpf', $funcionario_cpf)->first();
        
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

    /**
     * @OA\Post(
     *     path="/funcionario-vacina",
     *     tags={"FuncionarioVacina"},
     *     summary="Registra uma nova vacinação para um funcionário",
     *     operationId="store",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"funcionario_cpf", "vacina_id", "data_dose", "dose"},
     *             @OA\Property(property="funcionario_cpf", type="string", example="12345678900"),
     *             @OA\Property(property="vacina_id", type="integer", example="1"),
     *             @OA\Property(property="data_dose", type="string", format="date", example="2024-03-14"),
     *             @OA\Property(property="dose", type="integer", example="1"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Vacinação registrada com sucesso!",
     *     ),
     * )
     */
    public function store(Request $request)
    {
        // Validação e lógica de request...
        $this->funcionarioVacinaRepo->addVacinaToFuncionario($request->funcionario_cpf, $request->vacina_id, [
            'data_dose' => $request->data_dose,
            'dose' => $request->dose
        ]);

        return response()->json(['message' => 'Vacinação registrada com sucesso!'], 201);
    }

    /**
     * @OA\Put(
     *     path="/funcionario-vacina/{funcionario_cpf}/{vacina_id}/{dose}",
     *     tags={"FuncionarioVacina"},
     *     summary="Atualiza os detalhes de uma vacinação específica de um funcionário",
     *     operationId="update",
     *     @OA\Parameter(
     *         name="funcionario_cpf",
     *         in="path",
     *         description="CPF do funcionário",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="vacina_id",
     *         in="path",
     *         description="ID da vacina",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="dose",
     *         in="path",
     *         description="Dose da vacina",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"data_dose"},
     *             @OA\Property(property="data_dose", type="string", format="date", example="2024-03-14"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Registro de vacinação atualizado com sucesso!",
     *     ),
     * )
     */
    // public function update(Request $request, $funcionario_cpf, $vacina_id, $dose)
    // {
    //     // Validação e lógica de request...
    //     $this->funcionarioVacinaRepo->updateVacinaFuncionario($funcionario_cpf, $vacina_id, $dose, ['data_dose' => $request->data_dose]);

    //     return response()->json(['message' => 'Registro de vacinação atualizado com sucesso!']);
    // }

    public function update(Request $request, $id)
    {
        try {
            $vacinacao = $this->funcionarioVacinaRepo->find($id);
            $this->vacinacaoUseCases->updateDose($vacinacao->dose, $request->dose);
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


    /**
     * @OA\Delete(
     *     path="/funcionario-vacina/{funcionario_cpf}/{vacina_id}/{dose}",
     *     tags={"FuncionarioVacina"},
     *     summary="Remove uma vacinação específica de um funcionário",
     *     operationId="destroy",
     *     @OA\Parameter(
     *         name="funcionario_cpf",
     *         in="path",
     *         description="CPF do funcionário",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="vacina_id",
     *         in="path",
     *         description="ID da vacina",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="dose",
     *         in="path",
     *         description="Dose da vacina",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Registro de vacinação removido com sucesso!",
     *     ),
     * )
     */
    public function destroy($funcionario_cpf, $vacina_id, $dose)
    {
        $this->funcionarioVacinaRepo->removeVacinaFromFuncionario($funcionario_cpf, $vacina_id, $dose);

        return response()->json(['message' => 'Registro de vacinação removido com sucesso!'], 204);
    }
}