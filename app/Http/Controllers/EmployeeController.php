<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.index');
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

        return redirect()->route('employee.index');
    }
}
