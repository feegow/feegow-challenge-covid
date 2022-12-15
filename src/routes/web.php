<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\vacinaController;
use App\Http\Controllers\FuncionarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource("/", FuncionarioController::class);
Route::resource("/funcionario", FuncionarioController::class);
Route::resource("/vacina", VacinaController::class);
