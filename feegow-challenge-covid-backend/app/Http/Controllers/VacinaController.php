<?php

namespace App\Http\Controllers;

use App\Repositories\VacinaRepository;
use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class VacinaController extends Controller
{
    protected $vacinaRepo;

    public function __construct(VacinaRepository $vacinaRepo)
    {
        $this->vacinaRepo = $vacinaRepo;
    }

    /**
     * @OA\Get(
     *     path="/api/vacinas",
     *     tags={"Vacinas"},
     *     summary="Lista todas as vacinas",
     *     @OA\Response(
     *         response=200,
     *         description="Operação bem-sucedida",
     *     )
     * )
     */
    public function index()
    {
        $vacinas = $this->vacinaRepo->getAll();
        return response()->json($vacinas);
    }

    /**
     * @OA\Post(
     *     path="/api/vacinas",
     *     tags={"Vacinas"},
     *     summary="Cria uma nova vacina",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome", "lote", "data_validade"},
     *             @OA\Property(property="nome", type="string", example="Vacina X"),
     *             @OA\Property(property="lote", type="string", example="Lote123"),
     *             @OA\Property(property="data_validade", type="string", format="date", example="2024-12-31")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Vacina criada com sucesso"
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/vacinas/{id}",
     *     tags={"Vacinas"},
     *     summary="Exibe uma vacina específica",
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
     *         description="Vacina não encontrada.",
     *     )
     * )
     */
    public function show($id)
    {   
        $vacina = $this->vacinaRepo->find($id);
        if (!$vacina) {
            return response()->json(['message' => 'Vacina não encontrado.'], 404);
        }
        return response()->json($vacina);
    }

    /**
     * @OA\Put(
     *     path="/api/vacinas/{id}",
     *     tags={"Vacinas"},
     *     summary="Atualiza uma vacina específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome", "lote", "data_validade"},
     *             @OA\Property(property="nome", type="string", example="Nova Vacina X"),
     *             @OA\Property(property="lote", type="string", example="NovoLote123"),
     *             @OA\Property(property="data_validade", type="string", format="date", example="2025-12-31")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Vacina atualizada com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vacina não encontrada.",
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/vacinas/{id}",
     *     tags={"Vacinas"},
     *     summary="Deleta uma vacina específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Vacina deletada com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vacina não encontrada.",
     *     )
     * )
     */
    public function destroy($id)
    {
        $vacina = $this->vacinaRepo->find($id);
        $this->vacinaRepo->delete($vacina);
        return response()->json(null, 204);
    }
}
