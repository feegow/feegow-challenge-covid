<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Medicine;
use Illuminate\Contracts\View\View;

class EmployeeController extends Controller
{
    public function create(): View
    {
        $medicines = Medicine::all();
        return view('employee.create', compact('medicines'));
    }

    public function store(EmployeeRequest $request)
    {
        $validated = $request->validated();
        dd($validated);
    }

    public function show(): View
    {
        return view('employee.show');
    }

    public function index(): View
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }
}
