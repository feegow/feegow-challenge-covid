<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFuncionarioRequest;
use App\Http\Requests\UpdateFuncionarioRequest;
use App\Repositories\FuncionarioRepository;
use App\Models\Funcionario;

/* 
 * @OA\Schema(
 *   schema="StoreFuncionarioRequest",
 *   type="object",
 *   @OA\Property(
 *     property="cpf",
 *     type="string",
 *     format="regex:/^\d{11}$/",
 *     description="CPF do Funcionário"
 *   ),
 *   @OA\Property(
 *     property="nome_completo",
 *     type="string",
 *     description="Nome completo do Funcionário"
 *   ),
 *   @OA\Property(
 *     property="data_nascimento",
 *     type="string",
 *     format="date",
 *     description="Data de nascimento do Funcionário"
 *   ),
 *   @OA\Property(
 *     property="portador_comorbidade",
 *     type="boolean",
 *     description="Indica se o funcionário é portador de comorbidades"
 *   )
 * )
 *
 * @OA\Schema(
 *   schema="UpdateFuncionarioRequest",
 *   type="object",
 *   allOf={
 *     @OA\Schema(ref="#/components/schemas/StoreFuncionarioRequest"),
 *   }
 * )
 */
class FuncionarioController extends Controller
{
    protected $funcionarioRepo;

    public function __construct(FuncionarioRepository $funcionarioRepo)
    {
        $this->funcionarioRepo = $funcionarioRepo;
    }

    /**
     * @OA\Get(
     *     path="/api/funcionarios",
     *     tags={"Funcionarios"},
     *     summary="Lista todos os funcionários",
     *     @OA\Response(
     *         response=200,
     *         description="Operação bem-sucedida",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nenhum Funcionário encontrado.",
     *     )
     * )
     */
    public function index()
    {
        $funcionarios = $this->funcionarioRepo->getAll();
        if (!$funcionarios) {
            return response()->json(['message' => 'Nenhum Funcionário encontrado.'], 404);
        }
        return response()->json($funcionarios);
    }

    /**
     * @OA\Post(
     *     path="/api/funcionarios",
     *     tags={"Funcionarios"},
     *     summary="Cria um novo funcionário",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"cpf", "nome_completo", "data_nascimento", "portador_comorbidade"},
     *             @OA\Property(property="cpf", type="string", format="regex:/^\d{11}$/", example="12345678900"),
     *             @OA\Property(property="nome_completo", type="string", example="João Silva"),
     *             @OA\Property(property="data_nascimento", type="string", format="date", example="1990-01-01"),
     *             @OA\Property(property="portador_comorbidade", type="boolean", example=true),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Funcionário criado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Funcionário não encontrado.",
     *     ),
     * )
     */
    public function store(StoreFuncionarioRequest $request)
    {
        $funcionario = Funcionario::create($request->validated());
        return response()->json($funcionario, 201);
    }
   

    /**
     * @OA\Get(
     *     path="/api/funcionarios/{id}",
     *     tags={"Funcionarios"},
     *     summary="Exibe um funcionário específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operação bem-sucedida",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Funcionário não encontrado.",
     *     )
     * )
     */
    public function show($id)
    {
        $funcionario = $this->funcionarioRepo->find($id);
        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado.'], 404);
        }
        return response()->json($funcionario);
    }

    /**
     * @OA\Put(
     *     path="/api/funcionarios/{funcionario}",
     *     tags={"Funcionarios"},
     *     summary="Atualiza um funcionário específico",
     *     @OA\Parameter(
     *         name="funcionario",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"cpf", "nome_completo", "data_nascimento", "portador_comorbidade"},
     *             @OA\Property(property="cpf", type="string", format="regex:/^\d{11}$/", example="12345678900"),
     *             @OA\Property(property="nome_completo", type="string", example="João Silva"),
     *             @OA\Property(property="data_nascimento", type="string", format="date", example="1990-01-01"),
     *             @OA\Property(property="portador_comorbidade", type="boolean", example=true),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Funcionário atualizado com sucesso"
     *     ),
    *     @OA\Response(
     *         response=404,
     *         description="Funcionário não encontrado.",
     *     )
     * )
     */
    public function update(UpdateFuncionarioRequest $request, Funcionario $funcionario)
    {
        $funcionario->update($request->validated());
        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado.'], 404);
        }
        return response()->json($funcionario);
    }

    /**
     * @OA\Delete(
     *     path="/api/funcionarios/{id}",
     *     tags={"Funcionarios"},
     *     summary="Deleta um funcionário específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Funcionário deletado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Funcionário não encontrado.",
     *     )
     * )
     */
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
