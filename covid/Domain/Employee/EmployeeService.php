<?php

namespace Covid\Domain\Employee;

use DateTime;
use Exception;
use Covid\Domain\Employee\DTO\EmployeeDto;
use Covid\Domain\Employee\Entity\Dose;
use Covid\Domain\Employee\Entity\Doses;
use Covid\Domain\Employee\Entity\Employee;
use Covid\Domain\Employee\Entity\Medicine;
use Covid\Domain\Employee\Entity\ValueObject\CPF;

class EmployeeService
{
    /**
     * @throws Exception
     */
    public function buildEmployeeEntity(EmployeeDto $dto): Employee
    {
        $employee = new Employee(
            new CPF($dto->cpf),
            $dto->name,
            new DateTime($dto->dob),
            $dto->comorbidities,
            new Doses()
        );
        $employee->addId($dto->id);
        foreach ($dto->doses as $doseDto) {
            if ($doseDto === null) {
                continue;
            }
            $medicineDto = $doseDto->medicine;
            $medicine = new Medicine(
                $medicineDto->name,
                $medicineDto->lot,
                new DateTime($medicineDto->expirationDate)
            );

            $medicine->addId($medicineDto->id);

            $dose = new Dose(
                $medicine,
                new DateTime($doseDto->dateApplyed),
                $doseDto->doseSequence
            );

            $dose->addId($doseDto->id);

            $employee->doses->add($dose);
        }

        return $employee;
    }
}
