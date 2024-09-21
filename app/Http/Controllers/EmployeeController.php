<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Medicine;
use App\Service\EmployeeService;
use Covid\Application\CreateEmployee;
use DomainException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    private EmployeeService $service;
    public function __construct()
    {
        $this->service = new EmployeeService();
    }

    public function create(): View
    {
        $medicines = Medicine::all();
        return view('employee.create', compact('medicines'));
    }

    public function store(EmployeeRequest $request)
    {
        $validated = $request->validated();
        DB::beginTransaction();
        try {
            $dosesDto = $this->service->getDosesFromRequest($validated);
            $employeeDto = $this->service->buildEmployeeDtoEntity($validated, $dosesDto);
            app()->make(CreateEmployee::class)->handle($employeeDto);
            DB::commit();

        } catch (DomainException $de) {
            DB::rollBack();
            Log::error($de->getMessage(), [$de->getTrace()]);
            return redirect()->back()
                ->with('error', $de->getMessage())
                ->withInput();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), [$e->getTrace()]);
            return redirect()->back()
                ->with('error', 'Erro ao cadastrar funcionário')
                ->withInput();
        }

        return redirect()->route('employee.index')->with('success', 'Funcionário cadastrado com sucesso');
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
