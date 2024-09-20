<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employee/create', 'App\Http\Controllers\EmployeeController@create')->name('employee.create');
Route::post('/employee/store', 'App\Http\Controllers\EmployeeController@store')->name('employee.store');
Route::get('/employee/show', 'App\Http\Controllers\EmployeeController@show')->name('employee.show');
Route::get('/employee/index', 'App\Http\Controllers\EmployeeController@index')->name('employee.index');

Route::get('/medicine/index', 'App\Http\Controllers\MedicineController@index')->name('medicine.index');
Route::get('/report/index', 'App\Http\Controllers\ReportController@index')->name('report.index');

