<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateVacinaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'sometimes|required|string|max:255',
            'lote' => 'sometimes|required|string|max:255',
            'data_validade' => 'sometimes|required|date',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome da vacina é obrigatório.',
            'nome.string' => 'O nome da vacina deve ser uma string.',
            'nome.max' => 'O nome da vacina não pode ter mais de 255 caracteres.',
            'lote.required' => 'O lote da vacina é obrigatório.',
            'lote.string' => 'O lote da vacina deve ser uma string.',
            'lote.max' => 'O lote da vacina não pode ter mais de 255 caracteres.',
            'data_validade.required' => 'A data de validade da vacina é obrigatória.',
            'data_validade.date' => 'A data de validade da vacina deve ser uma data válida.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Erros de validação',
            'data' => $validator->errors()
        ], 422));
    }
}
