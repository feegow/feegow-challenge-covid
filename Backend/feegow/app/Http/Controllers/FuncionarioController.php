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
        $f = Funcionario::Where("cpf", $request->input('cpf'))->First();
        if($f == null)
        {
            try {
            

                $funcionario = new Funcionario();
                $funcionario->nome = $request->input('nome');
                $funcionario->cpf = $request->input('cpf');
                $funcionario->dtNascimento = date($request->input('dtNascimento'));
                $funcionario->idPrimeiraDoseCovid = $request->input('idPrimeiraDoseCovid');
                $funcionario->idSegundaDoseCovid = $request->input('idSegundaDoseCovid');
                $funcionario->idTerceiraDoseCovid = $request->input('idTerceiraDoseCovid');
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
        else
        {
            return ['erro' => true, 'response' => "Colaborador já cadastrado!", 'code' => 400];
        }
        
    }

    public function update(Request $request)
    {
                $f = Funcionario::Where("cpf", $request->input('cpf'))->first();
        
                $f->nome = $request->input('nome');
                $f->cpf = $request->input('cpf');
                $f->dtNascimento = date($request->input('dtNascimento'));
                $f->idPrimeiraDoseCovid = $request->input('idPrimeiraDoseCovid');
                $f->idSegundaDoseCovid = $request->input('idSegundaDoseCovid');
                $f->idTerceiraDoseCovid = $request->input('idTerceiraDoseCovid');
                $f->comorbidade = $request->input('comorbidade');
                
                $f->save();

                
                return $f;
       
        
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
   
    public function findAllLike(Request $request)
    {
        try {
         
        $funcionario = Funcionario::With('dosesVacinaCovid')->where('nome', 'LIKE', '%'.$request->input('nome').'%');
        return $funcionario->paginate(12);

        }
        catch(\Exeception $ex)
        {
            Log::error($ex);
            return ['response' => $ex->getMessage(), 'code' => $ex->getCode()];
        }
        
        
    }
    
    
    public function findAll(Request $request)
    {
        try {
         
        $funcionario = Funcionario::With('dosesVacinaCovid');
        return $funcionario->paginate(12);

        }
        catch(\Exeception $ex)
        {
            Log::error($ex);
            return ['response' => $ex->getMessage(), 'code' => $ex->getCode()];
        }
        
        
    }


}
