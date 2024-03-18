<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\VacinaController;
use App\Http\Controllers\FuncionarioVacinaController;

// Funcionários
Route::get('funcionarios', [FuncionarioController::class, 'index']);
Route::get('vacinacao/{id}/funcionarios', [FuncionarioController::class, 'indexVacinacaoByVacinacaoId']);
Route::post('funcionarios', [FuncionarioController::class, 'store']);
Route::get('funcionarios/{id}', [FuncionarioController::class, 'show']);
Route::put('funcionarios/{id}', [FuncionarioController::class, 'update']);
Route::delete('funcionarios/{id}', [FuncionarioController::class, 'destroy']);


// Vacinas / Vacinacao
Route::apiResource('vacinas', VacinaController::class);

// Funcionário Vacinas / Vacinacao
Route::post('/vacinacao', [FuncionarioVacinaController::class, 'store']);
Route::get('vacinacao/funcionarios/{id}', [FuncionarioVacinaController::class, 'indexVacinasByFuncionarioId']);
Route::get('/vacinacao/{id}', [FuncionarioVacinaController::class, 'show']);
Route::put('/vacinacao/{id}', [FuncionarioVacinaController::class, 'update']);

