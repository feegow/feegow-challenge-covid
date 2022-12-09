<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Models\DoseVacinaCovid;

class DoseVacinaCovidController extends Controller
{
    public function create(Request $request)
    {
        try {
         
        $dose = new DoseVacinaCovid();
        $dose->idFuncionario = $request->input('idFuncionario');
        $dose->dtDoseCovid = $request->input('dtDoseCovid');
        $dose->nome = $request->input('nome');
        $dose->lote = $request->input('lote');
        $dose->dtValidade = $request->input('dtValidade');
   
        $dose->save();
        return $dose;

        }
        catch(\Exeception $ex)
        {
            Log::error($ex);
            return ['response' => $ex->getMessage(), 'code' => $ex->getCode()];
        }
        
        
    }
}
