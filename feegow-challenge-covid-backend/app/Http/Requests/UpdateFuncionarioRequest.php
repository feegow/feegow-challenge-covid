<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;

class UpdateFuncionarioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cpf' => ['required', 'string', 'regex:/^\d{11}$/'],
            'nome_completo' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'portador_comorbidade' => 'required|boolean',
        ];
    }
    
    public function messages()
    {
        return [
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.regex' => 'O campo CPF deve conter exatamente 11 dígitos numéricos.',
            'cpf.string' => 'O campo CPF deve ser uma sequência de números válidos.',
            'nome_completo.required' => 'O nome completo é obrigatório.',
            'nome_completo.string' => 'O nome completo deve ser uma sequência de caracteres.',
            'nome_completo.max' => 'O nome completo não pode ter mais que 255 caracteres.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.date' => 'A data de nascimento deve ser uma data válida.',
            'portador_comorbidade.required' => 'A informação sobre ser portador de comorbidade é obrigatória.',
            'portador_comorbidade.boolean' => 'A informação sobre ser portador de comorbidade deve ser um valor booleano.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 422));
    }
}
