<?php

namespace App\Http\Controllers;

use App\Helper\TransformDataHelper;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Employee;
use App\Models\Medicine;
use covid\Application\UseCase\CreateEmployee;
use covid\Application\UseCase\UpdateEmployee;
use DomainException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    private TransformDataHelper $helper;
    public function __construct()
    {
        $this->helper = new TransformDataHelper();
    }

    public function create(): View
    {
        $medicines = Medicine::all();
        return view('employee.create', compact('medicines'));
    }

    public function edit($cpf)
    {
        $cpf = base64_decode($cpf);
        $employee = Employee::with('doses')->where('cpf', $cpf)->first();
        $doses = $employee->doses->keyBy('dose_sequence')->all();
        $medicines = Medicine::all();
        return view('employee.edit', compact('employee', 'medicines', 'doses'));
    }

    public function update(EmployeeUpdateRequest $request, $cpf)
    {
        try {
            $validated = $request->validated();
            $cpf = base64_decode($cpf);
            $validated['cpf'] = $cpf;
            $employee = Employee::with('doses.medicine')->where('cpf', $cpf)->first();
            $previousDoses = $employee->doses->keyBy('dose_sequence')->all();

            $dosesDto = $this->helper->getDosesFromRequest($validated);
            $this->helper->restoreDosesApplyed($previousDoses, $dosesDto);
            $employeeDto = $this->helper->buildEmployeeDtoEntity($validated, $dosesDto);
            app()->make(UpdateEmployee::class)->handle($employeeDto);
        } catch (DomainException $de) {
            Log::error($de->getMessage(), [$de->getTrace()]);
            return redirect()->back()
                ->with('error', $de->getMessage())
                ->withInput();
        } catch (\Exception $e) {
            Log::error($e->getMessage(), [$e->getTrace()]);
            return redirect()->back()
                ->with('error', 'Erro ao atualizar funcionário')
                ->withInput();
        }

        return redirect()->route('employee.index')->with('success', 'Funcionário atualizado com sucesso');
    }

    public function store(EmployeeRequest $request)
    {
        $validated = $request->validated();
        DB::beginTransaction();
        try {
            $dosesDto = $this->helper->getDosesFromRequest($validated);
            $employeeDto = $this->helper->buildEmployeeDtoEntity($validated, $dosesDto);
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
        $employees = Employee::paginate(10);
        return view('employee.index', compact('employees'));
    }
}
