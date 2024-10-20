<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust this based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date_format:Y-m-d',
            'vaccine_id' => 'required|exists:vaccines,id',
            'has_comorbidity' => 'required|boolean',
            'first_dose_date' => 'nullable|date_format:Y-m-d',
            'second_dose_date' => 'nullable|date_format:Y-m-d',
            'third_dose_date' => 'nullable|date_format:Y-m-d',
        ];

        if ($this->has('cpf')) {
            $rules['cpf'] = [
                'required',
                'string',
                'max:14',
                Rule::unique('employees')->ignore($this->route('employee')),
            ];
        }

        return $rules;
    }
}
