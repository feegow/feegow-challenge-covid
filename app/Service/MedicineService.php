<?php

namespace App\Service;

use App\Models\Medicine;
use Illuminate\Support\Facades\Cache;

class MedicineService
{
    public static function getAll()
    {
        return Cache::remember('medicines-all', 60, function () {
            return Medicine::all();
        });
    }

    public static function flushCache(): void
    {
        Cache::forget('medicines-all');
    }
}
