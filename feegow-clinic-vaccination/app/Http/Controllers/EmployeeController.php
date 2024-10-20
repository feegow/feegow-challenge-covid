<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 15);
        $search = $request->input('search');

        $cacheKey = "employees_page_{$page}_perPage_{$perPage}_search_" . md5($search);

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($perPage, $search) {
            $query = Employee::query();

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereRaw('LOWER(full_name) LIKE ?', ['%' . strtolower($search) . '%']);
                });
            }

            $employees = $query->orderBy('created_at', 'desc')->paginate($perPage);

            return EmployeeResource::collection($employees);
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());
        Cache::flush();
        return new EmployeeResource($employee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        Cache::flush();
        return new EmployeeResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        Cache::flush();
        return response()->noContent();
    }
}
