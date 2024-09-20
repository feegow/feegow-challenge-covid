<?php

namespace App\Http\Controllers;

use App\Models\Medicine;

class MedicineController extends Controller
{

    public function index()
    {
        $medicines = Medicine::all();
        return view('medicine.index', compact('medicines'));
    }
}
