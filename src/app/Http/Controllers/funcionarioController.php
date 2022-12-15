<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Vacina;

class funcionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionarios = Funcionario::all();
        return view ('funcionarios.index')->with('funcionarios', $funcionarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vacinas = Vacina::all();
        return view('funcionarios.create')->with('vacinas', $vacinas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomeCompleto'=>'required',           
            'cpf'=>'required|cpf',
            'dataNascimento'=>'required'
        ],[
            'nomeCompleto.required'  => 'Digite um nome para continuar',
            'cpf.required' => 'Digite um CPF válido',
            'dataNascimento.required' => 'Digite uma data de nascimento válida'
        ]);

        $input = $request->all();
        $input['portadorComorbidade'] = (isset($input['portadorComorbidade']) && $input['portadorComorbidade'] == 'on');
        $input['vacinaAplicada'] = (isset($input['vacinaAplicada']) && $input['vacinaAplicada'] == 'on');

        $funcionario = Funcionario::where('cpf', $input['cpf'])->exists();
        
        if($funcionario){
            return redirect()->to('/create')->withErrors(['message1'=>'CPF já cadastrado']);
        }

        Funcionario::create($input);
        return redirect('/')->with('flash_message', 'Funcionário adicinado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $funcionarios = Funcionario::find($id);
        $vacinas = Vacina::find($funcionarios['vacinaAplicada_id']);
        return view('funcionarios.show')->with('funcionarios', $funcionarios)->with('vacinas', $vacinas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $funcionario = Funcionario::find($id);
        $vacinas = Vacina::all();
        return view('funcionarios.edit')->with('funcionario', $funcionario)->with('vacinas', $vacinas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomeCompleto'=>'required',           
            'cpf'=>'required|cpf',
            'dataNascimento'=>'required'
        ],[
            'nomeCompleto.required'  => 'Digite um nome para continuar',
            'cpf.required' => 'Digite um CPF válido',
            'dataNascimento.required' => 'Digite uma data de nascimento válida'
        ]);

        $funcionario = Funcionario::find($id);
        $input = $request->all();
        $input['portadorComorbidade'] = (isset($input['portadorComorbidade']) && $input['portadorComorbidade'] == 'on');
        $input['vacinaAplicada'] = (isset($input['vacinaAplicada']) && $input['vacinaAplicada'] == 'on');

        $funcionario->update($input);
        return redirect('funcionario')->with('flash_menssage', 'Funcionario Atualizado(a)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Funcionario::destroy($id);
        return redirect('funcionario')->with('flash_message', 'Funcionario deletado(a)');
    }
}
