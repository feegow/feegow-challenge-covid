<?php

namespace App\Helper;

use App\Models\Dose;
use App\Models\Medicine;
use Covid\Domain\Employee\DTO\DoseDto;
use Covid\Domain\Employee\DTO\DosesDto;
use Covid\Domain\Employee\DTO\EmployeeDto;
use Covid\Domain\Employee\DTO\MedicineDto;
use Covid\Domain\Employee\Entity\DoseSequence;

class TransformDataHelper
{

    public function getDosesFromRequest(array $validated): DosesDto
    {
        $firstDose = null;
        $secondDose = null;
        $thirdDose = null;

        if (isset($validated['first_dose_date']) && $validated['first_dose_date']) {
            $firstDose = $this->makeDoseFromRequest($validated, 'first');
        }

        if (isset($validated['second_dose_date']) && $validated['second_dose_date']) {
            $secondDose = $this->makeDoseFromRequest($validated, 'second');
        }

        if (isset($validated['third_dose_date']) && $validated['third_dose_date']) {
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
            filter_var($validated['comorbidities'], FILTER_VALIDATE_BOOLEAN),
            $doses
        );
    }

    public function formatDate(string $date): string
    {
        return implode('-', array_reverse(explode('/', $date)));
    }

    public function restoreDosesApplyed(array $previousDoses, DosesDto &$dosesDto): void
    {
        foreach ($previousDoses as $doseApplyed) {
            $sequence = $doseApplyed->dose_sequence . 'Dose';
            $dosesDto->$sequence = $this->restoreDose($doseApplyed);
        }
    }

    private function restoreDose(Dose $previousDose): DoseDto
    {
        $medicineDto = new MedicineDto(
            $previousDose->medicine->name,
            $previousDose->medicine->lot,
            $previousDose->medicine->expiration_date
        );
        $medicineDto->id = $previousDose->medicine->id;

        return new DoseDto(
            $medicineDto,
            $previousDose->date_applyed->format('Y-m-d'),
            DoseSequence::from($previousDose->dose_sequence)
        );
    }
}
