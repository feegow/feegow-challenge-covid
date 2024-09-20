<?php

namespace Covid\Infrastructure\Persistence;

use Covid\Domain\Employee\Persistence\EmployeeRepository;
use Covid\Domain\Employee\Entity\Employee;
use Covid\Domain\Employee\Entity\ValueObject\CPF;

class EmployeeRespositoryEloquent implements EmployeeRepository
{
    public function save(Employee $employee): void
    {
        $employee = Employee::create([
            'cpf' => $employee->cpf->value(),
            'name' => $employee->name,
            'dob' => $employee->dob,
            'comorbidities' => $employee->comorbidities
        ]);

        $doses = $this->prepareDosesToCreate($employee->doses);

        //if (count($doses) > 0) {
            $employee->doses()->createMany($doses);
        //}
    }

    public function findByCpf(CPF $cpf): Employee
    {
        $employee = $this->dao->findByCpf($cpf->value());
        return new Employee(
            $employee->cpf,
            $employee->name,
            $employee->dob,
            $employee->comorbidities,
            $employee->doses
        );
    }

    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    public function delete(CPF $cpf): void
    {
        // TODO: Implement delete() method.
    }

    public function update(Employee $employee): void
    {
        $employee = Employee::find($employee->id);
        $employee->update([
            'cpf' => $employee->cpf->value(),
            'name' => $employee->name,
            'dob' => $employee->dob,
            'comorbidities' => $employee->comorbidities
        ]);

        $doses = $this->getNewDoses($employee->doses);

        //if (count($doses) > 0) {
            $employee->doses()->createMany($doses);
        //}
    }

    private function prepareDosesToCreate($doses): array
    {
        return $doses->map(function ($dose) {
            return [
                'medicine_id' => $dose->medicine->id,
                'date_applyed' => $dose->dateApplyed,
                'dose_sequence' => $dose->doseSequence->name
            ];
        });
    }

    private function getNewDoses($doses): array
    {
        $dosesFiltered = $doses->filter(function ($dose) {
            return $dose->id === null;
        });

        return $this->prepareDosesToCreate($dosesFiltered);
    }
}
