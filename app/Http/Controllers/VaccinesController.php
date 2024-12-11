<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;

class VaccinesController extends Controller
{
    public function index()
    {
        return view('vaccine.index');
    }

    public function create()
    {
        return view('vaccine.create');
    }

    public function apply($id = null)
    {
        return view('vaccine.apply', compact('id'));
    }

    public function edit(string $id)
    {
        $vaccine = Vaccine::find($id);

        return view('vaccine.update', compact('vaccine'));
    }

    public function destroy(string $id)
    {
        $vaccine = Vaccine::find($id);

        $vaccine->delete();

        return redirect()->route('vaccine.index');
    }
}
