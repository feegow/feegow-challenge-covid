<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\VacinaController;
use App\Http\Controllers\FuncionarioVacinaController;

// Funcionários
Route::apiResource('funcionarios', FuncionarioController::class);


// Vacinas
Route::apiResource('vacinas', VacinaController::class);

Route::post('funcionario-vacina', [FuncionarioVacinaController::class, 'store']);
Route::patch('funcionario-vacina/{funcionario_cpf}/{vacina_id}/{dose}', [FuncionarioVacinaController::class, 'update']);
Route::delete('funcionario-vacina/{funcionario_cpf}/{vacina_id}/{dose}', [FuncionarioVacinaController::class, 'destroy']);
