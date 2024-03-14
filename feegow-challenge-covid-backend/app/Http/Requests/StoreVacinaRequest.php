<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVacinaRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'lote' => 'required|string|max:255',
            'data_validade' => 'required|date',
        ];
    }
}
