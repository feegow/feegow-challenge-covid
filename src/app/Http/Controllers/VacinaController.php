<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacina;

class VacinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacinas = Vacina::all();
        return view ('vacinas.index')->with('vacinas', $vacinas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vacinas.create');
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
            'nome'=>'required',           
            'lote'=>'required',
            'dataValidade'=>'required'
        ],[
            'nome.required'  => 'Digite um nome para continuar',
            'lote.required' => 'Digite um lote válido',
            'dataValidade.required' => 'Digite um data de validade válida'
        ]);

        $input = $request->all();
        Vacina::create($input);
        return redirect('vacina')->with('flash_message', 'Vacina adicinada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vacina = Vacina::find($id);
        return view('vacinas.show')->with('vacinas', $vacina);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vacina = Vacina::find($id);
        return view('vacinas.edit')->with('vacina', $vacina);
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
            'nome'=>'required',           
            'lote'=>'required',
            'dataValidade'=>'required'
        ],[
            'nome.required'  => 'Digite um nome para continuar',
            'lote.required' => 'Digite um lote válido',
            'dataValidade.required' => 'Digite um data de validade válida'
        ]);

        $vacina = Vacina::find($id);
        $input = $request->all();
        $vacina->update($input);
        return redirect('vacina')->with('flash_menssage', 'Vacina Atualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vacina::destroy($id);
        return redirect('vacina')->with('flash_message', 'Vacina deletada');
    }
}
