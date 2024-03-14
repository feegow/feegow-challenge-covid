<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFuncionarioRequest extends FormRequest
{
    public function authorize()
    {
        return false; // Altere conforme necessário para sua lógica de autorização
    }

    public function rules()
    {
        return [
            'cpf' => 'required|string|max:11|unique:funcionarios,cpf',
            'nome_completo' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'portador_comorbidade' => 'required|boolean',
        ];
    }
}
