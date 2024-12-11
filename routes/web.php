<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VaccinesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('site');
})->name('site');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::get('/employees/update/{id}/', [EmployeeController::class, 'edit'])->name('employee.update');
    Route::delete('/employees/delete/{id}/', [EmployeeController::class, 'destroy'])->name('employee.delete');

    Route::get('/vaccines', [VaccinesController::class, 'index'])->name('vaccine.index');
    Route::get('/vaccines/create', [VaccinesController::class, 'create'])->name('vaccine.create');
    Route::get('/vaccines/update/{id}/', [VaccinesController::class, 'edit'])->name('vaccine.update');
    Route::delete('/vaccines/delete/{id}/', [VaccinesController::class, 'destroy'])->name('vaccine.delete');

    Route::get('/vaccines/apply/{id}/', [VaccinesController::class, 'apply'])->name('vaccine.apply');
});

require __DIR__.'/auth.php';
