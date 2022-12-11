<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Models\DoseVacinaCovid;
use App\Models\Funcionario;

class DoseVacinaCovidController extends Controller
{
    public function create(Request $request)
    {
        try {
         
        $dose = new DoseVacinaCovid();
        $dose->idFuncionario = $request->input('idFuncionario');
        $funcionario = Funcionario::Where('id', $request->input('idFuncionario'))->first();
        $dose->dtDoseCovid = $request->input('dtDoseCovid');
        $dose->nome = $request->input('nome');
        $dose->lote = $request->input('lote');
        $dose->dtValidade = $request->input('dtValidade');
   
        $dose->save();

        if($funcionario->idPrimeiraDoseCovid == null)
        {
            $funcionario->idPrimeiraDoseCovid = $dose->id;
            
        }
        else
        {
            if($funcionario->idSegundaDoseCovid == null)
            {
                $funcionario->idSegundaDoseCovid = $dose->id;
            }
            else
            {
                if($funcionario->idTerceiraDoseCovid == null)
                {
                    $funcionario->idTerceiraDoseCovid = $dose->id;
                }
            }
        }

        $funcionario->save();
        return $dose;

        }
        catch(\Exeception $ex)
        {
            Log::error($ex);
            return [  'response' => $ex->getMessage(), 'code' => $ex->getCode()];
        }
        
        
    }
    
    public function update(Request $request)
    {

        $dose = DoseVacinaCovid::Where('id', $request->input('id'))->first();
        $dose->dtDoseCovid = $request->input('dtDoseCovid');
        $dose->nome = $request->input('nome');
        $dose->lote = $request->input('lote');
        $dose->dtValidade = $request->input('dtValidade');
   
        $dose->save();

        return $dose;      
        
    }
}
