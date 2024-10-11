<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVaccineRequest;
use App\Http\Requests\UpdateVaccineRequest;
use App\Models\Vaccine;
use Illuminate\Support\Facades\Cache;

class VaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vaccines = Cache::remember('vaccines_data', 3600, function () {
            return Vaccine::all();
        });

        return response()->json($vaccines);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVaccineRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vaccine $vaccine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vaccine $vaccine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVaccineRequest $request, Vaccine $vaccine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaccine $vaccine)
    {
        //
    }
}
