<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\VacinaController;
use App\Http\Controllers\FuncionarioVacinaController;

// Funcionários
Route::get('funcionarios', [FuncionarioController::class, 'index']);
Route::get('funcionarios/{id}/vacinas', [FuncionarioController::class, 'indexVacinasByFuncionarioId']);
Route::get('vacinacao/{id}/funcionarios', [FuncionarioController::class, 'indexVacinacaoByVacinacaoId']);
Route::post('funcionarios', [FuncionarioController::class, 'store']);
Route::get('funcionarios/{id}', [FuncionarioController::class, 'show']);
Route::put('funcionarios/{id}', [FuncionarioController::class, 'update']);
Route::delete('funcionarios/{id}', [FuncionarioController::class, 'destroy']);


// Vacinas / Vacinacao
Route::apiResource('vacinas', VacinaController::class);

// Funcionário Vacinas
Route::get('/funcionario-vacinas', [FuncionarioVacinaController::class, 'index']);
Route::get('/funcionario-vacinas/funcionario/cpf/{funcionario_cpf}', [FuncionarioVacinaController::class, 'indexByFuncionarioCpf']);
Route::get('/funcionario-vacinas/funcionario/{id}', [FuncionarioVacinaController::class, 'indexByFuncionarioId']);
// Route::get('/funcionario-vacinas/vacina/{vacina_id}', [FuncionarioVacinaController::class, 'indexByVacinaId']);
//Route::get('/funcionario-vacinas/dose/{dose}', [FuncionarioVacinaController::class, 'indexByDose']);
//Route::get('/funcionario-vacinas/{funcionario_cpf}/{vacina_id}/{dose}', [FuncionarioVacinaController::class, 'show']);
Route::post('/funcionario-vacinas', [FuncionarioVacinaController::class, 'store']);
Route::put('/funcionario-vacinas/{funcionario_cpf}/{vacina_id}/{dose}', [FuncionarioVacinaController::class, 'update']);
Route::delete('/funcionario-vacinas/{funcionario_cpf}/{vacina_id}/{dose}', [FuncionarioVacinaController::class, 'destroy']);
