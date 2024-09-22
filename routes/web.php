<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employee/edit/{cpf}', 'App\Http\Controllers\EmployeeController@edit')->name('employee.edit');
Route::put('/employee/update/{cpf}', 'App\Http\Controllers\EmployeeController@update')->name('employee.update');
Route::get('/employee/create', 'App\Http\Controllers\EmployeeController@create')->name('employee.create');
Route::post('/employee/store', 'App\Http\Controllers\EmployeeController@store')->name('employee.store');
Route::get('/employee/show', 'App\Http\Controllers\EmployeeController@show')->name('employee.show');
Route::get('/employee/index', 'App\Http\Controllers\EmployeeController@index')->name('employee.index');

Route::get('/medicine/index', 'App\Http\Controllers\MedicineController@index')->name('medicine.index');
Route::get('/medicine/create', 'App\Http\Controllers\MedicineController@create')->name('medicine.create');
Route::post('/medicine/store', 'App\Http\Controllers\MedicineController@store')->name('medicine.store');
Route::get('/report/index', 'App\Http\Controllers\ReportController@index')->name('report.index');

