<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\DoseVacinaCovidController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('setColaborador', [FuncionarioController::class, 'create']);
Route::put('updateColaborador', [FuncionarioController::class, 'update']);
Route::get('getColaboradorById', [FuncionarioController::class, 'find']);
Route::get('getColaboradorAll', [FuncionarioController::class, 'findAll']);
Route::get('getColaboradorAllFilter', [FuncionarioController::class, 'findAllLike']);

Route::post('setDoseCovid', [DoseVacinaCovidController::class, 'create']);
Route::post('updateDoseCovid', [DoseVacinaCovidController::class, 'update']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
