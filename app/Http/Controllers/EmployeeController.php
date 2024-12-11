<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->paginate(20);

        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function edit(string $id)
    {
        $employee = Employee::with('user')->find($id);

        return view('employee.update', compact('employee'));
    }

    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        $employee->delete();
    }
}
