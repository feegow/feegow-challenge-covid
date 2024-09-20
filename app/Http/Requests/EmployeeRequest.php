<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'cpf', 'unique:employees'],
            'dob' => ['required', 'date_format:d/m/Y'],
            'comorbidities' => ['nullable'],
            'firstDose_medicine_id' => ['exists:medicines,id', 'nullable', 'required_with:firstDose_date'],
            'secondDose_medicine_id' => ['exists:medicines,id', 'nullable', 'required_with:secondDose_date'],
            'thirdDose_medicine_id' => ['exists:medicines,id', 'nullable', 'required_with:thirdDose_date'],
            'firstDose_date' => ['date_format:d/m/Y', 'nullable'],
            'secondDose_date' => ['date_format:d/m/Y', 'nullable'],
            'thirdDose_date' => ['date_format:d/m/Y', 'nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'cpf.cpf' => 'CPF inválido',
            'cpf.required' => 'CPF é obrigatório',
            'cpf.unique' => 'CPF já cadastrado',
            'name.required' => 'Nome é obrigatório',
            'dob.required' => 'Data de nascimento é obrigatória',
            'dob.date_format' => 'Data de nascimento inválida',
            'firstDose_date.date_format' => 'Data da primeira dose inválida',
            'secondDose_date.date_format' => 'Data da segunda dose inválida',
            'thirdDose_date.date_format' => 'Data da terceira dose inválida',
            'firstDose_medicine_id.exists' => 'Medicamento da primeira dose inválido',
            'secondDose_medicine_id.exists' => 'Medicamento da segunda dose inválido',
            'thirdDose_medicine_id.exists' => 'Medicamento da terceira dose inválido',
            'firstDose_medicine_id.required_with' => 'Data da primeira dose é obrigatória',
            'secondDose_medicine_id.required_with' => 'Data da segunda dose é obrigatória',
            'thirdDose_medicine_id.required_with' => 'Data da terceira dose é obrigatória',
        ];
    }
}
