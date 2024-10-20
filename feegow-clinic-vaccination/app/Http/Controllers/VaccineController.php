<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaccineRequest;
use App\Http\Resources\VaccineResource;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 15);
        $search = $request->input('search');

        $cacheKey = "vaccines_page_{$page}_perPage_{$perPage}_search_" . md5($search);

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($perPage, $search) {
            $query = Vaccine::query();

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
                });
            }

            $vaccines = $query->orderBy('created_at', 'desc')->paginate($perPage);

            return VaccineResource::collection($vaccines);
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VaccineRequest $request)
    {
        $vaccine = Vaccine::create($request->validated());
        Cache::flush();
        return new VaccineResource($vaccine);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vaccine $vaccine)
    {
        return new VaccineResource($vaccine);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VaccineRequest $request, Vaccine $vaccine)
    {
        $vaccine->update($request->validated());
        Cache::flush();
        return new VaccineResource($vaccine);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaccine $vaccine)
    {
        $vaccine->delete();
        Cache::flush();
        return response()->noContent();
    }
}
