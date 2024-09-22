<?php

namespace App\Service;

use App\Models\Medicine;
use Covid\Domain\Employee\DTO\DoseDto;
use Covid\Domain\Employee\DTO\DosesDto;
use Covid\Domain\Employee\DTO\EmployeeDto;
use Covid\Domain\Employee\DTO\MedicineDto;
use Covid\Domain\Employee\Entity\DoseSequence;

class EmployeeService
{

    public function getDosesFromRequest(array $validated): DosesDto
    {
        $firstDose = null;
        $secondDose = null;
        $thirdDose = null;

        if ($validated['first_dose_date']) {
            $firstDose = $this->makeDoseFromRequest($validated, 'first');
        }

        if ($validated['second_dose_date']) {
            $secondDose = $this->makeDoseFromRequest($validated, 'second');
        }

        if ($validated['third_dose_date']) {
            $thirdDose = $this->makeDoseFromRequest($validated, 'third');
        }

        return new DosesDto($firstDose, $secondDose, $thirdDose);
    }

    private function makeDoseFromRequest(array $validated, string $doseSequence): DoseDto
    {
        $medicine = Medicine::find($validated[$doseSequence . '_dose_medicine_id']);
        $medicineDto = new MedicineDto(
            $medicine->name,
            $medicine->lot,
            $medicine->expiration_date->format('Y-m-d')
        );
        $medicineDto->id = $medicine->id;

        return new DoseDto(
            $medicineDto,
            $this->formatDate($validated[$doseSequence . '_dose_date']),
            DoseSequence::from($doseSequence)
        );
    }

    public function buildEmployeeDtoEntity(array $validated, DosesDto $doses): EmployeeDto
    {
        return new EmployeeDto(
            $validated['name'],
            $validated['cpf'],
            $this->formatDate($validated['dob']),
            $validated['comorbidities'],
            $doses
        );
    }

    private function formatDate(string $date): string
    {
        return implode('-', array_reverse(explode('/', $date)));
    }
}
