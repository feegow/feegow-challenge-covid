<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VaccineRequest extends FormRequest
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
      'short_name' => 'nullable|string',
      'lot_number' => 'required|string',
      'expiration_date' => 'required|date_format:Y-m-d',
    ];

    // Add the 'name' rule with a unique check that ignores the current record when updating
    $rules['name'] = [
      'required',
      'string',
      'max:255',
      Rule::unique('vaccines')->ignore($this->route('vaccine')),
    ];

    return $rules;
  }
}
