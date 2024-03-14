<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVacinaRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'nome' => 'sometimes|required|string|max:255',
            'lote' => 'sometimes|required|string|max:255',
            'data_validade' => 'sometimes|required|date',
        ];
    }
}
