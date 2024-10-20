<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'cpf' => $this->cpf,
            'birth_date' => $this->birth_date,
            'first_dose_date' => $this->first_dose_date,
            'second_dose_date' => $this->second_dose_date,
            'third_dose_date' => $this->third_dose_date,
            'vaccine_id' => $this->vaccine_id,
            'vaccine_short_name' => $this->vaccine ? $this->vaccine->short_name : null,
            'has_comorbidity' => $this->has_comorbidity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
