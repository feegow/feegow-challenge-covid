<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    
    public function create(Request $request)
    {
        try {
         
        $funcionario = new Funcionario();
        $funcionario->nome = $request->input('nome');
        $funcionario->cpf = $request->input('cpf');
        $funcionario->dtNascimento = $request->input('dtNascimento');
        $funcionario->idPrimeiraDoseCovid = $request->input('idPrimeiraDoseCovid');
        $funcionario->idSegundaDoseCovid = $request->input('idSegundaDoseCovid');
        $funcionario->idTereceiraDoseCovid = $request->input('idTereceiraDoseCovid');
        $funcionario->comorbidade = $request->input('comorbidade');

        $funcionario->save();
        return $funcionario;

        }
        catch(\Exeception $ex)
        {
            Log::error($ex);
            return ['response' => $ex->getMessage(), 'code' => $ex->getCode()];
        }
        
        
    }

    public function find(Request $request)
    {
        try {
         
        $funcionario = Funcionario::With('dosesVacinaCovid')->where('id', $request->input('id'))->get();
        return $funcionario;

        }
        catch(\Exeception $ex)
        {
            Log::error($ex);
            return ['response' => $ex->getMessage(), 'code' => $ex->getCode()];
        }
        
        
    }
}
