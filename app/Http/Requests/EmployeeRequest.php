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
            'first_dose_medicine_id' => ['exists:medicines,id', 'nullable', 'required_with:first_dose_date'],
            'second_dose_medicine_id' => ['exists:medicines,id', 'nullable', 'required_with:second_dose_date'],
            'third_dose_medicine_id' => ['exists:medicines,id', 'nullable', 'required_with:third_dose_date'],
            'first_dose_date' => ['date_format:d/m/Y', 'nullable'],
            'second_dose_date' => ['date_format:d/m/Y', 'nullable'],
            'third_dose_date' => ['date_format:d/m/Y', 'nullable'],
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
            'first_dose_date.date_format' => 'Data da primeira dose inválida',
            'second_dose_date.date_format' => 'Data da segunda dose inválida',
            'third_dose_date.date_format' => 'Data da terceira dose inválida',

            'first_dose_medicine_id.exists' => 'Medicamento da primeira dose inválido',
            'second_dose_medicine_id.exists' => 'Medicamento da segunda dose inválido',
            'third_dose_medicine_id.exists' => 'Medicamento da terceira dose inválido',

            'first_dose_medicine_id.required_with' => 'Vacina da primeira dose é obrigatória',
            'second_dose_medicine_id.required_with' => 'Vacina da segunda dose é obrigatória',
            'third_dose_medicine_id.required_with' => 'Vacina da terceira dose é obrigatória',
        ];
    }
}
